<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $generalsetting->name }}</title>
        <link rel="shortcut icon" href="{{asset($generalsetting->favicon)}}" type="image/x-icon" />
        <!-- fot awesome -->
        <link rel="stylesheet" href="{{ asset('public/frontEnd/campaign/css') }}/all.css" />
        <!-- core css -->
        <link rel="stylesheet" href="{{ asset('public/frontEnd/campaign/css') }}/bootstrap.min.css" />
        <link rel="stylesheet" href="{{asset('public/backEnd/')}}/assets/css/toastr.min.css" />
        <!-- owl carousel -->
        <link rel="stylesheet" href="{{ asset('public/frontEnd/campaign/css') }}/owl.theme.default.css" />
        <link rel="stylesheet" href="{{ asset('public/frontEnd/campaign/css') }}/owl.carousel.min.css" />
        <!-- owl carousel -->
        <link rel="stylesheet" href="{{ asset('public/frontEnd/campaign/css') }}/style.css?v=1.0.0 "/>
        <link rel="stylesheet" href="{{ asset('public/frontEnd/campaign/css') }}/responsive.css?v=1.0.0" />
        
         @foreach($pixels as $pixel)
        <!-- Facebook Pixel Code -->
        <script>
            !(function (f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function () {
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
            fbq("init", "{{{$pixel->code}}}");
            fbq("track", "PageView");
        </script>
        <noscript>
            <img height="1" width="1" style="display: none;" src="https://www.facebook.com/tr?id={{{$pixel->code}}}&ev=PageView&noscript=1" />
        </noscript>
        @endforeach
        
        <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s);j.async=true;j.src="https://analytic.ozybd.com/5lahktimr.js?"+i;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','bvvrw=aWQ9R1RNLVc5UUtNU1dM&apiKey=f8fe72c7');</script>


        <meta name="app-url" content="{{route('campaign',$campaign->slug)}}" />
        <meta name="robots" content="index, follow" />
        <meta name="description" content="{{$campaign->short_description}}" />
        <meta name="keywords" content="{{ $campaign->slug }}" />

        <!-- Twitter Card data -->
        <meta name="twitter:card" content="product" />
        <meta name="twitter:site" content="{{$campaign->name}}" />
        <meta name="twitter:title" content="{{$campaign->name}}" />
        <meta name="twitter:description" content="{{ $campaign->short_description}}" />
        <meta name="twitter:creator" content="" />
        <meta property="og:url" content="{{route('campaign',$campaign->slug)}}" />
        <meta name="twitter:image" content="{{asset($campaign->banner)}}" />

        <!-- Open Graph data -->
        <meta property="og:title" content="{{$campaign->name}}" />
        <meta property="og:type" content="product" />
        <meta property="og:url" content="{{route('campaign',$campaign->slug)}}" />
        <meta property="og:image" content="{{asset($campaign->banner)}}" />
        <meta property="og:description" content="{{ $campaign->short_description}}" />
        <meta property="og:site_name" content="{{$campaign->name}}" />
    </head>

    <body>
         @php
            $subtotal = Cart::instance('shopping')->subtotal();
            $subtotal = str_replace(',', '', $subtotal);
            $subtotal = str_replace('.00', '', $subtotal);
            $shipping = Session::get('shipping') ? Session::get('shipping') : 0;
            $coupon = Session::get('coupon_amount') ? Session::get('coupon_amount') : 0;
            $discount = Session::get('discount') ? Session::get('discount') : 0;
        @endphp

        <section class="campaign-banner-section">
            <div class="container">
                <div class="website-logo">
                    <img src="{{ asset($generalsetting->white_logo) }}" alt="" height="50" />
                </div>
                <div class="campaign-title">
                    <h2>{{$campaign->name}}</h2>
                </div>
            </div>
        </section>
        <section class="product_video">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="video-button extra-button">
                            <a href="#order_form">অর্ডার করুন</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="campaign-video">
                            <iframe width="100%" height="350"
                            src="https://www.youtube.com/embed/{{$campaign->video}}" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="video-button">
                            <a href="#order_form">অর্ডার করুন</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <sectoin class="price-des">
            <div class="container show-price">
                <h4>{{$campaign->subtitle}}</h4>
                <h2>আগের দাম<del> {{$old_price}}</del> বর্তমান দাম {{$new_price}} টাকায়</h2> 
            </div>       
        </sectoin>

        <section class="secound-campaign-video">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="video-title">
                            <h4>{{ $campaign->twotitle }}</h4>
                         </div>
                        <div class="videofram">
                            <iframe width="100%" height="350"
                            src="https://www.youtube.com/embed/{{$campaign->twovideo}}" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                        </div>
                    </div>
                    <!-- end-col -->
                    <div class="col-sm-6">
                        <div class="video-title">
                            <h4>{{ $campaign->threetitle }}</h4>
                         </div>
                        <div class="videofram">
                            <iframe width="100%" height="350"
                            src="https://www.youtube.com/embed/{{$campaign->threevideo}}" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="campaign-details">
            <div class="extra-background"></div>
            <div class="container cam-des">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="campaign-image">
                                <img src="{{asset($campaign->best_image)}}" alt="" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="campaign-des">
                                <h3>{{$campaign->best_title}}?</h3>
                                <!-- <ul>
                                    <li><i class="fa-solid fa-heart"></i>   বিবি ক্রিমটি আপনার ত্বককে দিবে ইনস্ট্যান্ট ফুল কভারেজ।</li>

                                    <li><i class="fa-solid fa-heart"></i>   SPF 50/PA+++ থাকায় ক্রিমটি আপনার ত্বককে সূর্যের ক্ষতিকর রশ্মি থেকে দিবে আলটিমেট প্রটেকশন।</li>

                                    <li><i class="fa-solid fa-heart"></i>   ক্রিমটি তে উপস্থিত Niacinamide আপনার ত্বকের উজ্জ্বলতা এবং বার্ধ্যকের ছাপ দূর করবে।</li>
                                </ul> -->
                             
                                    <p>{!!$campaign->best_description!!}</p>
                                   
                                
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="video-buttons">
                                <a href="#order_form">অর্ডার করুন</a>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <section class="cap-product">
            <div class="container cam-des-pro">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="campaign-pdes">
                                <h3>{{$campaign->choose_title}}</h3>
                                <ul>
                                    <p>{!!$campaign->choose_description!!}</p>
                                   
                                </ul>
                            </div>
                            <div class="video-buttons text-end extra-button">
                                <a href="#order_form">অর্ডার করুন</a>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="campaign-pimage">
                                <img src="{{asset($campaign->choose_image)}}" alt="" />
                            </div>
                        </div>

                    </div>
                </div>
        </section>

        <section class="banner-neccecity">
            <div class="container">
                <div class="neccecity-profile">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="campaign-image">
                                <img src="{{asset($campaign->useful_image)}}" alt="" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="campaign-des">
                                <h3>{{$campaign->useful_title}}</h3>
                                <p>{!!$campaign->useful_description!!}</p>
                              
                            </div>
                            <div class="video-buttons">
                                <a href="#order_form">অর্ডার করুন</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="faq-section">
        <h1>সাধারণ জিজ্ঞাসা</h1>
        @foreach($campaign->generalTable as $key=>$value)
        <div class="faq-item">
            <button class="faq-question">
                {{$value->question}}
                <span class="icon">+</span>
            </button>
            <div class="faq-answer">
                <p>{{$value->answer}}</p>
            </div>
        </div>
        @endforeach

       

        <!-- Add more questions here -->
    </section>

        <!-- review section start -->
         @if($campaign->images)
         <section class="review-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="rev_inn">
                            <div class="rev_title">
                                <h2>আমাদের কাস্টমারের রিভিউ?</h2>
                            </div>
                            <div class="review_slider owl-carousel">
                            @foreach($campaign->images as $key=>$value)
                            <div class="review_item">
                                <img src="{{asset($value->image)}}" alt="">
                            </div>
                            @endforeach
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        <!-- review section end -->




        <section class="form_sec">
        <div class="container">
           <div class="row">
             <div class="col-sm-12">
                <div class="form_inn">
                    <div class="col-sm-12">
                        <div class="alert">
                            অর্ডার করতে আপনার নাম, ফোন নাম্বার দিন। এরপর পুরো ঠিকানা লিখে "অর্ডার" বাটনে ক্লিক করুন।
                        </div>
                        <div class="row order_by">
                            <div class="col-sm-5">
                                <div class="checkout-shipping" id="order_form">
                                    <form action="{{route('customer.ordersave')}}" method="POST" data-parsley-validate="">
                                    @csrf
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group mb-3">
                                                        <label for="name">আপনার নাম লিখুন  </label>
                                                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="আপনার নাম" name="name" value="{{old('name')}}" required>
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- col-end -->
                                                <div class="col-sm-12">
                                                    <div class="form-group mb-3">
                                                        <label for="phone">আপনার মোবাইল লিখুন *</label>
                                                        <input type="number" minlength="11" id="number" maxlength="11" pattern="0[0-9]+"  placeholder=" মোবাইল নাম্বার" title="please enter number only and 0 must first character" title="Please enter an 11-digit number." id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{old('phone')}}" required>
                                                        @error('phone')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- col-end -->
                                                <div class="col-sm-12">
                                                    <div class="form-group mb-3">
                                                        <label for="address">আপনার ঠিকানা লিখুন*</label>
                                                        <input type="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="বাসা, রোড, থানা, জেলা....." name="address" value="{{old('address')}}"  required>
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- <div class="col-sm-12">-->
                                                <!--    <div class="form-group mb-3">-->
                                                <!--        <label for="area">আপনার এরিয়া সিলেক্ট করুন *</label>-->
                                                <!--        <select id="area" class="form-control @error('area') is-invalid @enderror" name="area" required>-->
                                                <!--            <option value="">Select...</option>-->
                                                <!--            @foreach($shippingcharge as $key=>$value)-->
                                                <!--                <option value="{{$value->id}}">{{$value->name}}</option>-->
                                                <!--            @endforeach-->
                                                <!--        </select>-->
                                                <!--        @error('area')-->
                                                <!--            <span class="invalid-feedback" role="alert">-->
                                                <!--                <strong>{{ $message }}</strong>-->
                                                <!--            </span>-->
                                                <!--        @enderror-->
                                                <!--    </div>-->
                                                <!--</div> -->

                                                <div class="col-sm-12">
                                                    <div class="form-group mb-3">
                                                        <label for="area">আপনার এরিয়া সিলেক্ট করুন *</label>
                                                        <div>
                                                            @foreach($shippingcharge as $key => $value)
                                                                <div class="form-check">
                                                                    <input 
                                                                        type="radio" 
                                                                        id="area_{{ $value->id }}" 
                                                                        class="area form-check-input @error('area') is-invalid @enderror" 
                                                                        name="area" 
                                                                        value="{{ $value->id }}" {{$key == 0?'checked':''}}
                                                                        required
                                                                    >
                                                                    <label class="form-check-label" for="area_{{ $value->id }}">
                                                                        {{ $value->name }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        @error('area')
                                                            <span class="invalid-feedback d-block" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                @if($productcolors->count() > 0)
                                                     <div class="pro-color" style="width: 100%;">
                                                        <div class="color_inner">
                                                            <p>Color -</p>
                                                            <div class="size-container">
                                                                <div class="selector">
                                                                    @foreach ($productcolors as $key=>$procolor)
                                                                    <div class="selector-item color-item" data-id="{{$key}}">
                                                                        <input
                                                                            type="radio"
                                                                            id="fc-option{{ $procolor->color }}"
                                                                            value="{{ $procolor->color}}"
                                                                            name="product_color"
                                                                            class="selector-item_radio emptyalert stock_color stock_check" required data-color="{{ $procolor->color}}"
                                                                        />
                                                                        <label for="fc-option{{ $procolor->color }}" class="selector-item_label">{{ $procolor->color}}
                                                                        </label>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if($productsizes->count() > 0)
                                                        <div class="pro-size" style="width: 100%;">
                                                            <div class="size_inner">
                                                                <p>Size - <span class="attibute-name"></span></p>
                                                                <div class="size-container">
                                                                    <div class="selector">
                                                                        @foreach ($productsizes as $prosize)
                                                                            <div class="selector-item">
                                                                                <input type="radio"
                                                                                    id="f-option{{ $prosize->size }}"
                                                                                    value="{{ $prosize->size}}"
                                                                                    name="product_size"
                                                                                    class="selector-item_radio emptyalert stock_size stock_check" data-size="{{ $prosize->size}}"
                                                                                    required />
                                                                                <label
                                                                                    for="f-option{{ $prosize->size }}"
                                                                                    class="selector-item_label">{{ $prosize->size}}</label>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif


                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="order-button">অর্ডার করুন </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- card end -->
                                </form>
                                </div>
                            </div>
                            <!-- col end -->
                            <div class="col-sm-7 cust-order-1">
                                <div class="cart_details">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="potro_font">Product Details </h5>
                                        </div>
                                        <div class="card-body cartlist  table-responsive">
                                            <table class="cart_table table table-border table-striped text-center mb-0">
                                                <thead>
                                                   <tr>
                                                      <th style="width: 20%;">Delete</th>
                                                      <th style="width: 40%;">Product</th>
                                                      <th style="width: 20%;">Qty</th>
                                                      <th style="width: 20%;">Price</th>
                                                     </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach(Cart::instance('shopping')->content() as $value)
                                                    <tr>
                                                        <td>
                                                            <a class="cart_remove" data-id="{{$value->rowId}}"><i class="fas fa-trash text-danger"></i></a>
                                                        </td>
                                                        <td class="text-left">
                                                             <a style="font-size: 14px;" href="{{route('product',$value->options->slug)}}"><img src="{{asset($value->options->image)}}" height="30" width="30"> {{Str::limit($value->name,20)}}</a>
                                                        </td>
                                                        <td width="15%" class="cart_qty">
                                                            <div class="qty-cart vcart-qty">
                                                                <div class="quantity">
                                                                    <button class="minus cart_decrement"  data-id="{{$value->rowId}}">-</button>
                                                                    <input type="text" value="{{$value->qty}}" readonly />
                                                                    <button class="plus  cart_increment" data-id="{{$value->rowId}}">+</button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>৳ <strong>{{$value->price*$value->qty}}</strong></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                     <tr>
                                                      <th colspan="3" class="text-start px-4 border-bottom-dotted">Subtotal</th>
                                                      <td>
                                                       <span id="net_total"><span class="">৳ </span><strong>{{$subtotal}}</strong></span>
                                                      </td>
                                                     </tr>
                                                     <tr>
                                                      <th colspan="3" class="text-start px-4 border-bottom-dotted">Shipping </th>
                                                      <td>
                                                       <span id="cart_shipping_cost"><span class="">৳ </span><strong>{{$shipping}}</strong></span>
                                                      </td>
                                                     </tr>
                                                      <tr>
                                                        <th colspan="3" class="text-start px-4 border-bottom-dotted">Discount</th>
                                                        <td class="px-4">
                                                            <span id="cart_shipping_cost"><span class="">৳
                                                                </span><strong>{{ $discount + $coupon }}</strong></span>
                                                        </td>
                                                    </tr>
                                                     <tr>
                                                      <th colspan="3" class="text-start px-4 border-bottom-dotted">Total</th>
                                                      <td>
                                                       <span id="grand_total"><span class="">৳ </span><strong>{{$subtotal+$shipping}}</strong></span>
                                                      </td>
                                                     </tr>
                                                    </tfoot>

                                            </table>

                                                    <div class="cash">
                                                        <div class="cash-title">Cash on Delivery</div>
                                                        <div class="cash-tooltip">
                                                            পণ্য হাতে পেয়ে মুল্য পরিশোধ করুন
                                                        </div>
                                                    </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- col end -->
                            </div>
                    </div>
                </div>

             </div>
            </div>
        </div>
    </section>


        <script src="{{ asset('public/frontEnd/campaign/js') }}/jquery-2.1.4.min.js"></script>
        <script src="{{ asset('public/frontEnd/campaign/js') }}/all.js"></script>
        <script src="{{ asset('public/frontEnd/campaign/js') }}/bootstrap.min.js"></script>
        <script src="{{ asset('public/frontEnd/campaign/js') }}/owl.carousel.min.js"></script>
        <script src="{{ asset('public/frontEnd/campaign/js') }}/select2.min.js"></script>
        <script src="{{ asset('public/frontEnd/campaign/js') }}/script.js"></script>
        <script src="{{asset('public/backEnd/')}}/assets/js/toastr.min.js"></script>
        {!! Toastr::message() !!}


        <!-- bootstrap js -->
        <script>
            $(document).ready(function () {
                $(".owl-carousel").owlCarousel({
                    margin: 15,
                    loop: true,
                    dots: false,
                    autoplay: true,
                    autoplayTimeout: 6000,
                    autoplayHoverPause: true,
                    items: 1,
                    });
                $('.owl-nav').remove();
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>
        <script>
             $(".area").on("change", function () {
                var id = $(this).val();
                $.ajax({
                    type: "GET",
                    data: { id: id },
                    url: "{{route('shipping.charge.campaign')}}",
                    dataType: "html",
                    success: function(response){
                        $('.cartlist').html(response);
                    }
                });
            });
        </script>
           <script>
            $(".cart_remove").on("click", function () {
                var id = $(this).data("id");
                if (id) {
                    $.ajax({
                        type: "GET",
                        data: { id: id },
                        url: "{{route('cart.remove_bn')}}",
                        success: function (data) {
                            if (data) {
                                $(".cartlist").html(data);
                            }
                        },
                    });
                }
            });
            $(".cart_increment").on("click", function () {
                var id = $(this).data("id");
                if (id) {
                    $.ajax({
                        type: "GET",
                        data: { id: id },
                        url: "{{route('cart.increment_bn')}}",
                        success: function (data) {
                            if (data) {
                                $(".cartlist").html(data);
                            }
                        },
                    });
                }
            });

            $(".cart_decrement").on("click", function () {
                var id = $(this).data("id");
                if (id) {
                    $.ajax({
                        type: "GET",
                        data: { id: id },
                        url: "{{route('cart.decrement_bn')}}",
                        success: function (data) {
                            if (data) {
                                $(".cartlist").html(data);
                            }
                        },
                    });
                }
            });

        </script>
        <script>
            $('.review_slider').owlCarousel({
                dots: false,
                arrow: false,
                autoplay: true,
                loop: true,
                margin: 10,
                smartSpeed: 1000,
                mouseDrag: true,
                touchDrag: true,
                items: 6,
                responsiveClass: true,
                responsive: {
                    300: {
                        items: 1,
                    },
                    480: {
                        items: 2,
                    },
                    768: {
                        items: 5,
                    },
                    1170: {
                        items: 5,
                    },
                }
            });
        </script>
        <script>
            $(".stock_check").on("click", function () {
                var color = $(".stock_color:checked").data('color');
                var size = $(".stock_size:checked").data('size');
                var id = {{$campaign->product_id}};
                if(id){
                    $.ajax({
                        type: "GET",
                        data: { id:id,color: color ,size:size},
                        url: "{{route('campaign.stock_check')}}",
                        dataType: "json",
                        success: function(status){
                            if(status == true){
                                $('.confirm_order').prop('disabled', false);
                                return cart_content();
                            }else{
                                $('.confirm_order').prop('disabled', true);
                                toastr.error('Stock Out',"Please select another color or size");
                            }
                            console.log(status);
                            // return cart_content();
                        }
                    });
                }
            });
            function cart_content() {
                $.ajax({
                    type: "GET",
                    url: "{{route('cart.content')}}",
                    success: function (data) {
                        if (data) {
                           $(".cartlist").html(data);
                        } else {
                           $(".cartlist").html(data);
                        }
                    },
                });
            }
        </script>
        <script>
            const faqItems = document.querySelectorAll('.faq-item');

            faqItems.forEach(item => {
                const questionButton = item.querySelector('.faq-question');
                const answer = item.querySelector('.faq-answer');
                const icon = questionButton.querySelector('.icon');

                questionButton.addEventListener('click', () => {
                    // Toggle the answer visibility
                    answer.style.display = answer.style.display === 'block' ? 'none' : 'block';

                    // Toggle active class and icon
                    questionButton.classList.toggle('active');
                    icon.textContent = icon.textContent === '+' ? '-' : '+';
                });
            });
        </script>
        
                <!-- Google Tag Manager (noscript) -->
                <noscript><iframe src="https://analytic.ozybd.com/ns.html?id=GTM-W9QKMSWL" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
                <!-- End Google Tag Manager (noscript) -->

        
    </body>
</html>
