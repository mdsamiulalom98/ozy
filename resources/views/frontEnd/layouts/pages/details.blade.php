@extends('frontEnd.layouts.master')
@section('title', $details->name)
@push('seo')
    <meta name="app-url" content="{{ route('product', $details->slug) }}" />
    <meta name="robots" content="index, follow" />
    <meta name="description" content="{{ $details->meta_description }}" />
    <meta name="keywords" content="{{ $details->slug }}" />

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product" />
    <meta name="twitter:site" content="{{ $details->name }}" />
    <meta name="twitter:title" content="{{ $details->name }}" />
    <meta name="twitter:description" content="{{ $details->meta_description }}" />
    <meta name="twitter:creator" content="ozybd.com" />
    <meta property="og:url" content="{{ route('product', $details->slug) }}" />
    <meta name="twitter:image" content="{{ asset($details->image->image) }}" />

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $details->name }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ route('product', $details->slug) }}" />
    <meta property="og:image" content="{{ asset($details->image->image) }}" />
    <meta property="og:description" content="{{ $details->meta_description }}" />
    <meta property="og:site_name" content="{{ $details->name }}" />
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/zoomsl.css') }}">
@endpush

@section('content')
    <div class="homeproduct main-details-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <section class="product-section">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6 position-relative">
                                    @if ($details->old_price)
                                        <div class="product-details-discount-badge">
                                            <div class="sale-badge">
                                                <div class="sale-badge-inner">
                                                    <div class="sale-badge-box">
                                                        <span class="sale-badge-text">
                                                            <p> @php $discount=(((($details->old_price)-($details->new_price))*100) / ($details->old_price)) @endphp {{ number_format($discount, 0) }}%</p>
                                                            Discount
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- variable product image -->
                                    @if ($details->variables->count() > 0)
                                        <div class="details_slider owl-carousel">
                                            @foreach ($details->variables as $value)
                                                <div class="dimage_item">
                                                    <img src="{{ asset($value->image) }}" class="block__pic" />
                                                </div>
                                            @endforeach
                                        </div>
                                        <div
                                            class="indicator_thumb @if ($details->variables->count() > 4) thumb_slider owl-carousel @endif">
                                            @foreach ($details->variables as $key => $value)
                                                <div class="indicator-item" data-id="{{ $key }}">
                                                    <p>{{ $value->name }}</p>
                                                    <img src="{{ asset($value->image) }}" />
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- normal product image -->
                                    @else
                                        <div class="details_slider owl-carousel">
                                            @foreach ($details->images as $value)
                                                <div class="dimage_item">
                                                    <img src="{{ asset($value->image) }}" class="block__pic" />
                                                </div>
                                            @endforeach
                                        </div>
                                        <div
                                            class="indicator_thumb @if ($details->images->count() > 4) thumb_slider owl-carousel @endif">
                                            @foreach ($details->images as $key => $value)
                                                <div class="indicator-item" data-id="{{ $key }}">
                                                    <img src="{{ asset($value->image) }}" />
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>
                                <div class="col-sm-6">
                                    <div class="details_right">
                                        <div class="breadcrumb">
                                            <ul>
                                                <li><a href="{{ url('/') }}">Home</a></li>
                                                <li><span>/</span></li>
                                                <li><a
                                                        href="{{ url('/category/' . $details->category->slug) }}">{{ $details->category->name }}</a>
                                                </li>
                                                @if ($details->subcategory)
                                                    <li><span>/</span></li>
                                                    <li><a
                                                            href="#">{{ $details->subcategory ? $details->subcategory->subcategoryName : '' }}</a>
                                                    </li>
                                                    @endif @if ($details->childcategory)
                                                        <li><span>/</span></li>
                                                        <li><a
                                                                href="#">{{ $details->childcategory->childcategoryName }}</a>
                                                        </li>
                                                    @endif
                                            </ul>
                                        </div>

                                        <div class="product">
                                            <div class="product-cart">
                                                <p class="name">{{ $details->name }}</p>
                                                @if ($details->variable_count > 0 && $details->type == 0)
                                                    <p class="details-price">
                                                        @if ($details->variable->old_price)
                                                            <del>৳ <span
                                                                    class="old_price">{{ $details->variable->old_price }}</span></del>
                                                        @endif ৳ <span
                                                            class="new_price">{{ $details->variable->new_price }}</span>
                                                    </p>
                                                @else
                                                    <p class="details-price">
                                                        @if ($details->old_price)
                                                            <del>৳{{ $details->old_price }}</del>
                                                        @endif ৳{{ $details->new_price }}
                                                    </p>
                                                @endif
                                                <div class="details-ratting-wrapper">
                                                    @php
                                                        $averageRating = $reviews->avg('ratting');
                                                        $filledStars = floor($averageRating);
                                                        $emptyStars = 5 - $filledStars;
                                                    @endphp

                                                    @if ($averageRating >= 0 && $averageRating <= 5)
                                                        @for ($i = 1; $i <= $filledStars; $i++)
                                                            <i class="fas fa-star"></i>
                                                        @endfor

                                                        @if ($averageRating == $filledStars)
                                                            {{-- If averageRating is an integer, don't display half star --}}
                                                        @else
                                                            <i class="far fa-star-half-alt"></i>
                                                        @endif

                                                        @for ($i = 1; $i <= $emptyStars; $i++)
                                                            <i class="far fa-star"></i>
                                                        @endfor

                                                        <span>{{ number_format($averageRating, 2) }}/5</span>
                                                    @else
                                                        <span>Invalid rating range</span>
                                                    @endif
                                                    <a class="all-reviews-button" href="#writeReview">See Reviews</a>
                                                </div>
                                                <div class="product-code">
                                                    <p><span>SKU : </span>{{ $details->product_code }}</p>
                                                </div>

                                                <input type="hidden" name="id" value="{{ $details->id }}" />
                                                @if ($productcolors->count() > 0)
                                                    <div class="pro-color" style="width: 100%;">
                                                        <div class="color_inner">
                                                            <p>Color -</p>
                                                            <div class="size-container">
                                                                <div class="selector">
                                                                    @foreach ($productcolors as $key => $procolor)
                                                                        <div class="selector-item color-item"
                                                                            data-id="{{ $key }}">
                                                                            {{ $procolor->image }}
                                                                            <input type="radio"
                                                                                id="fc-option{{ $procolor->color }}"
                                                                                value="{{ $procolor->color }}"
                                                                                name="product_color"
                                                                                class="selector-item_radio emptyalert variable_color stock_color stock_check"
                                                                                required
                                                                                data-color="{{ $procolor->color }}" />
                                                                            <label for="fc-option{{ $procolor->color }}"
                                                                                class="selector-item_label">{{ $procolor->color }}
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($productsizes->count() > 0)
                                                    <div class="pro-size" style="width: 100%;">
                                                        <div class="size_inner">
                                                            <p>Size - <span class="attibute-name"></span></p>
                                                            <div class="size-container">
                                                                <div class="selector">
                                                                    @foreach ($productsizes as $prosize)
                                                                        <div class="selector-item">
                                                                            <input type="radio"
                                                                                id="f-option{{ $prosize->size }}"
                                                                                value="{{ $prosize->size }}"
                                                                                name="product_size"
                                                                                class="selector-item_radio emptyalert variable_size stock_size stock_check"
                                                                                data-size="{{ $prosize->size }}"
                                                                                required />
                                                                            <label for="f-option{{ $prosize->size }}"
                                                                                class="selector-item_label">{{ $prosize->size }}</label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($details->pro_unit)
                                                    <div class="pro_unig">
                                                        <label>Unit: {{ $details->pro_unit }}</label>
                                                        <input type="hidden" name="pro_unit"
                                                            value="{{ $details->pro_unit }}" />
                                                    </div>
                                                @endif
                                                <div class="pro_brand">
                                                    <p>Brand :
                                                        {{ $details->brand ? $details->brand->name : 'N/A' }}
                                                    </p>
                                                </div>

                                                <div class="row">
                                                    <div class="qty-cart col-sm-6">
                                                        <div class="quantity">
                                                            <span class="minus">-</span>
                                                            <input type="text" name="qty" value="1" />
                                                            <span class="plus">+</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="pro_brand stock"></div>
                                                    </div>
                                                    <div class="d-flex single_product col-sm-12">
                                                        <button type="button" data-id="{{ $details->id }}"
                                                            name="order_now"
                                                            class="btn px-4 add_cart_btn detailsFormSubmit"
                                                            id="add_to_cart" onclick="return sendSuccess();"
                                                            name="add_cart" value=""><i
                                                                class="fa fa-shopping-cart"></i>
                                                            ক্যাশ অন ডেলিভারিতে অর্ডার করুন</button>

                                                        {{-- <button type="button" data-id="{{ $details->id }}"
                                                                class="btn px-4 order_now_btn order_now_btn_m detailsFormSubmit"
                                                                onclick="return sendSuccess();" name="order_now"
                                                                value="" id="order_now">Order Now</button> --}}
                                                    </div>
                                                </div>
                                                <div class="mt-md-2 mt-2">
                                                    <h4 class="font-weight-bold ">
                                                        <a class="btn btn-dark w-100 call_now_btn" target="_blank"
                                                            href="https://m.me/ozybdofficial/">
                                                            <img src="{{ asset('public/frontEnd/images/messenger.png') }}" alt="">
                                                            Chat with us
                                                        </a>
                                                    </h4>
                                                    <h4 class="font-weight-bold mt-2">
                                                        <a class="btn btn-success w-100 call_now_btn" target="_blank"
                                                            href="https://wa.me/8801877702077">
                                                            <img src="{{ asset('public/frontEnd/images/whatsapp.png') }}" alt="">
                                                            Whatsapp Us
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div class="mt-md-2 mt-2">
                                                    <div class="del_charge_area">
                                                        <div class="alert alert-info text-xs">
                                                            <div class="flext_area">
                                                                <i class="fa-solid fa-cubes"></i>
                                                                <div>

                                                                    @foreach ($shippingcharge as $key => $value)
                                                                        <span>{{ $value->name }} <br /></span>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <div class="description-nav-wrapper">
        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                    <div class="description-nav">
                        <ul class="desc-nav-ul">
                            {{-- <li class="active">
                            <a href="#specification" target="_self">Specification</a>
                        </li> --}}
                            <li>
                                <a href="#description" target="_self">Description</a>
                            </li>
                            {{-- <li>
                            <a href="#question" target="_self">Questions (0)</a>
                        </li> --}}
                            <li>
                                <a href="#writeReview" target="_self">Reviews ({{ $reviews->count() }}) </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="pro_details_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="description tab-content details-action-box" id="description">
                        <h2>Description</h2>
                        <p>{!! $details->description !!}</p>
                    </div>
                    <div class="tab-content details-action-box" id="writeReview">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="section-head">
                                        <div class="title">
                                            <h2>Reviews ({{ $reviews->count() }})</h2>
                                            <p>Get specific details about this product from customers who own it.</p>
                                        </div>
                                        <div class="action">
                                            <div>
                                                <button type="button" class="details-action-btn question-btn btn-overlay"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    Write a review
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($reviews->count() > 0)
                                        <div class="customer-review">
                                            <div class="row">
                                                @foreach ($reviews as $key => $review)
                                                    <div class="col-sm-12 col-12">
                                                        <div class="review-card">
                                                            <p class="reviewer_name"><i data-feather="message-square"></i>
                                                                {{ $review->name }}</p>
                                                            <p class="review_data">
                                                                {{ $review->created_at->format('d-m-Y') }}</p>
                                                            <p class="review_star">{!! str_repeat('<i class="fa-solid fa-star"></i>', $review->ratting) !!}</p>
                                                            <p class="review_content">{{ $review->review }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="empty-content">
                                            <i class="fa fa-clipboard-list"></i>
                                            <p class="empty-text">This product has no reviews yet. Be the first one to
                                                write a review.</p>
                                        </div>
                                    @endif
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Your review</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="insert-review">
                                                        @if (Auth::guard('customer')->user())
                                                            <form action="{{ route('customer.review') }}"
                                                                id="review-form" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="product_id"
                                                                    value="{{ $details->id }}">
                                                                <div class="fz-12 mb-2">
                                                                    <div class="rating">
                                                                        <label title="Excelent">
                                                                            ☆
                                                                            <input required type="radio" name="ratting"
                                                                                value="5" />
                                                                        </label>
                                                                        <label title="Best">
                                                                            ☆
                                                                            <input required type="radio" name="ratting"
                                                                                value="4" />
                                                                        </label>
                                                                        <label title="Better">
                                                                            ☆
                                                                            <input required type="radio" name="ratting"
                                                                                value="3" />
                                                                        </label>
                                                                        <label title="Very Good">
                                                                            ☆
                                                                            <input required type="radio" name="ratting"
                                                                                value="2" />
                                                                        </label>
                                                                        <label title="Good">
                                                                            ☆
                                                                            <input required type="radio" name="ratting"
                                                                                value="1" />
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="message-text"
                                                                        class="col-form-label">Message:</label>
                                                                    <textarea required class="form-control radius-lg" name="review" id="message-text"></textarea>
                                                                    <span id="validation-message"
                                                                        style="color: red;"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button class="details-review-button"
                                                                        type="submit">Submit
                                                                        Review</button>
                                                                </div>

                                                            </form>
                                                        @else
                                                            <a class="customer-login-redirect"
                                                                href="{{ route('customer.login') }}">Login
                                                                to Post
                                                                Your Review</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="pro_vide">
                        <h2>Video</h2>
                        <iframe width="100%" height="315"
                            src="https://www.youtube.com/embed/{{ $details->pro_video }}" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="related-product-section">
        <div class="container">
            <div class="row">
                <div class="related-title">
                    <h5>Related Product</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="product-inner owl-carousel related_slider">
                        @foreach ($products as $key => $value)
                            <div class="product_item wist_item">
                                @include('frontEnd.layouts.partials.product')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('script')
    <script src="{{ asset('public/frontEnd/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/zoomsl.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".details_slider").owlCarousel({
                margin: 15,
                items: 1,
                loop: true,
                dots: false,
                nav: false,
                autoplay: false,
            });
            $(".indicator-item,.color-item").on("click", function() {
                var slideIndex = $(this).data('id');
                $('.details_slider').trigger('to.owl.carousel', slideIndex);
            });
        });
    </script>
    <!--Data Layer Start-->
    <script type="text/javascript">
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            ecommerce: null
        });
        dataLayer.push({
            event: "view_item",
            ecommerce: {
                items: [{
                    item_name: "{{ $details->name }}",
                    item_id: "{{ $details->id }}",
                    id: "{{ $details->id }}",
                    @if ($details->variable_count > 0 && $details->type == 0)
                        price: "{{ $details->variable->new_price }}",
                    @else
                        price: "{{ $details->new_price }}",
                    @endif
                    item_brand: "{{ $details->brand ? $details->brand->name : '' }}",
                    item_category: "{{ $details->category->name }}",
                    item_variant: "{{ $details->pro_unit }}",
                    currency: "BDT",
                    quantity: 1
                }],
            }
        });
    </script>


{{--
<script type="text/javascript">
    $(document).ready(function() {
    $('#add_to_cart').click(function() {
        gtag("event", "add_to_cart", {
            currency: "BDT",
            value: 3199, // Cart value or total amount
            items: [
                    @foreach (Cart::instance('shopping')->content() as $cartInfo)
                    {
                        item_id: "{{ $cartInfo->id }}",

                        item_name: "{{ $cartInfo->name }}",

                        price: "{{ $cartInfo->price }}",

                        currency: "BDT",

                        quantity: {{ $cartInfo->qty ?? 0 }}

                    },

                    @endforeach
                ]
            });
        });
    });

</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#order_now').click(function() {
            gtag("event", "add_to_cart", {
                currency: "BDT",
                value: "1.5",
                items: [
                        @foreach (Cart::instance('shopping')->content() as $cartInfo)
                            {
                                item_id: "{{ $details->id }}",
                                item_name: "{{ $details->name }}",
                                price: "{{ $details->new_price }}",
                                currency: "BDT",
                                quantity: {{ $cartInfo->qty ?? 0 }}
                            },
                        @endforeach
                    ]
            });
        });
    });
</script>
--}}
    <!-- Data Layer End-->
    <script>
        $(document).ready(function() {
            $(".related_slider").owlCarousel({
                margin: 10,
                items: 6,
                loop: true,
                dots: false,
                nav: false,
                autoplay: true,
                autoplayTimeout: 6000,
                autoplayHoverPause: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 2,
                        nav: false,
                    },
                    600: {
                        items: 3,
                    },
                    1000: {
                        items: 6,
                    },
                },
            });
            // $('.owl-nav').remove();
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".minus").click(function() {
                var $input = $(this).parent().find("input");
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
                return false;
            });
            $(".plus").click(function() {
                var $input = $(this).parent().find("input");
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;
            });
        });
    </script>

    <script>
        function sendSuccess() {
            // size validation
            if (document.forms["formName"]["product_size"]) {
                size = document.forms["formName"]["product_size"].value;
                if (size != "") {} else {
                    toastr.warning("Please select any size");
                    return false;
                }
            }
            if (document.forms["formName"]["product_color"]) {
                color = document.forms["formName"]["product_color"].value;
                if (color != "") {} else {
                    toastr.error("Please select any color");
                    return false;
                }
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $(".rating label").click(function() {
                $(".rating label").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".thumb_slider").owlCarousel({
                margin: 15,
                items: 4,
                loop: true,
                dots: false,
                nav: true,
                autoplayTimeout: 6000,
                autoplayHoverPause: true,
            });
        });
    </script>

    <script type="text/javascript">
        $(".block__pic").imagezoomsl({
            zoomrange: [3, 3]
        });
    </script>
    <script>
        $(".stock_check").on("click", function() {
            var color = $(".stock_color:checked").data('color');
            var size = $(".stock_size:checked").data('size');
            $('.selector-item_label').removeClass('red');
            var id = {{ $details->id }};
            console.log(color);
            if (id) {
                $.ajax({
                    type: "GET",
                    data: {
                        id: id,
                        color: color,
                        size: size
                    },
                    url: "{{ route('stock_check') }}",
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            $(".stock").html('<p><span>Stock : </span>' + response.product.stock +
                                '</p>');

                            $(".old_price").text(response.product.old_price);
                            $(".new_price").text(response.product.new_price);
                            // cart button enable
                            $('.add_cart_btn').prop('disabled', false);
                            $('.order_now_btn').prop('disabled', false);
                        } else {
                            toastr.error('Stock Out', "Please select another color or size");
                            $(".stock").empty();
                            // cart button disabled
                            $('.add_cart_btn').prop('disabled', true);
                            $('.order_now_btn').prop('disabled', true);
                        }


                    }
                });
            }
        });
    </script>

    <!--Microdata -->

    <script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"Product",
  "productID":"{{$details->id}}",
  "name":"{{$details->name}}",
  "description":"{!!$details->description!!}",
  "url":"{{Request::fullUrl()}}",
  "image":"{{asset($details->image->image)}}",
  "brand":"@if($details->brand_id !=NULL) {{$details->brand->brandName}} @endif",
  "offers": [
    {
      "@type": "Offer",
     @if ($details->variable_count > 0 && $details->type == 0)
      "price": "{{$details->variable->new_price}}",
      @else
      "price": "{{$details->new_price}}",
      @endif
      "priceCurrency": "BDT",
      "itemCondition": "https://schema.org/NewCondition",
      "availability": "https://schema.org/InStock"
    }
  ],
  "additionalProperty": [{
    "@type": "PropertyValue",
    "propertyID": "item_group_id",
    "value": "{{$details->name}}"
  }]
}
</script>
@endpush
