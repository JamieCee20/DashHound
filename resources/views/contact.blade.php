@extends('layouts.app')
@section('title', 'Contact Us')

@section('content')
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h1 class="text-dark">Contact Us</h1>
            </div>
        </div>
        <div class="row text-center" id="topicRow">
            <div class="col-4" id="contactList">
                <p class="h4"><ins>Topic of concern</ins></p>

                <ul class="list-group">
                    <li class="list-group-item"><a href="#">Game Issues</a></li>
                    <li class="list-group-item"><a href="#">User Complaints</a></li>
                    <li class="list-group-item"><a href="#">Website Bugs</a></li>
                </ul>
            </div>
            <div class="col-4" id="contactList">
                <p class="h4"><ins>FAQ</ins></p>

                <ul class="list-group text-secondary overflow-auto" style="height:500px;">
                    <li class="list-group-item"><strong>Where can I go to complain?</strong><br>View the complaints tab under topics of concern.</li>
                    <li class="list-group-item"><strong>A user is posting bad content, what can I do?</strong><br> We recommend making a ticket reporting the user with their name and a comment about why you are reporting along with evidence.</li>
                    <li class="list-group-item"><strong>How do I view official Game Creators' posts?</strong><br>To view the content of an official publisher, click the Official Publishers tab at the top nav bar and view teasers to games from companies such as Athesda</li>
                    <li class="list-group-item"><strong>Question 4</strong><br>Content for question 4 here</li>
                    <li class="list-group-item"><strong>Question 5</strong><br>Content for question 5 here</li>
                    <li class="list-group-item"><strong>Question 6</strong><br>Content for question 6 here</li>
                </ul>
            </div>
            <div class="col-4" id="contactList">
                <p class="h4"><ins>Contact Details</ins></p>

                <ul class="list-group">
                    <li class="list-group-item"><a href="mailto:jamiecollins@jlcwd.me?subject=Customer%20Query">Email</a></li>
                    <li class="list-group-item"><a href="#"><strike>Ticket</strike></a></li>
                    <li class="list-group-item"><a href="#"><strike>Online Chat</strike></a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
