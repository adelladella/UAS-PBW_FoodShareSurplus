<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>System Error (500) - FoodShare Debugger</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
  
  <style>
    :root {
      --bg: #FAF7EB;
      --dark: #382615;
      --accent2: #F47B30;
      --green: #1E7D5C;
    }
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background-color: var(--bg);
      color: var(--dark);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .error-card {
      background: #FFFFFF;
      border-radius: 20px;
      box-shadow: 0 15px 40px rgba(56, 38, 21, 0.08);
      border: 2px solid rgba(231, 76, 60, 0.3);
      max-width: 900px;
      width: 100%;
      overflow: hidden;
    }
    .error-header {
      background: #FDEDEC;
      border-bottom: 1px solid #FADBD8;
      padding: 30px;
    }
    .error-body {
      padding: 30px;
    }
    .log-terminal {
      background: #1E1E1E;
      color: #E5E9F0;
      font-family: 'JetBrains Mono', monospace;
      font-size: 0.85rem;
      padding: 20px;
      border-radius: 12px;
      max-height: 350px;
      overflow-y: auto;
      white-space: pre-wrap;
      border: 1px solid rgba(255,255,255,0.1);
      text-align: left;
    }
    .btn-action {
      border-radius: 30px;
      padding: 10px 24px;
      font-weight: 700;
      font-size: 0.9rem;
      border: none;
      transition: all 0.3s ease;
    }
    .btn-copy {
      background: var(--accent2);
      color: #FFFFFF;
    }
    .btn-copy:hover {
      background: #D65A18;
      color: #FFFFFF;
    }
    .btn-home {
      background: var(--green);
      color: #FFFFFF;
    }
    .btn-home:hover {
      background: #155B42;
      color: #FFFFFF;
    }
  </style>
</head>
<body>

  <div class="error-card">
    <div class="error-header d-flex align-items-center gap-3">
      <div class="text-danger fs-1"><i class="bi bi-exclamation-triangle-fill"></i></div>
      <div>
        <h4 class="fw-bold text-danger mb-1">Terjadi Kesalahan Sistem (HTTP 500)</h4>
        <p class="text-muted mb-0" style="font-size: 0.9rem;">Laravel Exception Handler - Halaman Debugging Pengembang</p>
      </div>
    </div>
    
    <div class="error-body">
      <!-- Error Message Details -->
      <div class="mb-4">
        <h6 class="fw-bold text-dark mb-2">Pesan Kesalahan (Exception Message):</h6>
        <div class="p-3 bg-light rounded-3 border fw-semibold text-secondary" style="font-size: 0.95rem;">
          {{ $exceptionMessage }}
        </div>
      </div>
      
      <!-- File Location Info -->
      @if($exceptionFile)
      <div class="mb-4">
        <h6 class="fw-bold text-dark mb-2">Lokasi Berkas:</h6>
        <div class="p-3 bg-light rounded-3 border font-monospace text-muted" style="font-size: 0.85rem;">
          {{ $exceptionFile }} : Baris {{ $exceptionLine }}
        </div>
      </div>
      @endif

      <!-- Stack Trace Log -->
      <div class="mb-4">
        <h6 class="fw-bold text-dark mb-2">Catatan Log Stack Trace:</h6>
        <div class="log-terminal" id="stackTraceText">{{ $exceptionTrace }}</div>
      </div>

      <!-- Action Buttons -->
      <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <button class="btn btn-action btn-copy d-flex align-items-center gap-2" onclick="copyStackTrace()">
          <i class="bi bi-clipboard-check"></i> Salin Log Kesalahan
        </button>
        <div class="d-flex gap-2">
          <button class="btn btn-action btn-home" onclick="window.location.reload()">
            <i class="bi bi-arrow-clockwise"></i> Coba Muat Ulang Halaman
          </button>
          <a href="/" class="btn btn-action btn-secondary d-flex align-items-center gap-2">
            <i class="bi bi-house-door-fill"></i> Kembali ke Beranda
          </a>
        </div>
      </div>
    </div>
  </div>

  <script>
    function copyStackTrace() {
      const logText = document.getElementById('stackTraceText').innerText;
      const errorMsg = "{{ $exceptionMessage }}";
      const fileInfo = "{{ $exceptionFile }} : {{ $exceptionLine }}";
      
      const fullLog = `=== FOODSHARE ERROR LOG ===\nMessage: ${errorMsg}\nFile: ${fileInfo}\n\nStack Trace:\n${logText}`;
      
      navigator.clipboard.writeText(fullLog).then(() => {
        alert('Log kesalahan berhasil disalin ke papan klip (clipboard)! Silakan tempelkan log ini untuk di-debugging.');
      }).catch(err => {
        alert('Gagal menyalin log kesalahan.');
      });
    }
  </script>

</body>
</html>
