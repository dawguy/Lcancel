@extends('layouts.app')

@section('content')
<style>
.player {
	border-style: solid;
	border-width: 2px;
	margin: 2px;
	background: #9494b8;
}

.player:hover{
	box-shadow: 0 0 4px rgba(216, 145, 145, 1);
}

.selected {
	background: #8585e0;
}

.playerLeft {
	margin: auto;
}

.playerMiddle {
	margin: auto;
}

.playerRight {
	margin: auto;
}

.player1Stock{
	background: lightgray;
	border-radius: 6px;
}

.player2Stock{
	background: lightgray;
	border-radius: 6px;
}

.p1s4:hover .p1s4{
	box-shadow: 0 0 4px rgba(216, 145, 145, 1);
}

.player2Stock:hover{
	box-shadow: 0 0 4px rgba(216, 145, 145, 1);
}

.player1Character:hover{
	box-shadow: 0 0 4px rgba(216, 145, 145, 1);
}

.player2Character:hover{
	box-shadow: 0 0 4px rgba(216, 145, 145, 1);
}

</style>
@push('scripts')
	<script type="text/javascript" src="{{URL::asset('js/NewMatch.js')}}"></script>
@endpush

<div class="container">
    <div class="row">
    	<h1>Select Player</h1>
		<div class="col-lg-4">
			<div class="">
				<h2>Friend</h2>
			</div>
			<div class="">
				@foreach($friends as $friend)
				<div data-playerid="{{ $friend['id'] }}" class="player">{{ $friend['name'] }}</div>
				@endforeach
			</div>
		</div>
		<div class="col-sm-4">
			<div class="">
				<h2>Recent</h2>
			</div>
			<div class="">
				@foreach($recents as $recent)
				<div data-playerid="{{ $recent['id'] }}" class="player">{{ $recent['name'] }}</div>
				@endforeach
			</div>
		</div>
   		<div class="col-sm-4">
			<div class="">
				<h2>Search</h2>
			</div>
			<div class="">
				<input type="text"/>
				@foreach($searches as $searched)
				<div data-playerid="{{ $searched['id'] }}" class="player">{{ $searched['name'] }}</div>
				@endforeach
			</div>
		</div>
    </div>

    <div class="row">
    	<h1>Match Outcome</h1>
    	<div class="">
    	<div class="col-lg-5">
    		<div class="playerLeft">
	    		<div class="row">
	    			<h3>{{ $user }}</h3>
				</div>
				<div class="row">
					Character:
					<img id="player1Character" class="player1Character" data-character="{{$main_character}}"src="{{URL::asset('/image/stocks/question.png')}}" alt="Selected Character" height="40" width="40">
					@include('character_select', array('playerNumber' => 1))
				</div>
				<div class="row">
					Stocks:
					<img id="player1_0Lives" style="p1s0 opacity: .1" class="player1StockNone" src="{{URL::asset('/image/none.png')}}" alt="No Lives" height="40" width="40">
					<img id="player1_1Lives" class="player1Stock p1s1 p1s2 p1s3 p1s4" src="{{URL::asset('/image/stocks/' . $main_character . '.png')}}" alt="Stock" height="40" width="40">
					<img id="player1_2Lives" class="player1Stock p1s2 p1s3 p1s4" src="{{URL::asset('/image/stocks/' . $main_character . '.png')}}" alt="Stock" height="40" width="40">
					<img id="player1_3Lives" class="player1Stock p1s3 p1s4" src="{{URL::asset('/image/stocks/' . $main_character . '.png')}}" alt="Stock" height="40" width="40">
					<img id="player1_4Lives" class="player1Stock p1s4" src="{{URL::asset('/image/stocks/' . $main_character . '.png')}}" alt="Stock" height="40" width="40">
				</div>
			</div>
    	</div>
    	<div class="col-lg-2">
    	   	<div class="row playerMiddle">
    	   		<h3>vs</h3>
			</div>
    	</div>
    	<div class="col-lg-5">
    		<div class="playerRight">
	    		<div class="row">
	    			<h3 id="opponent">Select Opponent</h3>
				</div>
				<div class="row">
					Character:
					<img id="player2Character" class="player2Character" src="{{URL::asset('/image/stocks/question.png')}}" alt="Selected Character" height="40" width="40">
					@include('character_select', array('playerNumber' => 2))
				</div>
				<div class="row">
					Stocks:
					<img id="player2_0Lives" style="opacity: .1" class="player2StockNone" src="{{URL::asset('/image/none.png')}}" alt="No Lives" height="40" width="40">
					<img id="player2_1Lives" class="player2Stock p2s1 p2s2 p2s3 p2s4" src="{{URL::asset('/image/stocks/question.png')}}" alt="Stock" height="40" width="40">
					<img id="player2_2Lives" class="player2Stock p2s2 p2s3 p2s4" src="{{URL::asset('/image/stocks/question.png')}}" alt="Stock" height="40" width="40">
					<img id="player2_3Lives" class="player2Stock p2s3 p2s4" src="{{URL::asset('/image/stocks/question.png')}}" alt="Stock" height="40" width="40">
					<img id="player2_4Lives" class="player2Stock p2s4" src="{{URL::asset('/image/stocks/question.png')}}" alt="Stock" height="40" width="40">
				</div>
			</div>
    	</div>
    </div>

    <div class="row">
        <div class="col-lg-5">
        </div>
        <div class="col-lg-2">
            <div class="row playerMiddle">
                <input id="submitMatch" type="submit" value="Submit">
            </div>
        </div>
        <div class="col-lg-5">
        </div>
    </div>
    <input type="hidden" id="token" value="{{ csrf_token() }}">
</div>
@endsection
