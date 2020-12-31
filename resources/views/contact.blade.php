@extends('layouts.phone')
@section('content')
@include('components.headerphone2')
<br>
<section>
    <div class="container-lg">
        <div class="contact-wrapper">
            <div class="row">
                <div class="col-md-6">
                    <div class="map">
                        <iframe src="{{$contact->link}}" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
                        <form action="/contact/send-comment" method="POST" class="contact">
                            @csrf
                            <input type="text" name="name" id="name" class="contact-name" placeholder="NAME*" required>
                            <input type="email" name="email" id="email" class="contact-email" placeholder="EMAIL*" required>
                            <input type="number" name="phone" id="phone" pattern="[0-9]" class="contact-phone" placeholder="PHONE">
                            <textarea name="comment" rows="15" name="comment" id="comment" placeholder="COMMENT"></textarea>
                            <span style="font-size:10px;">*Required</span>
                            <button type="submit" id="submit" class="btn-contact" style="background:grey; border:grey;" disabled>SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="contact-info">
                <p style="font-weight:bold;">OPENING HOURS</p>
                <p>Everyday : 10 AM - 10 PM</p>
                <p style="font-weight:bold;">
                    MORE INFORMATION : 
                    <a href="{{$contact->facebook}}" class="p-2"><span class="fab fa-facebook"></span></a>
                    <a href="{{$contact->instagram}}" class="p-2"><span class="fab fa-instagram"></span></a>
                    <a href="{{$contact->whatsapp}}" class="p-2"><span class="fab fa-whatsapp"></span></a>
                </p>
            </div>
        </div>
    </div>
</section>
@include('components.footerphone')
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#name').change(function() {
            if($('#name').val() != '' && $('#email').val() != '' && $('#comment').val() != '') {
                $('#submit').removeAttr('disabled');
                $('#submit').css('background', 'black');
                $('#submit').css('border', 'black');
            }
            else {
                $('#submit').attr('disabled', 'disabled');
                $('#submit').css('background', 'grey');
                $('#submit').css('border', 'grey');
            }
        });
        $('#email').change(function() {
            if($('#name').val() != '' && $('#email').val() != '' && $('#comment').val() != '') {
                $('#submit').removeAttr('disabled');
                $('#submit').css('background', 'black');
                $('#submit').css('border', 'black');
            }
            else {
                $('#submit').attr('disabled', 'disabled');
                $('#submit').css('background', 'grey');
                $('#submit').css('border', 'grey');
            }
        });
        $('#comment').bind('input propertychange', function() {
            if($('#name').val() != '' && $('#email').val() != '' && $('#comment').val() != '') {
                $('#submit').removeAttr('disabled');
                $('#submit').css('background', 'black');
                $('#submit').css('border', 'black');
            }
            else {
                $('#submit').attr('disabled', 'disabled');
                $('#submit').css('background', 'grey');
                $('#submit').css('border', 'grey');
            }
        });
    });
</script>
@endsection