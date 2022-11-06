@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.footer')

<body>
    @yield('header')
    @yield('sidebar')
    <main id="main" class="main">
        <div style="display:none" class=" alert alert-dismissible fade show" role="alert">

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="pagetitle">
            <h1>All Users</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">All Users</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body ">
                            <h5 class="card-title ">Users</h5>
                            <div class="table-responsive">
                                <!-- Table with stripped rows -->
                                <table id="mytable" class="table datatable ">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">role</th>
                                            <th scope="col">Region</th>
                                            <th class="" scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($records)
                                            @foreach ($records as $record)
                                                <tr>
                                                    <th scope="row">{{ $record->id }}</th>
                                                    <td class="">{{ $record->name }}</td>
                                                    <td class="">{{ $record->email }}</td>
                                                    <td>{{ $record->phone }}</td>
                                                    <td>{{ $record->role }}</td>
                                                    <td>{{ $record->region }}</td>

                                                    <td class="">
                                                        <button onclick="viewModal({{ $record->id }})"
                                                            class="modal-button btn btn-primary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalDialogScrollable">View</button>
                                                    </td>

                                                </tr>
                                            @endforeach

                                        @endisset


                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- view modal start --}}

        <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title "><strong>View User details</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-3">
                            <div class="col-lg-3 col-md-4 label ">Name</div>
                            <div class="col-lg-9 col-md-8" id="name"></div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-3 col-md-4 label">Email</div>
                            <div class="col-lg-9 col-md-8" id="email"></div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-3 col-md-4 label">Phone</div>
                            <div class="col-lg-9 col-md-8" id="phone"></div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-3 col-md-4 label">Role</div>
                            <div class="col-lg-9 col-md-8" id="role"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3 col-md-4 label">Station</div>
                            <div class="col-lg-9 col-md-8" id="station"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3 col-md-4 label">Section</div>
                            <div class="col-lg-9 col-md-8" id="section"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3 col-md-4 label">Unit</div>
                            <div class="col-lg-9 col-md-8" id="unit"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3 col-md-4 label">Region</div>
                            <div class="col-lg-9 col-md-8" id="region"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3 col-md-4 label">Created At</div>
                            <div class="col-lg-9 col-md-8" id="created-at"></div>
                        </div>


                        <input name="hidden_id" id="hidden_id" type="hidden">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close-modal btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button 
                        onclick="removeUser()" id="delete-btn" type="button" class="btn btn-danger"
                            data-bs-dismiss="modal">Delete</button>

                    </div>
                </div>
            </div>
        </div><!-- End Modal Dialog Scrollable-->

    </main><!-- End #main -->
    <script type=text/javascript>
        $(document).ready(function() {
            $('.alert').hide();
            // select 2 search code
            
        });
        var currentId={{Auth::User()->id}}
        function viewModal(id) {

            if (currentId==id) {
                $('#delete-btn').prop('disabled', true);
            } 
            else{
                $('#delete-btn').prop('disabled', false);
            } 

            $("#created-at").html("");
            $("#region").html("");
            $("#unit").html("");
            $("#section").html("");
            $("#station").html("");
            $("#role").html("");
            $("#phone").html("");
            $("#email").html("");
            $("#name").html("");
            $("#hidden_id").val(id);
            $.ajax({ //create an ajax request to display.php
                type: "GET",
                url: "user/" + id,
                success: function(data) {

                    $("#created-at").html(data.created_at);
                    $("#region").html(data.user.region);
                    $("#unit").html(data.user.unit);
                    $("#section").html(data.user.section);
                    $("#station").html(data.user.station);
                    $("#role").html(data.user.role);
                    $("#phone").html(data.user.phone);
                    $("#email").html(data.user.email);
                    $("#name").html(data.user.name);
                    $(".modal").modal('show');

                }
            }); //ajax

        }

        function removeUser() {
            
            id = $("#hidden_id").val();
            $.ajax({ //create an ajax request to display.php
                type: "POST",
                url: "user/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.success, "Success")
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error(response.error, "Error")
                    }
                }
            }); //ajax

        }
    </script>

</body>

</html>
