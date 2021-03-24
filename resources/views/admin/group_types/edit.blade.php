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
      <a href="{{ route('admin.group_types.index') }}" class="button is-success">
        <span class="icon is-small">
          <i class="fa fa-list"></i>
        </span>
        <span>قائمة الفئات</span>
      </a>
    </div><!-- End Card Header -->
    <!-- Start Form -->
    {!! Form::model($group_type,['method' => 'PATCH', 'url' => route('admin.group_types.update', $group_type->id)]) !!}
      @include('admin.group_types._form')
    {!! Form::close() !!}<!-- End Form -->
  </div><!-- End Card -->
@endsection<!-- End Content Section -->
