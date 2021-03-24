<!-- Layout Extend -->
@extends('admin.layouts.app')
<!-- SEO Section -->
@section('page.title', 'المجموعات')
<!-- Start Content Section -->
@section('content')
<!-- Start Card -->
<div class="card main-card">
    <!-- Start Card Header -->
    <div class="card-header is-justify-content-space-between">
        <a href="{{ route('admin.groups.create') }}" class="button is-success">
            <span class="icon is-small">
                <i class="fa fa-plus-circle"></i>
            </span>
            <span>اضافة مجموعة</span>
        </a>
        @include('admin.partials.search')
    </div><!-- End Card Header -->

    <!-- Start Card Content -->
    <div class="card-content">

        <div class="table-container">
            <table class="table is-fullwidth is-hoverable" id="articles">
                <thead>
                    <tr>
                        <th>اسم المجموعة</th>
                        <th>الفترة الزمنية</th>
                        <th>السعر</th>
                        <th>نوع المجموعة</th>
                        <th>التحكم</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ( $groups as $group)
                    <tr>
                        <th>{{ $group->name }}</th>
                        <th>{{ $group->duration }}</th>
                        <th>{{ $group->price }}</th>
                        <th>{{ $group->category_name }}</th>
                        <th>
                            <div class="buttons has-addons">
                                <a class="button is-info" href="{{ route('admin.groups.edit',[$group->id]) }}"> تعديل </a>
                                <span class="modal-open button is-danger" status-name="تأكيد الحذف"  traget-modal=".delete-modal" data_id="" data_name="" data-url="{{ route('admin.groups.destroy',[$group->id]) }}">حذف</span>
                            </form>
                        </div>
                        </th>
                    </tr>
                    @empty


                    @endforelse
                </tbody>
            </table>
        </div>
    </div><!-- End Card Content -->

    <!-- Start Card Footer -->
    <div class="card-footer with-pagination">

    </div><!-- End Card Content -->
</div><!-- End Card -->

<!-- Include Modals -->
@include('admin.partials.deleteModal')
@endsection
<!-- End Content Section -->
