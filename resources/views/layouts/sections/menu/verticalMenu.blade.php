<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  <!-- Hide app brand if navbar-full -->
  <div class="app-brand demo">
    <a href="{{ url('/') }}" class="app-brand-link">
      <span class="app-brand-logo demo me-1">
        @include('_partials.macros', ["height" => 20])
      </span>
      <span class="app-brand-text demo menu-text fw-semibold ms-2">{{ config('variables.templateName') }}</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    @foreach ($menuData[0]->menu as $menu)

      {{-- Menu headers --}}
      @if (isset($menu->menuHeader))
        <li class="menu-header fw-medium mt-4">
          <span class="menu-header-text">{{ __($menu->menuHeader) }}</span>
        </li>
      @else
        {{-- Determine active menu item --}}
        @php
          $activeClass = request()->is(trim($menu->url, '/')) ? 'active' : '';
        @endphp

        {{-- Main menu item --}}
        <li class="menu-item {{ $activeClass }}">
          <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}"
             class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}"
             @if (isset($menu->target) && !empty($menu->target)) target="_blank" @endif>
            @isset($menu->icon)
              <i class="{{ $menu->icon }}"></i>
            @endisset
            <div>{{ isset($menu->name) ? __($menu->name) : '' }}</div>
            @isset($menu->badge)
              <div class="badge bg-{{ $menu->badge[0] }} rounded-pill ms-auto">{{ $menu->badge[1] }}</div>
            @endisset
          </a>

          {{-- Submenu --}}
          @isset($menu->submenu)
            @include('layouts.sections.menu.submenu', ['menu' => $menu->submenu])
          @endisset
        </li>
      @endif
    @endforeach
  </ul>

</aside>
