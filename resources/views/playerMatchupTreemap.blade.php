@extends('layouts.app')

@section('content')
@push('scripts')
	<script type="text/javascript" src="{{URL::asset('js/playerMatchupTreemap.js')}}"></script>
@endpush
<div class="container">
    <div class="row">
        <div id="playerMatchup" style="display: block; max-width: 200; max-height: 200;">
        </div>
    </div>
</div>
<div id="playerMatchupTooltip" style="display: none; position: absolute; width: 90px; height: 60px; background-color: gray;">
	<div id="playerMatchupCharacter"></div>
	<div id="playerMatchupWins">Wins:</div>
	<div id="playerMatchupLosses">Losses:</div>
</div>
<script type="text/javascript">
    var playerOne = {!! json_encode($playerOne) !!};
	var playerTwo = {!! json_encode($playerTwo) !!};
</script>
@endsection
