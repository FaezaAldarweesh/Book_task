@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="pull-left justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Book Management</h2>
            <div>
                @can('book-find_Book')
                <form action="{{route('find_Book')}}" method="GET" class="d-flex">
                    @csrf
                    <input type="text" name="find_Book" class="form-control me-2" placeholder="Search Book">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
                @endcan()

                @can('book-create')
                <a class="btn btn-success ms-2" href="{{ route('Book.create') }}"> Create New book</a>
                @endcan
            </div>
        </div>

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif


        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Book ID</th>
                        <th>Book Name</th>
                        <th>author name</th>
                        <th>sub category name</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Books as $Book)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$Book->name}}</td>
                        <td>{{$Book->author}}</td>
                        <td>{{$Book->subCategory->name_sub_category}}</td>
                        <td>
                            <div class="d-flex">
                                @can('book-edit')
                                <a class="btn btn-primary me-2" href="{{route('Book.edit',$Book->id)}}">Edit</a>
                                @endcan
                                @can('book-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['Book.destroy', $Book->id],'class' => 'delete-form']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
