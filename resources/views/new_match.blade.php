@extends('layouts.app')

@section('content')
<style>
.player {
	border-style: solid;
	border-width: 3px;
	margin: 2px;
	background: #9494b8;
}

.selected {
	background: #8585e0;
}

.playerLeft {
	width: 50%;
	margin: auto;
}

.playerRight {
	width: 50%;
	margin: auto;
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
			</div>
    	</div>
    	<div class="col-lg-2">
    	   	<div class="row">
    	   		<h3>vs</h3>
			</div>
    	</div>
    	<div class="col-lg-5">
    		<div class="playerRight">
	    	    <div class="row">
	    			<h3>Jjllama #1</h3>
				</div>
			</div>
    	</div>
    </div>
</div>
@endsection
