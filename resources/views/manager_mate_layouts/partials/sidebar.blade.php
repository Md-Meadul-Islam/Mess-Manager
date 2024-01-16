<style>
  .sidebar-top{
    height: 70%;
  }
</style>
<aside id="sidebar" class="sidebar">
    <div class="sidebar-top">
      <ul class="sidebar-nav" id="sidebar-nav">  
        <li class="nav-item{{ request()->routeIs('manager_mate.dashboard') ? ' active' : '' }}">
          <a class="nav-link " href="{{route('manager_mate.dashboard')}}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-item{{ request()->routeIs('bazarstable.index') ? ' active' : '' }}">
          <a class="nav-link " href="{{route('bazarstable.index')}}">
            <span style='display:flex;margin-right:10px; width:16px; height:16px; justify-content:center; align-items:center;'>&#128240;</span><span>Bazar Details</span>
          </a>
        </li>
        <li class="nav-item{{ request()->routeIs('mealstable.index') ? ' active' : '' }}">
          <a class="nav-link " href="{{route('mealstable.index')}}">
            <span style='display:flex;margin-right:10px; width:16px; height:16px; justify-content:center; align-items:center;'>&#128197;</span><span>Meal Details</span>
          </a>
        </li>
        <li class="nav-item{{ request()->routeIs('') ? ' active' : '' }}">
          <a class="nav-link " href="#">
            <span style='display:flex;margin-right:10px; width:16px; height:16px; justify-content:center; align-items:center;'>&#129518;</span><span>Debits & Credits</span>
          </a>
        </li>
        <li class="nav-item{{ request()->routeIs('roommates.index') ? ' active' : '' }}">
          <a class="nav-link " href="{{route('roommates.index')}}">
            <i class="bi bi-person-hearts"></i>
            <span>Members</span>
          </a>
        </li>
        <li class="nav-item{{ request()->routeIs('') ? ' active' : '' }}">
          <a class="nav-link " href="#">
            <span style='display:flex;margin-right:10px; width:16px; height:16px; justify-content:center; align-items:center;'>🕞</span>
            <span>  Task</span>
          </a>
        </li><!-- End Dashboard Nav -->        
      </ul>
     </div>
     <hr>
     <div class="sidebar-bottom" class="vertical-align: bottom;">
      <ul class="sidebar-nav">
        <li class="nav-item">
          <a class="nav-link"href="#faq">
            <span style='display:flex;margin-right:10px; width:16px; height:16px; justify-content:center; align-items:center; color:red'>⁉</span><span>Documentation</span><i class="ms-auto"></i>
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