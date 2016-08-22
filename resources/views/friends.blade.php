@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2>Friends</h2>
    </div>
    <table class="table-condensed table-striped">
        <tbody>
        @foreach($friends as $friend)
            <tr>
                <td><a href="/profile/{{ $friend['id'] }}">{{ $friend['name'] }}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
