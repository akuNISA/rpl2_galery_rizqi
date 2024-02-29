
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Galery</title>

  <!-- Google Font: Source Sans Pro -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- AdminLTE css -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">selamat datang {{ Session::get('name') }}</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-slide="true" href="/logout" role="button">
          <i class="">logout</i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->


  <!-- Content Wrapper. Contains page content -->
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Galery</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <button class="btn btn-primary" data-toggle="modal" data-target="#baru">Upload</button>
              </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
              @foreach ($galeries as $item)
              <div class="time-label">
                <span class="bg-red">{{ date('d-M-Y',strtotime($item->created_at)) }}</span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fa fa-camera bg-purple"></i>
                <div class="timeline-item">
                  <h3 class="timeline-header"><a href="#">{{ $item->judul }}</a> {{ $item->deskripsi }}</h3>
                  <div class="timeline-body">
                    <img src="{{ Storage::url($item->photo) }}" alt="photo" width="250" height="250">
                  </div>
                  <div class="row mb-3">
                    <a href="#" class="btn btn-warning mr-4 edit" data-toggle="modal" data-target="#edit{{ $item->id }}">Edit</a>
                    <form action="{{ route('galery.destroy',$item->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button id="delete" class="btn btn-danger" onclick="return confirm('Apakah mau hapus?')">Delete</button>
                  </div>
                    </form>
                  <div class="modal fade" id="edit{{ $item->id }}">
                    <div class="modal-dialog modal-xl">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Upload Photo</h4>
                          <button type="button" class="close" data-dismiss="modal" arial-lebel="close">
                            <span aria-hidden="true">&times</span>
                          </button>
                        </div>
                        <form action="{{ route('galery.update',$item->id) }}" method="post" enctype="multipart/form-data" id="formpost">
                          @csrf
                          @method('PUT')
                          <input type="hidden" name="id" id="id">
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="judul">Judul</label>
                              <input type="text" name="judul" id="judul" class="form-control" placeholder="isikaan judul" value="{{ $item->judul }}">
                              <span class="text-danger">
                                @error('judul')
                                  {{ $message }}
                                @enderror
                              </span>
                            </div>
                            <div class="form-group">
                              <label for="dskripsi">deskripsi</label>
                              <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="isikaan deskripsi" value="{{ $item->deskripsi }}">
                              <span class="text-danger">
                                @error('deskripsi')
                                  {{ $message }}
                                @enderror
                              </span>
                            </div>
                            <div class="form-group">
                              <label for="photo">photo</label>
                              <input type="file" name="photo" id="photo" class="form-control" placeholder="upload photo" value="">
                              <span class="text-danger">
                                <img src="{{ Storage::url($item->photo) }}" alt="">
                                @error('photo')
                                  {{ $message }}
                                @enderror
                              </span>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismmis="modal">close</button>
                            <button type="submit" class="btn btn-primary">save</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>
              <!-- END timeline item -->
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->

    </section>
    <!-- /.content -->
  
  <!-- /.content-wrapper -->
  <div class="modal fade" id="baru">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Upload Photo</h4>
          <button type="button" class="close" data-dismiss="modal" arial-lebel="close">
            <span aria-hidden="true">&times</span>
          </button>
        </div>
        <form action="{{ route('galery.store') }}" method="post" enctype="multipart/form-data" id="formpost">
          @csrf
          <input type="hidden" name="id" id="id">
          <div class="modal-body">
            <div class="form-group">
              <label for="judul">Judul</label>
              <input type="text" name="judul" id="judul" class="form-control" placeholder="isikaan judul" value="">
              <span class="text-danger">
                @error('judul')
                  {{ $message }}
                @enderror
              </span>
            </div>
            <div class="form-group">
              <label for="dskripsi">deskripsi</label>
              <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="isikaan deskripsi" value="">
              <span class="text-danger">
                @error('deskripsi')
                  {{ $message }}
                @enderror
              </span>
            </div>
            <div class="form-group">
              <label for="photo">photo</label>
              <input type="file" name="photo" id="photo" class="form-control" placeholder="upload photo" value="">
              <span class="text-danger">
                @error('photo')
                  {{ $message }}
                @enderror
              </span>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismmis="modal">close</button>
            <button type="submit" class="btn btn-primary">save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('dist/js/demo.js') }}"></script> --}}
</body>
</html>
