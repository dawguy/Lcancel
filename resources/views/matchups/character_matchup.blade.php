@extends('layouts.master')

@section('content')
@push('scripts')
<script type="text/javascript" src="{{URL::asset('js/character_matchup.js')}}"></script>
@endpush
<div class="container">
    @foreach($matches as $key => $match)
        <div>
                <img class="img-rounded" src="{{URL::asset('/image/stocks/' . $match->winner_character()->first()['name'] . '.png')}}" />
                <a href="/matches/{{ $match['id'] }}">beat</a>
                <img class="img-rounded" src="{{URL::asset('/image/stocks/' . $match->loser_character()->first()['name'] . '.png')}}" />
        </div>
    @endforeach
<div>
@endsection
