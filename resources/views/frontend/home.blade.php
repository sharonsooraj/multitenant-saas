<!-- resources/views/frontend/home.blade.php -->
@extends('frontend.layouts.master')

@section('content')
<div id="wrapper" class="wrap">
    <!-- Header start -->
    <div id="hero_header" class="hero-header hero-seven-scene section panel overflow-hidden bg-gray-900">
        <div class="section-outer panel pt-9 lg:pt-10">
            <div class="container max-w-xl">
                <div class="section-inner panel">
                    <div class="row child-cols-12 child-cols items-center justify-between g-4 sm:g-6">
                        <div class="lg:col-6">
                            <div class="panel"
                                data-anime="targets: >*; translateY: [48, 0]; opacity: [0, 1]; easing: easeOutCubic; duration: 500; delay: anime.stagger(100, {start: 200});">
                                <div
                                    class="panel vstack items-center lg:items-start gap-2 xl:gap-3 sm:max-w-500px lg:max-w-400px xl:max-w-500px mx-auto lg:mx-0 mb-3 sm:mb-4 lg:mb-5 xl:mb-7 text-center lg:text-start">

                                    <span class="fs-7 py-narrow px-2 border-0 rounded-pill bg-primary text-white">About
                                        us</span>

                                    <h2 class="h3 sm:h2 xl:h1 lh-lg m-0 text-white">
                                        Powering your future <br class="d-none sm:d-block">
                                        with smart cloud <br class="d-none lg:d-block">
                                        collaboration.
                                    </h2>

                                    <hr class="my-0 d-none lg:d-block border-gray-700">

                                    <p class="fs-7 sm:fs-6 lg:fs-5 xl:fs-4 text-gray-100">
                                        At <strong class="text-white">Printfuse</strong>, we bring your digital workspace to life with
                                        <strong class="text-white">CloudSpace</strong> —
                                        a next-gen cloud platform built for teams, startups, and enterprises.
                                        Seamlessly manage files, collaborate in real-time, and boost productivity — all
                                        in one secure place.
                                    </p>
                                </div>

                                <div
                                    class="panel vstack sm:hstack justify-center lg:justify-start gap-2 sm:gap-4 lg:gap-2 xl:gap-4">
                                    <div class="clients hstack gap-2 sm:gap-1 xl:gap-2">
                                        <div class="hstack justify-end gap-0 w-2/3 sm:w-auto">
                                            <img src="{{ asset('assets/frontend/images/avatars/02.jpg') }}"
                                                alt="Avatar-image"
                                                class="w-40px h-40px rounded-circle border border-1 border-gray-900">
                                            <img src="{{ asset('assets/frontend/images/avatars/05.jpg') }}"
                                                alt="Avatar-image"
                                                class="w-40px h-40px rounded-circle border border-1 border-gray-900 ms-n1 lg:ms-n2 xl:ms-n1">
                                            <img src="{{ asset('assets/frontend/images/avatars/02.jpg') }}"
                                                alt="Avatar-image"
                                                class="w-40px h-40px rounded-circle border border-1 border-gray-900 ms-n1 lg:ms-n2 xl:ms-n1">
                                            <img src="{{ asset('assets/frontend/images/avatars/01.jpg') }}"
                                                alt="Avatar-image"
                                                class="w-40px h-40px rounded-circle border border-1 border-gray-900 ms-n1 lg:ms-n2 xl:ms-n1">
                                        </div>

                                        <span class="fs-7 xl:fs-6 text-gray-100">10+millions users use
                                            <br class="d-none sm:d-block xl:d-none">
                                            our <br class="d-none xl:d-block">
                                            product worldwide.</span>
                                    </div>
                                    <div class="rating hstack justify-center items-center gap-2">
                                        <h3 class="h2 sm:h3 xl:h2 m-0 text-white">4.8</h3>
                                        <div class="panel">
                                            <ul class="stars nav-x gap-narrow sm:mb-narrow">
                                                <li><img class="w-18px xl:w-20px text-yellow"
                                                        src="https://starplatethemes.com/php/fixora/assets/images/common/star-rating.svg"
                                                        alt="stars" data-uc-svg></li>
                                                <li><img class="w-18px xl:w-20px text-yellow"
                                                        src="https://starplatethemes.com/php/fixora/assets/images/common/star-rating.svg"
                                                        alt="stars" data-uc-svg></li>
                                                <li><img class="w-18px xl:w-20px text-yellow"
                                                        src="https://starplatethemes.com/php/fixora/assets/images/common/star-rating.svg"
                                                        alt="stars" data-uc-svg></li>
                                                <li><img class="w-18px xl:w-20px text-yellow"
                                                        src="https://starplatethemes.com/php/fixora/assets/images/common/star-rating.svg"
                                                        alt="stars" data-uc-svg></li>
                                                <li><img class="w-18px xl:w-20px text-yellow"
                                                        src="https://starplatethemes.com/php/fixora/assets/images/common/star-rating.svg"
                                                        alt="stars" data-uc-svg></li>
                                            </ul>
                                            <span class="fs-7 xl:fs-6 fw-medium text-gray-100">Best rated company</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="lg:col-6 xl:col-5"
                            data-anime="translateX: [48, 0]; opacity: [0, 1]; easing: easeOutCubic; duration: 500; delay: 400;">
                            <figure
                                class="featured-image m-0 rounded ratio ratio-1x1 sm:ratio-2x1 lg:ratio-1x1 rounded overflow-hidden">
                                <img class="media-cover image"
                                    src="{{ asset('assets/frontend/images/template/hero-about.jpg') }}" alt="image">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
