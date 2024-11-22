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
                <input type="text" class="search-bar" placeholder="Search" id="message-search-bar">
                <span class="input-group-addon">
                  <button type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                </span>
              </div>
            </div>
          </div>

          <div class="inbox_chat">
            <!-- Iterate over each conversation -->
            @foreach($conversations as $conv)
              @php
                $otherUser = $conv->user_one == Auth::id() ? $conv->userTwo : $conv->userOne;
                $latestMessage = $conv->messages->last();
              @endphp
              @if($otherUser)
                <a href="{{ route('chat', $otherUser->id) }}">
                  <div class="chat_list {{ isset($conversation) && $conv->id == $conversation->id ? 'active_chat' : '' }}">
                    <div class="chat_people">
                      <div class="chat_img"><img src="{{ $otherUser->profile_image ?? asset('assets/img/avatars/1.png') }}" alt="user" class="rounded-circle"></div>
                      <div class="chat_ib">
                        <h5>{{ $otherUser->username }}
                          @if($latestMessage)
                            <span class="chat_date">{{ $latestMessage->created_at->setTimezone('Asia/Jakarta')->format('h:i A | M d') }}</span>
                          @endif
                        </h5>
                        <p>{{ $latestMessage ? $latestMessage->content : 'No messages yet' }}</p>
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
            @if(isset($conversation) && $conversation->messages->isNotEmpty())
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
                    <div class="incoming_msg_img"><img src="{{ $otherUser->profile_image ?? asset('assets/img/avatars/1.png') }}" alt="user" class="rounded-circle"></div>
                    <div class="received_msg">
                      <div class="received_withd_msg">
                        <p>{{ $message->content }}</p>
                        <span class="time_date">{{ $message->created_at->format('h:i A | M d') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
              @endforeach
            @else
              <p class="no-messages-text">No messages to display.</p>
              <img src="{{ asset('assets/svg/chatillust.svg') }}" alt="Chat Illustration" class="chat-illustration no-messages-illustration">
            @endif
          </div>

          <!-- Message Input Area -->
          <div class="type_msg {{ isset($conversation) && $conversation->messages->isNotEmpty() ? '' : 'no-messages' }}">
            <div class="input_msg_write">
              @if(isset($conversation))
                <form action="{{ route('messages.send') }}" method="POST" id="sendMessageForm">
                  @csrf
                  <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                  <input type="text" class="write_msg" name="content" placeholder="Type a message" required>
                  <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                </form>
              @else
                <p>Select a profile and start messaging.</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pusher and JavaScript for Real-time Messages -->
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script>
    const msgHistory = document.querySelector('.msg_history');

    function scrollToBottom() {
      msgHistory.scrollTop = msgHistory.scrollHeight;
    }

    // Scroll to bottom on page load
    document.addEventListener('DOMContentLoaded', scrollToBottom);

    // Scroll to bottom when a new message is added
    const pusher = new Pusher("{{ config('broadcasting.connections.pusher.key') }}", {
      cluster: "{{ config('broadcasting.connections.pusher.options.cluster') }}",
      encrypted: true
    });

    @if(isset($conversation))
    const channel = pusher.subscribe('chat.{{ $conversation->id }}');

    channel.bind('App\\Events\\MessageSent', function(data) {
      const message = data.message;
      const currentUser = {{ Auth::id() }};

      const messageContent = message.content ? message.content : "Message content missing";
      const formattedDate = new Date(message.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric' });

      const messageHtml = message.sender_id === currentUser ?
        `<div class="outgoing_msg">
            <div class="sent_msg">
              <p>${messageContent}</p>
              <span class="time_date">${formattedDate}</span>
            </div>
          </div>` :
        `<div class="incoming_msg">
            <div class="incoming_msg_img"><img src="/path/to/user-image.jpg" alt="user"></div>
            <div class="received_msg">
              <div class="received_withd_msg">
                <p>${messageContent}</p>
                <span class="time_date">${formattedDate}</span>
              </div>
            </div>
          </div>`;

      document.querySelector('.msg_history').innerHTML += messageHtml;

      // Scroll to the bottom after adding the new message
      scrollToBottom();
    });

    document.getElementById('sendMessageForm').addEventListener('submit', function(event) {
      event.preventDefault();

      const formData = new FormData(this);

      fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      })
        .then(data => {
          console.log("Message sent successfully:", data);

          document.querySelector('.write_msg').value = '';

          scrollToBottom();
        })
        .catch(error => {
          console.error("Error sending message:", error);
          alert(error.message);
        });
    });
    @endif
  </script>
{{--Search Users in navbar--}}
  <script>
    document.getElementById('search-bar').addEventListener('input', function(event) {
      const query = event.target.value;

      if (query.length > 2) {
        fetch(`/search-users?query=${query}`)
          .then(response => response.json())
          .then(users => {
            const searchResultsContainer = document.querySelector('.inbox_chat');
            searchResultsContainer.innerHTML = '';

            users.forEach(user => {
              const userHtml = `
            <a href="/chat/${user.id}">
              <div class="chat_list">
                <div class="chat_people">
                  <div class="chat_img"><img src="${user.profile_image || '/assets/img/avatars/1.png'}" alt="user" class="rounded-circle"></div>
                  <div class="chat_ib">
                    <h5>${user.username}</h5>
                  </div>
                </div>
              </div>
            </a>
          `;
              searchResultsContainer.innerHTML += userHtml;
            });
          })
          .catch(error => console.error('Error fetching search results:', error));
      } else {
        fetch('/conversations')
          .then(response => response.json())
          .then(conversations => {
            const searchResultsContainer = document.querySelector('.inbox_chat');
            searchResultsContainer.innerHTML = '';

            conversations.forEach(conversation => {
              const conversationHtml = `
            <a href="/chat/${conversation.user.id}">
              <div class="chat_list">
                <div class="chat_people">
                  <div class="chat_img"><img src="${conversation.user.profile_image || '/assets/img/avatars/1.png'}" alt="user" class="rounded-circle"></div>
                  <div class="chat_ib">
                    <h5>${conversation.user.username}
                      ${conversation.latest_message_time ? `<span class="chat_date">${conversation.latest_message_time}</span>` : ''}
                    </h5>
                    <p>${conversation.latest_message}</p>
                  </div>
                </div>
              </div>
            </a>
          `;
              searchResultsContainer.innerHTML += conversationHtml;
            });
          })
          .catch(error => console.error('Error fetching conversations:', error));
      }
    });
  </script>
  <script>
    document.getElementById('message-search-bar').addEventListener('input', function(event) {
      const query = event.target.value;

      if (query.length > 2) {
        fetch(`/search-users?query=${query}`)
          .then(response => response.json())
          .then(users => {
            const searchResultsContainer = document.querySelector('.inbox_chat');
            searchResultsContainer.innerHTML = '';

            users.forEach(user => {
              const userHtml = `
            <a href="/chat/${user.id}">
              <div class="chat_list">
                <div class="chat_people">
                  <div class="chat_img"><img src="${user.profile_image || '/assets/img/avatars/1.png'}" alt="user" class="rounded-circle"></div>
                  <div class="chat_ib">
                    <h5>${user.username}</h5>
                  </div>
                </div>
              </div>
            </a>
          `;
              searchResultsContainer.innerHTML += userHtml;
            });
          })
          .catch(error => console.error('Error fetching search results:', error));
      } else {
        fetch('/conversations')
          .then(response => response.json())
          .then(conversations => {
            const searchResultsContainer = document.querySelector('.inbox_chat');
            searchResultsContainer.innerHTML = '';

            conversations.forEach(conversation => {
              const conversationHtml = `
            <a href="/chat/${conversation.user.id}">
              <div class="chat_list">
                <div class="chat_people">
                  <div class="chat_img"><img src="${conversation.user.profile_image || '/assets/img/avatars/1.png'}" alt="user" class="rounded-circle"></div>
                  <div class="chat_ib">
                    <h5>${conversation.user.username}
                      ${conversation.latest_message_time ? `<span class="chat_date">${conversation.latest_message_time}</span>` : ''}
                    </h5>
                    <p>${conversation.latest_message}</p>
                  </div>
                </div>
              </div>
            </a>
          `;
              searchResultsContainer.innerHTML += conversationHtml;
            });
          })
          .catch(error => console.error('Error fetching conversations:', error));
      }
    });
  </script>

@endsection