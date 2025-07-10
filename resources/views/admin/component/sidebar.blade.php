<!--  App Topstrip -->
<div class="app-topstrip bg-dark py-6 px-3 w-100 d-lg-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center justify-content-center gap-5 mb-2 mb-lg-0">
      <a class="d-flex justify-content-center" href="#">
        {{-- <h1 class="text-white">Dashboard Penerimaan</h1> --}}
        {{-- <img src="{{asset('dashboarduser/assets/images/logos/logo-wrappixel.svg')}}" alt="" width="150"> --}}
        <h4 class="fs-35 fw-bold text-white">Budget Buddy</h4>
      </a>

      
    </div>

  </div>
  <!-- Sidebar Start -->
  <aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
      <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="" class="text-nowrap logo-img">
          {{-- <img src="{{asset('dashboarduser/assets/images/logos/logo.svg')}}" alt="" /> --}}
          <h4>Dashboard Admin</h4>
        </a>
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
          <i class="ti ti-x fs-6"></i>
        </div>
      </div>
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
          <li class="nav-small-cap">
            <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
            <span class="hide-menu">Home</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('admin.dashboard')}}" aria-expanded="false">
              <i class="ti ti-atom"></i>
              <span class="hide-menu">Dashboard</span>
            </a>
          </li>
          <!-- ---------------------------------- -->
          <!-- Dashboard -->
          <!-- ---------------------------------- -->
          <li class="sidebar-item">
            <a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)" aria-expanded="false">
              <div class="d-flex align-items-center gap-3">
                <span class="d-flex">
                  <i class="ti ti-layout-grid"></i>
                </span>
                <span class="hide-menu">Fitur Admin</span>
              </div>
              
            </a>
            <ul aria-expanded="false" class="collapse first-level">
              <li class="sidebar-item">
                <a class="sidebar-link justify-content-between"  
                  href="{{route('admin.user')}}">
                  <div class="d-flex align-items-center gap-3">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">List User</span>
                  </div>
                  
                </a>
              </li>
              
            </ul>
          </li>

          <li>
            <span class="sidebar-divider lg"></span>
          </li>
          
      </nav>
      <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  </aside>