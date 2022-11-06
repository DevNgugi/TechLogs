@include('layouts.header');
@include('layouts.sidebar')
@include('layouts.footer')


<body>
    @yield('header')
    @yield('sidebar')

    <main id="main" class="main">


        <div class="pagetitle">

            <h1>Add Data</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item">Data</li>
                    <li class="breadcrumb-item active">Add Data</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Data</h5>

                <!-- No Labels Form -->
                <form class="row g-3" method="POST">
                    @csrf

                    <div class="col-md-4">
                        <label for="role" class="form-label">Select Category</label>
                        <select id="identifier" class="form-select" name="identifier">
                            <option selected>Programme</option>
                            <option>Problem Type</option>
                            <option>Service</option>
                            <option>Region</option>
                            <option>Station</option>
                            <option>Unit</option>
                        </select>
                    </div>

                    <div id="group-div" class="col-md-4">
                        <label for="group" class="form-label">Group</label>
                        <input id="group" type="text" class="form-control" name="group" required />
                    </div>

                    <div id="section-div" class="col-md-4">
                        <label for="section" class="form-label">Section</label>
                        <select id="section" class="form-select" name="section">
                            <option selected>Transmission</option>
                            <option>Production</option>
                            <option>DVBT</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="name" class="form-label">Content</label>
                        <input id="content" type="text" class="form-control" name="content" required />
                    </div>

                    <div id="region-div" class="col-md-4">
                        <label for="role" class="form-label">Select Region</label>
                        <select id="region" class="form-select" name="region">
                            @foreach ($records as $data)
                                @if ($data->identifier == 'Region')
                                    <option>{{ $data->content }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center">
                        <button id="add-data-btn" class="btn btn-primary">Submit</button>
                    </div>
                </form><!-- End No Labels Form -->

            </div>
        </div>
        <section id="data-show" class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body ">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title ">View and Edit Data</h5>
                            <button onclick="location.reload()" style="margin-right: 2em" type="button" class="btn btn-success btn-sm"><i class="bi bi-arrow-clockwise"></i>Refresh</button>
                            
                            </div>
                            <div class="table-responsive">
                                <!-- Table with stripped rows -->
                                <table class="table datatable ">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Identifier</th>
                                            <th scope="col">Group</th>
                                            <th scope="col">Content</th>
                                            <th class="" scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="editTable">
                                        @foreach ($records as $data)
                                            <tr>
                                                <td>{{ $data->id}}</td>
                                                <td>{{ $data->identifier }}</td>
                                                <td>{{ $data->group }}</td>
                                                <td>{{ $data->content }}</td>
                                                <td >
                                                    <button onclick="viewModal({{ $data->id }})"
                                                        class="btn btn-success">View</button>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        {{-- start modal for edit --}}
        <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title "><strong>View Data details</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form class="row" id="modal-form">
                            @csrf
                            <label class=" col-lg-3 col-md-4 mt-3  label">Identifier</label>
                            <div id="identifier-update" class="col-lg-9 col-md-8 mt-3">

                            </div>
                            <div id="group-update-div" class="row">
                                <div class="mt-3 col-lg-3 col-md-8 label">Group</div>
                                <div class=" mt-3 col-lg-9 col-md-8">
                                    <input class="form-control" id="group-update" required type="text">
                                </div>
                            </div>
                            <div id="region-input-div" class="row">
                                <div class="mt-3 col-lg-3 col-md-8 label">Region</div>
                                <div class=" mt-3 col-lg-9 col-md-8">
                                    <select id="region-update" class="form-select">
                                        @foreach ($records as $data)
                                            @if ($data->identifier == 'Region')
                                                <option>{{ $data->content }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="update-section-div" class="col-md-4">
                                <label for="section" class="form-label">Section</label>
                                <select id="update-section" class="form-select" name="update-section">
                                    <option selected>Transmission</option>
                                    <option>Production</option>
                                    <option>DVBT</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="mt-3 col-lg-3 col-md-8 label">Content</div>
                                <div class="mt-3 col-lg-9 col-md-8">
                                    <input class="form-control" id="content-update" required type="text">
                                </div>
                            </div>

                        </form>
                        <input name="hidden_id" id="hidden_id" type="hidden">
                    </div>
                    <div class="modal-footer">
                        <button onclick="deleteData()" class="update-button btn btn-danger" type="button">
                            Delete</button>
                        <button onclick="update()" class="update-button btn btn-primary" type="button">Submit
                            Changes</button>

                    </div>
                </div>
            </div>
        </div><!-- End Modal Dialog Scrollable-->

    </main><!-- End #main -->
 

    <script>
        $(document).ready(function() {
            $('#region-div').hide();
            $('#group-div').hide();
            $('#section-div').hide();

            $("#add-data-btn").click(function(e) {
                var identifier = $('#identifier').val();
                var group = '';
                var content = $('#content').val();
                var station = '';
                var region = '';
                var section = '';

                if (identifier == 'Station') {
                    region = $('#region').val();
                    group = $('#group').val();

                }
                if (identifier == 'Problem Type') {
                    group = $('#group').val();
                }
                if (identifier == 'Unit') {
                    section = $('#section').val();
                }


                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "/addData",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        identifier: identifier,
                        group: group,
                        content: content,
                        station: station,
                        region: region,
                        section: section

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
                        console.log(error.error);

                    }
                }); //end ajax
            }); //end button click

            // get selected role
            $('#identifier').change(function() {
                let region = $('#region-div');
                let group = $('#group-div');
                let identifier = $('#identifier').val();
                let section = $('#section-div');

                group.hide();
                region.hide();
                section.hide();

                if (identifier == 'Station') {
                    region.show();
                    group.show();
                } else if (identifier == 'Problem Type') {
                    group.show();
                } else if (identifier == 'Unit') {
                    section.show();
                } else {
                    group.hide();
                    region.hide();
                }
            });
        }); //end document readt
    </script>

    <script>
        $(document).ready(function() {

            $('#region-update').select2({
                theme: "bootstrap",
                dropdownParent: $('#modalDialogScrollable')
            });
            
            $('#region').select2({
                theme: "bootstrap"
            });
        });

        function viewModal(id) {
            $('#hidden_id').val(id);
            $('#region-input-div').hide();
            $('#group-update-div').hide();
            $('#update-section-div').hide();
            $.ajax({ //create an ajax request to display.php
                type: "GET",
                url: "data/" + id,
                success: function(data) {

                    $('#identifier-update').html(data.identifier)
                    if (data.group) {

                        $('#group-update').val(data.group)
                        $('#group-update-div').show();
                    }
                    if (data.identifier == 'Station') {
                        $('#region-input-div').show();
                    }

                    $('#content-update').val(data.content)

                    $("#modalDialogScrollable").modal('show');
                }

            }); //ajax

        }

        function update() {
            var id = $('#hidden_id').val();
            var identifier = $('#identifier-update').text();
            var group = '';
            var content = $('#content-update').val();
            var station = '';
            var region = '';
            var section = '';

            if (identifier == 'Station') {
                region = $('#region-update').val();
                group = $('#group-update').val();

            }
            if (identifier == 'Problem Type') {
                group = $('#group-update').val();
            }
            if (identifier == 'Unit') {
                section = $('#update-section').val();
            }


            $.ajax({
                type: "POST",
                url: "/data/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    identifier: identifier,
                    group: group,
                    content: content,
                    station: station,
                    region: region,
                    section: section

                },
                success: function(response) {
                    $("#modalDialogScrollable").modal('hide');
                    if (response.success) {
                        toastr.success(response.success, "Success")
                    }
                    if (response.error) {
                        toastr.error(response.error, "Error")
                    }

                },
                error: function(error) {
                    console.log(error.error);

                }
            }); //end ajax

        }

        function deleteData() {
            var id = $('#hidden_id').val();
            $.ajax({
                type: "POST",
                url: "/delete/data/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $("#modalDialogScrollable").modal('hide');
                    if (response.success) {
                        toastr.success(response.success, "Success")
                    }
                    if (response.error) {
                        toastr.error(response.error, "Error")

                    }

                },
                error: function(error) {
                    console.log(error.error);

                }
            }); //end ajax

        }
        //on closing modal

    </script>

</body>


</html>
