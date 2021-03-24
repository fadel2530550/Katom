<!-- Layout Extend -->
@extends('admin.layouts.app')
<!-- SEO Section -->
@section('page.title', 'تعديل مقال')
<!-- Start Content Section -->
@section('content')
<!-- Start Card -->
  <div class="card main-card">
    <!-- Start Card Header -->
    <div class="card-header">
      <a href="{{ route('admin.groups.index') }}" class="button is-success">
        <span class="icon is-small">
          <i class="fa fa-list"></i>
        </span>
        <span>قائمة المجموعات</span>
      </a>
    </div><!-- End Card Header -->
    <!-- Start Form -->
    {!! Form::model($groups,['method' => 'PATCH', 'url' => route('admin.groups.update',$groups->id)]) !!}
      @include('admin.groups._form')
    {!! Form::close() !!}<!-- End Form -->
  </div><!-- End Card -->
@endsection<!-- End Content Section -->
