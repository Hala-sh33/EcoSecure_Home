<table class="table table-bordered">
    <thead>
    <tr>
        <th>Start Timestamp</th>
        <th>End Timestamp</th>
        <th>Consumption (kWh)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($logs as $log)
        <tr>
            <td>{{ $log->startStamp }}</td>
            <td>{{ $log->endStamp }}</td>
            <td><span class="badge badge-info">{{ $log->consumption }} kWh</span></td>
        </tr>
    @endforeach
    </tbody>
</table>
