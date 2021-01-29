@extends('layouts.phone')
@section('title')
 | Shipping
@endsection
@section('content')
@include('components.headerphone2')
<section>
    <div class="shipping-wrapper">
        <div class="container lg">
            <div class="shipping-content">
                <h1>Shipping</h1>
                <h2>Shipping within Indonesia (1-3 business days)</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta, perferendis.</p>
                <p>Lorem ipsum dolor sit amet.</p>
                <h2>International Shipping (5-7 business days)</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta, perferendis. Lorem ipsum dolor sit amet consectetur.</p>
                <p>Lorem ipsum dolor sit amet.</p>
                <h2>Local Delivery</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta, perferendis. </p>

                <p>----</p>
                <p>All parcels are shipped with tracking to ensure we get your parcel to you safely.</p>
                <p>We make every effort to ship out all orders on the day they are placed or the next business day although we cannot guarantee this for all orders.</p>
                <p>Please make sure all shipping address details are correct, any typo’s or errors in the shipping details is not our responsibility.</p>
                <p>Thank you</p>
            </div>
        </div>
    </div>
</section>
@include('components.footerphone')
@endsection
	
@section('script')
@endsection