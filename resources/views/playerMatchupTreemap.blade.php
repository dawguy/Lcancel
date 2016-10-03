@extends('layouts.app')

@section('content')
@push('scripts')
	<script type="text/javascript" src="{{URL::asset('js/playerMatchupTreemap.js')}}"></script>
@endpush
<div class="container">
    <div class="row">
        <div class="graph">
        </div>
    </div>
</div>
<script type="text/javascript">
    var playerOne = {!! json_encode($playerOne) !!};
	var playerTwo = {!! json_encode($playerTwo) !!};
</script>
@endsection
