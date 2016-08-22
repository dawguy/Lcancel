@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2>
            {{$player['name']}}
        </h2>
        <h3>
            Recent Matches
        </h3>
    </div>
    <table class="table-striped">
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
            <td>{{$player['name']}}</td>
            <td>{{$characters[$match->winner_character]}}</td>
            <td>{{$match->name}}</td>
            <td>{{$characters[$match->loser_character]}}</td>
        </tr>
        @else
        <tr style="text-align: center;">
            <td>{{$match->name}}</td>
            <td>{{$characters[$match->winner_character]}}</td>
            <td>{{$player['name']}}</td>
            <td>{{$characters[$match->loser_character]}}</td>
        </tr>
        @endif

        @endforeach
    </table>
</div>
@endsection
