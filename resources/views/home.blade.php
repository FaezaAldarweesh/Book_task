@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <!-- <a href="{{route('MainCategory.index')}}">التصنيفات الرئيسية</a>
                <a href="{{route('SubCategory.index')}}">التصنيفات الفرعية</a>
                <a href="{{route('Book.index')}}">الكتب</a> -->
            </div>
        </div>
    </div>
</div>
@endsection
