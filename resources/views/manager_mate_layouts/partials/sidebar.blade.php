<style>
  .sidebar-top{
    height: 70%;
  }
</style>
<aside id="sidebar" class="sidebar">
    <div class="sidebar-top">
      <ul class="sidebar-nav" id="sidebar-nav">
  
        <li class="nav-item">
          <a class="nav-link " href="{{route('manager_mate.dashboard')}}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#mess_details" data-bs-toggle="collapse" href="#">
            <i class="bi bi-layout-text-window-reverse"></i><span>Mess Details</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="mess_details" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="{{route('bazarstable.index')}}">
                <i class="bi bi-circle"></i><span>Bazar Details</span>
              </a>
            </li>
            <li>
              <a href="{{route('mealstable.index')}}">
                <i class="bi bi-circle"></i><span>Meal Details</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{route('roommates.index')}}">
            <i class="bi bi-person-hearts"></i>
            <span>Members</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#"><i>🕞</i> 
            <span>  Task</span>
          </a>
        </li><!-- End Dashboard Nav -->        
      </ul>
     </div>
     <hr>
     <div class="sidebar-bottom" class="vertical-align: bottom;">
      <ul class="sidebar-nav">
        <li class="nav-item">
          <a class="nav-link"href="{{route('manager_mate.faq')}}">
            <i class="bi bi-question-octagon-fill"></i><span>Doc</span><i class="ms-auto"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link"href="#footer">
            <i class="fa-solid fa-address-card"></i><span>Contact</span><i class="ms-auto"></i>
          </a>
        </li>
      </ul>
     </div>
  </aside>