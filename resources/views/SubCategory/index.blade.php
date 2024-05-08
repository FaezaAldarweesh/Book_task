@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="pull-left justify-content-between align-items-center mb-4">
            <h2 class="mb-0">sub category Management</h2>
            <div>
                @can('find_SubCategory')
                <form action="{{route('find_SubCategory')}}" method="GET" class="d-flex">
                    @csrf
                    <input type="text" name="find_SubCategory" class="form-control me-2" placeholder="Search sub category">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
                @endcan()

                @can('subCategory-create')
                <a class="btn btn-success ms-2" href="{{ route('SubCategory.create') }}"> Create New category</a>
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
                        <th>Sub Category ID</th>
                        <th>Sub Category Name</th>
                        <th>Main Category Name</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($SubCategories as $Sub_Category)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$Sub_Category->name_sub_category}}</td>
                        <td>{{$Sub_Category->MainCategory->name_main_category}}</td>
                        <td>
                            <div class="d-flex">
                                @can('subCategory-edit')
                                <a class="btn btn-primary me-2" href="{{route('SubCategory.edit',$Sub_Category->id)}}">Edit</a>
                                @endcan
                                @can('subCategory-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['SubCategory.destroy', $Sub_Category->id],'class' => 'delete-form']) !!}
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
