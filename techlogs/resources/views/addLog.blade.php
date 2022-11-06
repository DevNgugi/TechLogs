@include('layouts.header');
@include('layouts.sidebar')
@include('layouts.footer')


<body>
@yield('header')
@yield('sidebar')
  <main id="main" class="main">

    <div class="pagetitle">

        <h1>Add Log</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item">Logs</li>
            <li class="breadcrumb-item active">Add Log</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Add New Log</h5>

          <!-- No Labels Form -->
          <form class="row g-3" method="POST">
            @csrf
            <div class="col-md-4">
              <label for="" class="form-label">Date of Event</label>
              <input  type="date" class="form-control" id="event_date" required>
            </div>
            <div class="col-md-4">
                <label for="" class="form-label">Time of Event</label>
              <input type="time" class="form-control" id="event_time" required>
            </div>
            <div class="col-md-4">
                <label for="" class="form-label">Nature of Event</label>
              <select  class="form-select" id="event_nature">
                <option selected >Normal Event</option>
                <option >Negative Incident</option>
              </select>
            </div>

            <div class="col-md-4">
              <label for="" class="form-label">Problem Type</label>
            <select class="form-select" id="problem">
              @foreach ($records as $data)
              @if ($data->identifier=='Problem Type')
              <option>{{$data->content}}</option>
              @endif
              @endforeach

            </select>
          </div>

            <div class="col-md-4">
              <label for="" class="form-label">Priority</label>
            <select class="form-select" id="priority">
              <option selected >Low</option>
              <option >Normal</option>
              <option >High</option>
              <option >Emergency</option>
            </select>
          </div>
          @if (Auth::User()->section=='Production'|| Auth::User()->role =='admin')
       
          <div class="col-md-4">
            <label for="programme" class="form-label">Programme</label>
          <select class="form-select" id="programme">
          @foreach ($records as $data)
              @if ($data->identifier=='Programme')
              <option>{{$data->content}}</option>
              @endif
              @endforeach
          </select>
          </div>
          @endif

          <div class="col-md-4">
            <label for="" class="form-label">Service</label>
          <select class="form-select" id="service">
          @foreach ($records as $data)
              @if ($data->identifier=='Service')
              <option>{{$data->content}}</option>
              @endif
              @endforeach
          </select>
        </div>


          <div class="col-md-4">
            <label for="" class="form-label">Station Area</label>
          <select  class="form-select" id="station">
          @foreach ($records as $data)
              @if ($data->identifier=='Station')
              <option>{{$data->content}}</option>
              @endif
              @endforeach
          </select>
        </div>


      <div class="col-md-4">
        <label for="" class="form-label">Unit</label>
      <select class="form-select" id="unit">
      @foreach ($records as $data)
              @if ($data->identifier=='Unit')
              <option>{{$data->content}}</option>
              @endif
              @endforeach
      </select>
    </div>

          <div class="col-md-4">
            <label for="" class="form-label">Region </label>
          <select id="region" class="form-select" id="region">
          @foreach ($records as $data)
              @if ($data->identifier=='Region')
              <option>{{$data->content}}</option>
              @endif
              @endforeach
          </select>
        </div>
            <div class="col-md-12">
                <label for="" class="form-label">Description</label>
                <textarea class="form-control" style="height: 100px" id="description" required></textarea>
            </div>
            <div class="text-center">
              <button id='add-log-btn' type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form><!-- End No Labels Form -->

        </div>
      </div>

  </main><!-- End #main -->
  <!-- end isset records variable from the data controller
 -->
 
<div class="modal fade" id="basicModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-white"><span> <i class="title_icon bi "></i><span> <span id=""> </span></h5>
        <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn border-secondary" data-bs-dismiss="modal">Okay</button>
      </div>
      
    </div>
  </div>
</div><!-- End error Modal-->

</body>
<script>
  $(document).ready(function() {
    $('#basicModal').modal('hide')
  
    $("#add-log-btn").click(function(e) { 

    if($('.modal-header').hasClass('bg-danger')){$('.modal-header').removeClass('bg-danger')}
    if($('.modal-header').hasClass('bg-success')){$('.modal-header').removeClass('bg-success')}
    if($('.title_icon').hasClass('bi-exclamation-triangle')){$('.title_icon').removeClass('bi-exclamation-triangle')}
    if($('.title_icon').hasClass('bi-check2-square')){$('.title_icon').removeClass('bi-check2-square')}

    var event_date= $('#event_date').val(); 
    var event_time= $('#event_time').val(); 
    var event_nature= $('#event_nature').val(); 
    var priority= $('#priority').val(); 
    var programme= $('#programme').val(); 
    var service= $('#service').val(); 
    var problem= $('#problem').val(); 
    var description= $('#description').val(); 
    var unit= $('#unit').val(); 
    var region= $('#region').val(); 
    var station= $('#station').val(); 

    e.preventDefault();
    $.ajax({ 
    type: "POST",
    url: "/addLog", 
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
    data:{
      event_date:event_date,
      event_time:event_time,
      event_nature:event_nature,
      priority:priority,
      programme:programme,
      service:service,
      problem:problem,
      description:description,
      unit:unit,
      region:region,
      station:station

    },     
    success: function (response) {
      if(response.success) {
      $('.modal-header').addClass('bg-success');
      $('.title_icon').addClass('bi-check2-square');
      $('.title_icon').next().html(' Success');
      $('.modal-body').html(response.success);
      $('#basicModal').modal('show');
      }if(response.error){
        $('.modal-header').addClass('bg-danger');
      $('.title_icon').addClass('bi-exclamation-triangle');
      $('.title_icon').next().html(' Error');
      $('.modal-body').html(response.error);
      $('#basicModal').modal('show');
      }

},
error: function(error) {
        console.log(error.error);
        
        }
});//end ajax

  });//end button click

// select 2 search code
$('#problem, #region,#station,#unit,#service,#programme').select2({
    theme: "bootstrap"
});


});
</script>
</html>