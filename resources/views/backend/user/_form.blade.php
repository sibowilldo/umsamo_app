@csrf
@include('layout.forms.errors')
<div class="form-group row">
    <label class="col-form-label text-right col-lg-3 col-sm-12">Title *</label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        {{ Form::text('title', null, ['class'=>'form-control', 'placeholder' => '']) }}
    </div>
</div>

<div class="form-group row">
    <label class="col-form-label text-right col-lg-3 col-sm-12">Description </label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        {{ Form::textarea('description', null, ['class' =>'form-control', 'rows'=>3]) }}
    </div>
</div>

<div class="form-group row">
    <label class="col-form-label text-right col-lg-3 col-sm-12">Model Type *</label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        {{ Form::select('model_type', $model_types, null, ['class'=>'form-control', 'placeholder' => 'Please select a model type']) }}
    </div>
</div>

<div class="form-group row">
    <label class="col-form-label text-right col-lg-3 col-sm-12" for="is_active">Enable </label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        @if(isset($status))
            <input type="checkbox" name="is_active" id="is_active" {{$status->is_active?'checked':''}} data-switch="true" data-on-text="Enabled" data-off-text="Disabled" data-on-color="primary" />
        @else
            <input type="checkbox" name="is_active" id="is_active" checked="{{old('is_active')?:'checked'}}" data-switch="true" data-on-text="Enabled" data-off-text="Disabled" data-on-color="primary" />
        @endif
    </div>
</div>
