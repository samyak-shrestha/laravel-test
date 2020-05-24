@extends('crud::layouts.master')

@section('content')

<p>
    This view is loaded from module: {!! config('crud.name') !!}
</p>
<a class="btn btn-primary" href="{{ route('crud.create')}}"> create </a>
<br> <br>
<table class="table table-bordered table-striped">
    <tr>
        <th width="45%">First Name</th>
        <th width="35%">Last Name</th>
        <th width="30%">Action</th>
    </tr>
    @foreach($data as $row)
    <tr>
        <td>{{ $row->first_name }}</td>
        <td>{{ $row->last_name }}</td>
        <td>

            <form action="{{ route('crud.destroy', $row->id) }}" method="post">
                <a href="{{ route('crud.show', $row->id) }}" class="btn btn-primary">Show</a>
                <a href="{{ route('crud.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
{!! $data->links() !!}

@endsection