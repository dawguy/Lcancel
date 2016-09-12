@extends('layouts.app')

@section('content')
@push('scripts')
	<script type="text/javascript" src="{{URL::asset('js/matchup.js')}}"></script>
@endpush
<div class="container">
    <div class="row">
        <div class="chart">
        </div>
    </div>
</div>
<script type="text/javascript">
    var matches    = {!! json_encode($matches) !!};
    var characters = {!! json_encode($characters) !!};
</script>
@endsection
