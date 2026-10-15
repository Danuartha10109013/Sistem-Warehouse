<!doctype html>
<html lang="id">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Masuk | Sistem Informasi Warehouse - PT Tata Metal Lestari</title>

   <!-- Favicon -->
   <link rel="shortcut icon" href="{{ asset('Logo TML.png') }}" />

   <!-- Fonts: Plus Jakarta Sans -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet">

   <!-- Bootstrap 5 & Icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

   <style>
      :root {
         --brand-primary: #135b9f;
         --brand-primary-hover: #0f4a82;
         --brand-primary-active: #0c3c6a;
         --brand-dark: #0f172a;
         --text-main: #1e293b;
         --text-muted: #64748b;
         --bg-surface: #ffffff;
         --bg-app: #f1f5f9;
         --border-subtle: #e2e8f0;
         --border-focus: #135b9f;
      }

      * {
         box-sizing: border-box;
      }

      body {
         font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
         background:
            radial-gradient(circle at 50% 40%, rgba(255, 255, 255, 0.22) 0%, transparent 60%),
            linear-gradient(135deg, #9bb2bf 0%, #689a9e 48%, #4a7d9b 100%);
         background-attachment: fixed;
         min-height: 100vh;
         margin: 0;
         display: flex;
         flex-direction: column;
         justify-content: center;
         align-items: center;
         padding: 24px 16px;
         -webkit-font-smoothing: antialiased;
      }

      /* Subtle enterprise top accent bar */
      .top-accent-bar {
         position: fixed;
         top: 0;
         left: 0;
         right: 0;
         height: 3px;
         background: linear-gradient(90deg, #135b9f 0%, #4a9e91 50%, #67a8ce 100%);
         z-index: 100;
      }

      .login-container {
         width: 100%;
         max-width: 440px;
         margin: auto;
      }

      .login-card {
         background: rgba(255, 255, 255, 0.92);
         backdrop-filter: blur(24px) saturate(160%);
         -webkit-backdrop-filter: blur(24px) saturate(160%);
         border: 1px solid rgba(255, 255, 255, 0.8);
         border-radius: 18px;
         padding: 38px 34px;
         box-shadow:
            0 20px 40px -10px rgba(15, 38, 55, 0.2),
            0 4px 14px rgba(0, 0, 0, 0.04),
            inset 0 1px 0 rgba(255, 255, 255, 0.8);
      }

      .brand-header {
         text-align: center;
         margin-bottom: 28px;
      }

      .brand-logo {
         height: 72px;
         width: auto;
         object-fit: contain;
         margin-bottom: 16px;
         filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.06));
      }

      .system-title {
         font-size: 21.5px;
         font-weight: 700;
         color: var(--brand-dark);
         margin-bottom: 6px;
         letter-spacing: -0.3px;
         line-height: 1.3;
      }

      .system-subtitle {
         font-size: 14px;
         color: var(--text-muted);
         margin: 0;
         line-height: 1.4;
         font-weight: 500;
      }

      .form-label {
         font-size: 13.5px;
         font-weight: 600;
         color: #334155;
         margin-bottom: 6px;
      }

      .input-wrapper {
         position: relative;
      }

      .input-icon {
         position: absolute;
         left: 14px;
         top: 50%;
         transform: translateY(-50%);
         color: #94a3b8;
         font-size: 16px;
         pointer-events: none;
         transition: color 0.2s ease;
      }

      .form-control {
         height: 44px;
         font-size: 14px;
         border-radius: 8px;
         border: 1px solid #cbd5e1;
         padding-left: 40px;
         padding-right: 14px;
         color: #1e293b;
         background-color: #ffffff;
         transition: border-color 0.2s ease, box-shadow 0.2s ease;
      }

      .form-control::placeholder {
         color: #94a3b8;
         font-size: 13.5px;
      }

      .form-control:focus {
         border-color: var(--border-focus);
         box-shadow: 0 0 0 3px rgba(19, 91, 159, 0.12);
         background-color: #ffffff;
      }

      .input-wrapper:focus-within .input-icon {
         color: var(--brand-primary);
      }

      .password-input-wrapper .form-control {
         padding-right: 42px;
      }

      .password-toggle-btn {
         position: absolute;
         right: 12px;
         top: 50%;
         transform: translateY(-50%);
         background: none;
         border: none;
         padding: 4px;
         color: #64748b;
         cursor: pointer;
         font-size: 16px;
         display: flex;
         align-items: center;
         justify-content: center;
         transition: color 0.15s ease;
      }

      .password-toggle-btn:hover {
         color: var(--brand-dark);
      }

      .password-toggle-btn:focus {
         outline: none;
         color: var(--brand-primary);
      }

      .btn-submit {
         height: 48px;
         background: linear-gradient(135deg, #135b9f 0%, #0d4a82 100%);
         border: none;
         color: #ffffff;
         font-weight: 600;
         font-size: 14.5px;
         border-radius: 8px;
         letter-spacing: 0.1px;
         box-shadow: 0 4px 14px rgba(19, 91, 159, 0.28);
         transition: all 0.2s ease;
      }

      .btn-submit:hover {
         background: linear-gradient(135deg, #104f8b 0%, #0a3d6d 100%);
         color: #ffffff;
         box-shadow: 0 6px 18px rgba(19, 91, 159, 0.35);
         transform: translateY(-1px);
      }

      .btn-submit:active {
         background: #0a3d6d !important;
         transform: translateY(0);
         box-shadow: 0 2px 8px rgba(19, 91, 159, 0.2);
      }

      .btn-submit:focus {
         outline: none;
         box-shadow: 0 0 0 3px rgba(19, 91, 159, 0.25);
      }

      .alert {
         border-radius: 8px;
         font-size: 13px;
         padding: 10px 14px;
         margin-bottom: 20px;
         display: flex;
         align-items: flex-start;
         gap: 10px;
         line-height: 1.45;
      }

      .alert-danger {
         background-color: #fef2f2;
         border-color: #fecaca;
         color: #991b1b;
      }

      .alert-success {
         background-color: #f0fdf4;
         border-color: #bbf7d0;
         color: #166534;
      }

      .alert .btn-close {
         padding: 10px;
         margin-left: auto;
         font-size: 10px;
      }

      .login-footer {
         text-align: center;
         margin-top: 24px;
         color: rgba(255, 255, 255, 0.95);
         font-size: 12.5px;
         line-height: 1.5;
         text-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
      }

      .login-footer span {
         font-weight: 600;
         color: #ffffff;
      }

      /* Mobile optimization */
      @media (max-width: 480px) {
         body {
            padding: 16px 12px;
         }

         .login-card {
            padding: 30px 20px;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
         }

         .brand-logo {
            height: 60px;
            margin-bottom: 14px;
         }

         .system-title {
            font-size: 19px;
         }

         .system-subtitle {
            font-size: 13px;
         }
      }
   </style>
</head>

<body>
   <div class="top-accent-bar"></div>

   <main class="login-container">
      <div class="login-card">
         <header class="brand-header">
            <img src="{{ asset('template_v2/bahan_logo_v2/logobg-ic.png') }}" alt="Logo PT Tata Metal Lestari"
               class="brand-logo" onerror="this.src='{{ asset('template_v2/bahan_logo_v2/logobg-ic.png') }}'">
            <h1 class="system-title">Sistem Informasi Manajemen Operasional</h1>
            <p class="system-subtitle">PT.Tata Metal Lestari</p>
         </header>

         {{-- Alert Notification --}}
         @if (session('error'))
            <div class="alert alert-danger" role="alert">
               <i class="bi bi-exclamation-circle-fill flex-shrink-0 mt-1" style="font-size: 14px;"></i>
               <div>{{ session('error') }}</div>
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         @elseif (session('success'))
            <div class="alert alert-success" role="alert">
               <i class="bi bi-check-circle-fill flex-shrink-0 mt-1" style="font-size: 14px;"></i>
               <div>{{ session('success') }}</div>
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         @endif

         <form method="POST" action="{{ route('login-proses') }}" id="loginForm" autocomplete="on">
            @csrf

            <!-- Email Input -->
            <div class="mb-3">
               <label for="email" class="form-label">Alamat Email</label>
               <div class="input-wrapper">
                  <i class="bi bi-envelope input-icon"></i>
                  <input type="email" name="email" id="email" class="form-control" placeholder="contoh@tatametal.com"
                     value="{{ session('email') ?? old('email') }}" required autofocus autocomplete="email">
               </div>
            </div>

            <!-- Password Input -->
            <div class="mb-4">
               <label for="password" class="form-label">Kata Sandi</label>
               <div class="input-wrapper password-input-wrapper">
                  <i class="bi bi-shield-lock input-icon"></i>
                  <input type="password" name="password" id="password" class="form-control"
                     placeholder="Masukkan kata sandi" required autocomplete="current-password">
                  <button type="button" class="password-toggle-btn" id="togglePasswordBtn"
                     aria-label="Tampilkan atau sembunyikan kata sandi" tabindex="-1">
                     <i class="bi bi-eye" id="passwordIcon"></i>
                  </button>
               </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-submit w-100 d-flex align-items-center justify-content-center gap-2"
               id="btnSubmit">
               <span id="btnText">Masuk ke Sistem</span>
               <i class="bi bi-arrow-right" id="btnIcon"></i>
            </button>
         </form>
      </div>

      <footer class="login-footer">
         <div>&copy; {{ date('Y') }} <span>PT Tata Metal Lestari</span>.</div>
         <div class="mt-1" style="font-size: 11px;">Sistem Informasi Manajemen Operasional.</div>
      </footer>
   </main>

   <!-- Scripts -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script>
      // Toggle Password Visibility
      const togglePasswordBtn = document.getElementById('togglePasswordBtn');
      const passwordInput = document.getElementById('password');
      const passwordIcon = document.getElementById('passwordIcon');

      if (togglePasswordBtn && passwordInput && passwordIcon) {
         togglePasswordBtn.addEventListener('click', function () {
            const isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            passwordIcon.classList.toggle('bi-eye', !isPassword);
            passwordIcon.classList.toggle('bi-eye-slash', isPassword);
         });
      }

      // Submit Button Loading Feedback
      const loginForm = document.getElementById('loginForm');
      const btnSubmit = document.getElementById('btnSubmit');
      const btnText = document.getElementById('btnText');
      const btnIcon = document.getElementById('btnIcon');

      if (loginForm && btnSubmit) {
         loginForm.addEventListener('submit', function () {
            btnSubmit.disabled = true;
            if (btnText) btnText.textContent = 'Memverifikasi...';
            if (btnIcon) btnIcon.className = 'spinner-border spinner-border-sm text-light';
         });
      }
   </script>
</body>

</html>