@include('layouts.header');
@include('layouts.sidebar')
@include('layouts.footer')


<body>
    @yield('header')
    @yield('sidebar')
    <main id="main" class="main">
        <div style="display:none" class="alert  alert-dismissible fade show" role="alert">

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="pagetitle">

            <h1>Add User</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Add User</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add New User</h5>

                <!-- No Labels Form -->
                <form class="row g-3" method="POST">
                    @csrf

                    <div class="col-md-4">
                        <label for="role" class="form-label">Select Role</label>
                        <select id="role" class="form-select" name="role">
                            <option selected>Technician</option>
                            <option>Technical Operator</option>
                            <option>EIC</option>
                            <option>CTO</option>
                            <option>PTO Production</option>
                            <option>PTO Transmission</option>
                            <option>DVBT Manager</option>
                            <option>AMTS Production</option>
                            <option>AMTS Transmission</option>
                            <option>MTS</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="form-label">Name</label>
                        <input required id="name" type="text" class="form-control" name="name" />
                    </div>

                    <div class="col-md-4">
                        <label for="email" class="form-label">Email</label>
                        <input required autocomplete="false" id="email" type="email" class="form-control"
                            name="email" />
                    </div>

                    <div class="col-md-4">
                        <label for="phone" class="form-label">Phone</label>
                        <input autocomplete="off" id="phone" type="number" class="form-control" name="phone"
                            required />
                    </div>

                    <div id="region-div" class="col-md-4">
                        <label for="region" class="form-label">Region</label>
                        <select id="region" class="form-select" name="region">
                            @foreach ($records as $data)
                                @if ($data->identifier == 'Region')
                                    <option>{{ $data->content }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div id="station-div" class="col-md-4">
                        <label for="station" class="form-label">Station</label>
                        <select id="station" class="form-select" name="station">
                            @foreach ($records as $data)
                                @if ($data->identifier == 'Station')
                                    <option>{{ $data->content }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div id="section-div" class="col-md-4">
                        <label for="station" class="form-label">Section</label>
                        <select id="section" class="form-select" name="section">
                            <option selected>Production</option>
                            <option>Transmission</option>
                            <option>DVBT</option>
                        </select>
                    </div>

                    <div id="unit-div" class="col-md-4">
                        <label for="unit" class="form-label">Unit</label>
                        <select id="unit" class="form-select" name="unit">
                            @foreach ($records as $data)
                                @if ($data->identifier == 'Unit')
                                    <option>{{ $data->content }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="password" class="form-label">Password</label>
                        <input autocomplete="off" id="password" type="password" class="form-control" name="password"
                            required />
                    </div>

                    <div class="text-center">
                        <button id="add-user-btn" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form><!-- End No Labels Form -->

            </div>
        </div>

    </main><!-- End #main -->
    <script>
        function isBlank(str) {
            return (!str || /^\s*$/.test(str));
        }
        $(document).ready(function() {
            $('#basicModal').modal('hide')
            $("#add-user-btn").click(function(e) {
                e.preventDefault();
                

                var name = $('#name').val();
                var phone = $('#phone').val();
                var email = $('#email').val();
                var station = $('#station').val();
                var region = $('#region').val();
                var password = $('#password').val();
                var role = $('#role').val();
                var unit = $('#unit').val();
                var section = $('#section').val();

                if ((isBlank(name)) ||
                    (isBlank(email)) ||
                    (isBlank(phone)) ||
                    (isBlank(name)) ||
                    (isBlank(password))
                ) {
                    toastr.error('Please fill All fields', "Error")
                } 
                if (
                    role == 'DVBT Manager' ||
                    role == 'PTO Transmission' ||
                    role == 'PTO Production') {
              
                } 
                if (role == 'MTS' ||
                    role == 'AMTS Transmission' ||
                    role == 'AMTS Production') {

                    region = '';
                    unit = '';
                    section = '';
                    station = '';
                    
                }
                    $.ajax({
                        type: "POST",
                        url: "/addUser",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            name: name,
                            phone: phone,
                            email: email,
                            station: station,
                            section: section,
                            region: region,
                            password: password,
                            role: role,
                            unit: unit

                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.success, "Success")
                            }
                            if (response.error) {
                                toastr.error(response.error, "Error")
                            }

                        },
                        error: function(error) {
                            console.log(error);

                        }
                    }); //end ajax
                
            }); //end button click


            // get selected role
            $('#role').change(function() {
                let role = $('#role').val();
                let station = $('#station-div');
                let unit = $('#unit-div');
                let region = $('#region-div');
                let section = $('#section-div');

                region.show();
                station.show();
                unit.show();
                section.show();

                if (role == 'DVBT Manager' || role == 'PTO Transmission' || role == 'PTO Production') {
                    region.hide();
                    unit.hide();
                    station.hide();
                }
                if (role == 'MTS' || role == 'AMTS Transmission' || role == 'AMTS Production') {
                    region.hide();
                    unit.hide();
                    station.hide();
                    section.hide();
                } else {
                    region.show();
                    station.show();
                    unit.show();
                    section.show();
                }
            });


            // select 2 search code
            $('#problem, #region,#station,#unit,#service,#programme').select2({
                theme: "bootstrap"
            });


        }); //end document readt
    </script>
    <script>
        // phone validation
        $(document).ready(function() {

            $('#phone').focusout(function() {

                if (/^\d{10}$/.test($(this).val())) {
                    $('#phone').css("border-color", "#ced4da");

                } else {

                    $(this).css("border-color", "red");
                }

            });

        });
    </script>


</body>

</html>
