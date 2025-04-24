
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Date</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Status</th>
        <th>Action Taken</th>
    </tr>
    </thead>
    <tbody>
    @foreach($logs as $log)
        <tr>
            <td>{{ $log->date }}</td>
            <td>{{ $log->startTime }}</td>
            <td>{{ $log->endTime }}</td>
            <td>
                    <span class="badge badge-{{ $log->emergencyStatus == 'critical' ? 'danger' : ($log->emergencyStatus == 'ongoing' ? 'warning' : 'success') }}">
                        {{ ucfirst($log->emergencyStatus) }}
                    </span>
            </td>
            <td>{{ $log->action }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
