@extends('layouts.master')

@section('content')
    @push('scripts')
    <script type="text/javascript" src="{{URL::asset('js/matches.js')}}"></script>
    @endpush
    <div class="container">
        <h1>Match</h1>
        <div class="container">
            <div class="row">
                <a href="/player/{{$match->winner}}">{{$match->winner()->first()->name}}</a> won with {{$match->winner_stocks}} stocks left as {{$match->winner_character()->first()->name}}
            </div>
            <div class="row">
                <a href="/player/{{$match->loser}}">{{$match->loser()->first()->name}}</a> lost as {{$match->loser_character()->first()->name}}
            </div>
        </div>

        <div class="container">
            <h3>Player vs Player Stats</h3>
            <ul style="list-style: none;">
                <li>
                    <a href="/matchups/players/{{$match->winner}}/{{$match->loser}}/characters/{{$match->winner_character}}/{{$match->loser_character}}">Character Matchup</a>
                </li>
                <li>
                    <a href="/matchups/players/{{$match->winner}}/{{$match->loser}}">Player Matchup</a>
                </li>
            </ul>
        </div>

        <div class="container">
            <h3>Overall Stats</h3>
            <ul style="list-style: none;">
                <li>
                    <a href="/matchups/characters/{{$match->winner_character}}/{{$match->loser_character}}">{{$match->winner_character()->first()->name}} vs {{$match->loser_character()->first()->name}} Stats</a>
                </li>
                <li>
                    <a href="/matchups/character/{{$match->winner_character}}">All {{$match->winner_character()->first()->name}} Matchup Stats</a>
                </li>
                <li>
                    <a href="/matchups/character/{{$match->loser_character}}">All {{$match->loser_character()->first()->name}} Matchup Stats</a>
                </li>
            </ul>
        </div>
        <div class="container">
            <a href="{{URL::previous()}}">Back to matches</a>
        </div>
    </div>
@endsection
