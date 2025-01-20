<div class="product_item_inner">
    {{-- <div class="wish-compare">
       <div class="wish-compare-inner">
           <!--<a title="Compare" href="#" data-id="{{ $value->id }}"-->
           <!--    class="comparecartbutton"><i class="fa-solid fa-sliders"></i>-->
           <!--</a>-->
           <button data-id="{{ $value->id }}" class="hover-zoom compare_store"
               title="Compare"><i class="fa-solid fa-sliders"></i></button>
           <button data-id="{{ $value->id }}" class="hover-zoom wishlist_store"
               title="Wishlist"><i class="fa-regular fa-heart"></i></button>
       </div>
   </div> --}}
    @if ($value->variable_count > 0 && $value->type == 0)
        @if ($value->variable->old_price)
            <div class="sale-badge">
                <div class="sale-badge-inner">
                    <div class="sale-badge-box">
                        <span class="sale-badge-text">
                            <p>@php $discount=(((($value->variable->old_price)-($value->variable->new_price))*100) / ($value->variable->old_price)) @endphp {{ number_format($discount, 0) }}%</p>
                            Of
                        </span>
                    </div>
                </div>
            </div>
        @endif
    @else
        @if ($value->old_price)
            <div class="sale-badge">
                <div class="sale-badge-inner">
                    <div class="sale-badge-box">
                        <span class="sale-badge-text">
                            <p>@php $discount=(((($value->old_price)-($value->new_price))*100) / ($value->old_price)) @endphp {{ number_format($discount, 0) }}%</p>
                            Of
                        </span>
                    </div>
                </div>
            </div>
        @endif
    @endif
    <div class="pro_img">
        <a href="{{ route('product', $value->slug) }}">
            <img src="{{ asset($value->image ? $value->image->image : '') }}" alt="{{ $value->name }}" />
        </a>
    </div>
    <div class="pro_des">
        <div class="pro_name">
            <a href="{{ route('product', $value->slug) }}">{{ Str::limit($value->name, 80) }}</a>
        </div>
        <div class="pro_price">
            @if ($value->variable_count > 0 && $value->type == 0)
                <p>
                    @if ($value->variable->old_price)
                        <del>৳ {{ $value->variable->old_price }}</del>
                    @endif

                    ৳ {{ $value->variable->new_price }}

                </p>
            @else
                <p>
                    @if ($value->old_price)
                        <del>৳ {{ $value->old_price }}</del>
                    @endif

                    ৳ {{ $value->new_price }}

                </p>
            @endif
        </div>
    </div>
</div>

@if ($value->variable_count > 0 && $value->type == 0)
    <div class="pro_btn">

        <div class="cart_btn order_button">
            <a href="{{ route('product', $value->slug) }}" class="addcartbutton">Quick Add
            </a>
        </div>
    </div>
    @else
    <div class="pro_btn">
        <div class="cart_btn order_button">
            <button class="addcartbutton" data-id="{{ $value->id }}">Quick Add </button>
        </div>
    </div>
@endif
