<div class="row">
    @foreach($events as $event)
        <div class="col-lg-6 col-xxl-4">
            <form action="{{ route('appointments.store') }}" method="post" class="rounded">
                @csrf
                <input type="hidden" name="_self" value="{{ Auth::user()->uuid }}">
                <div class="card card-custom bg-diagonal card-stretch gutter-b border-left-{{$event->status->color}}" style="border-left-width: 3px">
                    {{-- Body --}}
                    <div class="card-body d-flex flex-column p-0">
                        <div class="d-flex align-items-stretch justify-content-between card-spacer flex-grow-1">
                            <div class="d-flex flex-column flex-grow-1 ">
                                <div class="d-flex align-items-center">
                        <span class="svg-icon svg-icon-primary svg-icon-4x mr-5">
                            <svg height="512" viewBox="0 0 64 64" width="512" xmlns="http://www.w3.org/2000/svg"><g id="Calendar"><path d="m57 9h-6v3a3 3 0 0 1 -6 0v-3h-10v3a3 3 0 0 1 -6 0v-3h-10v3a3 3 0 0 1 -6 0v-3h-6a4 4 0 0 0 -4 4v8h58v-8a4 4 0 0 0 -4-4z" fill="#9bc9ff"/><rect fill="#9bc9ff" height="5" rx="1" width="6" x="23" y="28"/><rect fill="#9bc9ff" height="5" rx="1" width="6" x="11" y="28"/><rect fill="#9bc9ff" height="5" rx="1" width="6" x="47" y="28"/><rect fill="#9bc9ff" height="5" rx="1" width="6" x="23" y="37"/><rect fill="#9bc9ff" height="5" rx="1" width="6" x="11" y="37"/><rect fill="#9bc9ff" height="5" rx="1" width="6" x="23" y="46"/><rect fill="#9bc9ff" height="5" rx="1" width="6" x="35" y="28"/><rect fill="#9bc9ff" height="5" rx="1" width="6" x="35" y="37"/><rect fill="#9bc9ff" height="5" rx="1" width="6" x="11" y="46"/><g fill="#1ece81"><path d="m57 8h-5v-2a4 4 0 0 0 -8 0v2h-8v-2a4 4 0 0 0 -8 0v2h-8v-2a4 4 0 0 0 -8 0v2h-5a5 5 0 0 0 -5 5v40a5 5 0 0 0 5 5h28a1 1 0 0 0 0-2h-28a3.009 3.009 0 0 1 -3-3v-31h56v17a1 1 0 0 0 2 0v-26a5 5 0 0 0 -5-5zm-11-2a2 2 0 0 1 4 0v6a2 2 0 0 1 -4 0zm-16 0a2 2 0 0 1 4 0v6a2 2 0 0 1 -4 0zm-16 0a2 2 0 0 1 4 0v6a2 2 0 0 1 -4 0zm46 14h-56v-7a3.009 3.009 0 0 1 3-3h5v2a4 4 0 0 0 8 0v-2h8v2a4 4 0 0 0 8 0v-2h8v2a4 4 0 0 0 8 0v-2h5a3.009 3.009 0 0 1 3 3z"/><path d="m30 29a2 2 0 0 0 -2-2h-4a2 2 0 0 0 -2 2v3a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2zm-6 3v-3h4v3z"/><path d="m18 29a2 2 0 0 0 -2-2h-4a2 2 0 0 0 -2 2v3a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2zm-6 3v-3h4v3z"/><path d="m52 34a2 2 0 0 0 2-2v-3a2 2 0 0 0 -2-2h-4a2 2 0 0 0 -2 2v3a2 2 0 0 0 2 2zm-4-5h4v3h-4z"/><path d="m30 38a2 2 0 0 0 -2-2h-4a2 2 0 0 0 -2 2v3a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2zm-6 3v-3h4v3z"/><path d="m18 38a2 2 0 0 0 -2-2h-4a2 2 0 0 0 -2 2v3a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2zm-6 3v-3h4v3z"/><path d="m28 45h-4a2 2 0 0 0 -2 2v3a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-3a2 2 0 0 0 -2-2zm-4 5v-3h4v3z"/><path d="m36 34h4a2 2 0 0 0 2-2v-3a2 2 0 0 0 -2-2h-4a2 2 0 0 0 -2 2v3a2 2 0 0 0 2 2zm0-5h4v3h-4z"/><path d="m34 41a2 2 0 0 0 2 2 1 1 0 0 0 0-2v-3h4a1 1 0 0 0 0-2h-4a2 2 0 0 0 -2 2z"/><path d="m16 45h-4a2 2 0 0 0 -2 2v3a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-3a2 2 0 0 0 -2-2zm-4 5v-3h4v3z"/><path d="m49 36a13 13 0 1 0 13 13 13.015 13.015 0 0 0 -13-13zm0 24a11 11 0 1 1 11-11 11.013 11.013 0 0 1 -11 11z"/><path d="m54.778 44.808-7.778 7.778-3.535-3.536a1 1 0 0 0 -1.414 1.414l4.242 4.243a1 1 0 0 0 1.414 0l8.485-8.485a1 1 0 0 0 -1.414-1.414z"/></g></g></svg>
                        </span>
                                    {{--                        <div class="flaticon2-calendar-9 icon-3x text-primary mr-5"></div>--}}
                                    <div class="d-flex flex-column">
                                        <a href="#" class="font-weight-bolder font-size-h5">{{$event->title}}</a>
                                        <span class="text-dark-50 font-weight-bold mt-1">
                            <span class="label label-dot label-{{$event->status->color}}"></span> {{$event->status->title}}
                                    </div>
                                </div>
                                <div class="mt-10">
                                    <div class="d-flex justify-content-around">
                                        <div class="flex-fill mr-2">
                                            <p class="font-weight-bolder">Selected Date</p>
                                            <select name="event_date" id="event_date_{{ $event->id }}" class="form-control kt-selectpicker" title="Pick a Date" data-id="{{ $event->id }}">
                                                @foreach($event_dates->where('event_id', $event->id) as $event_date)
                                                    <option value="{{$event_date->id}}" data-limit="{{$event_date->limit}}">{{ $event_date->date_time->format('D, d M Y') }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="flex-fill ml-2">
                                            <p class="font-weight-bolder">Selected Type</p>
                                            <select name="appointment_type" id="appointment_type_{{ $event->id }}" class="form-control kt-selectpicker">
                                                @foreach($appointment_types as $appointment_type)
                                                    <option value="{{$appointment_type}}">{{ $appointment_type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-top-0 zindex-2 pt-0">
                        <div class="row">
                            <div class="col-sm-6">
                            </div>

                            <div class="col-sm-6 text-lg-right">
                                <button data-id="{{ $event->id }}" class="btn btn-light-primary font-weight-bold btn-make-appointment" type="submit">Make Appointment</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endforeach
</div>
