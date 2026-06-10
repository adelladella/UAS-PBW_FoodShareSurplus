<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('welcome');
});

// REAL DB LOGIN
Route::post('/api/login', function (Request $request) {
    $email = $request->input('email');
    $password = $request->input('password');

    // 1. Coba cari user secara langsung menggunakan email terdaftar (email resmi @foodshare.id)
    $user = DB::table('users')->where('email', $email)->first();

    // 2. Fallback: Jika tidak ditemukan, periksa apakah email yang dimasukkan adalah email kontak asli yang disetujui saat registrasi
    if (!$user) {
        $reg = DB::table('registration_requests')
            ->where('email', $email)
            ->where('status', 'approved')
            ->first();
            
        if ($reg) {
            // Temukan user berdasarkan nama organisasi hasil approval registrasi tersebut
            $user = DB::table('users')
                ->where('organization_name', $reg->organization_name)
                ->first();
        }
    }

    if ($user && Hash::check($password, $user->password)) {
        return response()->json([
            'status' => 'success',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email, // Mengembalikan email resmi untuk sesi auth
                'role' => $user->role,
                'organization_name' => $user->organization_name,
                'phone' => $user->phone,
                'address' => $user->address,
            ]
        ]);
    }

    return response()->json([
        'status' => 'error',
        'message' => 'Email atau kata sandi salah. Pastikan kredensial Anda benar.'
    ], 401);
});

// GET AVAILABLE FOOD (Katalog & Live Stock)
Route::get('/api/available-food', function () {
    $food = DB::table('food_items')
        ->join('users', 'food_items.donor_id', '=', 'users.id')
        ->select('food_items.*', 'users.name as donor_name', 'users.organization_name as donor_org')
        ->where('food_items.status', 'available')
        ->where('food_items.quantity', '>', 0)
        ->orderBy('food_items.id', 'desc')
        ->get();
        
    return response()->json($food);
});

// GET DONOR'S FOOD (Donor Dashboard - Read)
Route::get('/api/donor-food/{donor_id}', function ($donor_id) {
    $food = DB::table('food_items')
        ->where('donor_id', $donor_id)
        ->orderBy('id', 'desc')
        ->get();
    return response()->json($food);
});

// ADD NEW SURPLUS FOOD (Donor Dashboard - Create)
Route::post('/api/food-items', function (Request $request) {
    $donor_id = $request->input('donor_id');

    // Cek apakah donor terdaftar, memiliki role 'donor', dan sudah diverifikasi
    $donor = DB::table('users')->where('id', $donor_id)->first();
    if (!$donor) {
        return response()->json([
            'status' => 'error',
            'message' => 'Akun donatur tidak ditemukan di dalam sistem.'
        ], 404);
    }
    if ($donor->role !== 'donor') {
        return response()->json([
            'status' => 'error',
            'message' => 'Hanya akun ber-peran Donatur yang dapat mendistribusikan makanan surplus.'
        ], 403);
    }
    if (!$donor->is_verified) {
        return response()->json([
            'status' => 'error',
            'message' => 'Akun donatur Anda belum diverifikasi oleh admin. Silakan tunggu verifikasi admin selesai.'
        ], 403);
    }

    $name = $request->input('food_name');
    $category = $request->input('category');
    $quantity = $request->input('quantity');
    $unit = $request->input('unit', 'porsi');
    $description = $request->input('description', '');
    $expired_hours = (int) $request->input('expired_hours', 4);
    $pickup_address = $request->input('pickup_address', 'Jl. Sudirman No.12, Balikpapan');

    $id = DB::table('food_items')->insertGetId([
        'donor_id' => $donor_id,
        'food_name' => $name,
        'category' => $category,
        'quantity' => $quantity,
        'unit' => $unit,
        'description' => $description,
        'expired_at' => now()->addHours($expired_hours),
        'pickup_address' => $pickup_address,
        'status' => 'available',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $inserted = DB::table('food_items')->where('id', $id)->first();
    return response()->json([
        'status' => 'success',
        'data' => $inserted
    ]);
});

// DELETE FOOD (Donor Dashboard - Delete)
Route::delete('/api/food-items/{id}', function ($id) {
    DB::table('food_items')->where('id', $id)->delete();
    return response()->json(['status' => 'success']);
});

// GET CLAIMS FOR TIMELINE & TRACKING (Lembaga - Read)
Route::get('/api/claims/{lembaga_id}', function ($lembaga_id) {
    $claims = DB::table('claims')
        ->join('food_items', 'claims.food_item_id', '=', 'food_items.id')
        ->join('users as donors', 'food_items.donor_id', '=', 'donors.id')
        ->join('users as recipient', 'claims.lembaga_id', '=', 'recipient.id')
        ->leftJoin('distributions', 'claims.id', '=', 'distributions.claim_id')
        ->select(
            'claims.*', 
            'food_items.food_name', 
            'food_items.category', 
            'donors.organization_name as donor_name',
            'donors.address as donor_address',
            'recipient.address as lembaga_address',
            'distributions.volunteer_name',
            'distributions.volunteer_phone',
            'distributions.status as dist_status',
            'distributions.notes as dist_notes',
            'distributions.delivered_at'
        )
        ->where('claims.lembaga_id', $lembaga_id)
        ->orderBy('claims.id', 'desc')
        ->get();

    return response()->json($claims);
});

// COMPLETE CLAIM / MARK DELIVERED (Lembaga - Update)
Route::post('/api/claims/{id}/delivered', function ($id) {
    $claim = DB::table('claims')->where('id', $id)->first();
    if (!$claim) {
        return response()->json([
            'status' => 'error',
            'message' => 'Klaim tidak ditemukan.'
        ], 404);
    }

    if ($claim->status !== 'approved') {
        return response()->json([
            'status' => 'error',
            'message' => 'Hanya klaim yang sudah disetujui admin yang dapat ditandai selesai.'
        ], 400);
    }

    // Update distribution status to delivered
    DB::table('distributions')->where('claim_id', $id)->update([
        'status' => 'delivered',
        'notes' => 'Makanan surplus telah sukses diterima oleh Lembaga Penerima.',
        'delivered_at' => now(),
        'updated_at' => now()
    ]);

    return response()->json(['status' => 'success']);
});

// SUBMIT CLAIM (Lembaga - Create)
Route::post('/api/claims', function (Request $request) {
    $food_item_id = $request->input('food_item_id');
    $lembaga_id = $request->input('lembaga_id');
    $quantity = $request->input('claimed_quantity');
    $pickup_method = $request->input('pickup_method');
    $notes = $request->input('notes');

    // Cek apakah lembaga terdaftar, memiliki role 'lembaga', dan sudah diverifikasi
    $lembaga = DB::table('users')->where('id', $lembaga_id)->first();
    if (!$lembaga) {
        return response()->json([
            'status' => 'error',
            'message' => 'Akun lembaga tidak ditemukan di dalam sistem.'
        ], 404);
    }
    if ($lembaga->role !== 'lembaga') {
        return response()->json([
            'status' => 'error',
            'message' => 'Hanya akun lembaga penerima yang diperbolehkan mengajukan klaim makanan.'
        ], 403);
    }
    if (!$lembaga->is_verified) {
        return response()->json([
            'status' => 'error',
            'message' => 'Akun lembaga Anda belum diverifikasi oleh admin. Tidak dapat mengajukan klaim.'
        ], 403);
    }

    // Batasi 2 klaim makanan per hari (tidak menghitung klaim yang telah ditolak)
    $today_start = now()->startOfDay();
    $today_end = now()->endOfDay();
    
    $existing_claims_today = DB::table('claims')
        ->where('lembaga_id', $lembaga_id)
        ->whereBetween('claimed_at', [$today_start, $today_end])
        ->where('status', '!=', 'rejected')
        ->count();

    if ($existing_claims_today >= 2) {
        return response()->json([
            'status' => 'error',
            'message' => 'Batas harian terlampaui. Lembaga Anda telah mencapai batas maksimal 2 kali klaim hari ini.'
        ], 429);
    }

    // Fetch food item to check stock
    $food = DB::table('food_items')->where('id', $food_item_id)->first();
    if (!$food || $food->quantity < $quantity) {
        return response()->json([
            'status' => 'error',
            'message' => 'Stok tidak mencukupi atau item tidak ditemukan.'
        ], 400);
    }

    // Insert claim
    $claim_id = DB::table('claims')->insertGetId([
        'food_item_id' => $food_item_id,
        'lembaga_id' => $lembaga_id,
        'claimed_quantity' => $quantity,
        'pickup_method' => $pickup_method,
        'notes' => $notes,
        'status' => 'pending',
        'claimed_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Update food item stock
    $new_qty = $food->quantity - $quantity;
    DB::table('food_items')->where('id', $food_item_id)->update([
        'quantity' => $new_qty,
        'status' => $new_qty <= 0 ? 'claimed' : 'available',
        'updated_at' => now()
    ]);

    // Insert initial distribution entry
    DB::table('distributions')->insert([
        'claim_id' => $claim_id,
        'volunteer_name' => 'Budi Santoso',
        'volunteer_phone' => '081299887766',
        'status' => 'pending',
        'notes' => 'Menunggu validasi admin.',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json([
        'status' => 'success',
        'claim_id' => $claim_id
    ]);
});

// GET ADMIN ALL CLAIMS (Admin - Read)
Route::get('/api/admin/pending-claims', function () {
    $claims = DB::table('claims')
        ->join('food_items', 'claims.food_item_id', '=', 'food_items.id')
        ->join('users as donors', 'food_items.donor_id', '=', 'donors.id')
        ->join('users as lembaga', 'claims.lembaga_id', '=', 'lembaga.id')
        ->select(
            'claims.*',
            'food_items.food_name',
            'donors.organization_name as donor_name',
            'lembaga.organization_name as lembaga_name'
        )
        ->orderBy('claims.id', 'desc')
        ->get();

    return response()->json($claims);
});

// VERIFY CLAIM: APPROVE OR REJECT (Admin - Update)
Route::post('/api/admin/claims/{id}/verify', function (Request $request, $id) {
    $status = $request->input('status'); // approved, rejected

    $claim = DB::table('claims')->where('id', $id)->first();
    if (!$claim) {
        return response()->json([
            'status' => 'error',
            'message' => 'Klaim tidak ditemukan.'
        ], 404);
    }

    if ($status === 'approved') {
        // Prinsip Tercepat: Cek apakah sudah ada klaim lain untuk makanan yang sama yang statusnya disetujui
        $already_approved = DB::table('claims')
            ->where('food_item_id', $claim->food_item_id)
            ->where('status', 'approved')
            ->where('id', '!=', $id)
            ->exists();

        if ($already_approved) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyetujui klaim. Makanan surplus ini telah disetujui untuk diklaim oleh lembaga lain terlebih dahulu (Prinsip Tercepat).'
            ], 400);
        }
    }

    DB::table('claims')->where('id', $id)->update([
        'status' => $status,
        'approved_at' => $status === 'approved' ? now() : null,
        'updated_at' => now()
    ]);

    // Update distribution
    if ($status === 'approved') {
        $claimRecord = DB::table('claims')->where('id', $id)->first();
        if ($claimRecord && $claimRecord->pickup_method === 'pickup') {
            $pickup_deadline = $request->input('pickup_deadline', '2 jam dari sekarang');
            DB::table('distributions')->where('claim_id', $id)->update([
                'status' => 'ready_for_pickup',
                'notes' => 'Siap diambil mandiri oleh Lembaga. Batas waktu pengambilan: ' . $pickup_deadline,
                'updated_at' => now()
            ]);
        } else {
            DB::table('distributions')->where('claim_id', $id)->update([
                'status' => 'in_delivery',
                'notes' => 'Relawan sedang mengambil makanan.',
                'updated_at' => now()
            ]);
        }

        // Auto-reject any other competing pending claims for the same food item
        $other_pending_claims = DB::table('claims')
            ->where('food_item_id', $claim->food_item_id)
            ->where('status', 'pending')
            ->where('id', '!=', $id)
            ->pluck('id');

        if ($other_pending_claims->isNotEmpty()) {
            DB::table('claims')->whereIn('id', $other_pending_claims)->update([
                'status' => 'rejected',
                'updated_at' => now()
            ]);

            DB::table('distributions')->whereIn('claim_id', $other_pending_claims)->update([
                'status' => 'rejected',
                'notes' => 'Klaim dibatalkan secara otomatis karena makanan surplus sudah disetujui untuk lembaga lain terlebih dahulu (Prinsip Tercepat).',
                'updated_at' => now()
            ]);
        }
    } else {
        // Refund food stock
        $food = DB::table('food_items')->where('id', $claim->food_item_id)->first();
        if ($food) {
            DB::table('food_items')->where('id', $claim->food_item_id)->update([
                'quantity' => $food->quantity + $claim->claimed_quantity,
                'status' => 'available',
                'updated_at' => now()
            ]);
        }
        DB::table('distributions')->where('claim_id', $id)->update([
            'status' => 'rejected',
            'notes' => 'Klaim ditolak oleh donatur/administrator.',
            'updated_at' => now()
        ]);
    }

    return response()->json(['status' => 'success']);
});

// DISTRIBUTE CLAIM / MARK DISTRIBUTED (Lembaga - Update)
Route::post('/api/claims/{id}/distributed', function ($id) {
    $claim = DB::table('claims')->where('id', $id)->first();
    if (!$claim) {
        return response()->json([
            'status' => 'error',
            'message' => 'Klaim tidak ditemukan.'
        ], 404);
    }

    // Update distribution status to distributed
    DB::table('distributions')->where('claim_id', $id)->update([
        'status' => 'distributed',
        'notes' => 'Makanan surplus telah sukses disalurkan kepada penerima manfaat di lokasi tujuan.',
        'updated_at' => now()
    ]);

    return response()->json(['status' => 'success']);
});

// GET DASHBOARD STATS (Admin & Global)
Route::get('/api/admin/stats', function () {
    $total_saved = DB::table('claims')->where('status', 'approved')->sum('claimed_quantity');
    $active_donors = DB::table('users')->where('role', 'donor')->count();
    $lembaga_count = DB::table('users')->where('role', 'lembaga')->count();
    $pending_claims = DB::table('claims')->where('status', 'pending')->count();

    return response()->json([
        'total_saved' => $total_saved + 247, // Offset base
        'active_donors' => $active_donors,
        'lembaga_count' => $lembaga_count,
        'pending_claims' => $pending_claims
    ]);
});

// GET ADMIN RESCUED DETAILS
Route::get('/api/admin/rescued-details', function () {
    $details = DB::table('claims')
        ->join('food_items', 'claims.food_item_id', '=', 'food_items.id')
        ->join('users as donors', 'food_items.donor_id', '=', 'donors.id')
        ->join('users as lembaga', 'claims.lembaga_id', '=', 'lembaga.id')
        ->select(
            'claims.id',
            'claims.claimed_quantity',
            'claims.approved_at',
            'food_items.food_name',
            'food_items.unit',
            'donors.organization_name as donor_name',
            'lembaga.organization_name as lembaga_name'
        )
        ->where('claims.status', 'approved')
        ->orderBy('claims.approved_at', 'desc')
        ->get();
    return response()->json($details);
});

// GET ADMIN ACTIVE DONORS
Route::get('/api/admin/active-donors', function () {
    $donors = DB::table('users')
        ->where('role', 'donor')
        ->select('id', 'name', 'organization_name', 'email', 'phone', 'address')
        ->orderBy('id', 'asc')
        ->get();
    $result = [];
    foreach ($donors as $donor) {
        $total_shared = DB::table('food_items')
            ->where('donor_id', $donor->id)
            ->sum('quantity');
        $donor->total_shared = $total_shared;
        $result[] = $donor;
    }
    return response()->json($result);
});

// GET ADMIN ACTIVE LEMBAGA
Route::get('/api/admin/active-lembaga', function () {
    $lembagas = DB::table('users')
        ->where('role', 'lembaga')
        ->select('id', 'name', 'organization_name', 'email', 'phone', 'address')
        ->orderBy('id', 'asc')
        ->get();
    $result = [];
    foreach ($lembagas as $lembaga) {
        $total_claims = DB::table('claims')
            ->where('lembaga_id', $lembaga->id)
            ->sum('claimed_quantity');
        $lembaga->total_claims = $total_claims;
        $result[] = $lembaga;
    }
    return response()->json($result);
});

// GET ADMIN ACTIVITIES REAL-TIME LOG
Route::get('/api/admin/activities', function () {
    // 1. Get food item registrations
    $food = DB::table('food_items')
        ->join('users', 'food_items.donor_id', '=', 'users.id')
        ->select(
            DB::raw("'food_added' as activity_type"),
            'food_items.created_at',
            'users.organization_name as actor_name',
            DB::raw("CONCAT('Mendaftarkan donasi ', food_items.food_name, ' (', food_items.quantity, ' ', food_items.unit, ')') as description")
        )
        ->get();

    // 2. Get claims
    $claims = DB::table('claims')
        ->join('food_items', 'claims.food_item_id', '=', 'food_items.id')
        ->join('users', 'claims.lembaga_id', '=', 'users.id')
        ->select(
            DB::raw("'claim_added' as activity_type"),
            'claims.created_at',
            'users.organization_name as actor_name',
            DB::raw("CONCAT('Mengklaim ', claims.claimed_quantity, ' porsi dari ', food_items.food_name) as description")
        )
        ->get();

    // 3. Get verifications
    $verifications = DB::table('claims')
        ->join('food_items', 'claims.food_item_id', '=', 'food_items.id')
        ->join('users', 'claims.lembaga_id', '=', 'users.id')
        ->whereNotNull('claims.approved_at')
        ->select(
            DB::raw("'claim_verified' as activity_type"),
            'claims.updated_at as created_at',
            DB::raw("'Super Admin HQ' as actor_name"),
            DB::raw("CONCAT('Menyetujui klaim #KL-00', claims.id, ' (', food_items.food_name, ' oleh ', users.organization_name, ')') as description")
        )
        ->get();

    // Combine and sort
    $merged = $food->merge($claims)->merge($verifications);
    $sorted = $merged->sortByDesc('created_at')->values()->all();

    return response()->json(array_slice($sorted, 0, 10)); // return latest 10 activities
});

// GET ALL ARTICLES (News Portal - Read)
Route::get('/api/articles', function (Request $request) {
    $category = $request->query('category');
    
    $query = DB::table('articles');
    
    if ($category && $category !== 'semua') {
        $query->where('category', $category);
    }
    
    $articles = $query->orderBy('id', 'desc')->get();
    return response()->json($articles);
});

// GET SINGLE ARTICLE
Route::get('/api/articles/{id}', function ($id) {
    DB::table('articles')->where('id', $id)->increment('views');
    $article = DB::table('articles')->where('id', $id)->first();
    
    if (!$article) {
        return response()->json([
            'status' => 'error',
            'message' => 'Artikel tidak ditemukan.'
        ], 404);
    }
    
    return response()->json($article);
});

// CREATE ARTICLE (CRUD - Create)
Route::post('/api/articles', function (Request $request) {
    $title = $request->input('title');
    $category = $request->input('category');
    $content = $request->input('content');
    $author = $request->input('author', 'Admin');
    
    if (empty($title) || empty($category) || empty($content)) {
        return response()->json([
            'status' => 'error',
            'message' => 'Judul, kategori, dan konten utama wajib diisi.'
        ], 400);
    }
    
    $emojiMap = [
        'edukasi' => '📚',
        'sosial' => '🤝',
        'tips' => '💡',
    ];
    $emoji = $emojiMap[$category] ?? '📰';
    
    // Auto-generate snippet
    $snippet = mb_strimwidth(strip_tags($content), 0, 120, '...');
    
    $id = DB::table('articles')->insertGetId([
        'title' => $title,
        'category' => $category,
        'author' => $author,
        'emoji' => $emoji,
        'content' => $content,
        'snippet' => $snippet,
        'status' => 'published',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    
    $inserted = DB::table('articles')->where('id', $id)->first();
    
    return response()->json([
        'status' => 'success',
        'data' => $inserted
    ]);
});

// UPDATE ARTICLE (CRUD - Update)
Route::put('/api/articles/{id}', function (Request $request, $id) {
    $title = $request->input('title');
    $category = $request->input('category');
    $content = $request->input('content');
    
    if (empty($title) || empty($category) || empty($content)) {
        return response()->json([
            'status' => 'error',
            'message' => 'Judul, kategori, dan konten utama wajib diisi.'
        ], 400);
    }
    
    $article = DB::table('articles')->where('id', $id)->first();
    if (!$article) {
        return response()->json([
            'status' => 'error',
            'message' => 'Artikel tidak ditemukan.'
        ], 404);
    }
    
    $emojiMap = [
        'edukasi' => '📚',
        'sosial' => '🤝',
        'tips' => '💡',
    ];
    $emoji = $emojiMap[$category] ?? '📰';
    
    $snippet = mb_strimwidth(strip_tags($content), 0, 120, '...');
    
    DB::table('articles')->where('id', $id)->update([
        'title' => $title,
        'category' => $category,
        'emoji' => $emoji,
        'content' => $content,
        'snippet' => $snippet,
        'updated_at' => now(),
    ]);
    
    $updated = DB::table('articles')->where('id', $id)->first();
    
    return response()->json([
        'status' => 'success',
        'data' => $updated
    ]);
});

// DELETE ARTICLE (CRUD - Delete)
Route::delete('/api/articles/{id}', function ($id) {
    $deleted = DB::table('articles')->where('id', $id)->delete();
    
    if (!$deleted) {
        return response()->json([
            'status' => 'error',
            'message' => 'Artikel tidak ditemukan atau sudah dihapus.'
        ], 404);
    }
    
    return response()->json([
        'status' => 'success',
        'message' => 'Artikel berhasil dihapus.'
    ]);
});

// SUBMIT REGISTRATION REQUEST (Guest - Create)
Route::post('/api/register-request', function (Request $request) {
    $orgName = $request->input('organization_name');
    $contact = $request->input('contact_person');
    $email = $request->input('email');
    $phone = $request->input('phone');
    $address = $request->input('address');
    $mapsLink = $request->input('google_maps_link');
    $role = $request->input('role', 'lembaga'); // donor or lembaga

    if (empty($orgName) || empty($contact) || empty($email) || empty($phone) || empty($address) || empty($mapsLink)) {
        return response()->json([
            'status' => 'error',
            'message' => 'Semua kolom formulir pendaftaran wajib diisi lengkap.'
        ], 400);
    }

    $id = DB::table('registration_requests')->insertGetId([
        'organization_name' => $orgName,
        'contact_person' => $contact,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'google_maps_link' => $mapsLink,
        'role' => $role,
        'status' => 'pending',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Pendaftaran berhasil dikirim! Pengajuan Anda sedang diverifikasi manual oleh Admin.',
        'data_id' => $id
    ]);
});

// GET PENDING REGISTRATION REQUESTS (Admin - Read)
Route::get('/api/admin/registration-requests', function () {
    $requests = DB::table('registration_requests')
        ->where('status', 'pending')
        ->orderBy('id', 'desc')
        ->get();
    return response()->json($requests);
});

// APPROVE REGISTRATION REQUEST (Admin - Approve & Generate User)
Route::post('/api/admin/registration-requests/{id}/approve', function (Request $request, $id) {
    $reg = DB::table('registration_requests')->where('id', $id)->first();
    if (!$reg) {
        return response()->json([
            'status' => 'error',
            'message' => 'Permohonan pendaftaran tidak ditemukan.'
        ], 404);
    }

    if ($reg->status !== 'pending') {
        return response()->json([
            'status' => 'error',
            'message' => 'Permohonan pendaftaran sudah diproses sebelumnya.'
        ], 400);
    }

    // Cleanse organization name for @foodshare.id emailprefix
    $cleanName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $reg->organization_name));
    if (empty($cleanName)) {
        $cleanName = ($reg->role === 'donor' ? 'donor' : 'lembaga') . rand(100, 999);
    }

    $baseEmail = $cleanName;
    $counter = 1;
    $generatedEmail = $baseEmail . '@foodshare.id';
    while (DB::table('users')->where('email', $generatedEmail)->exists()) {
        $generatedEmail = $baseEmail . $counter . '@foodshare.id';
        $counter++;
    }

    // Generate readable random password: foodshare + 4 random digits
    $generatedPassword = 'foodshare' . rand(1000, 9999);

    // Create user record in 'users'
    $userId = DB::table('users')->insertGetId([
        'name' => $reg->contact_person,
        'email' => $generatedEmail,
        'password' => Hash::make($generatedPassword),
        'role' => $reg->role ?? 'lembaga',
        'organization_name' => $reg->organization_name,
        'phone' => $reg->phone,
        'address' => $reg->address,
        'is_verified' => true,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Update registration request status
    DB::table('registration_requests')->where('id', $id)->update([
        'status' => 'approved',
        'updated_at' => now()
    ]);

    return response()->json([
        'status' => 'success',
        'role' => $reg->role ?? 'lembaga',
        'organization_name' => $reg->organization_name,
        'contact_person' => $reg->contact_person,
        'contact_email' => $reg->email,
        'generated_email' => $generatedEmail,
        'generated_password' => $generatedPassword
    ]);
});

// REJECT REGISTRATION REQUEST (Admin - Reject/Delete)
Route::post('/api/admin/registration-requests/{id}/reject', function (Request $request, $id) {
    $reg = DB::table('registration_requests')->where('id', $id)->first();
    if (!$reg) {
        return response()->json([
            'status' => 'error',
            'message' => 'Permohonan pendaftaran tidak ditemukan.'
        ], 404);
    }

    DB::table('registration_requests')->where('id', $id)->update([
        'status' => 'rejected',
        'updated_at' => now()
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Permohonan pendaftaran berhasil ditolak.'
    ]);
});

// GET USER STATISTICS (Donor & Lembaga)
Route::get('/api/users/{id}/stats', function ($id) {
    $user = DB::table('users')->where('id', $id)->first();
    if (!$user) {
        return response()->json(['status' => 'error', 'message' => 'User tidak ditemukan.'], 404);
    }
    
    if ($user->role === 'donor') {
        $total_items = DB::table('food_items')->where('donor_id', $id)->count();
        $total_portions = DB::table('food_items')->where('donor_id', $id)->sum('quantity');
        
        $claimed_portions = DB::table('claims')
            ->join('food_items', 'claims.food_item_id', '=', 'food_items.id')
            ->where('food_items.donor_id', $id)
            ->where('claims.status', 'approved')
            ->sum('claims.claimed_quantity');

        $pending_portions = DB::table('claims')
            ->join('food_items', 'claims.food_item_id', '=', 'food_items.id')
            ->where('food_items.donor_id', $id)
            ->where('claims.status', 'pending')
            ->sum('claims.claimed_quantity');

        $helped_count = DB::table('claims')
            ->join('food_items', 'claims.food_item_id', '=', 'food_items.id')
            ->where('food_items.donor_id', $id)
            ->where('claims.status', 'approved')
            ->distinct('claims.lembaga_id')
            ->count('claims.lembaga_id');

        $categories = DB::table('food_items')
            ->where('donor_id', $id)
            ->select('category', DB::raw('SUM(quantity) as total'))
            ->groupBy('category')
            ->get();

        $recent_donations = DB::table('food_items')
            ->where('donor_id', $id)
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();
            
        return response()->json([
            'role' => 'donor',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'organization_name' => $user->organization_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address,
            ],
            'total_items' => $total_items,
            'total_portions' => (int) $total_portions,
            'claimed_portions' => (int) $claimed_portions,
            'pending_portions' => (int) $pending_portions,
            'helped_count' => $helped_count,
            'categories' => $categories,
            'recent_donations' => $recent_donations
        ]);
        
    } else if ($user->role === 'lembaga') {
        $total_claims = DB::table('claims')->where('lembaga_id', $id)->count();
        $total_portions = DB::table('claims')->where('lembaga_id', $id)->sum('claimed_quantity');
        
        $approved_portions = DB::table('claims')
            ->where('lembaga_id', $id)
            ->where('status', 'approved')
            ->sum('claimed_quantity');
            
        $approved_count = DB::table('claims')
            ->where('lembaga_id', $id)
            ->where('status', 'approved')
            ->count();
            
        $pending_count = DB::table('claims')
            ->where('lembaga_id', $id)
            ->where('status', 'pending')
            ->count();

        $rejected_count = DB::table('claims')
            ->where('lembaga_id', $id)
            ->where('status', 'rejected')
            ->count();

        $pickup_count = DB::table('claims')
            ->where('lembaga_id', $id)
            ->where('pickup_method', 'pickup')
            ->where('status', 'approved')
            ->count();

        $delivery_count = DB::table('claims')
            ->where('lembaga_id', $id)
            ->where('pickup_method', 'delivery')
            ->where('status', 'approved')
            ->count();

        $pickup_methods = DB::table('claims')
            ->where('lembaga_id', $id)
            ->select('pickup_method', DB::raw('count(*) as count'))
            ->groupBy('pickup_method')
            ->get();

        $categories = DB::table('claims')
            ->join('food_items', 'claims.food_item_id', '=', 'food_items.id')
            ->where('claims.lembaga_id', $id)
            ->select('food_items.category', DB::raw('SUM(claims.claimed_quantity) as total'))
            ->groupBy('food_items.category')
            ->get();

        $recent_claims = DB::table('claims')
            ->join('food_items', 'claims.food_item_id', '=', 'food_items.id')
            ->where('claims.lembaga_id', $id)
            ->select('claims.*', 'food_items.food_name', 'food_items.unit')
            ->orderBy('claims.id', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'role' => 'lembaga',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'organization_name' => $user->organization_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address,
            ],
            'total_claims' => $total_claims,
            'total_portions' => (int) $total_portions,
            'approved_portions' => (int) $approved_portions,
            'approved_count' => $approved_count,
            'pending_count' => $pending_count,
            'rejected_count' => $rejected_count,
            'pickup_count' => $pickup_count,
            'delivery_count' => $delivery_count,
            'pickup_methods' => $pickup_methods,
            'categories' => $categories,
            'recent_claims' => $recent_claims
        ]);
    }
    
    return response()->json(['status' => 'error', 'message' => 'Role tidak didukung.'], 400);
});

// GET SYSTEM ERROR LOGS (Admin Debugging)
Route::get('/api/admin/logs', function () {
    $logPath = storage_path('logs/laravel.log');
    if (!file_exists($logPath)) {
        return response()->json(['logs' => 'Tidak ada berkas log yang ditemukan.']);
    }
    
    $fileSize = filesize($logPath);
    if ($fileSize === 0) {
        return response()->json(['logs' => 'Berkas log kosong (tidak ada error yang tercatat).']);
    }

    $file = new \SplFileObject($logPath, 'r');
    $file->seek(PHP_INT_MAX);
    $lastLine = $file->key();
    
    $lines = [];
    $start = max(0, $lastLine - 300);
    for ($i = $start; $i < $lastLine; $i++) {
        $file->seek($i);
        $lines[] = $file->current();
    }
    
    // Kembalikan dengan urutan terbalik agar log terbaru berada di paling atas
    return response()->json(['logs' => implode('', array_reverse($lines))]);
});

// CLEAR SYSTEM ERROR LOGS
Route::post('/api/admin/logs/clear', function () {
    $logPath = storage_path('logs/laravel.log');
    file_put_contents($logPath, '');
    return response()->json(['status' => 'success']);
});

// ============================================================
// TEMPORARY: Route untuk menjalankan migration di production
// HAPUS ROUTE INI SETELAH MIGRATION BERHASIL!
// Akses: /run-migrate?key=foodshare-migrate-2026
// ============================================================
Route::get('/run-migrate', function (Request $request) {
    // Proteksi sederhana dengan secret key
    if ($request->query('key') !== 'foodshare-migrate-2026') {
        abort(403, 'Unauthorized.');
    }

    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        $output = \Illuminate\Support\Facades\Artisan::output();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Migration berhasil dijalankan!',
            'output' => $output
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});
