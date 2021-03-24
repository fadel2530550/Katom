<!-- Start Card Content -->
<div class="card-content">
  <div class="field is-horizontal">
      <div class="field-label is-normal">
          <label class="label required"> نوع الصنف </label>
      </div>
      <div class="field-body">
          <div class="field">
              <div class="control">
                  {!! Form::text('name', null, ['class' => 'input', 'required']) !!}
              </div>
          </div>
      </div>
  </div>
  <hr />
  <div class="field is-horizontal">
      <div class="field-label is-normal">
          <label class="label required">الصنف الفرعي</label>
      </div>
      <div class="field-body">
          <div class="field">
              <div class="control">
                  <div class="select is-width">
                    <select name="parent_id" class="form-control @error('parent_id')is-invalid @enderror" id="parent" >
                        <option value="">لا يوجد تصنيف</option>
                        @foreach (App\Models\GroupTypes::whereNull('parent_id')->get() as $gy)
                      <option {{($gy->id == $group_type->parent_id)?'selected':''}} value="{{$gy->id}}">{{$gy->name}}</option>
                        @endforeach
                    </select>
                        @error('parent_id')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                  </div>
              </div>
          </div>
      </div>
  </div>
  <hr />
</div><!-- End Card Content -->
<!-- Start Card Footer -->
<div class="card-footer">
  <div class="buttons has-addons">
      <a class="button is-info" href="{{ route('admin.group_types.index') }}"> الغاء </a>
      <button type="submit" class="button is-success">حفظ</button>
  </div>
</div><!-- End Card Footer -->
