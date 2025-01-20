@extends('frontEnd.layouts.master') @section('title', 'Customer Checkout') @push('css')
<link rel="stylesheet" href="{{ asset('public/frontEnd/css/select2.min.css') }}" />
@endpush @section('content')
<section class="chheckout-section">
    @php
        $subtotal = Cart::instance('shopping')->subtotal();
        $subtotal = str_replace(',', '', $subtotal);
        $subtotal = str_replace('.00', '', $subtotal);
        $shipping = Session::get('shipping') ? Session::get('shipping') : 0;
        $coupon = Session::get('coupon_amount') ? Session::get('coupon_amount') : 0;
        $discount = Session::get('discount') ? Session::get('discount') : 0;
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-sm-5 cus-order-2 mb-4">
                <div class="checkout-shipping">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h4>Fill in the information to confirm your order <span style="color:#fe5200;"> "Place
                                    Order" </span>
                                Click the button or call this number to order by phone
                                <a style="color:#fe5200;" Click on
                                    href="tel:{{ $contact->hotline }}">{{ $contact->hotline }}</a>.
                            </h4> --}}
                            <h4>ক্যাশ অন ডেলিভারিতে অর্ডার করতে আপনার তথ্য দিন </h4>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('customer.ordersave') }}" id="checkoutForm" method="POST"
                                data-parsley-validate="">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group customized-input-box mb-3">
                                            <label for="name">Your Name *</label>
                                            <span class="input-icon-label">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <input type="text" placeholder ="Name" id="name"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required />
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-12">
                                        <div class="form-group customized-input-box mb-3">
                                            <label for="phone">Phone Number*</label>
                                            <span class="input-icon-label">
                                                <i class="fa fa-phone"></i>
                                            </span>
                                            <input placeholder ="Your Phone" type="text" minlength="11"
                                                id="number" maxlength="11" pattern="0[0-9]+"
                                                title="please enter number only and 0 must first character"
                                                title="Please enter an 11-digit number." id="phone"
                                                class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                value="{{ old('phone') }}" required />
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->

                                    <div class="col-sm-12">
                                        <div class="form-group customized-input-box mb-3">
                                            <label for="address">Address*</label>
                                            <span class="input-icon-label">
                                                <i class="fa fa-map-location-dot"></i>
                                            </span>
                                            <input placeholder ="Your Address" type="address" id="address"
                                                class="form-control @error('address') is-invalid @enderror"
                                                name="address" value="{{ old('address') }}" required />
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="area">Select Delivery Area *</label>
                                            <div class="shipping-area-box">
                                                @foreach ($shippingcharge as $key => $value)
                                                    <div class="area-item" data-id="{{ $value->id }}">
                                                        <input name="area" id="area-{{ $key + 1 }}"
                                                            type="radio" value="{{ $value->id }}">
                                                        <label
                                                            for="area-{{ $key + 1 }}">{{ $value->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @error('area')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <!--<label for="district">District *</label>-->
                                            <select id="district"
                                                class="form-control select2 district @error('district') is-invalid @enderror"
                                                name="district" value="{{ old('district') }}" required>
                                                <option value="">District...</option>
                                                @foreach ($districts as $key => $district)
                                                    <option value="{{ $district->district }}">
                                                        {{ $district->district }}</option>
                                                @endforeach
                                            </select>
                                            @error('district')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <!--<label for="area">Upazila/Area *</label>-->
                                            <select id="area"
                                                class="form-control  area select2 @error('area') is-invalid @enderror"
                                                name="area" value="{{ old('area') }}" required>
                                                <option value="">Upazila/Area...</option>
                                            </select>
                                            @error('area')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    --}}
                                    <!-- col-end -->

                                    <div class="col-sm-12">
                                        @if (Session::get('free_shipping') != 1)
                                            <div class="radio_payment">
                                                <label id="payment_method">PAYMENT METHOD</label>
                                                <div class="payment_option">
                                                </div>
                                            </div>
                                        @endif
                                        <div class="payment-methods">
                                            @if (Session::get('free_shipping') != 1)
                                                <div class="form-check p_cash payment_method" data-id="cod">
                                                    <input class="form-check-input" type="radio" name="payment_method"
                                                        id="inlineRadio1" value="Cash On Delivery" checked required />
                                                    <label class="form-check-label" for="inlineRadio1">
                                                        Cash On Delivery
                                                    </label>
                                                </div>
                                            @endif
                                            @if ($bkash_gateway)
                                                <div class="form-check p_bkash payment_method" data-id="bkash">
                                                    <input class="form-check-input" type="radio"
                                                        @if (Session::get('free_shipping') == 1) checked @endif
                                                        name="payment_method" id="inlineRadio2" value="bkash"
                                                        required />
                                                    <label class="form-check-label" for="inlineRadio2">
                                                        Bkash
                                                    </label>
                                                </div>
                                            @endif

                                            @if ($shurjopay_gateway)
                                                <div class="form-check p_shurjo payment_method" data-id="shurjopay">
                                                    <input class="form-check-input" type="radio"
                                                        name="payment_method" id="inlineRadio3" value="shurjopay"
                                                        required />
                                                    <label class="form-check-label" for="inlineRadio3">
                                                        Shurjopay
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form
                                action="@if (Session::get('coupon_used')) {{ route('customer.coupon_remove') }} @else {{ route('customer.coupon') }} @endif"
                                class="checkout-coupon-form" method="POST">
                                @csrf
                                <div class="coupon">
                                    <input type="text" name="coupon_code"
                                        placeholder=" @if (Session::get('coupon_used')) {{ Session::get('coupon_used') }} @else Apply Coupon @endif"
                                        class="border-0 shadow-none form-control" />
                                    <input type="submit"
                                        value="@if (Session::get('coupon_used')) remove @else apply @endif "
                                        class="border-0 shadow-none btn btn-theme" />
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- card end -->

                </div>
            </div>
            <!-- col end -->
            <div class="col-sm-7 cust-order-1">
                <div class="cart_details table-responsive-sm">
                    <div class="card">
                        <div class="card-header">
                            <h5>ORDER DETAILS</h5>
                        </div>
                        <div class="card-body cartlist">
                            @foreach (Cart::instance('shopping')->content() as $value)
                                <div class="checkout-cart-item">
                                    <div class="checkout-cart-image">
                                        <img src="{{ asset($value->options->image) }}" />
                                        <div class="checkout-cart-quantity">
                                            {{ $value->qty }}
                                        </div>
                                    </div>
                                    <div class="checkout-cart-info">
                                        <a href="{{ route('product', $value->options->slug) }}">
                                            {{ Str::limit($value->name, 50) }}</a>
                                        @if ($value->options->product_size)
                                            <p>Size: {{ $value->options->product_size }}</p>
                                        @endif
                                        @if ($value->options->product_color)
                                            <p>Color: {{ $value->options->product_color }}</p>
                                        @endif
                                    </div>
                                    <div class="checkout-cart-prices"><span class="">৳ </span><strong>{{ $value->price }}</strong>
                                    </div>
                                    <div class="checkout-cart-remove">
                                        <a class="cart_remove" data-id="{{ $value->rowId }}"><i
                                                class="fas fa-times "></i></a>
                                    </div>
                                </div>
                            @endforeach
                            <div class="checkout-cart-summary">
                                <div class="checkout-summary-item">
                                    <div  class="text-end px-4 left">Total</div>
                                    <div class="px-4 right">
                                        <span id="net_total"><span class="">৳
                                            </span><strong>{{ $subtotal }}</strong></span>
                                    </div>
                                </div>
                                <div class="checkout-summary-item">
                                    <div  class="text-end px-4 left">Delevery Charge</div>
                                    <div class="px-4 right">
                                        <span id="cart_shipping_cost"><span class="">৳
                                            </span><strong>{{ $shipping }}</strong></span>
                                    </div>
                                </div>

                                <div class="checkout-summary-item">
                                    <div  class="text-end px-4 left">Total</div>
                                    <div class="px-4 right">
                                        <span id="grand_total"><span class="">৳
                                            </span><strong>{{ $subtotal + $shipping - ($discount + $coupon) }}</strong></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="p-3" style="padding-top: 0;">
                            <div class="form-group">
                                <button style=""
                                    onclick="event.preventDefault();
                                document.getElementById('checkoutForm').submit();"
                                    class="order_place" type="submit">Order Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- col end -->
        </div>
    </div>
</section>
@endsection @push('script')
<script src="{{ asset('public/frontEnd/') }}/js/parsley.min.js"></script>
<script src="{{ asset('public/frontEnd/') }}/js/form-validation.init.js"></script>
<script src="{{ asset('public/frontEnd/') }}/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $(".select2").select2();
    });
</script>
{{-- <script>
    $("#area").on("change", function() {
        var id = $(this).val();
        $.ajax({
            type: "GET",
            data: {
                id: id
            },
            url: "{{ route('shipping.charge') }}",
            dataType: "html",
            success: function(response) {
                $(".cartlist").html(response);
            },
        });
    });
</script> --}}
<script>
    var firstItem = $(".area-item").first();
    firstItem.addClass("active");
    var firstRadioInput = firstItem.find("input[type='radio']").first();
    firstRadioInput.prop("checked", true);

    $(".area-item").on("click", function() {
        var id = $(this).data("id");
        $(".area-item").removeClass('active');
        $(this).addClass('active');
        $.ajax({
            type: "GET",
            data: {
                id: id
            },
            url: "{{ route('shipping.charge') }}",
            dataType: "html",
            success: function(response) {
                $(".cartlist").html(response);
            },
        });
    });
</script>

<script type="text/javascript">
    dataLayer.push({
        ecommerce: null
    }); // Clear the previous ecommerce object.
    dataLayer.push({
        event: "view_cart",
        ecommerce: {
            value: {{ $subtotal + $shipping - ($discount + $coupon) }}
            items: [
                @foreach (Cart::instance('shopping')->content() as $cartInfo)
                    {
                        item_name: "{{ $cartInfo->name }}",
                        item_id: "{{ $cartInfo->id }}",
                        id: "{{ $cartInfo->id }}",
                        price: "{{ $cartInfo->price }}",
                        item_brand: "{{ $cartInfo->options->brand }}",
                        item_category: "{{ $cartInfo->options->category }}",
                        item_size: "{{ $cartInfo->options->size }}",
                        item_color: "{{ $cartInfo->options->color }}",
                        currency: "BDT",
                        quantity: {{ $cartInfo->qty ?? 0 }},

                    },
                @endforeach
            ]
        }
    });
</script>
<script type="text/javascript">
    // Clear the previous ecommerce object.
    dataLayer.push({
        ecommerce: null
    });

    // Push the begin_checkout event to dataLayer.
    dataLayer.push({
        event: "begin_checkout",
        ecommerce: {
            value: {{ $subtotal + $shipping - ($discount + $coupon) }},
            items: [
                @foreach (Cart::instance('shopping')->content() as $cartInfo)
                    {
                        item_name: "{{ $cartInfo->name }}",
                        item_id: "{{ $cartInfo->id }}",
                        id: "{{ $cartInfo->id }}",
                        price: "{{ $cartInfo->price }}",
                        item_brand: "{{ $cartInfo->options->brands }}",
                        item_category: "{{ $cartInfo->options->category }}",
                        item_size: "{{ $cartInfo->options->size }}",
                        item_color: "{{ $cartInfo->options->color }}",
                        currency: "BDT",
                        quantity: {{ $cartInfo->qty ?? 0 }}
                    },
                @endforeach
            ]
        }
    });
</script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush
