<table>
    <tr>
        @foreach ($options as $option)
            <td>{{ $option }}</td>
        @endforeach
    </tr>
    @foreach ($data as $item)
        <tr>
            @foreach ($item as $value)
                <td>{{ $value }}</td>
            @endforeach
        </tr>
    @endforeach
</table>