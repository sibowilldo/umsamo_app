@csrf
@include('layout.forms.errors')

{{ Form::hidden('item_id', 1) }}

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
    <label class="col-form-label text-right col-lg-3 col-sm-12">Status</label>
    <div class="col-lg-9 col-md-9 col-sm-12">
        {{ Form::select('status_id', $statuses, [7], ['class'=>'form-control selectpicker']) }}
    </div>
</div>


<div class="separator separator-dashed my-8"></div>
<div>
    <div class="form-group row">
        <label class="col-form-label text-right col-lg-3 col-sm-12">Dates:</label>
        <div class="col-lg-9" id="event_dates_repeater">
            <div  class="form-group row align-items-center event-date-group">
                <div class="col-md-6">
                    <input type="text" class="form-control event-date-time datetimepicker" name="event_date[0][date_time]" data-pattern-name="event_date[++][date_time]" autocomplete="off" placeholder="Select a Date" />
                    <div class="d-md-none mb-2"></div>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control event-date-time" name="event_date[0][limit]" data-pattern-name="event_date[++][limit]" autocomplete="off" placeholder="Limit" />
                    <div class="d-md-none mb-2"></div>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-sm font-weight-bolder btn-light-danger btn-icon r-btnRemove">
                        <i class="flaticon2-trash"></i></button>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <button type="button" class="r-btnAdd btn btn-sm font-weight-bolder btn-light-primary">
                        <i class="flaticon2-add"></i>Add More</button>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-9 col-md-9 col-sm-12 offset-lg-3 offset-md-3">
            <label class="checkbox">
                <input type="checkbox" name="auto_select_dates"/> Auto Select Days
                <span></span>
            </label>
            <span class="form-text text-muted">Choosing this option will auto select the same days of the month based on the FIRST date selection you made above</span>
        </div>
    </div>
</div>
