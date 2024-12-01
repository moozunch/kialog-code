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

<div class="community row g-4">
  @foreach($topics as $topic)
  <div class="col-sm-6 col-md-4 col-lg-3">
    <div class="card h-100" style="position: relative;">
      <img src="{{ asset('assets/img/backgrounds/graphics.jpg') }}" class="card-img-top" alt="...">
      @if(auth()->id() === $topic->user_id)
      <a class="btn position-absolute top-0 end-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin: 10px;">
        <i class="mdi mdi-dots-horizontal"></i>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <form action="{{ route('topics.destroy', $topic->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal" data-topic-id="{{ $topic->id }}" data-topic-title="{{ $topic->title }}">
              <i class="mdi mdi-trash-can-outline me-2"></i> Delete
            </button>
          </form>
        </li>
      </ul>
      @endif
      <div class="card-body d-flex flex-column">
        <h5 class="card-title">{{ $topic->title }}</h5>
        <p class="card-text">{{ $topic->description }}</p>
        @if(!$topic->users->contains(auth()->id()))
        <button type="button" class="btn btn-primary mt-auto w-50" data-bs-toggle="modal" data-bs-target="#joinConfirmationModal" data-topic-id="{{ $topic->id }}" data-topic-title="{{ $topic->title }}">JOIN</button>
        @else
        <a href="{{ route('topics.show', $topic->id) }}" class="btn btn-primary mt-auto w-50">OPEN</a>
        @endif
      </div>
    </div>
  </div>
  @endforeach
</div>

@foreach($topics as $topic)
<!-- Modal for joining a community -->
<div class="modal fade" id="joinConfirmationModal" tabindex="-1" aria-labelledby="joinConfirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-bottom text-center p-3">
        <h5 class="modal-title fw-medium" id="joinConfirmationModalLabel">Join Community</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body border-bottom p-3">
        Are you sure you want to join the <span id="communityTitle"></span> community?
      </div>
      <div class="modal-footer text-center p-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="joinForm" action="" method="POST">
          @csrf
          <button type="submit" class="btn btn-primary">Yes, Join</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-bottom text-center p-3">
        <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body border-bottom p-3">
        Are you sure you want to delete the <span id="deleteCommunityTitle"></span> community?
      </div>
      <div class="modal-footer text-center p-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Yes, Delete</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
  var joinConfirmationModal = document.getElementById('joinConfirmationModal');
  var communityTitle = document.getElementById('communityTitle');
  var joinForm = document.getElementById('joinForm');

  joinConfirmationModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var topicId = button.getAttribute('data-topic-id'); // Extract info from data-* attributes
    var topicTitle = button.getAttribute('data-topic-title'); // Get the topic title

    communityTitle.textContent = topicTitle; // Set the community title
    joinForm.action = '/topics/' + topicId + '/join'; // Update the form action
  });

  var deleteConfirmationModal = document.getElementById('deleteConfirmationModal');
    var confirmDeleteButton = document.getElementById('confirmDeleteButton');
    var deleteCommunityTitle = document.getElementById('deleteCommunityTitle');
    var formToSubmit;

    deleteConfirmationModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget; // Button that triggered the modal
      var topicId = button.getAttribute('data-topic-id'); // Extract info from data-* attributes
      var topicTitle = button.getAttribute('data-topic-title'); // Get the topic title
      deleteCommunityTitle.textContent = topicTitle; // Set the community title
      formToSubmit = button.closest('form'); // Get the form to submit
    });

    confirmDeleteButton.addEventListener('click', function () {
      if (formToSubmit) {
        formToSubmit.submit();
      }
    });
});
</script>
@endsection
