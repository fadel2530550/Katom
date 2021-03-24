<!-- Layout Extend -->
@extends('admin.layouts.app')
<!-- SEO Section -->
@section('page.title', 'نوع الفئات')
<!-- Start Content Section -->
@section('content')
<!-- Start Card -->
<div class="card main-card">
    <!-- Start Card Header -->
    <div class="card-header is-justify-content-space-between">
        <a href="{{ route('admin.group_types.create') }}" class="button is-success">
            <span class="icon is-small">
                <i class="fa fa-plus-circle"></i>
            </span>
            <span>اضافة فئة جديد</span>
        </a>
    </div><!-- End Card Header -->

    <!-- Start Card Content -->
    <div class="card-content">
        <div class="table-container">
            <table class="table is-fullwidth is-hoverable" id="articles">
                <thead>
                    <tr>
                        <th>نوع الفئة</th>
                        <th>تصنيف الفئة</th>
                        <th>التحكم</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grouptype as $type)
                    <tr @if($loop->odd) style="background:#54cc96" @endif>
                        <th class="select-checkbox">{{ $type->name }}</th>
                        <th>{{ $type->parent->name }}</th>
                        <th>
                            <div class="buttons has-addons">
                                <a class="button is-info" href="{{ route('admin.group_types.edit',[$type->id]) }}"> تعديل </a>
                                <span class="modal-open button is-danger" status-name="تأكيد الحذف"
                                 traget-modal=".delete-modal" data_id="{{ $type->id }}"
                                 data_name="{{ $type->name }}"
                                 data-url="{{ route('admin.group_types.destroy',[$type->id])  }}">حذف</span>
                            </form>
                        </div>
                        </th>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div><!-- End Card Content -->

    <!-- Start Card Footer -->
    <div class="card-footer  with-pagination">
      {!! $grouptype->links() !!}
    </div><!-- End Card Footer -->
</div><!-- End Card -->

<!-- Include Modals -->
@include('admin.partials.deleteModal')
@endsection
<!-- End Content Section -->
