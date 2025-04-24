
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Emergency Name</th>
        <th>Description</th>
        <th>Contact</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($logs as $log)
        <tr>
            <td>{{ $log->emergencyName }}</td>
            <td>{{ $log->emergencyDescription }}</td>
            <td><span class="badge badge-secondary">{{ $log->emergencyContact }}</span></td>
            <td>
                <button class="btn btn-sm btn-outline-primary" onclick="editEmergencyEntity({{ $log->emergencyID }})">
                    Edit
                </button>
                <button class="btn btn-sm btn-outline-danger" onclick="deleteEmergencyEntity({{ $log->emergencyID }})">
                    Delete
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
