
@section('sidebar')

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed " href="/dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
   
      <li class="nav-item">
        <a class="nav-link collapsed " href="notifications">
          <i class="bi bi-bell"></i>
          <span>Notifications</span>
        </a>
      </li><!-- End Dashboard Nav -->
      
      @if (
        Auth::User()->role=='Admin')

      <li class="nav-item">
        <a class="nav-link collapsed " href="/addData">
          <i class="bi bi-clipboard-data"></i>
          <span>Data Entry</span>
        </a>
      </li><!-- End Dashboard Nav -->
     @endif
     
      @if (
         Auth::User()->role=='Technician'||
            Auth::User()->role=='Technical Operator'||
            Auth::User()->role=='EIC'||
            Auth::User()->role=='PTO Transmission'||
            Auth::User()->role=='PTO Production'||
            Auth::User()->role=='DVBT Manager'||
            Auth::User()->role=='CTO'
        )
        
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Logs</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          @if (
            Auth::User()->role=='Technician'||
            Auth::User()->role=='Technical Operator'||
            Auth::User()->role=='EIC'||
            Auth::User()->role=='CTO')
          <li>
            <a href="/addLog">
              <i class="bi bi-circle"></i><span>Add Log</span>
            </a>
          </li>
          @endif
          
          <li>
            <a href="/logs">
              <i class="bi bi-circle"></i><span>View Logs</span>
            </a>
          </li>
          
        </ul>
       
      </li><!-- End Forms Nav -->

      @endif

      @if (
         Auth::User()->role=='PTO Transmission'||
            Auth::User()->role=='PTO Production'||
            Auth::User()->role=='DVBT Manager'||
            Auth::User()->role=='AMTS Production'||
        Auth::User()->role=='AMTS Transmission'||
        Auth::User()->role=='MTS'
        )
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>View reports</span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Generate Reports</span>
            </a>
          </li>
         
        </ul>
      </li><!-- End Forms Nav -->
       @endif

       @if (
        Auth::User()->role=='Admin')

      <li class="nav-heading">Users</li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('viewUsers')}}">
              <i class="bi bi-circle"></i><span>View Users</span>
            </a>
          </li>
          <li>
            <a href="/addUser">
              <i class="bi bi-circle"></i><span>Add User</span>
            </a>
          </li>
         
        </ul>
      </li><!-- End Forms Nav -->
      @endif

      <li class="nav-item">
        <a class="nav-link collapsed " href="{{ route('profile')}}" >
          <i class="bi bi-person"></i>
      <span>My Account</span>
        </a>
      </li><!-- End Dashboard Nav -->
          
    </ul>
        <div class="footer">
         Created by <strong><span>Ngugi Phil, </span></strong>
        {{
          \Carbon\Carbon::createFromFormat('m/d/Y', '02/20/2022')->diffForHumans(); 
           
        }}
        </div>


  </aside><!-- End Sidebar-->

 
 <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


@endsection