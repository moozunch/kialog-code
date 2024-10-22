@extends('layouts/contentNavbarLayout')

@section('title', 'Topic')

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
<div class="create-topic mb-4">
  <button type="button" class="btn btn-primary btn-m" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">CREATE</button>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">CREATE TOPIC</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('topics.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Title: </label>
              <textarea class="form-control" id="topic-title" name="title" placeholder="Let's create a topic!"></textarea>
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Description: </label>
              <textarea class="form-control" id="topic-description" name="description" placeholder="Type your description."></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
          </form>
        </div>
      </div>h
    </div>
  </div>
</div>
<div class="community d-flex justify-content-around">
@foreach($topics as $topic)
  <div class="card" style="width: 18rem;">
    <img src="{{ asset('assets/img/backgrounds/graphics.jpg') }}" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{ $topic->title }}</h5>
      <p class="card-text">{{ $topic->description }}</p>
      <a href="#" class="btn btn-primary">JOIN</a>
    </div>
  </div>
@endforeach
</div>
@endsection
