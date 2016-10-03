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
    var playerMatchupJson = {!! json_encode($playerMatchupJson) !!};
</script>
@endsection
