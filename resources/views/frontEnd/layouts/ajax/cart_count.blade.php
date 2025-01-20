@php
    $subtotal = Cart::instance('shopping')->subtotal();
    $subtotal = str_replace(',', '', $subtotal);
    $subtotal = str_replace('.00', '', $subtotal);
    view()->share('subtotal', $subtotal);
@endphp
<button class="cart-toggle-button">
    <p class="margin-shopping">
        <i class="fa-solid fa-cart-shopping"></i>
        <span>{{ Cart::instance('shopping')->count() }}</span>
    </p>
</button>

<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>
<script>
    feather.replace()
</script>

