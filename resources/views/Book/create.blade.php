@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">php 
            <h2>Create New book</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('Book.index') }}"> Back</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif


{!! Form::open(array('route' => 'Book.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            <strong>author:</strong>
            {!! Form::text('author', null, array('placeholder' => 'author','class' => 'form-control')) !!}
            <select name="subcategory_id">
                <option value="" selected disabled></option>
                @foreach($subcategories as $subcategory)
                    <option value="{{$subcategory->id}}">{{$subcategory->name_sub_category}}</option>
                @endforeach
            </select>  
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}

@endsection