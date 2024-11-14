@extends('layouts/contentNavbarLayout')

@section('title', 'Message')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/message.css') }}">
@endsection

{{-- @section('vendor-script')
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection --}}

@section('page-script')
<script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
@endsection

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet" />

<div class="container">
    <div class="messaging">
        <div class="inbox_msg">
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
                    <div class="chat_list active_chat">
                        <div class="chat_people">
                            <div class="chat_img"><img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"></div>
                            <div class="chat_ib">
                                <h5>Alfathan <span class="chat_date">Today</span></h5>
                                <p>Test, which is a new approach to have all solutions astrology under one roof.</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat_list">
                        <div class="chat_people">
                            <div class="chat_img"><img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"></div>
                            <div class="chat_ib">
                                <h5>Annisa <span class="chat_date">Nov 2</span></h5>
                                <p>Test, which is a new approach to have all solutions astrology under one roof.</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat_list">
                        <div class="chat_people">
                            <div class="chat_img"><img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"></div>
                            <div class="chat_ib">
                                <h5>Sabrina <span class="chat_date">Oct 25</span></h5>
                                <p>Test, which is a new approach to have all solutions astrology under one roof.</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat_list">
                        <div class="chat_people">
                            <div class="chat_img"><img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"></div>
                            <div class="chat_ib">
                                <h5>Natasya <span class="chat_date">Oct 17</span></h5>
                                <p>Test, which is a new approach to have all solutions astrology under one roof.</p>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
            <div class="mesgs">
                <div class="msg_history">
                    <div class="incoming_msg">
                        <div class="incoming_msg_img"><img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"></div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p>Test which is a new approach to have all solutions</p>
                                <span class="time_date">11:10 AM | Sept 25</span>
                            </div>
                        </div>
                    </div>
                    <div class="outgoing_msg">
                        <div class="sent_msg">
                            <p>Test which is a new approach to have all solutions</p>
                            <span class="time_date">11:15 AM | Sept 25</span>
                        </div>
                    </div>
                    <div class="incoming_msg">
                        <div class="incoming_msg_img"><img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"></div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p>Test, which is a new approach to have</p>
                                <span class="time_date">20:00 PM | Yesterday</span>
                            </div>
                        </div>
                    </div>
                    <div class="outgoing_msg">
                        <div class="sent_msg">
                            <p>Apollo University, Delhi, India Test</p>
                            <span class="time_date">20:30 PM | Yesterday</span>
                        </div>
                    </div>
                    <div class="incoming_msg">
                        <div class="incoming_msg_img"><img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"></div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p>We work directly with our designers and suppliers, and sell direct to you, which means quality, exclusive products, at a price anyone can afford.</p>
                                <span class="time_date">08:00 AM | Today</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="type_msg">
                    <div class="input_msg_write">
                        <input type="text" class="write_msg" placeholder="Type a message">
                        <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection