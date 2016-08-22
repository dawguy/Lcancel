@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <ul style="list-style-type: none; padding: 0px; margin: 0px;">
            <li><h2>{{$player['name']}}</h2></li>
            <li><h4><a href="/profile/{{$player['id']}}">View Profile</a></h4></li>
    </ul>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead >
                <th style="text-align: center;">Winner</th>
                <th style="text-align: center;">Character</th>
                <th style="text-align: center;">Loser</th>
                <th style="text-align: center;">Character</th>
            </thead>
            <tbody>
            @foreach( $matches as $match)
            @if( $player['id'] === $match->winner)
            <tr style="text-align: center;">
                <td><a href="/history/{{$player['id']}}">{{$player['name']}}</a></td>
                <td>{{$characters[$match->winner_character]}}</td>
                <td><a href="/history/{{$match['loser']}}">{{$match->name}}</a></td>
                <td>{{$characters[$match->loser_character]}}</td>
            </tr>
            @else
            <tr style="text-align: center;">
                <td><a href="/history/{{$match['winner']}}">{{$match->name}}</a></td>
                <td>{{$characters[$match->winner_character]}}</td>
                <td><a href="/history/{{$player['id']}}">{{$player['name']}}</a></td>
                <td>{{$characters[$match->loser_character]}}</td>
            </tr>
            @endif

            @endforeach
        </table>
    </div>
</div>
@endsection
