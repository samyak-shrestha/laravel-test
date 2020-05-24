@extends('crud::layouts.master')

@section('content')

<div class="jumbotron text-center">
    <div align="right">
        <a href="{{ route('crud.index') }}" class="btn btn-default">Back</a>
    </div>
    <br />
    <h3>First Name - {{ $data->first_name }} </h3>
    <h3>Last Name - {{ $data->last_name }}</h3>
</div>
@endsection