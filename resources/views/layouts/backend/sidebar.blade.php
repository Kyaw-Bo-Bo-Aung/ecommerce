<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                    data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ Request::is('admin') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li>
                <li class="app-sidebar__heading">Setting</li>
                <li>
                    <a href="{{ route('admin.profile-setting') }}" class="{{ Request::is('admin/profile/profile-setting') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-user"></i>
                            Profile setting
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.password-setting') }}" class="{{ Request::is('admin/profile/password-setting') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-lock"></i>
                        Password setting
                    </a>
                </li>
                <li class="app-sidebar__heading">Catelogues</li>
                <li>
                    <a href="{{ route('admin.sections') }}" class="{{ Request::is('admin/sections*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-albums"></i>
                        Sections
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.index') }}" class="{{ Request::is('admin/categories*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-photo-gallery"></i>
                        Categories
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.subcategories.index') }}" class="{{ Request::is('admin/subcategories*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-network"></i>
                        Sub-categories
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-box2"></i>
                        Products
                    </a>
                </li>
                <li class="app-sidebar__heading">Widgets</li>
                <li>
                    <a href="dashboard-boxes.html">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Dashboard Boxes
                    </a>
                </li>
                <li class="app-sidebar__heading">Forms</li>
                <li>
                    <a href="forms-controls.html">
                        <i class="metismenu-icon pe-7s-mouse">
                        </i>Forms Controls
                    </a>
                </li>
                <li>
                    <a href="forms-layouts.html">
                        <i class="metismenu-icon pe-7s-eyedropper">
                        </i>Forms Layouts
                    </a>
                </li>
                <li>
                    <a href="forms-validation.html">
                        <i class="metismenu-icon pe-7s-pendrive">
                        </i>Forms Validation
                    </a>
                </li>
                <li class="app-sidebar__heading">Charts</li>
                <li>
                    <a href="charts-chartjs.html">
                        <i class="metismenu-icon pe-7s-graph2">
                        </i>ChartJS
                    </a>
                </li>
                <li class="app-sidebar__heading">PRO Version</li>
                <li>
                    <a href="https://dashboardpack.com/theme-details/architectui-dashboard-html-pro/" target="_blank">
                        <i class="metismenu-icon pe-7s-graph2">
                        </i>
                        Upgrade to PRO
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
