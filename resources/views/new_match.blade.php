@extends('layouts.app')

@section('content')
<style>
.player {
	border-style: solid;
	border-width: 3px;
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

.player1Stock:hover{
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
<div class="container">
    <div class="row">
    	<h1>Select Player</h1>
		<div class="col-lg-4">
			<div class="">
				<h2>Friend</h2>
			</div>
			<div class="">
				<div class="player">
					JJllama #10
				</div>
				<div class="player selected">
					Bloodisblue #1
				</div>
				<div class="player">
					Bloodisblue #11
				</div>
				<div class="player">
					Bloodisblue #13
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="">
				<h2>Recent</h2>
			</div>
			<div class="">
				<div class="player">
					JJllama #12
				</div>
				<div class="player">
					Bloodisblue #11
				</div>
				<div class="player">
					Bloodisblue #14
				</div>
				<div class="player">
					Bloodisblue #15
				</div>
				<div class="player">
					Bloodisblue #17
				</div>
				<div class="player">
					Bloodisblue #18
				</div>
			</div>
		</div>
   		<div class="col-sm-4">
			<div class="">
				<h2>Search</h2>
			</div>
			<div class="">
				<div class="player">
					JJllama #12
				</div>
				<div class="player">
					Bloodisblue #11
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
	    			<h3>Bloodisblue #1</h3>
				</div>
				<div class="row">
					Character:
					<img class="player1Character" src="{{URL::asset('/image/stocks/peach.png')}}" alt="Selected Character" height="40" width="40">
				</div>
				<div class="row">
					Stocks:
					<img class="player1Stock" src="{{URL::asset('/image/none.png')}}" alt="No Lives" height="40" width="40">
					<img class="player1Stock" src="{{URL::asset('/image/stocks/peach.png')}}" alt="Stock" height="40" width="40">
					<img class="player1Stock" src="{{URL::asset('/image/stocks/peach.png')}}" alt="Stock" height="40" width="40">
					<img class="player1Stock" src="{{URL::asset('/image/stocks/peach.png')}}" alt="Stock" height="40" width="40">
					<img class="player1Stock" src="{{URL::asset('/image/stocks/peach.png')}}" alt="Stock" height="40" width="40">
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
	    			<h3>Jjllama #311</h3>
				</div>
				<div class="row">
					Character:
					<img class="player2Character" src="{{URL::asset('/image/stocks/peach.png')}}" alt="Selected Character" height="40" width="40">
				</div>
				<div class="row">
					Stocks:
					<img class="player2Stock" src="{{URL::asset('/image/none.png')}}" alt="No Lives" height="40" width="40">
					<img class="player2Stock" src="{{URL::asset('/image/stocks/peach.png')}}" alt="Stock" height="40" width="40">
					<img class="player2Stock" src="{{URL::asset('/image/stocks/peach.png')}}" alt="Stock" height="40" width="40">
					<img class="player2Stock" src="{{URL::asset('/image/stocks/peach.png')}}" alt="Stock" height="40" width="40">
					<img class="player2Stock" src="{{URL::asset('/image/stocks/peach.png')}}" alt="Stock" height="40" width="40">
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
</div>
@endsection
