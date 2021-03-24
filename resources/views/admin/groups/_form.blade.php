<!-- Start Card Content -->
<div class="card-content">
    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label required">اسم المجموعة</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    {!! Form::text('name', null, ['class' => 'input', 'required']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label required">الفترة الزمنية</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    {!! Form::text('duration',null, ['class'=>'input','required']) !!}

                </div>
            </div>
        </div>
    </div>
    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label"> السعر </label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    {!! Form::text('price', null, ['class' => 'input','min:0']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label required">تصنيف المجموعة </label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    <div class="select is-width">
                        <select class="form-control @error('category_id')is-invalid @enderror" name="category_id"
                            id="parent_id">
                            <option value="">الصنف</option>
                            @foreach ($groupType as $gp)
                            <option {{ ($groups->category_id == $gp->id)?'selected':'' }} value="{{ $gp->id }}">{{ $gp->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label required">نوع المجموعة </label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    <div class="select is-width">
                        <select class=" form-control @error('type_parent_id')is-invalid @enderror" name="type_parent_id"
                            id="nametype">
                            <option value="">اختار النوع</option>
                        </select>
                        @error('type_parent_id')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

</div><!-- End Card Content -->
<!-- Start Card Footer -->
<div class="card-footer">
    <div class="buttons has-addons">
        <a class="button is-info" href="{{ route('admin.groups.index') }}"> الغاء </a>
        <button type="submit" class="button is-success">حفظ</button>
    </div>
</div><!-- End Card Footer -->

<script type="text/javascript">
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $(document).ready(function () {
        var e = document.getElementById("parent_id");
        var strUser = e.value;
        if(strUser!==''){
            $.ajax({
    url:"{{ route('admin.groups.fetch') }}",
    type:"POST",
    data: {
    "_token": "{{ csrf_token() }}",
    type_id: strUser
    },
    success:function (data) {
    $('#nametype').empty();
    $('#nametype').append('<option value="'+data.grouptypes.id+'">'+data.grouptypes.name+'</option>');
    }
    });
        }
    $('#parent_id').on('click',function(e) {
    var type_id = e.target.value;
    if(type_id===''){
         $('#nametype').empty();
         $('#nametype').append('<option value="">لا يوجد صنف</option>');
         }else{
    $.ajax({
    url:"{{ route('admin.groups.fetch') }}",
    type:"POST",
    data: {
    "_token": "{{ csrf_token() }}",
    type_id: type_id
    },
    success:function (data) {

    $('#nametype').empty();
    $('#nametype').append('<option value="'+data.grouptypes.id+'">'+data.grouptypes.name+'</option>');
    /*$.each(data.grouptypes,function(index,grouptype){
     $('#nametype').append('<option value="'+grouptype.id+'">'+grouptype.name+'</option>');
    });*/
    }
    });}
    });
    });
</script>
