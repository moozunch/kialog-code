@extends('layouts/contentNavbarLayout')

@section('title', 'Topic')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
<link rel="stylesheet" href="{{ asset('assets/css/displayposts.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/button.css') }}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')

  @foreach($bookmarks as $bookmark)
  <div class="card mt-2">
    @if($bookmark->image)
        <img src="{{ asset('storage/' . $bookmark->image) }}" class="card-img-top" alt="Post Image">
      @endif
    <div class="card-body">
      <div class="row mb-2 align-items-center">
        <div class="col-1" >
          <a href="{{ route('profile.show', ['id' => $bookmark->user->id]) }}">
          <img src="{{ $bookmark->user->profile_image ? $bookmark->user->profile_image : asset('assets/img/avatars/1.png') }}"  alt="Profile Picture" class="rounded-circle" width="50px">
        </div>
        <div class="col">
          <h5 class="card-title">{{ $bookmark->user->name }}</h5>
        </div>
      </div>
      <div class="row">
        <h6 class="card-title text-muted">{{ $bookmark->post->user->username }}</h6>
      </div>
      <p class="card-text">{{ $bookmark->post->message }}</p>
    </div>
    <div class="card-footer d-flex justify-content-between align-items-center">
      <small class="text-muted">Posted on {{ $bookmark->post->created_at->format('F j, Y') }}</small>
      <div>
        <form action="{{ route('posts.like', $bookmark->post->id) }}" method="POST" style="display: inline;">
          @csrf
          <button type="submit" class="btn btn-like btn-no-bg btn-light btn-sm">
            @if($bookmark->post->userLikes && !$bookmark->post->userLikes->isEmpty())
              <i class="mdi mdi-cards-heart text-danger"></i>
            @else
              <i class="mdi mdi-cards-heart-outline"></i>
            @endif
            {{ $bookmark -> post-> userLikes->count() }}
          </button>
        </form>
        <button class="btn btn-comment btn-no-bg btn-light btn-sm"><i class="mdi mdi-chat-outline"></i> {{ $bookmark -> post ->comments }}</button>
        <form action="{{ route('bookmarks.store', $bookmark->post->id) }}" method="POST" style="display: inline;">
          @csrf
          <button type="submit" class="btn btn-bookmark btn-no-bg btn-light btn-sm">
            @if($bookmark-> post ->bookmarks && !$bookmark -> post ->bookmarks->isEmpty())
              <i class="mdi mdi-bookmark text-primary"></i>
            @else
              <i class="mdi mdi-bookmark-outline"></i>
            @endif
          </button>
        </form>
        <button class="btn btn-no-bg btn-share btn-light btn-sm"><i class="mdi mdi-share-outline"></i></button>
      </div>
    </div>
  </div>
  @endforeach
@endsection
