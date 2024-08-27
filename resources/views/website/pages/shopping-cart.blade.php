@extends('website.index')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0; ?>
                                @forelse ($carts as $cart)
                                    <tr>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                <img src="img/shopping-cart/cart-1.jpg" alt="">
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6>{{$cart?->title}}</h6>
                                                <h5>${{$cart?->price}}</h5>
                                            </div>
                                        </td>
                                        <form action="{{route('update.cart.item', ['cart_id'=>$cart?->id])}}" method="post">
                                            @csrf
                                            <td class="quantity__item">
                                                <div class="quantity">
                                                    <div class="pro-qty-2">
                                                        <input type="text" name="qty" value="{{$cart?->qty}}">
                                                    </div>
                                                    <input type="submit" class="btn btn-info" name="" id="" value="update">
                                                </div>
                                            </td>
                                        </form>
                                        <td class="cart__price">{{$cart?->price * $cart?->qty }}</td>
                                        <td class="cart__close">
                                            <a href="{{route('trash.cart.item', ['cart_id'=>$cart?->id])}}"><i class="fa fa-close text-danger"></i></a>
                                        </td>
                                    </tr>
                                    <?php $total += ($cart?->price * $cart?->qty); ?>
                                @empty
                                    <p>No item found into the cart</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="#">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span>$ {{$total}}</span></li>
                            <li>Total <span>$ {{$total}}</span></li>
                        </ul>
                        <form action="{{route('stripe.page')}}" method="get">
                            @csrf
                            <input type="text" class="form-control mt-2" name="name" id="name" placeholder="Enter your name" required>
                            <input type="text" class="form-control mt-2" name="number" id="number" placeholder="Enter your number" required>
                            <input type="text" class="form-control mt-2" name="address" id="address" placeholder="Enter you address" required>
                            <input type="hidden" name="total_price" id="total_price" value="{{$total}}">
                            <button type="submit" class="form-control mt-2 btn btn-primary px-auto py-auto">Proceed Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection

<script>
    $(document).ready(function(){
        alert('aldjfladf');
    });
</script>
