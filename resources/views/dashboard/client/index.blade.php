<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield("title")</title>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css ')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body id="page-top">

    <!-- Page Wrapper id="wrapper" -->
    <div >

        <!-- Sidebar -->
             {{-- @include("layout.aside") --}}
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                
                <!-- Topbar -->
                <nav class="navbar p-4 navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    {{-- <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button> --}}

                    <div class="sidebar-brand-icon rotate-n-15">
                        <i style="font-size:37px;" class="bi text-primary bi-globe-asia-australia"></i>
                    </div>
                    <div style="font-size:25px; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif" class="sidebar-brand-text mx-3">Haouta</div>
                
                    <!-- Topbar Search -->
                
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto mr-3">
                
                       
                
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{auth()->user()->fname}} {{auth()->user()->lname}}</span>
                                <img class="img-profile rounded-circle"
                                 src="{{asset('assets/imgsProfile/admin.jpg')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{Route('profile.edit')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="post" action="{{route('logout')}}">
                                    @csrf
                                    <button type="submit" class="btn btn-light">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        logout
                                    </button>
                                </form>
                            </div>
                        </li>
                
                    </ul>
                
                </nav>
                <!-- End of Topbar -->


                <!-- Begin Page Content -->
                {{-- @if(empty($cadeau))
                <div class="alert alert-info">vous avez aucune cadeaux</div>
           @endif --}}
                <div style="border-radius:15px; width:98%;" class="container   p-4 ">
             
                     <h2>cadeaux</h2>
                 @if(auth()->user()->points>0)
                   <div class="alert alert-info">vous pouvez bénéficier de {{auth()->user()->points}} points</div>
                 @else
                   <div class="alert alert-danger">vous avez aucune points</div>
                 @endif

                 @if (session("success"))
                 <div class="alert alert-success">{{ session("success") }}</div>
             @endif
                <div style="justify-content:space-around; margin-top:15px; display:flex; gap:10px;" >
              
                    @foreach ($cadeau as $c)
                        <div style="width:300px; max-height:400px; border-radius:15px;" class="shadow-sm text-center">
                            <img style="width:200px; height:200px;" src="{{asset('assets/img/cadeau.jpg')}}">
                            <div style="display:flex; justify-content:space-around;">
                                <h2>{{$c->title}}</h2>
                                
                            </div>
                            <strong>{{$c->max_points}} points</strong> <br>
                                <span class="text-gray">demandé @if($c->counter>0) <div class="badge bg-success">{{$c->counter}}</div> @else <div class="badge bg-black">0</div> @endif fois</span>
                            
                            <form method="post"  class="mt-2" action="{{route('client.consommer')}}">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-block">consommer</button>
                                <input type="hidden" name="cadeau" value="{{$c->id}}" />
                            </form>
                        </div>
                    @endforeach
                    
                </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->

         
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    {{-- <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a> --}}

    <!-- Logout Modal-->
    {{-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div> --}}


    <!-- Bootstrap core JavaScript-->

    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('assets/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('assets/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('assets/js/demo/chart-pie-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
    <script>
            const message = document.getElementById('message')
            if (message) {
                const toast = new bootstrap.Toast(message)
                toast.show()
            }
            $(document).ready(function () {
                $.noConflict();
                $("#table").DataTable();
            })
            @yield("script")
    </script>

</body>

</html>