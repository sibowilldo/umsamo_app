@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <script>
            $.notify("{!! $message['message'] !!}", {
                type: "{{ $message['level'] }}",
                allow_dismiss: true,
                mouse_over:  true,
                placement: {
                    from: 'top',
                    align: 'center'
                },
                z_index: 10000,
                animate: {
                    enter: 'animated flipInX',
                    exit: 'animated flipOutX'
                }
            });
        </script>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
