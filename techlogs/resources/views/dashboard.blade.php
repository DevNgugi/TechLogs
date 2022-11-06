@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.footer')

<body>
@yield('header')
@yield('sidebar')

  <main id="main" class="main">
    <div class="pagetitle">
        <h1>Activity Summary</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item">activity</li>
            <li class="breadcrumb-item active">summary</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
  
      <section class="section dashboard">
        <div class="row">
  
          <!-- Left side columns -->
          <div class="col-lg-12">
            <div class="row">
  
              <!-- Sales Card -->
              <div class="col-xxl-4 col-md-4">
                <div class="card info-card customers-card">
  
                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                      </li>
  
                      <li ><a id="esc_today" class="dropdown-item" href="#">Today</a></li>
                      <li>  <a id="esc_month" class="dropdown-item" href="#">This Month</a></li>
                      <li><a id="esc_year" class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                  </div>
  
                  <div class="card-body">
                    <h5 class="card-title">Escalated <span id="label_esc">| This year</span></h5>
  
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-up-right-square"></i>
                      </div>
                      <div class="ps-3">
                        <h6 class="count" id="escalated_count"></h6>
                        <span id="percent_esc" class=" small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1"></span>
  
                      </div>
                    </div>
                  </div>
  
                </div>
              </div><!-- End Sales Card -->
  
              <!-- Revenue Card -->
              <div class="col-xxl-4 col-md-4">
                <div class="card info-card sales-card">
  
                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                      </li>
  
                      <li><a id="open_today" class="dropdown-item" href="#">Today</a></li>
                      <li><a id="open_month" class="dropdown-item" href="#">This Month</a></li>
                      <li><a id="open_year" class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                  </div>
  
                  <div class="card-body">
                    <h5 class="card-title">Open <span id="label_open">| This Year</span></h5>
  
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-envelope-open"></i>
                      </div>
                      <div class="ps-3">
                        <h6 class="count" id="open_count"></h6>
                        <span id="percent_open" class=" small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1"></span>
  
                      </div>
                    </div>
                  </div>
  
                </div>
              </div><!-- End Revenue Card -->

               <!-- Revenue Card -->
               <div class="col-xxl-4 col-md-4">
                <div class="card info-card revenue-card">
  
                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                      </li>
  
                      <li><a id="closed_today"  class="dropdown-item" href="#">Today</a></li>
                      <li><a id="closed_month" class="dropdown-item" href="#">This Month</a></li>
                      <li><a id="closed_year" class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                  </div>
  
                  <div class="card-body">
                    <h5 class="card-title">Closed <span id="label_closed">| This Year</span></h5>
  
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-envelope"></i>
                      </div>
                      <div class="ps-3">
                        <h6 class="count" id="closed_count"></h6>
                        <span id="percent_closed" class=" small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1"></span>
  
                      </div>
                    </div>
                  </div>
  
                </div>
              </div><!-- End Revenue Card -->
              
              <!-- Reports -->
              <div class="col-lg-6">
                <div class="card">
  
                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                      </li>
  
                      <li><a class="dropdown-item" href="#">Today</a></li>
                      <li><a class="dropdown-item" href="#">This Month</a></li>
                      <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                  </div>
  
                  <div class="card-body">
                    <h5 class="card-title">Event Nature <span>/This year</span></h5>
  
                    <!-- Line Chart -->
                    <canvas id="lineChart"></canvas>
                   
                  </div>
  
                </div>
              </div><!-- End Reports -->
              <div class="col-lg-6 ">
                <div class="card">
  
                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                      </li>
  
                      <li><a class="dropdown-item" href="#">Today</a></li>
                      <li><a class="dropdown-item" href="#">This Month</a></li>
                      <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                  </div>
  
                  <div class="card-body">
                    <h5 class="card-title">Event Priority <span>/This Year</span></h5>
  
                    <!-- Line Chart -->
                    <canvas id="barChart"></canvas>
                   
                  </div>
  
                </div>
              </div><!-- End Reports -->
  
              <!-- Recent Sales -->
              <div class="col-12">
                <div class="card recent-sales overflow-auto">
  
                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                      </li>
  
                      <li><a class="dropdown-item" href="#">Today</a></li>
                      <li><a class="dropdown-item" href="#">This Month</a></li>
                      <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                  </div>
  
                  <div class="card-body">
                    <h5 class="card-title">Recent Escalations <span>| Today</span></h5>
  
                    <table class="table table-borderless datatable">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Logger</th>
                          <th scope="col">Description</th>
                          <th scope="col">Service</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @isset($records)
                        @foreach ($records as $record)
                        <tr>
                          <th scope="row">#{{$record->id}}</a></th>
                          <td>{{$record->logger_email}}</td>
                          <td>{{$record->description}}</td>
                          <td>{{$record->service}}</td>
                          <td><span class="badge bg-danger">Escalated</span></td>
                        </tr>
                        @endforeach
                        @endisset
                      </tbody>
                    </table>
  
                  </div>
  
                </div>
              </div><!-- End Recent Sales -->
  
            </div>
          </div><!-- End Left side columns -->
  
  
        </div>
      </section>
  </main><!-- End #main -->
</body>

<script>
  
    $(document).ready(function() {
      let data_global= [];
      //get data from db to fill charts
      $.ajax({  //create an ajax request to display.php
        type: "GET",
        url: "chart/data",       
        success: function (data) {
          
          data_global= data;
          $('#escalated_count').html(data[3][2]);
          $('#open_count').html(data[4][2]);
          $('#closed_count').html(data[5][2]);

          if((data_global[3][5])>-1){
           if($('#percent_esc').hasClass('text-danger')){ $('#percent_esc').removeClass('text-danger');}
            $('#percent_esc').addClass('text-success');
            $('#percent_esc').html((data_global[3][5])+'%');
            $('#percent_esc').next().html('Increase');
          }else{
            if($('#percent_esc').hasClass('text-success')){ $('#percent_esc').removeClass('text-success');}
            $('#percent_esc').addClass('text-danger');
            $('#percent_esc').html((data_global[3][5])*-1+'%')
            $('#percent_esc').next().html('Decrease');
          }
          

          if((data_global[4][5])>-1){
            if($('#percent_esc').hasClass('text-danger')){ $('#percent_esc').removeClass('text-danger');}
            $('#percent_open').addClass('text-success');
            $('#percent_open').html((data_global[4][5])+'%');
            $('#percent_open').next().html('Increase');
            
          }else{
            if($('#percent_esc').hasClass('text-success')){ $('#percent_esc').removeClass('text-success');}
            $('#percent_open').addClass('text-danger');
            $('#percent_open').html((data_global[4][5])*-1+'%')
            $('#percent_open').next().html('Decrease');
          }


          if((data_global[5][5])>-1){
            if($('#percent_esc').hasClass('text-danger')){ $('#percent_esc').removeClass('text-danger');}
            $('#percent_closed').addClass('text-success');
            $('#percent_closed').html((data_global[5][5])+'%');
            $('#percent_closed').next().html('Increase');
            
          }else{
            if($('#percent_esc').hasClass('text-success')){ $('#percent_esc').removeClass('text-success');}
            $('#percent_closed').addClass('text-danger');
            $('#percent_closed').html((data_global[5][5])*-1+'%')
            $('#percent_closed').next().html('Decrease');
          }


          $('.count').each(function () {
              $(this).prop('Counter',0).animate({
                  Counter: $(this).text()
              }, {
                  duration: 1000,
                  easing: 'swing',
                  step: function (now) {
                      $(this).text(Math.ceil(now));
                  }
              });
          });

          // get month from date
          new Chart(document.querySelector('#lineChart'), {
            type: 'line',
            data: {
              labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'],
              datasets: [
                {
                label: 'Negative Events',
                data: data[0],
                fill: false,
                borderColor: 'rgb(211, 20, 20)',
                tension: 0.1
                
              },
              {
                label: 'Normal Events',
                data: data[1],
                fill: false,
                borderColor: ' rgb(33, 144, 158)',
                tension: 0.1
                
              },
            
            ]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });

          var arr=data[2][1];
          new Chart(document.querySelector('#barChart'), {
                      type: 'bar',
                      data: {
                        labels: ['Event Priority'],
                        datasets: [
                          {
                          label: 'Low',
                          data:[data[2][0]],
                          backgroundColor: [
                            'rgba(75, 192, 192, 0.2)'
                          ]
                        },
                        {
                          label: 'Normal',
                          data: [data[2][1]],
                          backgroundColor: [
                            ' rgb(33, 144, 158)'
                          ]
                        },
                        {
                          label: 'High',
                          data: [data[2][2]],
                          backgroundColor: [
                            
                            'rgb(255, 205, 86)'
                          ]
                        },
                        {
                          label: 'Emergency',
                          data: [data[2][3]],
                          backgroundColor: [
                            'rgb(255, 99, 132)'
                          ]
                        }
                        
                      ]
                      },
                      options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      }
                    });

        }
      });
      // event listeners
      $('#esc_today').click(function(){
          $('#label_esc').html('| Today');
          $('#escalated_count').html(data_global[3][0]);
         
          if((data_global[3][3])>-1){
            if($('#percent_esc').hasClass('text-danger')){ $('#percent_esc').removeClass('text-danger');}
            $('#percent_esc').addClass('text-success');
            $('#percent_esc').html((data_global[3][3])+'%');
            $('#percent_esc').next().html('Increase');
          }else{
            if($('#percent_esc').hasClass('text-success')){ $('#percent_esc').removeClass('text-success');}
            $('#percent_esc').addClass('text-danger');
            $('#percent_esc').html((data_global[3][3])*-1+'%')
            $('#percent_esc').next().html('Decrease');
          }


      });
      $('#esc_month').click(function(){
        $('#label_esc').html('| This Month');
        $('#escalated_count').html(data_global[3][1]);
        if((data_global[3][4])>-1){
          if($('#percent_esc').hasClass('text-danger')){ $('#percent_esc').removeClass('text-danger');}
            $('#percent_esc').addClass('text-success');
            $('#percent_esc').html((data_global[3][4])+'%');
            $('#percent_esc').next().html('Increase');
          }else{
            if($('#percent_esc').hasClass('text-success')){ $('#percent_esc').removeClass('text-success');}
            $('#percent_esc').addClass('text-danger');
            $('#percent_esc').html((data_global[3][4])*-1+'%')
            $('#percent_esc').next().html('Decrease');
          }

      });
       $('#esc_year').click(function(){
        $('#label_esc').html('| This Year');
        $('#escalated_count').html(data_global[3][2]);
        if((data_global[3][5])>-1){
          if($('#percent_esc').hasClass('text-danger')){ $('#percent_esc').removeClass('text-danger');}
            $('#percent_esc').addClass('text-success');
            $('#percent_esc').html((data_global[3][5])+'%');
            $('#percent_esc').next().html('Increase');
          }else{
            if($('#percent_esc').hasClass('text-success')){ $('#percent_esc').removeClass('text-success');}
            $('#percent_esc').addClass('text-danger');
            $('#percent_esc').html((data_global[3][5])*-1+'%')
            $('#percent_esc').next().html('Decrease');
          }
      });

      $('#open_today').click(function(){
        $('#label_open').html('| Today');
          $('#open_count').html(data_global[4][0]);
          if((data_global[4][3])>-1){
            if($('#percent_open').hasClass('text-danger')){ $('#percent_open').removeClass('text-danger');}
            $('#percent_open').addClass('text-success');
            $('#percent_open').html((data_global[4][3])+'%');
            $('#percent_open').next().html('Increase');
            
          }else{
            if($('#percent_open').hasClass('text-success')){ $('#percent_open').removeClass('text-success');}
            $('#percent_open').addClass('text-danger');
            $('#percent_open').html((data_global[4][3])*-1+'%')
            $('#percent_open').next().html('Decrease');
          }
      });

      $('#open_month').click(function(){
        $('#label_open').html('| This Month');
          $('#open_count').html(data_global[4][1]);
          if((data_global[4][4])>-1){
            if($('#percent_open').hasClass('text-danger')){ $('#percent_open').removeClass('text-danger');}
            $('#percent_open').addClass('text-success');
            $('#percent_open').html((data_global[4][4])+'%');
            $('#percent_open').next().html('Increase');
            
          }else{
            if($('#percent_open').hasClass('text-success')){ $('#percent_open').removeClass('text-success');}
            $('#percent_open').addClass('text-danger');
            $('#percent_open').html((data_global[4][4])*-1+'%')
            $('#percent_open').next().html('Decrease');
          }

      });
       $('#open_year').click(function(){
        $('#label_open').html('| This Year');
          $('#open_count').html(data_global[4][2]);
          if((data_global[4][5])>-1){
            if($('#percent_open').hasClass('text-danger')){ $('#percent_open').removeClass('text-danger');}
            $('#percent_open').addClass('text-success');
            $('#percent_open').html((data_global[4][5])+'%');
            $('#percent_open').next().html('Increase');
            
          }else{
            if($('#percent_open').hasClass('text-success')){ $('#percent_open').removeClass('text-success');}
            $('#percent_open').addClass('text-danger');
            $('#percent_open').html((data_global[4][5])*-1+'%')
            $('#percent_open').next().html('Decrease');
          }

      });

      $('#closed_today').click(function(){
        $('#label_closed').html('| Today');
          $('#closed_count').html(data_global[5][0]);
          if((data_global[5][3])>-1){
            if($('#percent_closed').hasClass('text-danger')){ $('#percent_closed').removeClass('text-danger');}
            $('#percent_closed').addClass('text-success');
            $('#percent_closed').html((data_global[5][3])+'%');
            $('#percent_closed').next().html('Increase');
            
          }else{
            if($('#percent_closed').hasClass('text-success')){ $('#percent_closed').removeClass('text-success');}
            $('#percent_closed').addClass('text-danger');
            $('#percent_closed').html((data_global[5][3])*-1+'%')
            $('#percent_closed').next().html('Decrease');
          }
      });
      $('#closed_month').click(function(){
        $('#label_closed').html('| This Month');
          $('#closed_count').html(data_global[5][1]);
          if((data_global[5][4])>-1){
            if($('#percent_closed').hasClass('text-danger')){ $('#percent_closed').removeClass('text-danger');}
            $('#percent_closed').addClass('text-success');
            $('#percent_closed').html((data_global[5][4])+'%');
            $('#percent_closed').next().html('Increase');
            
          }else{
            if($('#percent_closed').hasClass('text-success')){ $('#percent_closed').removeClass('text-success');}
            $('#percent_closed').addClass('text-danger');
            $('#percent_closed').html((data_global[5][4])*-1+'%')
            $('#percent_closed').next().html('Decrease');
          }

      });
       $('#closed_year').click(function(){
        $('#label_closed').html('| This Year');
          $('#closed_count').html(data_global[5][2]);
          if((data_global[5][5])>-1){
            if($('#percent_closed').hasClass('text-danger')){ $('#percent_closed').removeClass('text-danger');}
            $('#percent_closed').addClass('text-success');
            $('#percent_closed').html((data_global[5][5])+'%');
            $('#percent_closed').next().html('Increase');
            
          }else{
            $('#percent_closed').a
            if($('#percent_closed').hasClass('text-success')){ $('#percent_closed').removeClass('text-success');}ddClass('text-danger');
            $('#percent_closed').html((data_global[5][5])*-1+'%')
            $('#percent_closed').next().html('Decrease');
          }

      });
     

    });
</script> 

</html>