@extends('layouts.layout')

@section("head")
    <link rel="stylesheet" href="/css/mycart.css">
@endsection



@section("content")

    @include("layouts.navbar")

<div class="form-group">
    <div class="d-flex justify-content-center w-75 parts-words py-3">
        <span class="px-5 parts part1">Shopping Cart</span>
        <span class="px-5 parts part2">Shipping</span>
        <span class="px-5 parts part3">Payment</span>
        <span class="px-5 parts part4">Finish</span>
    </div>
    <div class="d-flex justify-content-center p-3">
        <div class="line w-75 py-1">
            <div class="cart-dot px-5"></div>
            <div class="shipping-dot px-5"></div>
            <div class="payment-dot px-5"></div>
            <div class="finish-dot px-5"></div>
        </div>
    </div>
    <div class="container pt-4">
        <div class="shopping-cart">
            <div class="d-flex justify-content-center py-3">
                <i class="fa fa-3x fa-shopping-cart d-inline px-2" aria-hidden="true"></i>
                <h2 class="d-inline">My Shopping Cart</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <div class="order-items">
                              <table class="table table-striped items-table table2 text-center">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Size</th>
                                            <th>Color</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $p)
                                        <tr>
                                            <td>
                                                <div class="image">
                                                    <img class="img-fluid" src="{{ Storage::url($p->path) }}">
                                                </div>
                                                <div class="order-type">
                                                    <p>{{ $p->type ?? "" }}</p>
                                                </div>
                                            </td>
                                            <td>{{ $p->price }} EP</td>
                                            <td>{{ $p->sizes }}</td>
                                            <td>{{ $p->color_name }}</td>
                                            <td> {{ $p->amount }} </td>
                                            <td>{{ $p->total }} EP</td>
                                            <td>
                                                <form action="{{ route("cart.remove", ["cart" => $p->id]) }}" method="POST">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-danger text-white">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="totals">
                                            <td class="total-word">Total</td>
                                            <td>{{ $total }} EP</td>
                                        </tr>
                                    </tbody>
                                </table>  
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 py-3 d-flex justify-content-center">
                        <div class="next-btn py-2 px-3">
                            <a class="btn btn-info text-white" id="next-shipping">Next <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route("cart.paypal") }}" method="POST">
        @csrf
    <div class="container pt-4">
        <div class="shipping">
            <div class="d-flex justify-content-center py-3">
                <h2 class="d-inline">Shipping Information</h2>
            </div>
            <div class="form-group">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="shipping-fname">First Name</label>
                            <input id="shipping-fname" value="{{ old("fname") }}" name="fname" required class="form-control" type="text" placeholder="First Name">
                        </div>
                        <div class="col-md-6">
                            <label for="shipping-lname">Last Name</label>
                            <input id="shipping-lname" value="{{ old("lname") }}" name="lname" required class="form-control" type="text" placeholder="Last Name">
                        </div>
                        <div class="col-md-4 py-3">
                            <label for="shipping-governorate">Governorate</label>
                            <select class="custom-select" name="governorate" required id="shipping-governorate" required>
                                 <option selected disabled value="">Governorate</option>
                                 <option @if(old("governorate") == "Alexandria") selected @endif>Alexandria</option>
                                 <option @if(old("governorate") == "Aswan") selected @endif>Aswan</option>
                                 <option @if(old("governorate") == "Asyut") selected @endif>Asyut</option>
                                 <option @if(old("governorate") == "Beheira") selected @endif>Beheira</option>
                                 <option @if(old("governorate") == "Beni Suef") selected @endif>Beni Suef</option>
                                 <option @if(old("governorate") == "Cairo") selected @endif>Cairo</option>
                                 <option @if(old("governorate") == "Dakahlia") selected @endif>Dakahlia</option>
                                 <option @if(old("governorate") == "Damietta") selected @endif>Damietta</option>
                                 <option @if(old("governorate") == "Faiyum") selected @endif>Faiyum</option>
                                 <option @if(old("governorate") == "Gharbia") selected @endif>Gharbia</option>
                                 <option @if(old("governorate") == "Giza") selected @endif>Giza</option>
                                 <option @if(old("governorate") == "Ismailia") selected @endif>Ismailia</option>
                                 <option @if(old("governorate") == "Kafr El Sheikh") selected @endif>Kafr El Sheikh</option>
                                 <option @if(old("governorate") == "Luxor") selected @endif>Luxor</option>
                                 <option @if(old("governorate") == "Matruh") selected @endif>Matruh</option>
                                 <option @if(old("governorate") == "Minya") selected @endif>Minya</option>
                                 <option @if(old("governorate") == "Monufia") selected @endif>Monufia</option>
                                 <option @if(old("governorate") == "New Valley") selected @endif>New Valley</option>
                                 <option @if(old("governorate") == "North Sinai") selected @endif>North Sinai</option>
                                 <option @if(old("governorate") == "Port Said") selected @endif>Port Said</option>
                                 <option @if(old("governorate") == "Qalyubia") selected @endif>Qalyubia</option>
                                 <option @if(old("governorate") == "Qena") selected @endif>Qena</option>
                                 <option @if(old("governorate") == "Red Sea") selected @endif>Red Sea</option>
                                 <option @if(old("governorate") == "Sharqia") selected @endif>Sharqia</option>
                                 <option @if(old("governorate") == "Sohag") selected @endif>Sohag</option>
                                 <option @if(old("governorate") == "South Sinai") selected @endif>South Sinai</option>
                                 <option @if(old("governorate") == "Suez") selected @endif>Suez</option>
                             </select>
                        </div>
                        <div class="col-md-4 py-3">
                            <label for="shipping-street">Street</label>
                            <input id="shipping-street" value="{{ old("street") }}" name="street" required class="form-control" type="text" placeholder="Street">
                        </div>
                        <div class="col-md-4 py-3">
                            <label for="shipping-address">Address</label>
                            <input id="shipping-address" value="{{ old("address") }}" name="address" required class="form-control" type="text" placeholder="Address">
                        </div>
                        <div class="col-md-4 py-3">
                            <label for="shipping-houseNum">House Number</label>
                            <input id="shipping-houseNum" value="{{ old("house_number") }}" name="house_number" class="form-control" type="text" placeholder="House Number">
                        </div>
                        <div class="col-md-4 py-3">
                            <label for="shipping-tel1">Telephone Number1</label>
                            <input id="shipping-tel1"  value="{{ old("phone1") }}" name="phone1" class="form-control" type="text" placeholder="Telephone Number1">
                        </div>
                        <div class="col-md-4 py-3">
                            <label for="shipping-tel2">Telephone Number2</label>
                            <input id="shipping-tel2" value="{{ old("phone2") }}" name="phone2" class="form-control" type="text" placeholder="Telephone Number2">
                        </div>
                        <div class="col-md-12 py-3">
                            <p class="shipping-ask">When you want receive your order?</p>
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" @if(old("shipping") == "7") checked @endif value="7" class="custom-control-input" id="shipping-date-week" name="shipping" required>
                                <label class="custom-control-label d-inline" for="shipping-date-week">After One Week.</label>
                                <p class="d-inline ml-4">Delivery Fess: 25 EP</p>
                            </div>
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" value="3" @if(old("shipping") == "3") checked @endif class="custom-control-input" id="shipping-date-3days" name="shipping" required>
                                <label class="custom-control-label d-inline" for="shipping-date-3days">After 3 Days.</label>
                                <p class="d-inline ml-4">Delivery Fess: 50 EP</p>
                            </div>
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" value="1" @if(old("shipping") == "1") checked @endif class="custom-control-input" id="shipping-date-day" name="shipping" required>
                                <label class="custom-control-label d-inline" for="shipping-date-day">After One Day.</label>
                                <p class="d-inline ml-4">Delivery Fess: 100 EP</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 py-3 d-flex justify-content-center">
                        <div class="previous-btn py-2 px-3 mx-5">
                            <a class="btn btn-info text-white" id="prev-cart"><i class="fas fa-arrow-left"></i> Previous</a>
                        </div>
                        <div class="next-btn py-2 px-3 mx-5">
                            <a class="btn btn-info text-white" id="next-payment">Next <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container pt-4">
        <div class="payment">
            <div class="d-flex justify-content-center mb-3">
                <h2 class="d-inline">Payment Information</h2>
            </div> 
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <tbody>
                                <tr class="totals">
                                    <td class="total-word">Total Price</td>
                                    <td>{{ $total }} EP</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div  class="method">
                            <div class="text-center">
                                <h4 class="my-3"><i class="fab fa-paypal fa-2x" style="color:blue;"></i> PayPal</h4>
                                <form action="{{ route("cart.checkout") }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Pay With Paypal <i class="fab fa-paypal"></i></button>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-12 py-3 d-flex justify-content-center">
                        <div class="previous-btn py-2 px-3 mx-5">
                            <a class="btn btn-info text-white" id="prev-shipping"><i class="fas fa-arrow-left"></i> Previous</a>
                        </div>
                        <div class="next-btn py-2 px-3 mx-5">
                            <a class="btn btn-info text-white" id="next-finish">Next <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container pt-4">
        <div class="finish" id="finish">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="d-flex justify-content-center">
                            <p class="ask-finish"> Are You Ready to Submit</p>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="previous-btn py-2 px-3 mx-5">
                            <a class="btn btn-info text-white" id="prev-payment"><i class="fas fa-arrow-left"></i> Previous</a>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="finish-btn btn btn-info py-2 px-3">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>

@endsection




@section("footer")
    <script src="/js/mycart.js"></script>
@endsection