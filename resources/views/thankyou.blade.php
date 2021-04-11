@extends('layouts.frontend.app')
@section('content')
<div class="ps-404 bg--cover">
    <div class="ps-404__content">
        <h1>Thank you</h1>
        <h3>Your Order is Confirmed</h3>
        <p>Your will soon contact you.</p>
        <a class="ps-btn" href="{{ route('home') }}">Back to home<i class="ps-icon-next"></i></a>
    </div>
</div>
@endsection
