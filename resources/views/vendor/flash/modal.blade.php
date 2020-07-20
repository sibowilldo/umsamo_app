<script>
    let content = {};
    content.title = "{!! $message['title'] !!}",
    content.message = "{!! $message['message'] !!}",

    $.notify(content, {
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
