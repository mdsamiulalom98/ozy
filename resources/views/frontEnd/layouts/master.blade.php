<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') - {{ $generalsetting->name }}</title>
    <!-- App favicon -->
    <meta name="facebook-domain-verification" content="irkk0bt6na8i9yw1zrib1iiosqm9p3" />
    <link rel="shortcut icon" href="{{ asset($generalsetting->favicon) }}" alt="Super Ecommerce Favicon" />
    <meta name="author" content="Super Ecommerce" />
    <link rel="canonical" href="" />
    @stack('seo') @stack('css')
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/mobile-menu.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/select2.min.css') }}" />
    <!-- toastr css -->
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/assets/css/toastr.min.css" />

    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/wsit-menu.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/style.css?v=1.2.1') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/responsive.css?v=1.2.3') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/main.css') }}" />
    <script src="{{ asset('public/frontEnd/js/jquery-3.6.3.min.js') }}"></script>

    @foreach ($pixels as $pixel)
        <!-- Facebook Pixel Code -->
        <script>
            !(function(f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function() {
                    n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments);
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = "2.0";
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s);
            })(window, document, "script", "https://connect.facebook.net/en_US/fbevents.js");
            fbq("init", "{{ $pixel->code }}");
            fbq("track", "PageView");
        </script>
        <noscript>
            <img height="1" width="1" style="display: none;"
                src="https://www.facebook.com/tr?id={{ $pixel->code }}&ev=PageView&noscript=1" />
        </noscript>


        <!-- End Facebook Pixel Code -->
    @endforeach

    {{--
    @foreach ($gtm_code as $gtm)
        <script>
            (function(w, d, s, l, i) {

                w[l] = w[l] || [];

                w[l].push({
                    "gtm.start": new Date().getTime(),
                    event: "gtm.js"
                });


                var f = d.getElementsByTagName(s)[0],

                    j = d.createElement(s),

                    dl = l != "dataLayer" ? "&l=" + l : "";

                j.async = true;

                j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;

                f.parentNode.insertBefore(j, f);

                })(window, document, "script", "dataLayer", "GTM-{{ $gtm->code }}");

        </script>

@endforeach
--}}
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s);
            j.async = true;
            j.src = "https://analytic.ozybd.com/5lahktimr.js?" + i;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'bvvrw=aWQ9R1RNLVc5UUtNU1dM&apiKey=f8fe72c7');
    </script>

</head>

<body class="gotop">
    @php $subtotal = Cart::instance('shopping')->subtotal(); @endphp
    <div class="mobile-menu">
        <div class="mobile-menu-logo">
            <div class="logo-image">
                <img src="{{ asset($generalsetting->white_logo) }}" alt="" />
            </div>
            <div class="mobile-menu-close">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <ul class="first-nav">
            @foreach ($menucategories as $scategory)
                <li class="parent-category">
                    <a href="{{ url('category/' . $scategory->slug) }}" class="menu-category-name">
                        <img src="{{ asset($scategory->image) }}" alt="" class="side_cat_img" />
                        {{ $scategory->name }}
                    </a>
                    @if ($scategory->subcategories->count() > 0)
                        <span class="menu-category-toggle">
                            <i class="fa fa-chevron-down"></i>
                        </span>
                    @endif
                    <ul class="second-nav" style="display: none;">
                        @foreach ($scategory->subcategories as $subcategory)
                            <li class="parent-subcategory">
                                <a href="{{ url('subcategory/' . $subcategory->slug) }}"
                                    class="menu-subcategory-name">{{ $subcategory->subcategoryName }}</a>
                                @if ($subcategory->childcategories->count() > 0)
                                    <span class="menu-subcategory-toggle"><i class="fa fa-chevron-down"></i></span>
                                @endif
                                <ul class="third-nav" style="display: none;">
                                    @foreach ($subcategory->childcategories as $childcat)
                                        <li class="childcategory"><a href="{{ url('products/' . $childcat->slug) }}"
                                                class="menu-childcategory-name">{{ $childcat->childcategoryName }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Topbar section End  -->
    <header>
        <div class="mobile-header">
            <div class="mobile-logo">
                <div class="menu-bar">
                    <a class="toggle">
                        <i class="fa-solid fa-bars"></i>
                    </a>
                </div>
                <div class="menu-logo">
                    <a href="{{ route('home') }}"><img src="{{ asset($generalsetting->white_logo) }}"
                            alt="" /></a>
                </div>
                <div class="menu-bag">
                    <button class="cart-toggle-button margin-shopping">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="mobilecart-qty">{{ Cart::instance('shopping')->count() }}</span>
                    </button>
                </div>
            </div>
        </div>
        {{-- mobile header end --}}
        <div class="mobile-search">
            <form action="{{ route('search') }}">
                <input type="text" placeholder="Search Product ... " value=""
                    class="msearch_keyword msearch_click" name="keyword" />
                <button><i class="fa fa-search"></i></button>
                {{-- <button><i data-feather="search"></i></button> --}}
            </form>
            <div class="search_result"></div>
        </div>
        {{-- mobile search end --}}
        {{-- <section class="topbar">
                    <div class="container">
                        <div class="row">
                            <div class="main__header_top">
                                <div class="header-top">
                                    <ul>
                                        <li>
                                            <a href="tel:{{$contact->phone}}"><i class="fa fa-phone"></i>{{$contact->phone}}</a>
                                        </li>
                                        <li class="top__gmail">
                                            <a href="mailto:{{$contact->email}}"><i class="fa fa-envelope"></i>{{$contact->email}}</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="header-social">
                                    <div class="header-wishlist">
                                       <ul>
                                        <li class="wish-qty">
                                             <a href="{{route ('wishlist.show')}}">
                                                <i class="fa-solid fa-heart"></i>Wishlist
                                                <span>{{Cart::instance('wishlist')->count()}}</span>
                                            </a>
                                        </li>
                                         <li style="font-size: 19px">|</li>
                                        <li class="wish-qty">
                                             <a href="{{route ('compare.product')}}">
                                                <i class="fa-solid fa-sliders"></i>Compare
                                                <span>{{Cart::instance('compare')->count()}}</span>
                                            </a>
                                        </li>
                                         <li style="font-size: 19px">|</li>
                                     </ul>
                                    </div>
                                    <ul>
                                        <li>
                                            <a href=""><i class="fa fa-phone"></i></a>
                                        </li>
                                        <li>
                                            <a href=""><i class="fa-brands fa-square-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href=""><i class="fa-brands fa-youtube"></i></a>
                                        </li>
                                        <li>
                                            <a href=""><i class="fa-brands fa-whatsapp"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> --}}
        {{-- topbar end --}}
        <div class="desktop-menu">
            <div class="desktop-menu-logo">
                <div class="desktop-logo-image">
                    <a href="{{ route('home') }}"><img src="{{ asset($generalsetting->white_logo) }}"
                            alt="" /></a>
                </div>
                <div class="desktop-menu-close">
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <ul class="first-nav">
                @foreach ($menucategories as $scategory)
                    <li class="parent-category">
                        <a href="{{ url('category/' . $scategory->slug) }}" class="menu-category-name">
                            <img src="{{ asset($scategory->image) }}" alt="" class="side_cat_img" />
                            {{ $scategory->name }}
                        </a>
                        @if ($scategory->subcategories->count() > 0)
                            <span class="menu-category-toggle">
                                <i class="fa fa-chevron-down"></i>
                            </span>
                        @endif
                        <ul class="second-nav" style="display: none;">
                            @foreach ($scategory->subcategories as $subcategory)
                                <li class="parent-subcategory">
                                    <a href="{{ url('subcategory/' . $subcategory->slug) }}"
                                        class="menu-subcategory-name">{{ $subcategory->subcategoryName }}</a>
                                    @if ($subcategory->childcategories->count() > 0)
                                        <span class="menu-subcategory-toggle"><i
                                                class="fa fa-chevron-down"></i></span>
                                    @endif
                                    <ul class="third-nav" style="display: none;">
                                        @foreach ($subcategory->childcategories as $childcat)
                                            <li class="childcategory"><a
                                                    href="{{ url('products/' . $childcat->slug) }}"
                                                    class="menu-childcategory-name">{{ $childcat->childcategoryName }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="main-header" id="navbar_top">
            <!-- header to end -->
            <div class="logo-area">
                <div class="container">
                    <div class="row">

                        <div class="col-sm-12">

                            <div class="logo-header">
                                {{-- <div class="menu-bar">
                                        <a class="toggle-desktop">
                                            <i class="fa-solid fa-bars"></i>
                                        </a>
                                    </div> --}}
                                <div class="main-logo">
                                    <a href="{{ route('home') }}"><img
                                            src="{{ asset($generalsetting->white_logo) }}" alt="" /></a>
                                </div>
                                <div class="main-search">
                                    <form action="{{ route('search') }}">
                                        <input type="text" placeholder="Search Product..."
                                            class="search_keyword search_click" name="keyword" />
                                        <button>
                                            <i style="color: #fff;" class="fa fa-search"></i>
                                        </button>
                                        {{-- <button>
                                                <i data-feather="search"></i>
                                            </button> --}}
                                    </form>
                                    <div class="search_result"></div>
                                </div>
                                <div class="header-list-items">
                                    <ul>
                                        <li class="track_btn">
                                            <a href="{{ route('customer.order_track') }}"> <i
                                                    class="fa fa-truck"></i>Track Order</a>
                                        </li>
                                        @if (Auth::guard('customer')->user())
                                            <li class="for_order">
                                                <p>
                                                    <a href="{{ route('customer.account') }}">
                                                        <i class="fa-regular fa-user"></i>

                                                        {{ Str::limit(Auth::guard('customer')->user()->name, 14) }}
                                                    </a>
                                                </p>
                                            </li>
                                        @else
                                            <li class="for_order">
                                                <p>
                                                    <a href="{{ route('customer.login') }}">
                                                        <i class="fa-regular fa-user"></i>
                                                        Login / Sign Up
                                                    </a>
                                                </p>
                                            </li>
                                        @endif

                                        <li class="cart-dialog" id="cart-qty">
                                            <button class="cart-toggle-button">
                                                <p class="margin-shopping">
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                    <span>{{ Cart::instance('shopping')->count() }}</span>
                                                </p>
                                            </button>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="catagory_menu">
                                <ul>
                                    @foreach ($menucategories as $key => $scategory)
                                        <li class="cat_bar">
                                            <a href="{{ url('category/' . $scategory->slug) }}"
                                                class="highlight{{ $key }}">
                                                <span class="cat_head">{{ $scategory->name }}</span>
                                                @if ($scategory->subcategories->count() > 0)
                                                    <i class="fa-solid fa-angle-down cat_down"></i>
                                                @endif
                                            </a>
                                            @if ($scategory->subcategories->count() > 0)
                                                <ul class="Cat_menu">
                                                    @foreach ($scategory->subcategories as $subcat)
                                                        <li class="Cat_list cat_list_hover">
                                                            <a href="{{ url('subcategory/' . $subcat->slug) }}">
                                                                <span>{{ Str::limit($subcat->subcategoryName, 25) }}</span>
                                                                @if ($subcat->childcategories->count() > 0)
                                                                    <i class="fa-solid fa-chevron-right cat_down"></i>
                                                                @endif
                                                            </a>
                                                            @if ($subcat->childcategories->count() > 0)
                                                                <ul class="child_menu">
                                                                    @foreach ($subcat->childcategories as $childcat)
                                                                        <li class="child_main">
                                                                            <a
                                                                                href="{{ url('products/' . $childcat->slug) }}">{{ $childcat->childcategoryName }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main-header end -->
    </header>
    <div id="content">
        @yield('content')
    </div>
    <!-- content end -->
    <footer>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <div class="footer-about">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset($generalsetting->white_logo) }}" alt="" />
                            </a>
                            <p>{{ $contact->address }}</p>
                            <p><a href="tel:{{ $contact->hotline }}"
                                    class="footer-hotlint">{{ $contact->hotline }}</a></p>
                            <!--<p><a href="mailto:{{ $contact->hotmail }}" class="footer-hotlint">{{ $contact->hotmail }}</a></p>-->
                        </div>
                    </div>
                    <!-- col end -->
                    <div class="col-sm-3 mb-3 col-6">
                        <div class="footer-menu">
                            <ul>
                                <li class="title"><a>Useful Link</a></li>
                                <li>
                                    <a href="{{ route('contact') }}"> <a href="{{ route('contact') }}">Contact
                                            Us</a></a>
                                </li>
                                @foreach ($pages as $page)
                                    <li><a href="{{ route('page', ['slug' => $page->slug]) }}">{{ $page->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- col end -->
                    <div class="col-sm-2 mb-3 col-6">
                        <div class="footer-menu">
                            <ul>
                                <li class="title"><a>Link</a></li>
                                @foreach ($pagesright as $key => $value)
                                    <li>
                                        <a href="{{ route('page', ['slug' => $value->slug]) }}">{{ $value->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- col end -->
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <div class="footer-menu">
                            <ul>
                                <li class="title stay_conn"><a>Stay Connected</a></li>
                            </ul>
                            <ul class="social_link">
                                @foreach ($socialicons as $value)
                                    <li class="social_list">
                                        <a class="mobile-social-link" href="{{ $value->link }}"><i
                                                class="{{ $value->icon }}"></i></a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="d_app">
                                <h2>Download App</h2>
                                <a href="">
                                    <img src="{{ asset('public/frontEnd/images/app-download.png') }}"
                                        alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- col end -->
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="copyright">
                            <p>Copyright © {{ date('Y') }} {{ $generalsetting->name }}. All rights reserved.
                                Design & Developed By <a href="https://websolutionit.com/" target="_blank">Websolution
                                    IT</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--=====-->
    {{-- <div class="fixed_whats">
            <a href="https://api.whatsapp.com/send?phone=88{{$contact->phone}}" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
        </div> --}}
    <!--=========-->
    <div class="footer_nav">
        <ul>
            <li>
                <a class="toggle">
                    <span>
                        <i class="fa-solid fa-bars"></i>
                    </span>
                    <span>Category</span>
                </a>
            </li>

            <li>
                <a href="https://www.facebook.com/share/g/19tBYq7Lyw/?mibextid=wwXIfr" target="_blank">
                    <span>
                        <i class="fa-solid fa-message"></i>
                    </span>
                    <span>Review</span>
                </a>
            </li>

            <li class="mobile_home">
                <a href="{{ route('home') }}">
                    <span><i class="fa-solid fa-home"></i></span> <span>Home</span>
                </a>
            </li>

            <li>
                <button class="cart-toggle-button">
                    <span>
                        <i class="fa-solid fa-cart-shopping"></i>
                    </span>
                    <span>Cart (<b class="mobilecart-qty">{{ Cart::instance('shopping')->count() }}</b>)</span>
                </button>
            </li>
            @if (Auth::guard('customer')->user())
                <li>
                    <a href="{{ route('customer.account') }}">
                        <span>
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <span>Account</span>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ route('customer.login') }}">
                        <span>
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <span>Login</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>

    <div class="scrolltop" style="">
        <div class="scroll">
            <i class="fa fa-angle-up"></i>
        </div>
    </div>

    <!-- cart sidebar button-->
    <div class="fixed_whats">
        <a href="https://api.whatsapp.com/send/?phone=8801877702077" target="_blank"><i
                class="fa-brands fa-whatsapp"></i></a>
    </div>

    <!-- /. fixed sidebar -->

    <div id="custom-modal"></div>
    <div id="page-overlay"></div>
    <div id="loading">
        <div class="custom-loader"></div>
    </div>

    <!-- cart sidebar -->
    <div class="mini-cart-wrapper">
        @include('frontEnd.layouts.partials.mini_cart')
    </div>
    <!-- cart sidebar -->

    <script src="{{ asset('public/frontEnd/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/mobile-menu.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/wsit-menu.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/mobile-menu-init.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/wow.min.js') }}"></script>
    <script>
        new WOW().init();
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- feather icon -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>
    <script>
        feather.replace();
    </script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/toastr.min.js"></script>
    {!! Toastr::message() !!} @stack('script')
    <script>
        $('.wishlist_store').on('click', function() {
            var id = $(this).data('id');
            var qty = 1;
            $("#loading").show();
            if (id) {
                $.ajax({
                    type: "GET",
                    data: {
                        'id': id,
                        'qty': qty ? qty : 1
                    },
                    url: "{{ route('wishlist.store') }}",
                    success: function(data) {
                        if (data) {
                            $("#loading").hide();
                            toastr.success('success', 'Product added in wishlist');
                            return wishlist_count() + mobile_wishlist_count();
                        }
                    }
                });
            }
        });

        $('.wishlist_remove').on('click', function() {
            var id = $(this).data('id');
            $("#loading").show();
            if (id) {
                $.ajax({
                    type: "GET",
                    data: {
                        'id': id
                    },
                    url: "{{ route('wishlist.remove') }}",
                    success: function(data) {
                        if (data) {
                            $("#wishlist").html(data);
                            $("#loading").hide();
                            //return wishlist_count();
                        }
                    }
                });
            }
        });

        function wishlist_count() {
            $.ajax({
                type: "GET",
                url: "{{ route('wishlist.count') }}",
                success: function(data) {
                    if (data) {
                        $("#wishlist-qty").html(data);
                    } else {
                        $("#wishlist-qty").empty();
                    }
                }
            });
        };
    </script>

    <script>
        $(".quick_view").on("click", function() {
            var id = $(this).data("id");
            $("#loading").show();
            if (id) {
                $.ajax({
                    type: "GET",
                    data: {
                        id: id
                    },
                    url: "{{ route('quickview') }}",
                    success: function(data) {
                        if (data) {
                            $("#custom-modal").html(data);
                            $("#custom-modal").show();
                            $("#loading").hide();
                            $("#page-overlay").show();
                        }
                    },
                });
            }
        });
    </script>
    <!-- quick view end -->
    <script>
        $(document).ready(function() {
            $(document).on('click', '.detailsFormSubmit', function(e) {
                e.preventDefault();
                var color = $(".variable_color:checked").data('color');
                var size = $(".variable_size:checked").data('size');
                const productId = $(this).data('id');
                const addcart = $(this).data('addcart');
                if (!color) {
                    toastr.warning("Please select a color before adding to the cart.", "Warning");
                    $('.selector-item_label').addClass('red');
                    return; // Stop further execution
                }
                $.ajax({
                    url: '{{ route('ajax.cart.store') }}',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: productId,
                        color: color,
                        size: size,
                        addcart: addcart
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            toastr.success("Product add to cart succfully", "Success");
                            if(response.redirect) {
                                window.location.href = '{{ route('customer.checkout') }}';
                            } else {
                                $("#page-overlay").show();
                                $(".mini-cart-wrapper").addClass("active");
                            }
                            return cart_count() + mobile_cart() + cart_summary() + mini_cart();
                        } else if (!response.success) {
                            toastr.error("Product stock over", "Sorry");
                        } else {
                            console.log(response.message || 'Failed to update cart');
                        }
                    },
                    error: function() {
                        console.log('An error occurred while updating the cart.');
                    },
                });
            });
        });
    </script>
    <!-- cart js start -->
    <script>
        $(".addcartbutton").on("click", function() {
            var id = $(this).data("id");
            var qty = 1;
            if (id) {
                $.ajax({
                    cache: "false",
                    type: "GET",
                    url: "{{ url('add-to-cart') }}/" + id + "/" + qty,
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            toastr.success("Success", "Product add to cart successfully");
                            $(".mini-cart-wrapper").addClass("active");
                            $("#page-overlay").show();
                            return cart_count() + mobile_cart() + mini_cart();

                        }
                    },
                });
            }
        });
        $(".cart_store").on("click", function() {
            var id = $(this).data("id");
            var qty = $(this).parent().find("input").val();
            if (id) {
                $.ajax({
                    type: "GET",
                    data: {
                        id: id,
                        qty: qty ? qty : 1
                    },
                    url: "{{ route('cart.store') }}",
                    success: function(data) {
                        if (data) {
                            toastr.success("Success", "Product add to cart succfully");
                            return cart_count() + mobile_cart() + cart_summary() + mini_cart();
                        }
                    },
                });
            }
        });

        $(document).on('click', '.cart_remove', function(e) {
            var id = $(this).data("id");
            if (id) {
                $(this).prop("disabled", true);
                $.ajax({
                    type: "GET",
                    data: {
                        id: id
                    },
                    url: "{{ route('cart.remove') }}",
                    success: function(data) {
                        if (data) {
                            $(".cartlist").html(data);
                            return cart_count() + mobile_cart() + cart_summary() + mini_cart();
                        }
                    },
                });
            }
        });

        $(document).on('click', '.cart_increment', function(e) {
            var id = $(this).data("id");
            if (id) {
                $.ajax({
                    type: "GET",
                    data: {
                        id: id
                    },
                    url: "{{ route('cart.increment') }}",
                    success: function(data) {
                        if (data) {
                            $(".cartlist").html(data);
                            return cart_count() + mobile_cart() + cart_summary() + mini_cart();
                        }
                    },
                });
            }
        });

        $(document).on('click', '.cart_decrement', function(e) {
            var id = $(this).data("id");
            if (id) {
                $.ajax({
                    type: "GET",
                    data: {
                        id: id
                    },
                    url: "{{ route('cart.decrement') }}",
                    success: function(data) {
                        if (data) {
                            $(".cartlist").html(data);
                            return cart_count() + mobile_cart() + cart_summary() + mini_cart();
                        }
                    },
                });
            }
        });

        function cart_count() {
            $.ajax({
                type: "GET",
                url: "{{ route('cart.count') }}",
                success: function(data) {
                    if (data) {
                        $("#cart-qty").html(data);
                    } else {
                        $("#cart-qty").empty();
                    }
                },
            });
        }

        function mobile_cart() {
            $.ajax({
                type: "GET",
                url: "{{ route('mobile.cart.count') }}",
                success: function(data) {
                    if (data) {
                        $(".mobilecart-qty").html(data);
                    } else {
                        $(".mobilecart-qty").empty();
                    }
                },
            });
        }

        function cart_summary() {
            $.ajax({
                type: "GET",
                url: "{{ route('shipping.charge') }}",
                dataType: "html",
                success: function(response) {
                    $(".cart-summary").html(response);
                },
            });
        }
        function mini_cart() {
            $.ajax({
                type: "GET",
                url: "{{ route('mini.cart') }}",
                dataType: "html",
                success: function(data) {
                    $(".mini-cart-wrapper").html(data);
                },
            });
        }


    </script>

    <!--Compare js -->

    <script>
        // get type

        $(".compare_store").on("click", function() {
            var id = $(this).data("id");
            if (id) {
                $.ajax({
                    cache: "false",
                    type: "GET",
                    url: "{{ url('add-to-compare') }}/" + id,
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            toastr.success('Success', 'Product add to cart successfully');
                            return compare_count();
                        }
                    },
                });
            }
        });

        function compare_content() {
            $.ajax({
                type: "GET",
                url: "{{ url('compare/content') }}",
                dataType: "html",
                success: function(compareinfo) {
                    toastr.success('Product add in compare', '');
                    $('#compareContent').html(compareinfo);
                }
            });
        }
    </script>

    <!-- cart js end -->
    <script>
        $(".search_click").on("keyup change", function() {
            var keyword = $(".search_keyword").val();
            $.ajax({
                type: "GET",
                data: {
                    keyword: keyword
                },
                url: "{{ route('livesearch') }}",
                success: function(products) {
                    if (products) {
                        $(".search_result").html(products);
                    } else {
                        $(".search_result").empty();
                    }
                },
            });
        });
        $(".msearch_click").on("keyup change", function() {
            var keyword = $(".msearch_keyword").val();
            $.ajax({
                type: "GET",
                data: {
                    keyword: keyword
                },
                url: "{{ route('livesearch') }}",
                success: function(products) {
                    if (products) {
                        $("#loading").hide();
                        $(".search_result").html(products);
                    } else {
                        $(".search_result").empty();
                    }
                },
            });
        });
    </script>
    <!-- search js start -->

    <script>
        $(".district").on("change", function() {
            var id = $(this).val();
            $.ajax({
                type: "GET",
                data: {
                    id: id
                },
                url: "{{ route('districts') }}",
                success: function(res) {
                    if (res) {
                        $(".area").empty();
                        $(".area").append('<option value="">Select..</option>');
                        $.each(res, function(key, value) {
                            $(".area").append('<option value="' + key + '" >' + value +
                                "</option>");
                        });
                    } else {
                        $(".area").empty();
                    }
                },
            });
        });
    </script>
    <script>
        $(".toggle").on("click", function() {
            $("#page-overlay").show();
            $(".mobile-menu").addClass("active");
        });
        $(".cart-toggle").on("click", function() {
            $(".mini-cart-wrapper").addClass("active");
        });
        $(document).on('click', '.cart-toggle-button', function(e) {
            $("#page-overlay").show();
            $(".mini-cart-wrapper").addClass("active");
        });
        $(".toggle-desktop").on("click", function() {
            $("#page-overlay").show();
            $(".desktop-menu").addClass("active");
        });

        $("#page-overlay").on("click", function() {
            $("#page-overlay").hide();
            $(".mobile-menu").removeClass("active");
            $(".feature-products").removeClass("active");
            $(".mini-cart-wrapper").removeClass("active");
        });

        $(".mobile-menu-close").on("click", function() {
            $("#page-overlay").hide();
            $(".mobile-menu").removeClass("active");
        });

        $(".desktop-menu-close").on("click", function() {
            $("#page-overlay").hide();
            $(".desktop-menu").removeClass("active");
        });

        $(".mobile-filter-toggle").on("click", function() {
            $("#page-overlay").show();
            $(".feature-products").addClass("active");
        });
        $(document).on('click', '.mini-close-button', function(e) {
            $(".mini-cart-wrapper").removeClass("active");
            $("#page-overlay").hide();
        });
    </script>
    <script>
        $(document).ready(function() {
            var timer;

            function addAndRemoveClass() {
                // Add the class
                $(".order_place").addClass("custom-shake");

                // Wait for 2 seconds and then remove the class
                // Wait for 2 seconds and then remove the class
                timer = setTimeout(function() {
                    $(".order_place").removeClass("custom-shake");
                    timer = setTimeout(addAndRemoveClass, 2000);
                }, 2000);
            }

            // Initial call to start the cycle
            addAndRemoveClass();

            // Pause the cycle when mouse enters the element
            $(".order_place").mouseenter(function() {
                clearTimeout(timer); // Clear the timer
            });

            // Resume the cycle when mouse leaves the element
            $(".order_place").mouseleave(function() {
                addAndRemoveClass(); // Restart the cycle
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".parent-category").each(function() {
                const menuCatToggle = $(this).find(".menu-category-toggle");
                const secondNav = $(this).find(".second-nav");

                menuCatToggle.on("click", function() {
                    menuCatToggle.toggleClass("active");
                    secondNav.slideToggle("fast");
                    $(this).closest(".parent-category").toggleClass("active");
                });
            });
            $(".parent-subcategory").each(function() {
                const menuSubcatToggle = $(this).find(".menu-subcategory-toggle");
                const thirdNav = $(this).find(".third-nav");

                menuSubcatToggle.on("click", function() {
                    menuSubcatToggle.toggleClass("active");
                    thirdNav.slideToggle("fast");
                    $(this).closest(".parent-subcategory").toggleClass("active");
                });
            });
        });
    </script>

    <script>
        var menu = new MmenuLight(document.querySelector("#menu"), "all");

        var navigator = menu.navigation({
            selectedClass: "Selected",
            slidingSubmenus: true,
            // theme: 'dark',
            title: "ক্যাটাগরি",
        });

        var drawer = menu.offcanvas({
            // position: 'left'
        });

        //  Open the menu.
        document.querySelector('a[href="#menu"]').addEventListener("click", (evnt) => {
            evnt.preventDefault();
            drawer.open();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener("scroll", function() {
                if (window.scrollY > 200) {
                    document.getElementById("navbar_top").classList.add("fixed-top");
                } else {
                    document.getElementById("navbar_top").classList.remove("fixed-top");
                    document.body.style.paddingTop = "0";
                }
            });
        });

        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $(".scrolltop:hidden").stop(true, true).fadeIn();
            } else {
                $(".scrolltop").stop(true, true).fadeOut();
            }
        });
        $(function() {
            $(".scroll").click(function() {
                $("html,body").animate({
                    scrollTop: $(".gotop").offset().top
                }, "1000");
                return false;
            });
        });
    </script>
    <script>
        $(".filter_btn").click(function() {
            $(".filter_sidebar").addClass("active");
            $("body").css("overflow-y", "hidden");
        });
        $(".filter_close").click(function() {
            $(".filter_sidebar").removeClass("active");
            $("body").css("overflow-y", "auto");
        });
    </script>

    <!--@foreach ($gtm_code as $gtm) -->
    <!--<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-{{ $gtm->code }}" height="0" width="0" style="display: none; visibility: hidden;"></iframe></noscript>-->

    <!--
@endforeach-->

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://analytic.ozybd.com/ns.html?id=GTM-W9QKMSWL" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->


</body>

</html>
