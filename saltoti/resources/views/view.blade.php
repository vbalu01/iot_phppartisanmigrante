<div>
    <table style="border: 1px solid black;">
        <tr>
            <th>
                Üzem azonosító
            </th>
            <th>
                Üzem név
            </th>
        </tr>
        @foreach ($data as $row)
            <tr>
                <td>
                    {{ $row->ID }}
                </td>
                <td>
                    <a href="/uzem/{{ $row->ID }}/0">{{ $row->name }}</a>
                </td>
            </tr>
        @endforeach
    </table>
</div>
