@extends('layouts.layout')

@section("head")
@endsection


@section("content")
<div class="chatting">
    <div class="container-fluid parts p-0 m-0 height-100">
        <div class="row height-100">
            <div class="col-12">
                @include("layouts.navbar")
            </div>
            <div class="container my-4 col-12">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <form action="{{ route("request.storeInfo", ["req" => $req->id]) }}" method="POST">
                            @csrf
                            <div class="row">

                            <div class="form-group col-md-6">
                                <label for="fname">First Name:</label>
                                <input class="form-control" type="text" name="fname" id="fname" value="{{ old("fname") }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lname">Last Name:</label>
                                <input class="form-control" type="text" name="lname" id="lname" value="{{ old("lname") }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="governorate">Governorate:</label>
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
                            <div class="form-group col-md-6">
                                <label for="street">Street:</label>
                                <input class="form-control" type="text" name="street" id="street" value="{{ old("street") }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="address">Address:</label>
                                <input class="form-control" type="text" name="address" id="address" value="{{ old("address") }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="house_number">House number:</label>
                                <input class="form-control" type="text" name="house_number" id="house_number" value="{{ old("house_number") }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone1">Phone number #1:</label>
                                <input class="form-control" type="text" name="phone1" id="phone1" value="{{ old("phone1") }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone2">Phone number #2:</label>
                                <input class="form-control" type="text" name="phone2" id="phone2" value="{{ old("phone2") }}">
                            </div>
                            <div class="form-group col-12">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        </form>
                                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section("footer")

@endsection