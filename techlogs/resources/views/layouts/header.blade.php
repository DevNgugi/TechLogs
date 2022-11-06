@section('header')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>KBC Technical logs</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet">

        <!-- Vendor /CSS Files -->
        <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">


        <link rel="stylesheet" href="/assets/vendor/select2.min.css" />
        <link rel="stylesheet" href="/assets/vendor/select2-bootstrap.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <!-- Template Main CSS File -->
        <link href="/assets/css/style.css" rel="stylesheet">

        <style>
            .footer {
                position: fixed;
                bottom: 20px;
                color: #012970;

            }

        </style>
    </head>

    <body>
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center">

            <div class="d-flex align-items-center justify-content-between">
                <a href="#" class="logo d-flex align-items-center">
                    <img src="assets/img/logoKBC.png" alt="">
                    <span class="d-none d-lg-block">
                        <h4>Technical Logs</h4>
                    </span>
                </a>
                <i class="bi bi-list toggle-sidebar-btn"></i>
            </div><!-- End Logo -->


            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">

                    <li class="nav-item d-block d-lg-none">
                        <a class="nav-link nav-icon search-bar-toggle " href="#">
                            <i class="bi bi-search"></i>
                        </a>
                    </li><!-- End Search Icon-->

                    <li class="nav-item dropdown">

                        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-bell"></i>
                            <span class="notif-counter badge bg-primary badge-number"></span>
                        </a><!-- End Notification Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">

                            <li class="dropdown-header">
                                You have <span class="notif-counter">no</span> new notification(s)
                                <a href="{{ route('notif') }}"><span class="badge rounded-pill bg-primary p-2 ms-2">View
                                        all</span></a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            {{-- item 1 --}}
                            <div id="notif-body">
                                
                            </div>


                            

                        </ul><!-- End Notification Dropdown Items -->

                    </li><!-- End Notification Nav -->


                    <li class="nav-item dropdown pe-3">

                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                            <img src="/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                            <span style="text-transform:capitalize"
                                class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                        </a><!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6 style="text-transform:capitalize">{{ Auth::user()->name }}</h6>
                                <span id='user-role'>{{ Auth::user()->role }}</span><br>
                                <span id='user-email'>{{ Auth::user()->email }}</span>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('profile') }}">
                                    <i class="bi bi-person"></i>
                                    <span>My Profile</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>

                                <a class="dropdown-item d-flex align-items-center" href="" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right"></i>

                                    <span>Sign Out</span>
                                    <form id="logout-form" method="POST" action="{{ route('logout') }}">
                                        @csrf

                                    </form>
                                </a>
                            </li>

                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->

                </ul>
            </nav><!-- End Icons Navigation -->

        </header><!-- End Header -->
        <!-- Vendor JS Files -->

        <script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="/assets/vendor/jquery-3.6.0.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/vendor/chart.js/chart.min.js"></script>
        <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="/assets/vendor/php-email-form/validate.js"></script>

        <script src="/assets/vendor/select2.min.js"></script>
        <!-- Template Main JS File -->

        <script src="/assets/js/main.js" defer></script>
        <script defer>
            //  hide alerts after 5 seconds
            var element = document.querySelector('.btn-close');
            if (typeof(element) != 'undefined' && element != null) {
                setTimeout(() => {
                    document.querySelector('.btn-close').click();
                }, 4000);
            }
        </script>
        <script>
            $(document).ready(function() {
                var id = "{{ Auth::User()->email }}";

                $.ajax({
                    type: "GET",
                    url: "/notifications/" + id,
                    success: function(data) {
                      
                      if(data.length>0){

                        $('.notif-counter').html(data.length)
                      }

                        for (const key in data) {
                          if(key<4){

                            const li = document.createElement("li");
                            li.classList.add("notification-item");
                            const i = document.createElement("i");
                            i.classList.add("bi");

                            if (data[key].type == "Escalation") {
                                i.classList.add("bi-exclamation-triangle-fill");
                                i.classList.add("text-danger");
                            }
                            if (data[key].type == "Password") {
                                i.classList.add("bi-check-circle");
                                i.classList.add("text-success");
                            }
                            if (data[key].type == "Overdue") {
                                i.classList.add("bi-exclamation-circle");
                                i.classList.add("text-warning");
                            }
                            const div = document.createElement("div");
                            const h4 = document.createElement("h4");
                            h4.textContent = (data[key].type);
                            const p1 = document.createElement("p");
                            p1.textContent = (data[key].subject);
                            const p2 = document.createElement("p");
                            p2.textContent = (data[key].date);
                            const li2 = document.createElement("li");
                            const hr = document.createElement("hr");
                            hr.classList.add("dropdown-divider");
                            div.appendChild(h4);
                            div.appendChild(p1);
                            div.appendChild(p2);

                            li.appendChild(i);
                            li.appendChild(div);

                            li2.appendChild(hr);

                            document.querySelector('#notif-body').appendChild(li)
                            document.querySelector('#notif-body').appendChild(li2)
                          }
                        }

                    } //end success
                });
            });
        </script>
    @endsection
