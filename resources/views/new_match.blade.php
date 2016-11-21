@extends('layouts.app')

@section('content')
<style>
.playerLeft {
	margin: auto;
}

.playerMiddle {
	margin: auto;
}

.playerRight {
	margin: auto;
}

.ui-helper-hidden-accessible {
	display:none;
}

.ui-menu-item {
	border-style: solid;
	border-width: 2px;
	margin: 2px;
	background: #9494b8;
}

ul.ui-autocomplete {
		list-style: none;
    padding: 0px;
    margin: 0px;
}

.playerContainer {
	display: inline-block;
	width: 100%;
	height: 100%;
	background: #BBBBBB;
}

.playerNav li.active{
	background: #AAFFFF;
}
</style>
@push('scripts')
	<script type="text/javascript" src="{{URL::asset('js/NewMatch.js')}}"></script>
@endpush

<div class="container">
	<div class="row">
		<div class="col-lg-5">
			<div class="playerContainer">
				<div class="playerNav">
					<ul class="nav navbar-nav">
						<li>
							<a href="#">Stats</a>
						</li>
						<li>
							<a href="#">Vs Player</a>
						</li>
						<li>
							<a href="#">Vs Character</a>
						</li>
					</ul>
				</div>
				<div class="ui-widget">
					<label for="player1Name">Player 1</label>
					<input id="player1Name" type="text"></input>
				</div>
				<div id="player1Stats" class="playerStats">
					Wins: <span id="player1StatsWins"></span><br>
					Losses: <span id="player1StatsLosses"></span><br>
					Elo: <span id="player1StatsElo"></span><br>
				</div>
			</div>
		</div>
		<div class="col-lg-2">
    	   	<div class="row playerMiddle">
    	   		<h3>vs</h3>
			</div>
    	</div>
		<div class="col-lg-5">
			<div class="playerContainer playerRight">
				<div class="playerNav">
					<ul class="nav navbar-nav">
						<li>
							<a href="#">Stats</a>
						</li>
						<li>
							<a href="#">Vs Player</a>
						</li>
						<li>
							<a href="#">Vs Character</a>
						</li>
					</ul>
				</div>
				<div class="ui-widget">
					<label for="player2Name">Player 2</label>
					<input id="player2Name" type="text"></input>
				</div>
				<div id="player2Stats" class="playerStats">
					Wins: <span id="player2StatsWins"></span><br/>
					Losses: <span id="player2StatsLosses"></span><br>
					Elo: <span id="player2StatsElo"></span><br>
				</div>
			</div>
		</div>
	</div>

    <div class="row">
    	<h1>Match Outcome</h1>
    	<div class="">
    	<div class="col-lg-5">
    		<div class="playerLeft">
	    		<div class="row">
	    			<h3 id="player1Id">Player 1</h3>
				</div>
				<div class="row">
					Character: @include('character_select', array('playerNumber' => 1))
				</div>
				<div class="row">
					Stocks Remaining: <select class="selectpicker" id="player1Stocks">
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</select>
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
	    			<h3 id="player2Id">Player2</h3>
				</div>
				<div class="row">
					Character: @include('character_select', array('playerNumber' => 2))
				</div>
				<div class="row">
					Stocks Remaining: <select class="selectpicker" id="player2Stocks">
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</select>
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
