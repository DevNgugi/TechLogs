@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.footer')

@yield('header')
@yield('sidebar')
<style>
    td {
        white-space: nowrap;

        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        cursor: pointer;
    }

</style>
<main id="main" class="main">
    <div class="card">
        <div class="card-body">

            <h5 style="margin-left:0.5em" class="card-title">Notifications</h5>
            <div style="margin-bottom:1em;margin-left:0.5em">
                <input class="form-check-input" type="checkbox" id="gridCheck2">
                <label class="form-check-label" for="gridCheck2">
                    Mark all as read
                </label>
            </div>

            <table class="table datatable table-hover">
                @isset($notifications)
                    @foreach ($notifications as $note)
                        <tr class="">
                            <td onclick="viewNote({{ $note->id }})" class="col-11 d-fex justify-content-between">

                                @if ($note->type == 'Escalation')
                                    <i class="bi bi-exclamation-triangle-fill me-3 text-danger "></i>

                                    <span><b>{{ $note->from }}</b></span>
                                    <span class="">
                                        {{$note->head}}
                                    </span>
                                @endif
                                @if ($note->type == 'Password')
                                    <i class="bi bi-check-circle me-3 text-success "></i>
                                    <span><b>Password change:</b></span>
                                    <span class="">
                                        {{$note->subject}}
                                    </span>
                                @endif

                                @if ($note->type == 'Overdue')
                                    <i class="bi bi-exclamation-octagon me-3 text-warning "></i>
                                    <span class="">
                                        {{$note->subject}}
                                    </span>
                                @endif

                            </td>
                            @if ($note->is_read == '1')
                                <td class="d-flex justify-content-start">
                                    <i class="bi bi-check2-all me-3 text-secondary "></i>

                                </td>
                            @else
                                <td class="d-flex justify-content-start">
                                    <i class="bi bi-circle-fill me-2 text-primary "></i>
                                    <small
                                        class="text-muted">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $note->created_at)->diffForHumans() }}</small>
                                </td>
                            @endif

                        </tr>
                    @endforeach
                @endisset


            </table>

        </div>

    </div>
    </div>

</main><!-- End #main -->
<div class="modal fade" id="modalDialogScrollable" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title "><strong>View Notification</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mt-3">
                    <div class="col-lg-3 col-md-4 label ">From</div>
                    <div class="col-lg-9 col-md-8" id="from"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3 col-md-4 label">to</div>
                    <div class="col-lg-9 col-md-8" id="to"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3 col-md-4 label ">About</div>
                    <div class="col-lg-9 col-md-8" id="about"></div>
                </div>

                <div class="row mt-3">
                    <div class="col-lg-3 col-md-4 label">Subject</div>
                    <div class="col-lg-9 col-md-8" id="subject"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn-close-modal btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
               
            </div>
        </div>
    </div>
</div><!-- End Modal Dialog Scrollable-->

<script>
    function viewNote(id) {
        $("#from").html("");
        $("#to").html("");
        $("#about").html("");
        $("#subject").html("");
        $.ajax({ //create an ajax request to display.php
            type: "GET",
            url: "note/" + id,
            success: function(data) {

                $("#created-at").html(data.created_at);
                $("#from").html(data.note.from);
                $("#to").html(data.note.to);
                $("#about").html(data.note.type);
                $("#subject").html(data.note.subject);
                $(".modal").modal('show');

            },
            error:function(error){
                console.log(error);
            }
        }); //ajax

    }
</script>
</body>

</html>
