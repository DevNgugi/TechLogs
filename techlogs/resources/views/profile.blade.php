@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.footer')

@yield('header')
@yield('sidebar')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">


                        <h2 id="headname"></h2>
                        <h3 id="headrole"></h3>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">Change Password</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                @isset($user)
                                    <div class="row mt-5">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-9 col-md-8" id="fullname">{{$user->name}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8" id="phone">{{$user->phone}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8" id="email">{{$user->email}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Company</div>
                                        <div class="col-lg-9 col-md-8">Kenya Broadcasting Corporation</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Role</div>
                                        <div class="col-lg-9 col-md-8" id="role">{{$user->role}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Region</div>
                                        <div class="col-lg-9 col-md-8" id="region">{{$user->region}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Station</div>
                                        <div class="col-lg-9 col-md-8" id="station">{{$user->station}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Section</div>
                                        <div class="col-lg-9 col-md-8" id="section">{{$user->section}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Unit</div>
                                        <div class="col-lg-9 col-md-8" id="unit">{{$user->unit}}</div>
                                    </div>
                                @endisset
                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <div class="text-center" id="pass-errors"></div>
                                <form>
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control" id="password"
                                                required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword" type="password" class="form-control"
                                                id="newPassword" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="renewpassword" type="password" class="form-control"
                                                id="renewPassword" required>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button id="changepass" type="submit" class="btn btn-primary">Change
                                            Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->


</body>

<script>
    $(document).ready(function() {
        var id = {{ Auth::User()->id }};

        $("#changepass").click(function(e) {
            e.preventDefault();
            let currentPass = $('#password').val();
            let newPass = $('#newPassword').val();
            let renewPass = $('#renewPassword').val();


            $.ajax({
                type: "POST",
                url: "profile/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    currentPass: currentPass,
                    newPass: newPass,
                    renewPass: renewPass,

                },
                success: function(response) {
                    if (response.success) {
                        $('#pass-errors').addClass('text-success');
                        $('#pass-errors').show();
                        $('#pass-errors').html(response.success);
                        setTimeout(() => {
                            $('#pass-errors').hide()
                            $('#pass-errors').removeClass('text-success');
                        }, 2000);
                    }
                    if (response.error) {
                        $('#pass-errors').addClass('text-danger');
                        $('#pass-errors').show();
                        $('#pass-errors').html(response.error);
                        setTimeout(() => {
                            $('#pass-errors').hide()
                            $('#pass-errors').removeClass('text-danger');
                        }, 2000);
                    }
                    if (response.data) {
                        $('#pass-errors').addClass('text-danger');
                        $('#pass-errors').show();
                        $('#pass-errors').html(response.data);
                        setTimeout(() => {
                            $('#pass-errors').hide()
                            $('#pass-errors').removeClass('text-danger');
                        }, 2000);
                    }
                },
                error: function(error) {
                    console.log(error);

                }
            });
        });
    }); //end ready
</script>

</html>
