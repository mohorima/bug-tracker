<div id="mySidenav" class="sidenav">
  
    <ul class="nav flex-column">
  
        <li class="nav-item d-flex align-items-center justify-content-between my-1">
            
            <img src="{{ asset('/images/logo.svg') }}" alt="" height="30px" class="nav-logo">
            <a href="javascript:void(0)" onclick="closeNav()" id="closesidenav">
                <i class="fas fa-times closebtn"></i>
            </a>
        </li>
    
        <li class="nav-item">
            <router-link to="/dashboard" class="nav-link">
                <i class="fas fa-tachometer-alt mr-3 link-fa"></i>
                Dashboard
            </router-link>
        </li>  
    
        <li class="nav-item">
            <router-link to="/project" class="nav-link">
                <i class="fas fa-briefcase mr-3 link-fa"></i>
                Projects
            </router-link>
        </li> 
  
        <li class="nav-item">
            <router-link to="/task" class="nav-link">
                <i class="fas fa-tasks mr-3 link-fa"></i>
                Tasks
            </router-link>
        </li> 
  
        <li class="nav-item">
            <router-link to="/issue" class="nav-link">
                <i class="fas fa-bug mr-3 link-fa"></i>
                Issues
            </router-link>
        </li> 
  
        <li class="nav-item">
            <router-link to="/client" class="nav-link">
                <i class="fas fa-handshake mr-3 link-fa"></i>
                Clients
            </router-link>
        </li> 
  
        <li class="nav-item">
            <router-link to="/invoice" class="nav-link">
                <i class="fas fa-file-invoice-dollar mr-3 link-fa"></i>
                Invoices
            </router-link>
        </li> 

        <li class="nav-item">
            <a class="nav-link" href="">
              <i class="fas fa-chart-pie mr-3 link-fa"></i>
              Analytics
            </a>
        </li>
  
    </ul>


    <h6 class="sidebar-heading d-flex justify-content-between"  data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
      <span>Users</span>
      <i class="fas fa-angle-down ml-2"></i>
    </h6>

    <div  class="collapse" id="collapseUsers">

        <ul class="nav flex-column mb-2">

        <li class="nav-item">
            <router-link to="/user" class="nav-link">
                <i class="fas fa-user-friends mr-3 link-fa"></i>
                Users
            </router-link>
        </li> 

        <li class="nav-item">
            <router-link to="/role" class="nav-link">
                <i class="fas fa-user-shield mr-3 link-fa"></i>
                Roles
            </router-link>
        </li>

        <li class="nav-item">
            <router-link to="/permission" class="nav-link">
                <i class="fas fa-shield-alt mr-3 link-fa"></i>
                Permissions
            </router-link>
        </li>

        </ul>
    </div>
    
</div>
  
  