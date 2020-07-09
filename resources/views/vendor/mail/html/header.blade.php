<tr>
<td class="header">
    <table>
        <tr>
            <td>
                <a href="{{ $url }}" style="display: inline-block;">
                    @if (trim($slot) === 'Laravel')
                        <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
                    @else
                        {{ $slot }}
                    @endif
                </a>
            </td>
        </tr>
    </table>

</td>
</tr>
