<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('header', 'Dashboard') | Admin {{ $school_settings['school_name'] ?? config('app.name', 'MyPortal') }}</title>
  @if(isset($school_settings['school_logo']) && $school_settings['school_logo'])
    <link rel="icon" href="{{ asset('storage/'.$school_settings['school_logo']) }}" type="image/x-icon">
  @endif

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @stack('css')
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/') }}" class="nav-link" target="_blank">Lihat Website</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          @if(Auth::user()->photo)
            <img src="{{ asset('storage/'.Auth::user()->photo) }}" class="user-image img-circle elevation-2" style="object-fit: cover;" alt="User Image">
          @else
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF" class="user-image img-circle elevation-2" alt="User Image">
          @endif
          <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            @if(Auth::user()->photo)
                <img src="{{ asset('storage/'.Auth::user()->photo) }}" class="img-circle elevation-2" style="width: 90px; height: 90px; object-fit: cover;" alt="User Image">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF" class="img-circle elevation-2" alt="User Image">
            @endif
            <p>
              {{ Auth::user()->name }}
              <small>{{ ucfirst(Auth::user()->role) }} - {{ $school_settings['school_name'] ?? 'MyPortal Sekolah' }}</small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">Profile</a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline float-right">
                @csrf
                <button type="submit" class="btn btn-default btn-flat">Sign out</button>
            </form>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        @if(isset($school_settings['school_logo']) && $school_settings['school_logo'])
            <img src="{{ asset('storage/'.$school_settings['school_logo']) }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        @endif
      <span class="brand-text font-weight-light pl-2" style="white-space: normal; font-size: 0.9rem; line-height: 1.2; display: inline-block; vertical-align: middle; max-width: 170px;">{{ $school_settings['school_name'] ?? 'MyPortal Sekolah' }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-header">DATA MASTER</li>
          <li class="nav-item">
            <a href="{{ route('admin.classrooms.index') }}" class="nav-link {{ request()->routeIs('admin.classrooms*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-chalkboard"></i>
              <p>Data Kelas</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.students.index') }}" class="nav-link {{ request()->routeIs('admin.students*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>Data Siswa</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.teachers.index') }}" class="nav-link {{ request()->routeIs('admin.teachers*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>Data Guru</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.committees.index') }}" class="nav-link {{ request()->routeIs('admin.committees*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>Data Panitia</p>
            </a>
          </li>

          <li class="nav-header">CMS SEKOLAH</li>
          {{-- Slider Removed by User Request
           <li class="nav-item">
            <a href="{{ route('admin.sliders.index') }}" class="nav-link {{ request()->routeIs('admin.sliders*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-images"></i>
              <p>Slider Homepage</p>
            </a>
          </li>
          --}}
          <li class="nav-item">
            <a href="{{ route('admin.articles.index') }}" class="nav-link {{ request()->routeIs('admin.articles*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>Artikel & Berita</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tags"></i>
              <p>Kategori Berita</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.programs.index') }}" class="nav-link {{ request()->routeIs('admin.programs*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>Program Sekolah</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('admin.facilities.index') }}" class="nav-link {{ request()->routeIs('admin.facilities*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-building"></i>
              <p>Fasilitas</p>
            </a>
          </li>
          
           <li class="nav-item">
            <a href="{{ route('admin.advertisements.index') }}" class="nav-link {{ request()->routeIs('admin.advertisements*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-ad"></i>
              <p>Manajemen Iklan</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.messages.index') }}" class="nav-link {{ request()->routeIs('admin.messages*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-envelope"></i>
              <p>Pesan Masuk</p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{ route('admin.school_profile.index') }}" class="nav-link {{ request()->routeIs('admin.school_profile*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-id-card"></i>
              <p>Profil Sekolah</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cogs"></i>
              <p>Pengaturan Sekolah</p>
            </a>
          </li>



           <li class="nav-item">
            <a href="{{ route('admin.links.index') }}" class="nav-link {{ request()->routeIs('admin.links*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-link"></i>
              <p>Kelola Layanan Digital</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.galleries.index') }}" class="nav-link {{ request()->routeIs('admin.galleries*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-camera"></i>
              <p>Galeri Kegiatan</p>
            </a>
          </li>

          <li class="nav-header">MODUL UTAMA</li>
          <li class="nav-item">
             <a href="{{ route('admin.ppdb.index') }}" class="nav-link {{ request()->routeIs('admin.ppdb*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>PPDB Online</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('admin.voting.index') }}" class="nav-link {{ request()->routeIs('admin.voting*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-vote-yea"></i>
              <p>E-Voting</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('header')</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @yield('content')
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; {{ date('Y') }} <a href="{{ url('/') }}">{{ $school_settings['school_name'] ?? config('app.name', 'MyPortal') }}</a>.</strong> All rights reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<!-- bs-custom-file-input -->
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<!-- CKEditor 4 (Load only if NOT on settings page to avoid conflict with CKEditor 5) -->
@unless(request()->routeIs('admin.settings.index'))
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
@endunless

<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{ session('success') }}",
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: "{{ session('error') }}",
        });
    @endif
</script>

<script>
    // Global Image Preview
    $(document).on('change', '.custom-file-input', function(event) {
        var input = this;
        var file = input.files[0];
        
        if (file && file.type.match('image.*')) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                var $container = $(input).closest('.form-group');
                var $existingPreview = $container.find('.img-preview-container');
                
                // If existing preview div found (custom or previously created), update it
                if ($existingPreview.length > 0) {
                    $existingPreview.find('img').attr('src', e.target.result).show();
                } else {
                    // Look for strict img tag in previous sibling (common in edit forms)
                     var $prevImg = $container.prev().find('img');
                     
                     if ($prevImg.length > 0) {
                         $prevImg.attr('src', e.target.result);
                     } else {
                        // Create new preview container
                        var previewHtml = `
                            <div class="mt-2 img-preview-container">
                                <img src="${e.target.result}" class="img-fluid img-thumbnail" style="max-height: 200px; border-radius: 8px;">
                                <p class="text-xs text-muted mt-1">Preview Gambar Baru</p>
                            </div>
                        `;
                        
                        // Check if inside input-group
                        if ($(input).closest('.input-group').length > 0) {
                            $(input).closest('.input-group').after(previewHtml);
                        } else {
                            $(input).after(previewHtml);
                        }
                     }
                }
            }
            
            reader.readAsDataURL(file);
        }
    });
</script>

@stack('scripts')

</body>
</html>
