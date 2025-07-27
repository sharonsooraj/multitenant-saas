<header class="uc-header uc-navbar-sticky-wrap z-999 bg-transparent" style="--uc-nav-height: 80px"
    data-uc-sticky="start: 100vh; show-on-up: true; animation: uc-animation-slide-top; sel-target: .uc-navbar-container; cls-active: uc-navbar-sticky; cls-inactive: uc-navbar-transparent; end: !*;">
    <nav class="uc-navbar-container uc-navbar-float ft-tertiary z-1"
        data-anime="translateY: [-40, 0]; opacity: [0, 1]; easing: easeOutExpo; duration: 750; delay: 0;">
        <div class="container max-w-xl">
            <div class="uc-navbar min-h-64px lg:min-h-80px text-white"
                data-uc-navbar="mode: click; animation: uc-animation-slide-top-small; duration: 150;">
                <div class="uc-navbar-left">
                    <div class="uc-logo flex items-center gap-3 text-white">
                        <span class="text-2xl font-bold tracking-wide">Printfuse</span>
                        <img class="" src="{{ asset('assets/frontend/images/logo-light.png') }}" alt="CloudSpace"
                            style="
                        width: 110px;
                    ">
                    </div>
                </div>
                <div class="uc-navbar-right">
                    <ul
                        class="uc-navbar-nav gap-3 xl:gap-4 d-none lg:d-flex fw-semibold ltr:ms-2 ltr:xl:ms-4 rtl:me-2 rtl:xl:me-4">
                        <li>
                            <a href="{{ route('login') }}"
                                class="text-white hover:text-primary transition-colors duration-200">Log in</a>
                        </li>
                    </ul>

                    <a class="btn btn-sm btn-primary border-0 text-white text-none d-none lg:d-inline-flex hover:opacity-80 transition-all duration-250"
                        href="{{ route('register') }}">
                        Register
                    </a>

                    <a class="d-block lg:d-none text-white" href="#uc-menu-panel" data-uc-navbar-toggle-icon
                        data-uc-toggle>
                        <i class="unicon-menu"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <div class="w-full h-px bg-white bg-opacity-20"></div>
</header>
