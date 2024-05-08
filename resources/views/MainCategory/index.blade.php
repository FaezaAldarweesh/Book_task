@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Main Category Management</h2>
            <div>
                @can('find_MainCategory')
                <form action="{{ route('find_MainCategory') }}" method="GET" class="d-flex">
                    @csrf
                    <input type="text" name="find_MainCategory" class="form-control me-2" placeholder="Search Main Category">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
                @endcan

                @can('mainCategory-create')
                <a class="btn btn-success ms-2" href="{{ route('MainCategory.create') }}">Create New Category</a>
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
                        <th>Main Category ID</th>
                        <th>Main Category Name</th>
                        <th width="200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($MainCategories as $Main_Category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $Main_Category->name_main_category }}</td>
                        <td>
                            <div class="d-flex">
                                @can('mainCategory-edit')
                                <a class="btn btn-primary me-2" href="{{ route('MainCategory.edit', $Main_Category->id) }}">Edit</a>
                                @endcan
                                @can('mainCategory-delete')
                                {!! Form::open(['method' => 'DELETE', 'route' => ['MainCategory.destroy', $Main_Category->id], 'class' => 'delete-form']) !!}
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
