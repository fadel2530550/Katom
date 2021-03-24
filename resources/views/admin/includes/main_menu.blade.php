<collapse class="outer " accordion is-fullwidth>
    <a href="#" target="_blank" class="card link-item-no-collapse "><i class="fa fa-home"></i><span>رئيسية
            الموقع</span></a>
    <a href="{{ route('admin.dashboard') }}" class="card link-item-no-collapse "><i
            class="fas fa-tachometer-alt"></i><span>لوحه التحكم</span>
    </a>
    <collapse-item title="اقسام الموقع" icon="fa fa-sitemap">
        <a class="link-item" href="{{ route('admin.sections.create') }}">اضافة قسم</a>
        <a class="link-item" href="{{ route('admin.sections.index') }}">قائمة الاقسام</a>
    </collapse-item>
    <collapse-item title="المقالات" icon="fa fa-newspaper">
        <a class="link-item" href="{{ route('admin.articles.create') }}">اضافة مقال</a>
        <a class="link-item" href="{{ route('admin.articles.index') }}">قائمة المقالات</a>
    </collapse-item>
    <collapse-item title="الصور المتحركة" icon="fa fa-image">
        <a class="link-item" href="{{ route('admin.sliders.create') }}">اضافة صورة</a>
        <a class="link-item" href="{{ route('admin.sliders.index') }}">قائمة الصور</a>
    </collapse-item>
    <collapse-item title="المجموعات" icon="fa fa-sitemap">
        <a class="link-item" href="{{ route('admin.groups.index') }}">قائمة المجموعات</a>
        <a class="link-item" href="{{ route('admin.groups.create') }}">اضافة مجموعة</a>
        <a class="link-item" href="{{ route('admin.group_types.index') }}">اضافة الفئات </a>
    </collapse-item>
    <a href="{{ route('admin.contacts.index') }}" class="card link-item-no-collapse"><i
            class="fa fa-envelope"></i><span>رسائل التواصل</span></a>
    <a href="{{ route('admin_logout') }}" onclick="event.preventDefault();
  document.getElementById('logout-form').submit();" class="card link-item-no-collapse"><i
            class="fas fa-sign-out-alt"></i><span>تسجيل الخروج</span></a>
    <form id="logout-form" action="{{ route('admin_logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</collapse>
