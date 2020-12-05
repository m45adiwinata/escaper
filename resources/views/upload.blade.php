@extends('layouts.main')

@section('content')
@include('components.header2')
<div class="about">
	<div class="container " style="background-image: asset('images/images1.jpg');">
        <p class="mb-4" style="color:black;">Please upload your payment/transfer proof</p>
        <form action="/cart/post-upload" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$checkout->id}}">
            <input type="file" class="btn" id="imgInp" name="file" />
            <br>
            <img id="preview"></img>
            <br>
            <button type="submit" class="btn">Submit</button>
        </form>
    </div>
</div>
@include('components.footer')
@endsection

@section('script')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
    });
</script>
@endsection