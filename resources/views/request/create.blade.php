@extends("layouts.layout")

@section("head")
<link rel="stylesheet" href="/css/design.css">
@endsection


@section("content")
<div class="design-page">
    <div class="container-fluid p-0 m-0 height-100">
        <div class="row height-100">
            <div class="col-12">
                {{-- ============= Navbar ============= --}}
                @include("layouts.navbar")
            </div>
            <div class="col-6 height-100">
                <div class="container height-100 pt-3 pb-5">
                    <div class="special-design-image height-100">
                        <div class="container height-100">
                            <div class="image d-flex justify-content-center height-100">
                                <img class="img-fluid big-image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 height-99 scroll mb-5 pb-5" style="margin-left: -15px;">
                <form action="{{ route("request.store") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="choices w-100 d-flex flex-column justify-content-center text-center height-100">
                        <div class="request-type py-4">
                            <p> Choose the request type please</p>
                            <div class="type-choices text-left pb-3">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <label>Upload Request Photo</label>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <span class="btn btn-default btn-file">
                                                            Browse <input type="file" id="imgInp" name="image">
                                                        </span>
                                                    </span>
                                                    <input type="text" class="m-0 form-control" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="finish-noupload-inputs form-group text-left p-0 m-0 w-100">
                            <div class="container reqest-informatiom py-3 px-2">
                                    <div class="row">
                                        <div class="col-6 p-2 mb-1">
                                            <label for="goernorate2">Governorate:</label>
                                            <select class="custom-select" name="governorate" id="governorate2" required>
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
                                        <div class="col-6 p-2 mb-1">
                                            <div class="address">
                                                <label for="req-cust-address2">Addresss:</label>
                                                <input class="form-control" value="{{ old("address") }}" name="address" type="text" id="req-cust-address2" placeholder="Address">
                                            </div>
                                        </div>
                                        <div class="col-6 p-2 mb-1">
                                            <div class="address">
                                                <label for="req-cust-address2">street:</label>
                                                <input class="form-control" value="{{ old("street") }}" name="street" type="text" placeholder="street">
                                            </div>
                                        </div>
                                        <div class="col-6 p-2 mb-1">
                                            <div class="tel-num">
                                                <label for="req-cust-tel2">Telephone Number #1</label>
                                                <input class="form-control" value="{{ old("phone1") }}" name="phone1" type="tel" id="req-cust-tel2" placeholder="Telephone Number">
                                            </div>
                                        </div>
                                        <div class="col-6 p-2 mb-1">
                                            <div class="tel-num">
                                                <label for="req-cust-tel2">Telephone Number #2</label>
                                                <input class="form-control" value="{{ old("phone2") }}" name="phone2" type="tel" id="req-cust-tel2" placeholder="Telephone Number 2">
                                            </div>
                                        </div>
                                        <div class="col-12"></div>
                                        <div class="col-6 p-2 mb-1">
                                            <div class="tel-num">
                                                <label>Color</label>
                                                <input type="color" value="{{ old("color") }}" name="color" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6 p-2 mb-1">
                                            <div class="tel-num">
                                                <label>Color Name</label>
                                                <input type="text" value="{{ old("color_name") }}" name="color_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 p-2 mb-1">
                                            <div class="req-description">
                                                <label for="desc2">Description:</label>
                                                <textarea class="form-control" name="description" id="desc2" placeholder="Description" required>{{ old("description") }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 p-2 mb-1">
                                            <div class="req-description">
                                                <label for="desc2">Designer:</label>
                                                <select name="designer_id">
                                                    <option value="">-- Choose Designer --</option>
                                                    @foreach($designers as $d)
                                                    <option @if(old("designer_id") == $d->id) selected @endif value="{{ $d->id }}">{{ $d->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div>
                                                <label for="shipping-1">
                                                    <input type="radio" id="shipping-1" name="shipping" value="1"> One Day
                                                </label>
                                            </div>
                                            <div>
                                                <label for="shipping-3">
                                                    <input type="radio" id="shipping-3" name="shipping" value="3"> Three Days
                                                </label>
                                            </div>
                                            <div>
                                                <label for="shipping-7">
                                                    <input type="radio" id="shipping-7" name="shipping" value="7"> One Week
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 py-1 d-flex justify-content-center">
                                            <div class="prev-btn bottom-btn py-2 px-3 mx-2">
                                                <a class="btn btn-info text-white" id="prev-choice-types5"><i class="fas fa-arrow-left"></i> Previous</a>
                                            </div>
                                            <div class="send-btn py-2 px-3 mx-2">
                                                <button type="submit" class="btn btn-info text-white"><i class="fas fa-share-square text-white"></i> Send Request</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal 1 -->
<div class="modal answer-modal w-100 fade" id="send-request" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg w-100 m-auto" role="document">
        <div class="modal-content p-5">  
            <div id="close" data-dismiss="modal"><i class="fa fa-2x fa-window-close"></i></div>
            <div class="d-flex justify-content-center">
                <h3>Choose Designers To Send The Request to Them</h3>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="designer-choices d-flex justify-content-center align-items-center flex-column my-2 p-2">
                            <div class="row des">
                                <div class="col-3">
                                    <div class="designer">
                                        <div class="image">
                                            <img class="img-fluid" src="images/chatting/12.jpg">
                                        </div>
                                        <div class="designer-name d-inline">
                                            <p>Hanna Hassan</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-5 d-flex justify-content-end align-items-center float-right buttn ">
                                    <div class="butn float-right">
                                        <button class="btn btn-info mr-3"><i class="fas fa-share-square text-white"></i> Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="fin-btn d-flex justify-content-center">
                            <button data-dismiss="modal" class="btn btn-primary mr-3">Finish</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("removeFooter")
@endsection

@section("footer")
    <script src="/js/design.js"></script>
@endsection