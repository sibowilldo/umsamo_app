@if ($errors->any())
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible fade show   m-alert m-alert--air" style="border-radius: 0" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            <strong>Error: </strong> {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
