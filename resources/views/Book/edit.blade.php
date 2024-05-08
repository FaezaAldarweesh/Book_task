@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit book</h2>
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


{!! Form::model($Books, ['method' => 'PUT','route' => ['Book.update', $Books->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', $Books->name , array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Author:</strong>
            {!! Form::text('author', $Books->author , array('placeholder' => 'author','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>sub category:</strong>
            <br/>
            <select name="subcategory_id">
            <option value=" {{ $Books->subCategory->id}}">{{ $Books->subCategory->name_sub_category}}</option>
            @foreach($subCategories as $subCategory)
                <option value="{{$subCategory->id}}">{{$subCategory->name_sub_category}}</option>
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