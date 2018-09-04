<!DOCTYPE html>
<html lang="en">
<head>
   @include('admin.layouts.head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
@include('admin.layouts.header')
@include('admin.layouts.sidebar')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" id="app">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
                <admin-artiste></admin-artiste>

          </div>
          <!-- /.box -->
    
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
    
    

@include('admin.layouts.footer')
        </div>
    
</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>
