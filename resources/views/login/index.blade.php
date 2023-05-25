<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from coderthemes.com/zircos/layouts/vertical/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 28 Mar 2022 06:03:51 GMT -->
<head>
    <meta charset="utf-8" />
    <title>Login | Ekodus Canada - Admin PAnel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/ekodus-ca-logo-sm.png')}}">

    <!-- App css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-stylesheet" />

    <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">

                        <div class="text-center account-logo-box">
                            <div class="mt-2 mb-2">
                                <a href="index.html" class="text-success">
                                    <span><img src="{{asset('assets/images/ekodus-ca-logo.png')}}" alt="" height="50"></span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body">

                            <form id="loginForm">
                                @csrf
                                <div class="form-group">
                                    <label for="">Enter Email</label>
                                    <input class="form-control" type="email" name="email" id="email" required placeholder="e.g jhon@example.com" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="">Enter Password</label>
                                    <input class="form-control" type="password" name="password" required id="password" placeholder="e.g xxxxxxxxxxx" autocomplete="off">
                                </div>

                                <div class="form-group account-btn text-center mt-2">
                                    <div class="col-12">
                                        <button class="btn width-md btn-bordered btn-danger waves-effect waves-light" type="submitLoginBtn">Log In</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->

                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor js -->
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>

    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <script src="{{asset('assets/js/pages/sweetalerts.init.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('assets/js/app.min.js')}}"></script>

    <script>
        $('#loginForm').on('submit', function(e){
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url:"{{route('admin.login')}}",
                type:"POST",
                data:formData,
                contentType:false,
                processData:false,
                success:function(data){
                    if(data.status === 1){
                        location.replace(data.url)
                    }else{
                        Swal.fire({
                            icon:'error',
                            title:'Oops!',
                            text:data.message
                        })
                    }
                    
                },error:function(error){
                    Swal.fire({
                        icon:'error',
                        text:'Something Went Wrong.'
                    })
                }
            })
        });
    </script>

</body>


<!-- Mirrored from coderthemes.com/zircos/layouts/vertical/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 28 Mar 2022 06:03:51 GMT -->
</html>