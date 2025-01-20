@php
    $subtotal = Cart::instance('shopping')->subtotal();
    $subtotal = str_replace(',', '', $subtotal);
    $subtotal = str_replace('.00', '', $subtotal);
    $shipping = Session::get('shipping') ? Session::get('shipping') : 0;
    $coupon = Session::get('coupon_amount') ? Session::get('coupon_amount') : 0;
    $discount = Session::get('discount') ? Session::get('discount') : 0;
@endphp
<style>
       td.text-left a img {
       height: 30px;
   }
</style>
<table class="cart_table table table-bordered table-striped text-center mb-0">
    <thead>
        <tr>
            <th style="width: 20%;">Delele</th>
            <th style="width: 40%;">Product</th>
            <th style="width: 20%;">Qty</th>
            <th style="width: 20%;">Price</th>
        </tr>
    </thead>

    <tbody>
        @foreach (Cart::instance('shopping')->content() as $value)
            <tr>
                <td>
                    <a class="cart_remove" data-id="{{ $value->rowId }}"><i class="fas fa-trash text-danger"></i></a>
                </td>
                <td class="text-left">
                    <a style="font-size: 14px;" href="{{ route('product', $value->options->slug) }}"> <img
                            src="{{ asset($value->options->image) }}" />
                        {{ Str::limit($value->name, 20) }}</a>
                    @if ($value->options->product_size)
                        <p>Size: {{ $value->options->product_size }}</p>
                    @endif
                    @if ($value->options->product_color)
                        <p>Color: {{ $value->options->product_color }}</p>
                    @endif
                </td>
                <td class="cart_qty">
                    <div class="qty-cart vcart-qty">
                        <div class="quantity">
                            <button class="minus cart_decrement" data-id="{{ $value->rowId }}">-</button>
                            <input type="text" value="{{ $value->qty }}" readonly />
                            <button class="plus cart_increment" data-id="{{ $value->rowId }}">+</button>
                        </div>
                    </div>
                </td>
                <td><span class="">৳ </span><strong>{{ $value->price }}</strong>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" class="text-end px-4">Total</th>
            <td class="px-4">
                <span id="net_total"><span class="">৳
                    </span><strong>{{ $subtotal }}</strong></span>
            </td>
        </tr>
        <tr>
            <th colspan="3" class="text-end px-4">Delevery Charge</th>
            <td class="px-4">
                <span id="cart_shipping_cost"><span class="">৳
                    </span><strong>{{ $shipping }}</strong></span>
            </td>
        </tr>
        <tr>
            <th colspan="3" class="text-end px-4">Discount</th>
            <td class="px-4">
                <span id="cart_shipping_cost"><span class="">৳
                    </span><strong>{{ $discount + $coupon }}</strong></span>
            </td>
        </tr>
        <tr>
            <th colspan="3" class="text-end px-4">Total</th>
            <td class="px-4">
                <span id="grand_total"><span class="">৳
                    </span><strong>{{ $subtotal + $shipping - ($discount + $coupon) }}</strong></span>
            </td>
        </tr>
    </tfoot>
</table>



<!-- cart js end -->
