@extends('layouts.phone')
@section('content')
@include('components.headerphone')
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
                    <form action="" class="contact">
                        <input type="text" class="contact-name" placeholder="NAME" required>
                        <input type="email" class="contact-email" placeholder="EMAIL" required>
                        <input type="number" pattern="[0-9]" class="contact-phone" placeholder="PHONE">
                        <textarea rows="15" name="comment" id="" placeholder="COMMENT"></textarea>
                        <button type="submit" class="btn-contact">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="contact-info">
            <p>For inquiries regarding online orders please contact us at :</p>
            <p>E-mail : <a href="">{{$contact->email}}</a></p>
            <p>Instagram : <a href="">{{$contact->instagram}}</a></p>
        </div>
        </div>
    </div>
</section>
@include('components.footerphone')
@endsection