@if(!View::hasSection('removeFooter'))
<footer class="footer-area">
    <div class="col-md-12">
    <div class="footer-social-icon">
        <ul>
            <li><a href="#"><i class="fab fa-facebook"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            <li><a href="#"><i class="fab fa-google"></i></a></li>

        </ul>
    </div>
    <p class="copy-right">Copy Right 2020 &copy; By <a href="#">Vetrova</a> All Rights Reserved</p>
    </div>
</footer>
@endif



@auth
@php
    $user = Auth::user();
@endphp
<!--//////////////////////settings modal////////////////////////////////-->
<div class="modal settings-modal w-100 fade" id="settings" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg w-100 m-auto" role="document">
        <div class="modal-content p-5">
            <div id="close" data-dismiss="modal"><i class="fas fa-times fa-2x"></i></div>
            <div class="d-flex justify-content-center">
                <h3>Settings</h3>
            </div>
            <div class="container">
                <form action="{{ route("settings") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <lable>Profile Image</lable>
                            <div class="container">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Upload Profile Image</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <span class="btn btn-default btn-file">
                                                    Browse <input type="file" id="imgInp" name="image">
                                                </span>
                                            </span>
                                            <input type="text" class="form-control" readonly>
                                        </div>
                                        <div class="image-show">
                                            <img class="img-fluid" id='img-upload' src="{{ $user->profile_pic }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-3">
                            <label for="fname">First Name:</label>
                            <input class="form-control" type="text" id="fname" placeholder="First Name" name="fname"
                                value="{{ $user->fname }}">
                        </div>
                        <div class="col-md-6 p-3">
                            <label for="lname">Last Name:</label>
                            <input class="form-control" type="text" id="lname" placeholder="First Name" name="lname"
                                value="{{ $user->lname }}">
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary saveChangesBtn">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif


<script src="/js/all.js"></script>
{{-- <script src="/js/jquery-3.4.1.js"></script> --}}
<script src="/js/app.js"></script>
<script src="/js/jquery.easing.1.3.js"></script>
<script src="/js/jquery.skitter.js"></script>
<script src="/js/owl.carousel.min.js"></script>
<script src="/js/wow.min.js"></script>
<script src="/js/fabric.min.js"></script>
<script src="/js/jquery.drawsvg.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/bootstrap-notify.min.js"></script>
<script>
    //Click event to scroll to top
    $('.upButton').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });
</script>


@if(Session::has("success"))
    {{-- <script>
        notie.alert({
            type: 'success',
            text: "{{ Session::get('success') }}",
            stay: true, // optional, default = false
            // time: Number, // optional, default = 3, minimum = 1,
            // position: String // optional, default = 'top', enum: ['top', 'bottom']
        })
    </script> --}}
    
    <script>
        $.notify({
            // options
            icon: 'glyphicon glyphicon-warning-sign',
            title: '<h4>Congratulation 🤩</h4>',
            message: '<br>{{ Session::get("success") }}',
            target: '_blank'
        },{
            // settings
            element: 'body',
            position: null,
            type: "success",
            allow_dismiss: true,
            newest_on_top: false,
            showProgressbar: false,
            placement: {
                from: "bottom",
                align: "left"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 5000,
            timer: 1000,
            url_target: '_blank',
            mouse_over: null,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
        });
    </script>

@endif


@if($errors->any())
<script>
    
    let text = "<ul>";

    @foreach($errors->all() as $e)
        text += "<li>{{ $e }}</li>"
    @endforeach
    
    text += "</ul>"

    $.notify({
            // options
            icon: 'glyphicon glyphicon-warning-sign',
            title: '<h4>Oops!!</h4>',
            message: text,
            target: '_blank'
        },{
            // settings
            element: 'body',
            position: null,
            type: "danger",
            allow_dismiss: true,
            newest_on_top: false,
            showProgressbar: false,
            placement: {
                from: "bottom",
                align: "left"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 5000,
            timer: 1000,
            url_target: '_blank',
            mouse_over: null,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
        });
</script>
@endif


@auth
@if(in_array(Auth::user()->type, ["customer", "designer"]) && !request()->is("/chat*"))
<script>
    
    // ======== Listen To Events ========

        Echo.private('chat.{{ Auth::id() }}')
        .listen('.message.sent', (e) => {
            
            console.log(e);
            

            $.notify({
            // options
            icon: 'glyphicon glyphicon-warning-sign',
            title: `<h6>${e.user.fname + " " + e.user.lname}</h6>`,
            message: `<span style="max-width: 300px">${e.message.msg}...</span>`,
            url: `{{ url("/chat") }}/${e.request.id}`,
        },{
            // settings
            element: 'body',
            position: null,
            type: "info",
            allow_dismiss: true,
            newest_on_top: false,
            showProgressbar: false,
            placement: {
                from: "bottom",
                align: "left"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 5000,
            timer: 1000,
            url_target: '_blank',
            mouse_over: null,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
        });

        });    
            
        

</script>
@endif
@endif