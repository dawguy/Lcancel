@extends('layouts.app')

@section('content')
@push('scripts')
	<script type="text/javascript" src="{{URL::asset('js/Profile.js')}}"></script>
@endpush
<div class="container">
    <div class="row">
        <ul style="list-style-type: none; padding: 0px; margin: 0px;">
                <li><h2>{{$player['name']}}</h2></li>
                <li><h4><a href="/history/{{$player['id']}}">View History</a></h4></li>
                <li>Wins: {{$won}}</li>
                <li>Loses: {{$lost}}</li>
                <li>Primary Character: {{$mainCharacter['name']}}</li>
        </ul>
    </div>
    @if (isset($areFriends))
        @if ($areFriends)
        <div class="row">
            <button id="remove_friend">Remove Friend</a>
        </div>
        @else
        <div class="row">
            <button id="add_friend">Add Friend</a>
        </div>
        @endif
    @endif
</div>
<div>
    <input type="hidden" id="playerId" value="{{$player['id']}}"></input>
    <input type="hidden" id="token" value="{{ csrf_token() }}">
</div>
@endsection
