@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <ul>
                        <li>
                            <a href="/matches">Matches</a>
                        </li>
                        <li>
                            <a href="/friends">Friends</a>
                        </li>
                        <li>
                            <a href="/history">History</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
