@extends('layouts.app')

@section('content')
<style>
.player, .ui-menu-item {
	border-style: solid;
	border-width: 2px;
	margin: 2px;
	background: #9494b8;
}

.playerStats {

}

.playerNav {

}

.playerContainer {
	display: inline-block;
	background: #BBBBBB;
}


</style>
@push('scripts')
	<script type="text/javascript" src="{{URL::asset('js/NewMatch.js')}}"></script>
@endpush

<div class="container">
	<div class="row">
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
			<div>
				<label for="player1Name">Player 1</label>
				<input id="player1Name" type="text"></input>
			</div>
			<div id="player1Stats" class="playerStats">
				Wins: <br/>
				Losses: <br/>
				Elo: <br/>
				Character: <br/>
			</div>
		</div>
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
			<div>
				<label for="player2Name">Player 2</label>
				<input id="player2Name" type="text"></input>
			</div>
			<div id="player2Stats" class="playerStats">
				Wins: <br/>
				Losses: <br/>
				Elo: <br/>
				Character: <br/>
			</div>
		</div>
	</div>

    <div class="row">
		@include('character_select')
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
