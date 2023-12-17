<aside id="sidebar" class="sidebar">

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
      </li><!-- End Tables Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="{{route('roommates.index')}}">
          <i class="bi bi-journal-text"></i><span>Room Mate</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('roommates.index')}}">
              <i class="bi bi-circle"></i><span>All Mates</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->
      
    </ul>
    <ul class="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed"href="{{route('manager_mate.faq')}}">
          <i>⁉</i><span>FAQ</span><i class="ms-auto"></i>
        </a>
      </li><!-- End Forms Nav -->
    </ul>

  </aside>