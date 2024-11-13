@extends('layouts/contentNavbarLayout')

@section('title', 'Topics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
<link rel="stylesheet" href="{{ asset('assets/css/button.css') }}">
@endsection

@section('content')
<div class="create-topic mb-4">
  <div class="text-end">
    <button type="button" class="btn btn-primary btn-m" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">CREATE</button>
  </div>
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
              <label for="topic-title" class="col-form-label">Title:</label>
              <textarea class="form-control" id="topic-title" name="title" placeholder="Let's create a topic!"></textarea>
            </div>
            <div class="mb-3">
              <label for="topic-description" class="col-form-label">Description:</label>
              <textarea class="form-control" id="topic-description" name="description" placeholder="Type your description."></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="community d-flex justify-content-around">
  @foreach($topics as $topic)
  <div class="card" style="width: 18rem; position: relative;">
    <img src="{{ asset('assets/img/backgrounds/graphics.jpg') }}" class="card-img-top" alt="...">
    <a class="btn position-absolute top-0 end-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin: 10px;">
      <i class="mdi mdi-dots-horizontal"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
      <li>
        <form action="{{ route('topics.destroy', $topic->id) }}" method="POST" style="display: inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="dropdown-item text-danger">
            <i class="mdi mdi-trash-can-outline me-2"></i> Delete
          </button>
        </form>
      </li>
    </ul>
    <div class="card-body">
      <h5 class="card-title">{{ $topic->title }}</h5>
      <p class="card-text">{{ $topic->description }}</p>
      <form action="{{ route('topics.join', $topic->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Join</button>
      </form>
    </div>
  </div>
  @endforeach
</div>

@if(session('success'))
  <div class="alert alert-success mt-4">
    {{ session('success') }}
  </div>
@endif
@endsection
