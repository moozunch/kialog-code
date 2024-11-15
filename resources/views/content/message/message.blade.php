@extends('layouts/contentNavbarLayout')

@section('title', 'Messages')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/message.css') }}">
@endsection

@section('content')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet" />

  <div class="container">
    <div class="messaging">
      <div class="inbox_msg">

        <!-- Left Sidebar: List of Conversations -->
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Recent</h4>
            </div>
            <div class="srch_bar">
              <div class="stylish-input-group">
                <input type="text" class="search-bar" placeholder="Search">
                <span class="input-group-addon">
                  <button type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                </span>
              </div>
            </div>
          </div>

          <div class="inbox_chat">
            <!-- Iterate over each conversation -->
            @foreach($conversations as $conversation)
              @php
                // Determine the other user in the conversation
                $otherUser = $conversation->user_one == Auth::id() ? $conversation->userTwo : $conversation->userOne;
              @endphp
              @if($otherUser)
                <a href="{{ route('chat', $otherUser->id) }}">
                  <div class="chat_list {{ $conversation->id == $conversation->id ? 'active_chat' : '' }}">
                    <div class="chat_people">
                      <div class="chat_img"><img src="https://ptetutorials.com/images/user-profile.png" alt="user"></div>
                      <div class="chat_ib">
                        <h5>{{ $otherUser->username }}
                          <span class="chat_date">{{ $conversation->updated_at->format('M d') }}</span>
                        </h5>
                        <p>Last message preview...</p>
                      </div>
                    </div>
                  </div>
                </a>
              @endif
            @endforeach
          </div>
        </div>

        <!-- Right Side: Messages for Selected Conversation -->
        <div class="mesgs">
          <div class="msg_history">
            <!-- Display messages dynamically here -->
            @foreach($conversation->messages as $message)
              @if($message->sender_id == Auth::id())
                <!-- Outgoing message -->
                <div class="outgoing_msg">
                  <div class="sent_msg">
                    <p>{{ $message->content }}</p>
                    <span class="time_date">{{ $message->created_at->format('h:i A | M d') }}</span>
                  </div>
                </div>
              @else
                <!-- Incoming message -->
                <div class="incoming_msg">
                  <div class="incoming_msg_img"><img src="/path/to/user-image.jpg" alt="user"></div>
                  <div class="received_msg">
                    <div class="received_withd_msg">
                      <p>{{ $message->content }}</p>
                      <span class="time_date">{{ $message->created_at->format('h:i A | M d') }}</span>
                    </div>
                  </div>
                </div>
              @endif
            @endforeach
          </div>

          <!-- Message Input Area -->
          <div class="type_msg">
            <div class="input_msg_write">
              <form action="{{ route('messages.send') }}" method="POST" id="sendMessageForm">
                @csrf
                <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                {{--TODO: kenapa masih null terus woii--}}
                <input type="text" class="write_msg" name="content" placeholder="Type a message" required>
                <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pusher and JavaScript for Real-time Messages -->
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script>
    Pusher.logToConsole = true;

    const pusher = new Pusher("{{ config('broadcasting.connections.pusher.key') }}", {
      cluster: "{{ config('broadcasting.connections.pusher.options.cluster') }}",
      encrypted: true
    });

    const channel = pusher.subscribe('chat.{{ $conversation->id }}');

    channel.bind('App\\Events\\MessageSent', function(data) {
      const message = data.message;
      const currentUser = {{ Auth::id() }};

      // Log to verify message data
      console.log("Received message:", message);

      // Ensure message content is defined
      const messageContent = message.content ? message.content : "Message content missing";

      const messageHtml = message.sender_id === currentUser ?
        `<div class="outgoing_msg">
       <div class="sent_msg">
         <p>${messageContent}</p>
         <span class="time_date">${message.created_at}</span>
       </div>
     </div>` :
        `<div class="incoming_msg">
       <div class="incoming_msg_img"><img src="/path/to/user-image.jpg" alt="user"></div>
       <div class="received_msg">
         <div class="received_withd_msg">
           <p>${messageContent}</p>
           <span class="time_date">${message.created_at}</span>
         </div>
       </div>
     </div>`;

      document.querySelector('.msg_history').innerHTML += messageHtml;
    });
  </script>
  <script>
    document.getElementById('sendMessageForm').addEventListener('submit', function(event) {
      event.preventDefault(); // prevent default form submission

      const formData = new FormData(this);

      fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      })
        .then(response => response.json())
        .then(data => {
          console.log("Message sent successfully:", data);

          // Update the message history with the new message
          const messageHtml = `<div class="outgoing_msg">
        <div class="sent_msg">
          <p>${data.message.content}</p>
          <span class="time_date">${new Date(data.message.created_at).toLocaleString()}</span>
        </div>
      </div>`;

          document.querySelector('.msg_history').innerHTML += messageHtml;

          // Clear the input field after sending
          document.querySelector('.write_msg').value = '';
        })
        .catch(error => {
          console.error("Error sending message:", error);
          alert("There was an error sending your message. Please try again.");
        });
    });

  </script>

@endsection
