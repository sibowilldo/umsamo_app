{{-- List Widget 1 --}}

    <div class="card card-custom {{ @$class }}">
        {{-- Header --}}
        <div class="card-header border-0">
            <h3 class="card-title font-weight-bolder text-dark">Recent Comments</h3>
        </div>
        {{-- Body --}}
        <div class="card-body pt-0">
            @forelse($comments as $comment)
            <!--begin::Item-->
            <div class="d-flex align-items-center mb-9 bg-light-{{$comment->status->color}} rounded p-5">
                <!--begin::Icon-->
                <span class="svg-icon svg-icon-warning mr-5">
                    {{ Metronic::getSVG("media/svg/icons/Communication/Chat5.svg", "svg-icon-lg svg-icon-primary") }}
                </span>
                <!--end::Icon-->

                <!--begin::Title-->
                <div class="d-flex flex-column flex-grow-1 mr-2">
                    <p class="font-weight-bold text-dark-75 font-size-sm mb-1">{{ Str::substr($comment->body, 0, 80) . '...'}}</p>
                    <span class="text-muted font-weight-bold">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <!--end::Title-->

                <!--begin::Lable-->
                <a href="{{ route('appointments.show', $comment->appointment->uuid) }}" class="btn btn-sm btn-icon btn-light">
                    {{ Metronic::getSVG("media/svg/icons/Navigation/Right-2.svg", "svg-icon-lg svg-icon-primary") }}
                </a>
                <!--end::Lable-->
            </div>
            <!--end::Item-->
            @empty
                <div class="card card-stretch border-0 mb-8 mb-lg-0">
                        <div class="card-body">
                            <div class="d-flex flex-column justify-content-around min-h-350px align-items-center p-5">
                                <div class="mr-6">
                                    <span class="svg-icon svg-icon-info svg-icon-8x">
                                     {{ Metronic::getSVG("media/svg/icons/Communication/Chat-error.svg") }}
                                    </span>
                                </div>
                                <div class="d-flex flex-column text-center">
                                    <h4 class="text-dark font-weight-boldest font-size-h4 mb-3">
                                        You don't have any comments
                                    </h4>
                                    <div class="text-muted">
                                        This is where your most recent comments will appear,
                                        <br> both from you and from us.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforelse
        </div>
        <!--end::Body-->
    </div>
