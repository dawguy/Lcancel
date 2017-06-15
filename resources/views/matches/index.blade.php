@extends('layouts.master')

@section('content')
@push('scripts')
	<script type="text/javascript" src="{{URL::asset('js/matches.js')}}"></script>
@endpush
<div class="container">
	<ul>
        @foreach($matches as $match)
            <li>
                <a href="/matches/{{ $match['id'] }}">{{$match->winner()->first()->name}} beat {{ $match->loser()->first()->name }}</a>
            </li>
        @endforeach
    </ul>
    <div class="row">
    </div>
</div>
@endsection
