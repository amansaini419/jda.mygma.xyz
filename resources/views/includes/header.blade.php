<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="text-nowrap logo-img text-black mx-auto mt-2">
                <img src="{{ Storage::url(env('COMPANY_LOGO')) }}" width="80" alt="logo">
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('home') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Welcome</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">VOTING</span>
                </li>
                @foreach ($categories as $category)
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('category', ['slug' => $category->slug]) }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-clipboard-check"></i>
                        </span>
                        <span class="hide-menu">{{ $category->name }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </nav>
    </div>
</aside>
