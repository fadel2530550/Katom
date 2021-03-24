<!-- Layout Extend -->
@extends('admin.layouts.app')
<!-- SEO Section -->
@section('page.title', 'اضافة الفئات')
<!-- Start Content Section -->
@section('content')
  <!-- Start Card -->
  <div class="card main-card">
    <!-- Start Card Header -->
    <div class="card-header">
      <a href="{{ route('admin.group_types.index') }}" class="button is-success">
          <span class="icon is-small">
            <i class="fa fa-newspaper"></i>
          </span>
        <span>أنواع الفئات</span>
      </a>
    </div><!-- End Card Header -->
    <!-- Start Form -->
    {!! Form::open(['method' => 'POST', 'route' => ['admin.group_types.store']]) !!}
      @include('admin.group_types._form')
    {!! Form::close() !!}<!-- End Form -->
  </div><!-- End Card -->
@endsection<!-- End Content Section -->
