@extends('crud::layouts.master')

@section('content')
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div align="right">
    <a href="{{ route('crud.index') }}" class="btn btn-default">Back</a>
</div>

<form method="post" action="{{ route('crud.store') }}">

    @csrf
    <div class="form-group">
        <label class="col-md-4 text-right">Enter First Name</label>
        <div class="col-md-8">
            <input type="text" name="first_name" class="form-control input-lg" />
        </div>
    </div>
    <br />
    <br />
    <div class="form-group">
        <label class="col-md-4 text-right">Enter Last Name</label>
        <div class="col-md-8">
            <input type="text" name="last_name" class="form-control input-lg" />
        </div>
    </div>

    <br /><br /><br />
    <div class="form-group text-center">
        <input type="submit" name="add" class="btn btn-primary input-lg" value="Add" />
    </div>

</form>

@endsection