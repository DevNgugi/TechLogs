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
            <h1>All Logs</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item">Logs</li>
                    <li class="breadcrumb-item active">All logs</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body ">
                            <h5 class="card-title ">Logs</h5>
                            <div class="table-responsive">
                                <!-- Table with stripped rows -->
                                <table class="table datatable ">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Logger</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Station</th>
                                            <th scope="col">Service</th>
                                            <th scope="col">Nature</th>
                                            <th scope="col">Priority</th>
                                            <th scope="col">Status</th>
                                            <th class="" scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($logs)
                                            @foreach ($logs as $log)
                                                @if (Auth::user()->email == $log->logger_email || $log->escalated_to == Auth::user()->email || Auth::user()->role == 'PTO Production')
                                                    <tr>
                                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                                        <td class="">{{ $log->logger_email }}</td>
                                                        <td>{{ $log->event_date }}</td>
                                                        <td>{{ $log->event_time }}</td>
                                                        <td>{{ $log->station }}</td>
                                                        <td>{{ $log->service }}</td>

                                                        @if ($log->event_nature == 'Normal Event')
                                                            <td><span
                                                                    class="badge bg-info text-dark">{{ 'Normal' }}</span>
                                                            </td>
                                                        @else
                                                            <td><span
                                                                    class="badge bg-warning text-dark">{{ 'Negative' }}</span>
                                                            </td>
                                                        @endif

                                                        @if ($log->priority == 'Low')
                                                            <td><span
                                                                    class="badge bg-light text-dark">{{ $log->priority }}</span>
                                                            </td>
                                                        @elseif($log->priority == 'Normal')
                                                            <td><span
                                                                    class="badge bg-info text-dark">{{ $log->priority }}</span>
                                                            </td>
                                                        @elseif($log->priority == 'High')
                                                            <td><span
                                                                    class="badge bg-warning text-dark">{{ $log->priority }}</span>
                                                            </td>
                                                        @else
                                                            <td><span
                                                                    class="badge bg-danger ">{{ $log->priority }}</span>
                                                            </td>
                                                        @endif

                                                        @if ($log->status == 'Open')
                                                            <td><span id="status{{ $log->id }}"
                                                                    class="">{{ $log->status }}</span></td>
                                                        @elseif ($log->status == 'Closed')
                                                            <td><span id="status{{ $log->id }}"
                                                                    class="text-primary">{{ $log->status }}</span></td>
                                                        @elseif ($log->status == 'Resolved')
                                                            <td><span id="status{{ $log->id }}"
                                                                    class="text-success">{{ $log->status }}</span></td>
                                                        @elseif ($log->status == 'Escalated')
                                                            <td><span id="status{{ $log->id }}"
                                                                    class="text-danger">{{ $log->status }}</span></td>
                                                        @endif

                                                        <td class="">
                                                            <button 
                                                              onclick="viewModal({{$log->id }})"
                                                                class="modal-button btn btn-primary btn-sm"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalDialogScrollable">View</button>
                                                        </td>

                                                    </tr>
                                                @endif
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

        <div  class="modal fade" id="modalDialogScrollable" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title "><strong>View log details</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-3">
                            <div class="col-lg-3 col-md-4 label ">Event Date</div>
                            <div class="col-lg-9 col-md-8" id="event-date"></div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-3 col-md-4 label">Event time</div>
                            <div class="col-lg-9 col-md-8" id="event-time"></div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-3 col-md-4 label">Event Nature</div>
                            <div class="col-lg-9 col-md-8" id="event-nature"></div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-3 col-md-4 label">Status</div>
                            <div class="col-lg-9 col-md-8" id="event-status"></div>
                        </div>
                        <form style="display: none" class="row mt-3" id="modal-form">
                            @csrf
                            @if (Auth::user()->role == 'PTO Production' || Auth::user()->role == 'PTO Transmission' || Auth::user()->role == 'DVBT Manager')
                                <div id='escalate-label' class="col-lg-3 col-md-8 label mt-3">
                                    <span class="badge bg-danger">Escalate To: </span>
                                </div>

                                <div id='escalate-select' class="col-lg-9 col-md-8 mt-3 mb-3">
                                    <select id="escalate" class="form-select" name="escalate">
                                        @foreach ($users as $user)
                                            <option>{{ $user->email }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            @if (Auth::user()->role == 'Technical Operator' || Auth::user()->role == 'Technician')
                                <div class="col-lg-3 col-md-8 label">Take Action </div>

                                <div class="col-lg-9 col-md-8">
                                    <select id="status-update" class="form-select" name="status">
                                        <option selected>Closed</option>
                                        <option> Resolved</option>
                                    </select>
                                </div>
                            @endif
                            @if (Auth::user()->role == 'PTO Production' || Auth::user()->role == 'PTO Transmission' || Auth::user()->role == 'DVBT Manager' || Auth::user()->role == 'Technical Operator' || Auth::user()->role == 'Technician')
                                <label class="col-lg-3 col-md-4 mt-3  label">Comments</label>
                                <div class="col-lg-9 col-md-8 mt-3">
                                    <textarea required id="comments-update" class="form-control" style="height: 100px"></textarea>
                                </div>
                            @endif
                        </form>
                        <input name="hidden_id" id="hidden_id" type="hidden">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close-modal btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button style="display: none" class="update-button btn btn-primary" type="button">Submit
                            Changes</button>
                    </div>
                </div>
            </div>
        </div><!-- End Modal Dialog Scrollable-->

    </main><!-- End #main -->
    <script type=text/javascript>
        var auth_email = "{{Auth::User()->email}}";
        var auth_role = "{{Auth::User()->role}}";

        $(document).ready(function() {
            $('.alert').hide();

            $(".update-button").click(function() {
                
                let id = $('#hidden_id').val();
                let status = $('#status-update').val();
                let comments = $('#comments-update').val();
                let escalated_to = $('#escalate').val();
                let nature = $("#event-nature").text();

                let record = id;
                $.ajax({
                    type: "POST",
                    url: "/logs/id",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        email: auth_email,
                        record: record,
                        status: status,
                        escalated_to: escalated_to,
                        comments: comments,
                        nature: nature,

                    },
                    success: function(response) {
                        if (response) {
                            $('.alert').addClass("alert-success");
                            $('.alert').text(response.success);
                            $('.alert').show();
                            $('.btn-close-modal').click();

                            $.fn.updateTable(record);

                            setTimeout(() => {
                                $('.alert').hide();
                                $('.alert').removeClass("alert-success");
                            }, 4000);

                        }
                    },
                    error: function(error) {
                        console.log(error);

                    }
                });

            });

            $.fn.updateTable = function(id) {

                $.ajax({
                    type: "GET",
                    url: "logs/id/" + id,
                    success: function(data) {
                        if (data.status == 'Open') {
                            $("#status" + id).html('Open');
                        } else if (data.status == 'Closed') {
                            $("#status" + id).addClass('text-primary');
                            $("#status" + id).html('Closed');
                        } else if (data.status == 'Escalated') {
                            $("#status" + id).addClass('text-danger');
                            $("#status" + id).html('Escalated');
                        } else {
                            $("#status" + id).addClass('text-success');
                            $("#status" + id).html('Resolved');
                        }
                    }
                });

            }
            // select 2 search code
            $('#escalate').select2({
                theme: "bootstrap",
                dropdownParent: $('#modalDialogScrollable')
            });


        });

        function viewModal(id){
         
                $("#event-date").html("");
                $("#event-time").html("");
                $("#event-nature").html("");
                $("#event-status").html("");
                $.ajax({ //create an ajax request to display.php
                    type: "GET",
                    url: "logs/id/" + id,
                    success: function(data) {
                        $('#hidden_id').val(id);
                        $("#event-date").html(data.event_date);
                        $("#event-time").html(data.event_time + " hrs");
                        $(".update-button").attr('id', data.id);
                        if (data.event_nature == 'Normal Event') {
                            $("#event-nature").html('Normal Event');
                        } else {
                            $("#event-nature").html('Negative Incident');
                        }
                        if (data.status == 'Open') {
                            $("#event-status").html('Open');
                            $("#modal-form").css("display", "flex");
                            $(".update-button").css("display", "flex");

                        }
                        if (data.status == 'Escalated' && auth_role != 'Technician') {
                            $("#event-status").html('Escalated');
                            $("#modal-form").css("display", "none");
                            $(".update-button").css("display", "none");
                        }
                        if (data.status == 'Escalated' && auth_role == 'Technician') {
                            $("#event-status").html('Escalated');
                            $("#modal-form").css("display", "flex");
                            $(".update-button").css("display", "flex");
                        }
                        if (data.status == 'Closed') {
                            $("#event-status").html('Closed');
                            $("#modal-form").css("display", "none");
                            $(".update-button").css("display", "none");
                        }
                        if (data.status == 'Resolved') {
                            $("#event-status").html('Resolved');
                            $("#modal-form").css("display", "none");
                            $(".update-button").css("display", "none");
                        }

                        if (data.status == 'Escalated' && auth_email != data.escalated_to) {
                            $("#event-status").html('Escalated');
                            $("#modal-form").css("display", "none");
                            $(".update-button").css("display", "none");
                        }
                        $(".modal").modal('show');


                    }
                }); //ajax
           
        }
    </script>

</body>

</html>
