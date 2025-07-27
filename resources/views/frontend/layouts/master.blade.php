<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printfuse</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/frontend/images/logo-light.png') }}"/>
    <meta name="description" content="Full-featured, professional-looking software, saas and startup website template.">
    <meta name="keywords" content="saas, saas template, site template, software, startup, digital product, html5, landing, marketing, bootstrap, uikit3, agency, ai, digital agency, it solutions, nodejs">
    <meta name="theme-color" content="#178d72">

    <!-- Open Graph Tags -->
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Fixora">
    <meta property="og:description" content="Full-featured, Professional-looking SaaS, Software and Startup Site Template.">
    <meta property="og:url" content="https://unistudio.co/html/fixora/">
    <meta property="og:site_name" content="Fixora">
    <meta property="og:image:width" content="1180">
    <meta property="og:image:height" content="600">
    <meta property="og:image:type" content="image/png">

    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Fixora">
    <meta name="twitter:description" content="Full-featured, Professional-looking SaaS, Software and Startup Site Template.">

    <!-- preload head styles -->
    <link rel="preload" href="{{ asset('assets/frontend/css/unicons.min.css') }}" as="style">
    <link rel="preload" href="{{ asset('assets/frontend/css/swiper-bundle.min.css') }}" as="style">

    <!-- include uni-core components -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/js/uni-core/css/uni-core.min.css') }}">

    <!-- include styles -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/preloader.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/unicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/prettify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/swiper-bundle.min.css') }}">

    <!-- include main style -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/theme/main.min.css') }}">
</head>

<body class="uni-body panel bg-gray-900 text-gray-200 overflow-x-hidden">




    @include('frontend.layouts.header')

    <main class="flex-1 p-6">
        @yield('content')
    </main>

    @include('frontend.layouts.footer')

    <!-- include jquery & bootstrap js -->
    <script defer src="{{ asset('assets/frontend/js/libs/jquery.min.js') }}"></script>
    <script defer src="{{ asset('assets/frontend/js/libs/bootstrap.min.js') }}"></script>

    <!-- include scripts -->
    <script defer src="{{ asset('assets/frontend/js/libs/anime.min.js') }}"></script>
    <script defer src="{{ asset('assets/frontend/js/libs/swiper-bundle.min.js') }}"></script>
    <script defer src="{{ asset('assets/frontend/js/libs/scrollmagic.min.js') }}"></script>
    <script defer src="{{ asset('assets/frontend/js/libs/prettify.min.js') }}"></script>
    <script defer src="{{ asset('assets/frontend/js/libs/gsap.min.js') }}"></script>
    <script defer src="{{ asset('assets/frontend/js/helpers/data-attr-helper.js') }}"></script>
    <script defer src="{{ asset('assets/frontend/js/helpers/swiper-helper.js') }}"></script>
    <script defer src="{{ asset('assets/frontend/js/helpers/anime-helper.js') }}"></script>
    <script defer src="{{ asset('assets/frontend/js/helpers/anime-helper-defined-timelines.js') }}"></script>
    <script defer src="{{ asset('assets/frontend/js/uikit-components-bs.js') }}"></script>

    <!-- include uni-core bundle -->
    <script src="{{ asset('assets/frontend/js/uni-core/js/uni-core-bundle.min.js') }}"></script>

    <!-- include app script -->
    <script defer src="{{ asset('assets/frontend/js/app.js') }}"></script>
</body>
</html>
