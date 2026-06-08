<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Users
        DB::table('users')->insert([
            ['name'=>'Admin Sistem','email'=>'admin@foodshare.id','password'=>Hash::make('password'),'role'=>'admin','organization_name'=>'Food Share HQ','phone'=>'081200000001','address'=>'Jakarta Pusat','is_verified'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Restoran Sederhana','email'=>'donor1@foodshare.id','password'=>Hash::make('password'),'role'=>'donor','organization_name'=>'Restoran Sederhana Balikpapan','phone'=>'081200000002','address'=>'Jl. Sudirman No.12, Balikpapan','is_verified'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Katering Berkah','email'=>'donor2@foodshare.id','password'=>Hash::make('password'),'role'=>'donor','organization_name'=>'Katering Berkah Samarinda','phone'=>'081200000003','address'=>'Jl. Antasari No.45, Samarinda','is_verified'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Panti Asuhan Harapan','email'=>'lembaga1@foodshare.id','password'=>Hash::make('password'),'role'=>'lembaga','organization_name'=>'Panti Asuhan Harapan Bangsa','phone'=>'081200000004','address'=>'Jl. Pahlawan No.7, Samarinda','is_verified'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Yayasan Peduli','email'=>'lembaga2@foodshare.id','password'=>Hash::make('password'),'role'=>'lembaga','organization_name'=>'Yayasan Peduli Sesama','phone'=>'081200000005','address'=>'Jl. Gatot Subroto No.3, Samarinda','is_verified'=>1,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // Food Items
        DB::table('food_items')->insert([
            ['donor_id'=>2,'food_name'=>'Nasi Box Ayam Goreng','category'=>'makanan_berat','quantity'=>30,'unit'=>'porsi','description'=>'Nasi box lengkap dengan lauk ayam goreng, sayur, dan kerupuk.','expired_at'=>now()->addHours(4),'pickup_address'=>'Jl. Sudirman No.12, Balikpapan','status'=>'available','created_at'=>now(),'updated_at'=>now()],
            ['donor_id'=>2,'food_name'=>'Roti Tawar & Selai','category'=>'roti','quantity'=>50,'unit'=>'bungkus','description'=>'Roti tawar kemasan belum dibuka, mendekati tanggal kadaluarsa tapi masih layak.','expired_at'=>now()->addHours(12),'pickup_address'=>'Jl. Sudirman No.12, Balikpapan','status'=>'available','created_at'=>now(),'updated_at'=>now()],
            ['donor_id'=>3,'food_name'=>'Nasi Kuning Tumpeng Mini','category'=>'makanan_berat','quantity'=>20,'unit'=>'porsi','description'=>'Sisa catering acara pagi, dikemas higienis.','expired_at'=>now()->addHours(5),'pickup_address'=>'Jl. Antasari No.45, Samarinda','status'=>'claimed','created_at'=>now(),'updated_at'=>now()],
            ['donor_id'=>3,'food_name'=>'Kue Sus & Donat','category'=>'snack','quantity'=>60,'unit'=>'buah','description'=>'Kue sus dan donat dari sisa katering, masih segar.','expired_at'=>now()->addHours(6),'pickup_address'=>'Jl. Antasari No.45, Samarinda','status'=>'available','created_at'=>now(),'updated_at'=>now()],
            ['donor_id'=>2,'food_name'=>'Es Teh & Jus Kemasan','category'=>'minuman','quantity'=>40,'unit'=>'botol','description'=>'Minuman kemasan botol 350ml, belum dibuka.','expired_at'=>now()->addHours(24),'pickup_address'=>'Jl. Sudirman No.12, Balikpapan','status'=>'available','created_at'=>now(),'updated_at'=>now()],
        ]);

        // Claims
        DB::table('claims')->insert([
            ['food_item_id'=>3,'lembaga_id'=>4,'claimed_quantity'=>20,'pickup_method'=>'pickup','notes'=>'Kami siap menjemput jam 12 siang.','status'=>'approved','claimed_at'=>now(),'approved_at'=>now(),'created_at'=>now(),'updated_at'=>now()],
            ['food_item_id'=>1,'lembaga_id'=>5,'claimed_quantity'=>15,'pickup_method'=>'delivery','notes'=>'Mohon dikirim ke alamat yayasan kami.','status'=>'pending','claimed_at'=>now(),'approved_at'=>null,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // Distributions
        DB::table('distributions')->insert([
            ['claim_id'=>1,'volunteer_name'=>'Budi Santoso','volunteer_phone'=>'081299887766','status'=>'in_delivery','notes'=>'Relawan sedang dalam perjalanan.','delivered_at'=>null,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // Articles
        DB::table('articles')->insert([
            [
                'title' => '5 Cara Restoran Mengurangi Food Waste di Kota Balikpapan',
                'category' => 'edukasi',
                'author' => 'Admin',
                'emoji' => '📰',
                'content' => "Kota Balikpapan kini gencar menyuarakan kampanye kebersihan lingkungan dan pengurangan sampah, termasuk sampah pangan (food waste) dari sektor industri kuliner. Sektor restoran dan bakery menyumbang porsi sampah makanan yang cukup signifikan jika tidak dikelola dengan bijak. Bagi pemilik bisnis kuliner di Kota Minyak ini, berikut adalah 5 metode efektif dan praktis untuk mereduksi food waste secara berkala:\n\n1. Lakukan Audit Kelebihan Pangan Harian (Daily Food Waste Audit)\nLangkah awal yang krusial adalah mendokumentasikan setiap gram sisa makanan yang terbuang. Ketahui apakah sisa tersebut berasal dari proses persiapan dapur (trimming waste), sisa piring konsumen (plate waste), atau kelebihan produksi menu katering. Dengan data ini, koki dapat mendesain ukuran porsi dan rencana belanja bahan baku secara lebih presisi.\n\n2. Optimalkan Manajemen Penyimpanan Menggunakan Metode FIFO & FEFO\nPastikan gudang penyimpanan bahan kering dan lemari pendingin (chiller) menggunakan prinsip First-In First-Out (FIFO) serta First-Expired First-Out (FEFO). Pelabelan tanggal masuk yang jelas pada setiap bahan baku membantu staf dapur menggunakan bahan segar sebelum rusak, mencegah bahan makanan berharga terbuang sia-sia sebelum sempat diolah.\n\n3. Mengimplementasikan Sistem Pemesanan Berbasis Estimasi (Forecast Ordering)\nManfaatkan teknologi data atau pencatatan manual mingguan untuk melihat pola kunjungan pelanggan. Restoran dapat mengurangi menu prasmanan yang berisiko tinggi terbuang dan beralih ke menu porsi individu (a la carte), atau membatasi volume masak pada jam-jam sepi pengunjung berdasarkan perkiraan riwayat transaksi.\n\n4. Menghadirkan Edukasi Pola Konsumsi Bijak Kepada Pelanggan\nBerikan pesan ramah di buku menu atau dekorasi meja yang mengajak pelanggan memesan makanan secukupnya. Restoran juga sebaiknya memfasilitasi pembungkusan sisa makanan yang tidak habis secara higienis (takeaway box) agar pelanggan dapat menyantap kembali hidangan tersebut di rumah.\n\n5. Menyalurkan Surplus Makanan Layak Konsumsi Lewat Platform FoodShare\nKetika kelebihan makanan matang tetap terjadi, jangan biarkan makanan bersih tersebut berakhir di Tempat Pembuangan Akhir (TPA) Manggar. Gunakan aplikasi FoodShare untuk mendaftarkan surplus hidangan layak konsumsi Anda. Hanya dalam hitungan menit, lembaga sosial terdekat atau panti asuhan dapat mengklaim donasi Anda dan membagikannya secara cepat kepada saudara kita yang membutuhkan. Bersama, kita wujudkan zero food waste di Balikpapan!",
                'snippet' => 'Pelajari 5 strategi nyata dan praktis yang telah diterapkan restoran mitra untuk mengurangi food waste di Balikpapan...',
                'image_path' => null,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Mengapa 1/3 Makanan Dunia Terbuang Sia-Sia? Fakta & Solusi',
                'category' => 'edukasi',
                'author' => 'Admin',
                'emoji' => '🥗',
                'content' => "Menurut data Badan Pangan Dunia (FAO), sepertiga dari total produksi makanan untuk konsumsi manusia di seluruh dunia terbuang sia-sia setiap tahunnya. Jumlah fantastis ini setara dengan sekitar 1,3 miliar ton makanan lezat yang berakhir menjadi tumpukan sampah yang memproduksi gas metana berbahaya, berkontribusi besar pada pemanasan global.\n\nDi Indonesia sendiri, riset menunjukkan bahwa sampah makanan per kapita berkisar antara 23 hingga 48 juta ton per tahun. Tentu ini merupakan ironi yang sangat mendalam, mengingat masih banyak saudara-saudara kita yang mengalami kerawanan pangan atau gizi buruk.\n\nFaktor Utama Penyebab Food Waste Global:\n- Tahap Produksi & Panen: Di negara berkembang, keterbatasan teknologi pascapanen, kurangnya fasilitas pendingin cold-storage, serta rantai logistik yang buruk menyebabkan buah, sayur, dan biji-bijian membusuk sebelum sampai ke pasar retail.\n- Sektor Ritel & Komersial: Banyak supermarket menolak buah atau sayur yang memiliki cacat fisik minor secara visual (misalnya bengkok atau warnanya kurang cerah), meskipun kandungan nutrisinya masih 100% sempurna.\n- Konsumen Akhir: Kebiasaan berbelanja impulsif dalam jumlah berlebih (panic buying), menyajikan porsi makanan terlalu besar, hingga kurang memahami perbedaan label 'Baik Digunakan Sebelum' (Best Before) dan 'Tanggal Kedaluwarsa' (Expiry Date).\n\nSolusi Nyata yang Dapat Kita Lakukan:\nKita semua dapat berpartisipasi meredam krisis pangan ini dengan melakukan perubahan kecil namun konsisten di kehidupan sehari-hari. Mulailah membuat daftar belanja belanja sebelum pergi ke pasar, memanfaatkan bahan sisa makanan kreatif di kulkas, serta mengambil porsi makanan secukupnya di piring.\n\nDi tingkat komunitas, platform Distribusi Surplus Makanan seperti FoodShare hadir sebagai jembatan digital. Dengan mengintegrasikan sistem inventaris surplus dari industri bakery, restoran, dan katering di Balikpapan secara real-time, kita dapat memangkas rantai food waste secara revolusioner dan menyalurkan makanan sehat secara terhormat kepada yang membutuhkan.",
                'snippet' => 'Membongkar alasan sepertiga makanan global terbuang sia-sia beserta solusi komprehensif zero waste...',
                'image_path' => null,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Panti Asuhan Harapan Bangsa Terima 150 Porsi dari Program FoodShare',
                'category' => 'sosial',
                'author' => 'Admin',
                'emoji' => '🤝',
                'content' => "Aksi kepedulian sosial kembali diukir dengan indah di Kota Balikpapan. Akhir pekan kemarin, tim relawan berkolaborasi dengan platform FoodShare sukses menyalurkan total 150 porsi hidangan bergizi lengkap ke Panti Asuhan Harapan Bangsa di daerah Balikpapan Selatan.\n\nHidangan bernutrisi tinggi tersebut merupakan surplus makanan berkualitas premium yang diselamatkan dari Restoran Sederhana Balikpapan dan beberapa bakery mitra tepercaya. Seluruh makanan yang dibagikan telah melalui proses verifikasi standar higienitas yang ketat oleh staf dapur sebelum diserahterimakan kepada relawan kurir motor yang sigap mengantarkannya menggunakan kemasan ramah lingkungan.\n\nAnak-anak asuh beserta para pengurus panti menyambut gembira kedatangan tim donasi. Senyum ceria terpancar saat mereka menikmati menu lezat hangat yang biasanya disajikan di restoran mewah.\n\n'Kami sangat terharu dan bersyukur dengan adanya program penyelamatan makanan surplus dari FoodShare ini. Bantuan makanan berkualitas ini sangat meringankan beban pengeluaran harian yayasan kami, sekaligus memastikan anak-anak mendapatkan asupan nutrisi yang sehat dan bervariasi,' ungkap Ibu Maria selaku Kepala Pengasuh Panti Asuhan Harapan Bangsa.\n\nMelalui program kolaboratif ini, FoodShare berkomitmen untuk terus konsisten memperluas jaringan mitra donor agar semakin banyak titik panti asuhan, pondok pesantren, dan komunitas prasejahtera di Balikpapan yang terbantu secara berkala setiap minggunya.",
                'snippet' => 'Aksi nyata kolaborasi donasi surplus pangan dari restoran mitra yang disalurkan hangat kepada anak panti asuhan...',
                'image_path' => null,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Panduan Mitra Donor: Cara Input Surplus Makanan dengan Benar',
                'category' => 'tips',
                'author' => 'Admin',
                'emoji' => '💡',
                'content' => "Selamat bergabung dalam gerakan Zero Food Waste bersama FoodShare! Sebagai Mitra Donor (Restoran, Bakery, Cafe, atau Katering), peran Anda sangat luar biasa dalam menyelamatkan hidangan berharga agar tidak terbuang sia-sia.\n\nUntuk memastikan proses penyelamatan berjalan dengan aman, tertib, dan cepat, berikut adalah panduan praktis langkah demi langkah dalam memasukkan data surplus makanan Anda ke dalam database sistem:\n\nLangkah 1: Masuk ke Dashboard Toko Anda\nBuka halaman utama FoodShare, klik tombol 'Masuk Akun', masukkan email dan sandi toko Anda untuk masuk ke antarmuka Dashboard Mitra Donor.\n\nLangkah 2: Isi Formulir Donasi Makanan Baru\nKlik tombol 'Bagikan Makanan Surplus' di bagian atas halaman ringkasan data. Isi informasi hidangan Anda secara mendetail:\n- Nama Hidangan: Tulis nama menu secara spesifik (misalnya: Roti Manis Cokelat Keju, Nasi Box Lauk Ikan Goreng).\n- Jumlah & Satuan: Masukkan kuantitas porsi yang tersedia (contoh: 25 kotak, 30 pcs).\n- Kategori: Pilih kategori yang sesuai (Makanan Berat, Roti & Kue, Snack, atau Minuman).\n- Jam Kedaluwarsa: Estimasikan sisa waktu kelayakan konsumsi secara jujur (misalnya 4 jam atau 6 jam) demi menjamin keamanan pangan penerima donasi.\n\nLangkah 3: Tulis Catatan & Deskripsi Tambahan\nTambahkan info penting di kolom deskripsi (misalnya: Simpan dalam pendingin jika tidak langsung dikonsumsi, atau Makanan bebas kandungan babi).\n\nLangkah 4: Publikasikan Donasi\nPeriksa kembali seluruh data, lalu klik 'Bagikan Makanan'. Sistem akan langsung mendaftarkan donasi Anda di katalog real-time dan secara otomatis mengirimkan notifikasi kepada lembaga sosial terdekat untuk mengajukan klaim pickup. Sangat mudah, aman, dan mendatangkan banyak berkah!",
                'snippet' => 'Ikuti langkah-langkah praktis dan mudah cara mendaftarkan makanan surplus layak konsumsi lewat dashboard donor...',
                'image_path' => null,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'SDGs Goal 12: Konsumsi & Produksi Bertanggung Jawab dan Peran Kita',
                'category' => 'edukasi',
                'author' => 'Admin',
                'emoji' => '🌍',
                'content' => "Tujuan Pembangunan Berkelanjutan atau Sustainable Development Goals (SDGs) nomor 12 berfokus pada upaya menjamin pola konsumsi dan produksi yang bertanggung jawab di seluruh dunia. Salah satu target yang paling menantang dan mendesak berada pada Target 12.3: 'Pada tahun 2030, mengurangi separuh limbah pangan per kapita global di tingkat ritel dan konsumen, serta mengurangi kehilangan makanan sepanjang rantai produksi dan pasokan.'\n\nMengapa target ini sangat penting bagi kelangsungan hidup bumi kita?\nSampah makanan yang membusuk di TPA melepaskan gas rumah kaca (metana) yang berkekuatan 25 kali lebih merusak daripada karbon dioksida dalam mempercepat perubahan iklim. Selain itu, membuang makanan berarti kita juga menyia-nyiakan air bersih, lahan pertanian, energi, bahan bakar minyak transportasi, dan tenaga kerja manusia yang telah dikerahkan sepanjang rantai produksi makanan tersebut.\n\nLangkah Sederhana Mewujudkan SDGs 12:\nSebagai warga bumi yang bertanggung jawab, kita dapat memulai langkah nyata dari dapur rumah kita sendiri:\n- Rencanakan porsi makan keluarga secara bijaksana untuk menghindari sisa masakan.\n- Simpan bahan makanan dengan teknik penyimpanan yang tepat di kulkas agar awet lebih lama.\n- Olah kembali bahan makanan sisa kreatif menjadi kreasi hidangan baru yang lezat.\n\nPeran Aktif Platform FoodShare:\nMelalui kolaborasi digital di platform FoodShare, kami berupaya menciptakan solusi terintegrasi di Balikpapan untuk mempercepat pencapaian target SDGs Goal 12 ini. Dengan memindahkan surplus makanan dari unit usaha kuliner ke tangan yang membutuhkan, kita tidak hanya mengurangi volume sampah bumi secara drastis, tetapi juga secara aktif mengatasi kesenjangan kelaparan sosial di sekitar kita.",
                'snippet' => 'Menyelami kontribusi aksi hemat makanan dalam merealisasikan target pembangunan berkelanjutan PBB SDGs Goal 12...',
                'image_path' => null,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Perayaan Milestone: 200+ Porsi Terselamatkan di Bulan Pertama!',
                'category' => 'sosial',
                'author' => 'Admin',
                'emoji' => '🎉',
                'content' => "Sebuah pencapaian luar biasa yang patut kita rayakan bersama! Berkat kerja keras, sinergi, dan ketulusan hati seluruh mitra donor dan relawan, platform FoodShare berhasil memfasilitasi penyelamatan dan pendistribusian lebih dari 200 porsi makanan surplus berkualitas tinggi selama bulan pertama sejak peluncuran resmi kami di Balikpapan!\n\nPerjalanan indah di bulan pertama ini diawali dari kepedulian kecil beberapa restoran bakery yang berani mengambil aksi nyata untuk menekan angka limbah pangan harian mereka. Makanan lezat yang sebelumnya berisiko berakhir di pembuangan sampah kini bertransformasi menjadi hidangan berkah yang penuh keceriaan di atas meja makan panti asuhan, yayasan yatim piatu, dan pondok pesantren mitra.\n\nTerima Kasih Kepada Seluruh Pihak Terlibat:\n- Mitra Donor Istimewa (Restoran Sederhana Balikpapan, Katering Berkah, Bakery Manis Hati, dsb.) yang konsisten menyumbangkan surplus hidangan higienis mereka.\n- Lembaga Penerima Manfaat yang responsif dan gesit dalam mengelola penyaluran hidangan secara tertib kepada anak-anak binaan.\n- Relawan Kurir Sigap yang dengan sukarela meluangkan waktu dan tenaga menembus jalanan kota untuk menjamin makanan tiba dengan selamat dalam kondisi segar.\n\nMilestone ini membuktikan bahwa teknologi digital apabila dikombinasikan dengan solidaritas sosial mampu melahirkan dampak perubahan nyata yang luar biasa bagi kemanusiaan dan kelestarian lingkungan hidup. Mari kita tingkatkan semangat penyelamatan makanan di bulan-bulan berikutnya!",
                'snippet' => 'Merayakan keberhasilan penyelamatan 200+ porsi surplus pangan dari segenap mitra donor perdana di Balikpapan...',
                'image_path' => null,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Registration Requests
        DB::table('registration_requests')->insert([
            [
                'organization_name' => 'Panti Asuhan Kasih Ibu',
                'contact_person' => 'Siti Aminah',
                'email' => 'kasihibu@gmail.com',
                'phone' => '081234567890',
                'address' => 'Jl. Merdeka No.10, Balikpapan',
                'google_maps_link' => 'https://maps.google.com/?q=-1.265386,116.831200',
                'role' => 'lembaga',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'organization_name' => 'Restoran Minang Prima',
                'contact_person' => 'Rudi Hermawan',
                'email' => 'minangprima@gmail.com',
                'phone' => '082154321098',
                'address' => 'Jl. Mulawarman No.42, Manggar, Balikpapan',
                'google_maps_link' => 'https://maps.google.com/?q=-1.229158,116.924294',
                'role' => 'donor',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'organization_name' => 'Bakery Sedap Rasa',
                'contact_person' => 'Dewi Lestari',
                'email' => 'sedaprasabakery@gmail.com',
                'phone' => '081398765432',
                'address' => 'Jl. MT Haryono No.15, Balikpapan',
                'google_maps_link' => 'https://maps.google.com/?q=-1.242981,116.858712',
                'role' => 'donor',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
