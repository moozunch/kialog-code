@extends('layouts/contentNav barLayout')

@section('title', 'Material Design - Icons')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Icons /</span> Material Design Icons
</h4>

<p>You can check complete list of Material Design icons from <a href="https://pictogrammers.com/library/mdi/" target="_blank">https://pictogrammers.com/library/mdi/</a></p>

<!-- Icon Container -->
<div class="d-flex flex-wrap" id="icons-container">
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-ab-testing mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">ab-testing</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-abacus mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">abacus</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-abjad-arabic mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">abjad-arabic</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-abjad-hebrew mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">abjad-hebrew</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-abugida-devanagari mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">abugida-devanagari</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-abugida-thai mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">abugida-thai</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-access-point mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">access-point</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-access-point-check mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">access-point-check</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-access-point-minus mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">access-point-minus</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-access-point-network mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">access-point-network</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-access-point-network-off mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">access-point-network-off</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-access-point-off mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">access-point-off</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-access-point-plus mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">access-point-plus</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-access-point-remove mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">access-point-remove</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-account mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">account</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-account-alert mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">account-alert</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-account-alert-outline mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">account-alert-outline</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-account-arrow-down mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">account-arrow-down</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-account-cog-outline mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">account-cog-outline</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-account-convert-outline mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">account-convert-outline</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-adjust mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">adjust</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-advertisements mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">advertisements</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-air-conditioner mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">air-conditioner</p>
    </div>
  </div>
  <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
    <div class="card-body">
      <i class="mdi mdi-air-filter mdi-36px"></i>
      <p class="icon-name text-capitalize text-truncate mb-0 mt-2">air-filter</p>
    </div>
  </div>
</div>

<!-- Buttons -->
<div class="d-flex justify-content-center mx-auto gap-3">
  <a href="https://pictogrammers.com/library/mdi/" target="_blank" class="btn btn-primary">View All Icons</a>
  <a href="{{config('variables.documentation')}}/Icons.html" class="btn btn-primary" target="_blank">How to use icons?</a>
</div>
@endsection
