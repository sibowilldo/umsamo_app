@php
	$direction = config('layout.extras.user.offcanvas.direction', 'right');
@endphp
 {{-- User Panel --}}
<div id="kt_quick_user" class="offcanvas offcanvas-{{ $direction }} p-10">
	{{-- Header --}}
	<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
		<h3 class="font-weight-bold m-0">
			User Profile
		</h3>
		<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
			<i class="ki ki-close icon-xs text-muted"></i>
		</a>
	</div>

	{{-- Content --}}
    <div class="offcanvas-content pr-5 mr-n5">
		{{-- Header --}}
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                @if(!Auth::user()->profile)
                    <img src="{{ Avatar::create(Auth::user()->email)->toBase64() }}" alt="" class="symbol-label">
                @else
                    <div class="symbol-label" style="background-image:url('{{ Auth::user()->profile->avatar }}')"></div>
                @endif
				<i class="symbol-badge bg-success"></i>
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
                    {{Auth::user()->profile->full_name }}
				</a>
                <div class="text-muted mt-1">
                    {{Auth::user()->profile->cell_number }}
                </div>
                <div class="navi mt-2">
                    <a href="#" class="navi-item">
                        <span class="navi-link p-0 pb-2">
                            <span class="navi-icon mr-1">
								{{ Metronic::getSVG("media/svg/icons/Communication/Mail-notification.svg", "svg-icon-lg svg-icon-primary") }}
							</span>
                            <span class="navi-text text-muted text-hover-primary">{{ Auth::user()->email }}</span>
                        </span>
                    </a>
                    <a class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </div>
            </div>
        </div>

		{{-- Separator --}}
		<div class="separator separator-dashed mt-8 mb-5"></div>

		{{-- Nav --}}
		<div class="navi navi-spacer-x-0 p-0">
		    {{-- Item --}}
		    <a href="#" class="navi-item">
		        <div class="navi-link">
		            <div class="symbol symbol-40 bg-light mr-3">
		                <div class="symbol-label">
							{{ Metronic::getSVG("media/svg/icons/General/Notification2.svg", "svg-icon-md svg-icon-success") }}
						</div>
		            </div>
		            <div class="navi-text">
		                <div class="font-weight-bold">
		                    My Profile
		                </div>
		                <div class="text-muted">
		                    Account settings and more
		                </div>
		            </div>
		        </div>
		    </a>

		    {{-- Item --}}
		    <a href="#"  class="navi-item">
		        <div class="navi-link">
					<div class="symbol symbol-40 bg-light mr-3">
						<div class="symbol-label">
 						   {{ Metronic::getSVG("media/svg/icons/Shopping/Chart-bar1.svg", "svg-icon-md svg-icon-warning") }}
 					   </div>
				   	</div>
		            <div class="navi-text">
		                <div class="font-weight-bold">
		                    My Comments
		                </div>
		            </div>
		        </div>
		    </a>

		    {{-- Item --}}
		    <a href="#"  class="navi-item">
		        <div class="navi-link">
					<div class="symbol symbol-40 bg-light mr-3">
						<div class="symbol-label">
							{{ Metronic::getSVG("media/svg/icons/Files/Selected-file.svg", "svg-icon-md svg-icon-danger") }}
						</div>
				   	</div>
		            <div class="navi-text">
		                <div class="font-weight-bold">
		                    My Appointments
		                </div>
		            </div>
		        </div>
		    </a>
		</div>
    </div>
</div>
