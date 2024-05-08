@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit sub category</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('SubCategory.index') }}"> Back</a>
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


{!! Form::model($subCategory, ['method' => 'PUT','route' => ['SubCategory.update', $subCategory->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', $subCategory->name_sub_category , array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>main category:</strong>
            <br/>
            <select name="maincategory_id">
            <option value=" {{ $subCategory->maincategory->id}}">{{ $subCategory->maincategory->name_main_category}}</option>
            @foreach($maincategories as $maincategory)
                <option value="{{$maincategory->id}}">{{$maincategory->name_main_category}}</option>
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