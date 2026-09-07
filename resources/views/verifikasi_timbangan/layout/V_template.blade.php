<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Sistem Informasi Digital WH') | PT Tata Metal Lestari</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('bahan_logo_v2/logobg-ic.png') }}" />
  <link rel="stylesheet" href="{{ asset('template_v2/src/assets/css/styles.min.css') }}" />
  <!-- Menambahkan icon Tabler tambahan jika diperlukan -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

  @stack('css')
  <style>
      /* Mengubah sedikit background agar lebih netral sesuai persona industri */
      body {
          background-color: #f8fafc;
      }
      .app-header {
          box-shadow: 0px 2px 10px rgba(0,0,0,0.05);
      }
      
      /* Global Override Primary Color (Biru Korporat) */
      .btn-primary, .bg-primary {
          background-color: #135b9f !important;
          border-color: #135b9f !important;
      }
      .btn-primary:hover, .btn-primary:focus {
          background-color: #0f4a85 !important;
          border-color: #0f4a85 !important;
      }
      .btn-outline-primary {
          color: #135b9f !important;
          border-color: #135b9f !important;
      }
      .btn-outline-primary:hover {
          background-color: #135b9f !important;
          color: #ffffff !important;
      }
      .text-primary {
          color: #135b9f !important;
      }
      .page-item.active .page-link {
          background-color: #135b9f !important;
          border-color: #135b9f !important;
      }
      .form-check-input:checked {
          background-color: #135b9f !important;
          border-color: #135b9f !important;
      }
      .nav-pills .nav-link.active {
          background-color: #135b9f !important;
      }
      
      /* Soft Glassmorphism Sidebar Active State */
      .sidebar-nav ul .sidebar-item > .sidebar-link.active,
      .sidebar-nav ul .sidebar-item > .sidebar-link.active:hover,
      .sidebar-nav ul .sidebar-item.selected > .sidebar-link {
          background-color: rgba(19, 91, 159, 0.1) !important;
          color: #135b9f !important;
          font-weight: 700;
          box-shadow: none !important;
      }
      .sidebar-nav ul .sidebar-item > .sidebar-link.active i,
      .sidebar-nav ul .sidebar-item.selected > .sidebar-link i {
          color: #135b9f !important;
          stroke-width: 2.5;
      }
      .sidebar-nav ul .sidebar-item > .sidebar-link {
          transition: all 0.25s ease;
          color: #5a6a85;
      }
      .sidebar-nav ul .sidebar-item > .sidebar-link:hover {
          background-color: rgba(19, 91, 159, 0.04);
          color: #135b9f;
          transform: translateX(5px);
      }
      .nav-small-cap {
          font-size: 11px !important;
          font-weight: 800 !important;
          color: #94a3b8 !important;
          letter-spacing: 1px;
      }

      /* Modern Action Icons (Global for tables) */
      .action-icons {
          display: flex;
          align-items: center;
          gap: 6px;
          flex-wrap: nowrap;
          justify-content: center;
      }
              .action-icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 4px;
            text-decoration: none;
            border: none;
            transition: all 0.15s ease;
            background-color: transparent !important;
            color: #0f4a85 !important;
        }
        .action-icon-btn:hover {
            background-color: #e2e8f0 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .action-icon-btn i {
            font-size: 1.1rem;
        }
        .action-icon-btn.bg-delete, .action-icon-btn.delete-button, .delete-button {
            color: #b91c1c !important;
        }
        .action-icon-btn.bg-delete:hover, .action-icon-btn.delete-button:hover, .delete-button:hover {
            background-color: #fef2f2 !important;
        }
      .action-icon-btn:hover {
          filter: brightness(0.9);
          transform: translateY(-2px);
          box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      }
      .action-icon-btn i {
          font-size: 1.1rem;
      }
      
  </style>

  <style>
      /* Fix DataTables mobile layout */
      @media (max-width: 767px) {
          div.dataTables_wrapper div.dataTables_length,
          div.dataTables_wrapper div.dataTables_filter {
              text-align: left !important;
              margin-bottom: 12px !important;
          }
          div.dataTables_wrapper div.dataTables_filter input {
              width: 100% !important;
              margin-left: 0 !important;
              display: block !important;
              margin-top: 4px !important;
          }
          div.dataTables_wrapper div.dataTables_info {
              text-align: center !important;
              margin-bottom: 12px !important;
          }
          div.dataTables_wrapper div.dataTables_paginate {
              text-align: center !important;
              display: flex !important;
              justify-content: center !important;
          }
      }

      /* Custom DataTables Pagination & Info (Modern Styling) */
      .dataTables_wrapper .dt-footer-row {
          margin-top: 0;
          align-items: center;
          background-color: #ffffff;
          padding: 16px 20px;
          border-bottom-left-radius: 12px;
          border-bottom-right-radius: 12px;
          border-top: 1px solid #dee2e6;
          margin-left: 0;
          margin-right: 0;
      }
      div.dataTables_wrapper div.dataTables_info {
          padding-top: 0 !important;
          margin-bottom: 0 !important;
          display: flex;
          align-items: center;
          height: 100%;
          color: #475569 !important;
          font-weight: 500;
          font-size: 14px;
      }
      div.dataTables_wrapper div.dataTables_paginate ul.pagination {
          margin: 0;
          justify-content: flex-end;
          flex-wrap: wrap;
          row-gap: 8px;
      }
      div.dataTables_wrapper div.dataTables_paginate .page-link {
          color: #475569;
          border: 1px solid #e2e8f0;
          margin: 0 4px;
          border-radius: 8px !important;
          padding: 6px 14px;
          font-weight: 500;
          font-size: 14px;
          transition: all 0.2s ease;
      }
      div.dataTables_wrapper div.dataTables_paginate .page-item.active .page-link {
          background-color: #1a569d;
          border-color: #1a569d;
          color: #ffffff;
          box-shadow: 0 4px 6px -1px rgba(26, 86, 157, 0.2);
      }
      div.dataTables_wrapper div.dataTables_paginate .page-item.disabled .page-link {
          background-color: #f1f5f9;
          color: #94a3b8;
          border-color: #e2e8f0;
      }
      div.dataTables_wrapper div.dataTables_paginate .page-link:hover:not(.disabled) {
          background-color: #e2e8f0;
          color: #1e293b;
      }
      @media (max-width: 767px) {
          .dataTables_wrapper .dt-footer-row {
              padding: 16px;
              justify-content: center;
          }
          div.dataTables_wrapper div.dataTables_info {
              justify-content: center;
              margin-bottom: 12px !important;
          }
          div.dataTables_wrapper div.dataTables_paginate ul.pagination {
              justify-content: center;
          }
      }

      /* Custom Modal Backdrop (Darker & Blurred) via Modal Background */
      .modal.show {
          background-color: rgba(15, 23, 42, 0.65);
          backdrop-filter: blur(3px);
      }
  </style>
</head>


<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    
    <!-- Sidebar Removed -->
    
    <!--  Main wrapper -->
    <div class="body-wrapper" style="margin-left: 0 !important; width: 100% !important;">
      <!--  Header Start -->
      @include('verifikasi_timbangan.layout.V_header')
      <!--  Header End -->
      
      <div class="container-fluid" style="max-width: 100%; padding: 100px 30px 30px 30px;">
        
        <!-- Flash Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Main Content -->
        @yield('content')
        
      </div>
    </div>
  </div>
  
  <script src="{{ asset('template_v2/src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('template_v2/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('template_v2/src/assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('template_v2/src/assets/js/app.min.js') }}"></script>
  <script src="{{ asset('template_v2/src/assets/libs/simplebar/dist/simplebar.js') }}"></script>
  @stack('scripts')
  <style>
      /* Custom SweetAlert Button Styles */
      .swal-custom-btn {
          border-radius: 8px !important;
          padding: 12px 28px !important;
          font-size: 15px !important;
          font-weight: 600 !important;
          letter-spacing: 0.3px !important;
          transition: all 0.2s ease !important;
          margin: 0 8px !important;
          cursor: pointer;
      }

      .swal-custom-confirm {
          background-color: #b91c1c !important;
          color: #ffffff !important;
          border: 1px solid #991b1b !important;
          box-shadow: 0 4px 6px rgba(153, 27, 27, 0.15) !important;
      }

      .swal-custom-confirm:hover {
          background-color: #991b1b !important;
          transform: translateY(-2px) !important;
          box-shadow: 0 8px 15px rgba(153, 27, 27, 0.25) !important;
      }

      .swal-custom-cancel {
          background-color: #ffffff !important;
          color: #475569 !important;
          border: 1px solid #cbd5e1 !important;
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02) !important;
      }

      .swal-custom-cancel:hover {
          background-color: #f8fafc !important;
          color: #1e293b !important;
          border-color: #94a3b8 !important;
          transform: translateY(-2px) !important;
          box-shadow: 0 8px 15px rgba(0, 0, 0, 0.05) !important;
      }
      
      .custom-logout-popup {
          border-radius: 20px !important;
          padding: 32px 24px 24px !important;
          box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
      }

      .custom-actions-container {
          margin-top: 24px !important;
          gap: 12px;
      }

      .custom-close-btn {
          color: #94a3b8 !important;
      }

      .custom-close-btn:hover {
          color: #ef4444 !important;
          background: #fef2f2 !important;
      }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
      window.showCustomConfirm = function(options) {
          return Swal.fire({
              html: `
                  <div style="margin-bottom: 24px; margin-top: 10px; text-align: center;">
                      <div style="width: 80px; height: 80px; margin: 0 auto; display: flex; align-items: center; justify-content: center; background: #fef2f2; border-radius: 50%;">
                          <i class="${options.iconClass || 'fas fa-trash-alt'}" style="font-size: 40px; color: #ef4444;"></i>
                      </div>
                  </div>
                  <h2 style="font-weight: 800; color: #1e293b; font-size: 22px; margin-bottom: 12px; font-family: 'Inter', sans-serif; letter-spacing: -0.5px; text-align: center;">${options.title}</h2>
                  <p style="color: #64748b; font-size: 15px; margin-bottom: 0; line-height: 1.6; font-family: 'Inter', sans-serif; text-align: center;">
                      ${options.text}
                  </p>
              `,
              showCloseButton: true,
              showCancelButton: true,
              confirmButtonText: options.confirmText || 'Ya',
              cancelButtonText: 'Batal',
              reverseButtons: true,
              width: '420px',
              background: '#ffffff',
              backdrop: `rgba(15, 23, 42, 0.65)`,
              buttonsStyling: false,
              customClass: {
                  popup: 'custom-logout-popup',
                  closeButton: 'custom-close-btn',
                  confirmButton: 'swal-custom-btn swal-custom-confirm',
                  cancelButton: 'swal-custom-btn swal-custom-cancel',
                  actions: 'custom-actions-container'
              }
          });
      };

      document.addEventListener('DOMContentLoaded', function() {
          const logoutBtn = document.getElementById('dropdown-logout-btn');
          if (logoutBtn) {
              logoutBtn.addEventListener('click', function(e) {
                  e.preventDefault();
                  const url = this.getAttribute('href');
                  window.showCustomConfirm({
                      iconClass: 'ti ti-logout',
                      title: 'Konfirmasi Keluar',
                      text: 'Apakah Anda yakin ingin mengakhiri sesi ini?<br>Anda harus <span style="color: #1e293b; font-weight: 600;">login kembali</span> untuk mengakses sistem.',
                      confirmText: 'Ya, Keluar'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          window.location.href = url;
                      }
                  });
              });

          }


          // Auto close sidebar on mobile when clicking outside (FIXED)
          $(document).on('click', function(e) {
              if ($(window).width() < 1200) {
                  if ($('#main-wrapper').hasClass('show-sidebar')) {
                      // Jika klik di luar sidebar dan bukan pada tombol hamburger
                      if (!$(e.target).closest('.left-sidebar').length && !$(e.target).closest('.sidebartoggler').length) {
                          $('#main-wrapper').removeClass('show-sidebar');
                      }
                  }
              }
          });

          // Custom global search for DataTables
          $('.custom-dt-search').on('keyup', function() {
              $('#dataTable').DataTable().search(this.value).draw();
          });
      });
  </script>

  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script>
      $(document).ready(function() {
          if ($('#dataTable').length > 0) {
              $('#dataTable').DataTable({
                  "pageLength": 10,
                  "dom": "<'table-responsive'tr><'row dt-footer-row'<'col-sm-12 col-md-5 d-flex align-items-center'i><'col-sm-12 col-md-7'p>>",
                  "lengthMenu": [[10, 15, 25, 50, -1], [10, 15, 25, 50, "All"]],
                  "language": {
                      "search": "Cari Cepat:",
                      "lengthMenu": "Tampilkan _MENU_ data per halaman",
                      "zeroRecords": "Tidak ada data yang ditemukan",
                      "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                      "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                      "infoFiltered": "(disaring dari _MAX_ total data)",
                      "paginate": {
                          "first": "Pertama",
                          "last": "Terakhir",
                          "next": "Selanjutnya",
                          "previous": "Sebelumnya"
                      }
                  }
              });

          }


          // Auto close sidebar on mobile when clicking outside (FIXED)
          $(document).on('click', function(e) {
              if ($(window).width() < 1200) {
                  if ($('#main-wrapper').hasClass('show-sidebar')) {
                      // Jika klik di luar sidebar dan bukan pada tombol hamburger
                      if (!$(e.target).closest('.left-sidebar').length && !$(e.target).closest('.sidebartoggler').length) {
                          $('#main-wrapper').removeClass('show-sidebar');
                      }
                  }
              }
          });

          // Custom global search for DataTables
          $('.custom-dt-search').on('keyup', function() {
              $('#dataTable').DataTable().search(this.value).draw();
          });
      });
  </script>

</body>

</html>





