@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Character: {{$character}}</h1>
        <div class="container">
            <h2>Won Matches</h2>
            @foreach($won as $character => $stats)
                <div id="character{{$character}}" class="row">
                    <h3>{{$character}}</h3>
                    <div class="container">
                        @foreach( $stats as $stocks => $count )
                            <div class="row">
                                Stocks: {{ $stocks }} Games Won: {{ $count }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <h2>Lost Matches</h2>
            @foreach($lost as $character => $stats)
                <div id="character{{$character}}" class="row">
                    <h3>{{$character}}</h3>
                    <div class="container">
                        @foreach( $stats as $stocks => $count )
                            <div class="row">
                                Stocks: {{ $stocks }} Games Lost: {{ $count }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
