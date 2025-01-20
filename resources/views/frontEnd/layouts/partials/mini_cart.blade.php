@php
    $subtotal = Cart::instance('shopping')->subtotal();
    $subtotal = str_replace(',', '', $subtotal);
    $subtotal = str_replace('.00', '', $subtotal);
    $shipping = Session::get('shipping') ? Session::get('shipping') : 0;
    $coupon = Session::get('coupon_amount') ? Session::get('coupon_amount') : 0;
    $discount = Session::get('discount') ? Session::get('discount') : 0;
@endphp


<div class="mini-cart-header">
    <p>
        <i class="fa-solid fa-shopping-cart"></i>
        {{ Cart::instance('shopping')->content()->count() }} items - ({{ $subtotal }} TK)
    </p>
    <button class="mini-close-button mini-close-cart">
        <i class="fa-solid fa-times"></i>
    </button>
</div>
@if (Cart::instance('shopping')->count() > 0)
    <div class="mini-cart-body">
        @foreach (Cart::instance('shopping')->content() as $item)
            <div class="mini-cart-item {{ $loop->last ? 'border-none' : '' }}">
                <div class="cart-item-image">
                    <img src="{{ asset($item->options->image ?? '') }}" alt="">
                </div>
                <div class="cart-item-content">
                    <div class="cart-product">
                        <a href="">{{ $item->name }}</a>
                    </div>
                    <div class="cart-item-subtotal">
                        <strong>{{ $item->price * $item->qty }} TK</strong>
                        @if ($item->options->size)
                            <small>Size: {{ $item->options->size }}</small>
                        @endif
                    </div>
                </div>
                <div class="cart-quantity-content">
                    @if ($item->qty == 1)
                        <button class="mini-cart-change cart_remove" data-id="{{ $item->rowId }}" type="button">
                            <i class="fa fa-trash-alt"></i>
                        </button>
                    @else
                        <button class="mini-cart-change cart_decrement" data-id="{{ $item->rowId }}" type="button">
                            <i class="fa fa-minus"></i>
                        </button>
                    @endif
                    <span>{{ $item->qty }}</span>
                    <button class="mini-cart-change cart_increment" data-id="{{ $item->rowId }}" type="button">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mini-cart-checkout">
        <div class="mini-cart-summary">
            <ul>
                <li><span>Subtotal</span><span>{{ $subtotal }} Tk</span></li>
            </ul>
        </div>


        <a href="{{ route('customer.checkout') }}" class="mini-cart-order order_place">
            <i class="fa fa-shopping-cart"></i>
            ক্যাশ অন ডেলিভারিতে অর্ডার করুন
        </a>
    </div>
    <button class="mini-close-button floating-close-button"><i class="fa-solid fa-angle-right"></i></button>
@else
    <button class="mini-close-button floating-close-button"><i class="fa-solid fa-angle-right"></i></button>

    <div class="empty-cart">
        <div class="empty-img">
            <img src="{{ asset('public/frontEnd/images/empty-cart.webp') }}" alt="">
        </div>
    </div>
@endif
<script></script>
