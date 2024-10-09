@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="community d-flex justify-content-around">
  <div class="card" style="width: 18rem;">
    <img src="{{ asset('assets/img/backgrounds/graphics.jpg') }}" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">TI'23</h5>
      <p class="card-text">ytiti (yang ti ti aja)</p>
      <a href="#" class="btn btn-primary">JOIN</a>
    </div>
  </div>
  <div class="card" style="width: 18rem;">
    <img src="{{ asset('assets/img/backgrounds/graphics2.jpg') }}" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Compscie'23</h5>
      <p class="card-text">yang merasa anak compscie join sini</p>
      <a href="#" class="btn btn-primary">JOIN</a>
    </div>
  </div>
</div>
@endsection
