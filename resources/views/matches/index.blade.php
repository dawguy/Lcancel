@extends('layouts.master')

@section('content')
@push('scripts')
	<script type="text/javascript" src="{{URL::asset('js/matches.js')}}"></script>
@endpush
<div class="container">
	<h1>Recent Matches</h1>
	<ul style="list-style: none;">
        @foreach($matches as $match)
            <li>
				<img class="img-rounded" src="{{URL::asset('/image/stocks/' . $match->winner_character()->first()['name'] . '.png')}}" />
				<a href="/matches/{{ $match['id'] }}">{{$match->winner()->first()->name}} beat {{ $match->loser()->first()->name }}</a>
				<img class="img-rounded" src="{{URL::asset('/image/stocks/' . $match->loser_character()->first()['name'] . '.png')}}" />
            </li>
        @endforeach
    </ul>
</div>
@endsection
