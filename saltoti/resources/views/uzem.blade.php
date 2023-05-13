<?php
    dd($data);
?>

<div>
    <table>
        <tr>
            <th>
                Kompresszor id
            </th>
            <th>
                Kompresszor név
            </th>
        </tr>
        @foreach ($data['kompresszorok'] as $row)
            <tr>
                <td>{{ $row->ID }}</td>
                <td>{{ $row->name }}</td>
            </tr>
        @endforeach
        </tr>
    </table>
    <tr>
    <table>
        <tr>
            <th>
                Termelőgép id
            </th>
            <th>
                Termelőgép név
            </th>
        </tr>
        @foreach ($data['gepek'] as $row)
            <tr>
                <td>{{ $row->ID }}</td>
                <td>{{ $row->name }}</td>
            </tr>
        @endforeach
        </tr>
    </table>
</div>