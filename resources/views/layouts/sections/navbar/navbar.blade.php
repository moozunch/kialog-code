@php
  $containerNav = $containerNav ?? 'container-fluid';
  $navbarDetached = ($navbarDetached ?? '');
@endphp

  <!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
  <nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
    @endif
    @if(isset($navbarDetached) && $navbarDetached == '')
      <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="{{$containerNav}}">
          @endif

          <!--  Brand demo (display only for navbar-full and hide on below xl) -->
          {{-- @if(isset($navbarFull))
            <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
              <a href="{{url('/')}}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
              @include('_partials.macros',["height"=>20])
              </span>
                <span class="app-brand-text demo menu-text fw-semibold ms-1">{{config('variables.templateName')}}</span>
              </a>
              <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
              </a>
            </div>
          @endif --}}

          <!-- ! Not required for layout-without-menu -->
          @if(!isset($navbarHideToggle))
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="mdi mdi-menu mdi-24px"></i>
              </a>
            </div>
          @endif

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
              <div class="position-relative">
                <form class="d-flex" role="search">
                  <input class="form-control me-2 pe-5" type="search" placeholder="Search" aria-label="Search" style="border-radius: 12px">
                  <i class="mdi mdi-magnify mdi-24px position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);"></i>
                </form>
              </div>
            </div>
            <!-- /Search -->
            <ul class="navbar-nav flex-row align-items-center ms-auto">

              <!-- User dan Dropdown-->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="{{ Auth::user()->profile_image ? Auth::user()->profile_image : asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-px-40 rounded-circle" style="object-fit: cover; object-position: center">
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                  <li>
                    <a class="dropdown-item pb-2 mb-1" href="javascript:void(0);">
                      <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2 pe-1">
                          <div class="avatar avatar-online">
                            <img src="{{ Auth::user()->profile_image ? Auth::user()->profile_image : asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-px-40 rounded-circle" style="object-fit: cover; object-position: center">
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <h6 class="mb-0">{{ Auth::user()->name ?? 'Default Name' }}</h6>
                          <small class="text-muted">{{ Auth::user()->username }}</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider my-1"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                      <i class="mdi mdi-account-outline me-1 mdi-20px"></i>
                      <span class="align-middle">My Profile</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('settings') }}">
                      <i class='mdi mdi-cog-outline me-1 mdi-20px'></i>
                      <span class="align-middle">Settings</span>
                    </a>
                  </li>
                  {{-- <li>
                    <a class="dropdown-item" href="javascript:void(0);">
            <span class="d-flex align-items-center align-middle">
              <i class="flex-shrink-0 mdi mdi-credit-card-outline me-1 mdi-20px"></i>
              <span class="flex-grow-1 align-middle ms-1">Billing</span>
              <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
            </span>
                    </a>
                  </li> --}}
                  <li>
                    <div class="dropdown-divider my-1"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class='mdi mdi-power me-1 mdi-20px'></i>
                      <span class="align-middle">Log Out</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                  </li>
                </ul>
              </li>
              <!--/ User -->
            </ul>
          </div>

          @if(!isset($navbarDetached))
        </div>
        @endif
      </nav>
      <!-- / Navbar -->
