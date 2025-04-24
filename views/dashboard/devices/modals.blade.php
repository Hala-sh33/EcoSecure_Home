<!-- Emergency Entity Modal -->
<div class="modal fade" id="emergencyEntityModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Emergency Entity</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="emergencyEntityForm">
                    <input type="hidden" name="inventoryDeviceID" id="emergencyEntityDeviceID">
                    <div class="form-group">
                        <label>Emergency Contact Type</label>
                        <select class="form-control" name="emergencyContactType" id="emergencyContactType" required onchange="toggleUserChoice()">
                            <option value="">-- Select --</option>
                            <option value="police">Police</option>
                            <option value="civil_defense">Civil Defense</option>
                            <option value="user_choice">User Choice</option>
                        </select>
                    </div>

                    <div class="form-group" id="userChoiceContainer" style="display: none;">
                        <label>Select Member</label>
                        <select class="form-control" name="emergencyContactUser">
                            <option value="">-- Select Member --</option>
{{--                            @foreach($members as $member)--}}
{{--                                <option value="{{ $member->userName }}">{{ $member->userName }}</option>--}}
{{--                            @endforeach--}}
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Emergency Name</label>
                        <input type="text" class="form-control" name="emergencyName" required>
                    </div>
                    <div class="form-group">
                        <label>Emergency Description</label>
                        <textarea class="form-control" name="emergencyDescription" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Emergency Contact</label>
                        <input type="text" class="form-control" name="emergencyContact" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Emergency Incident Modal -->
<div class="modal fade" id="emergencyIncidentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Emergency Incident</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="emergencyIncidentForm">
                    <input type="hidden" name="inventoryDeviceID" id="emergencyIncidentDeviceID">
                    <div class="form-group">
                        <label>Incident Date</label>
                        <input type="date" class="form-control" name="date" required>
                    </div>
                    <div class="form-group">
                        <label>Start Time</label>
                        <input type="time" class="form-control" name="startTime" required>
                    </div>
                    <div class="form-group">
                        <label>End Time</label>
                        <input type="time" class="form-control" name="endTime" required>
                    </div>
                    <div class="form-group">
                        <label>Incident Status</label>
                        <select class="form-control" name="emergencyStatus" required>
                            <option value="resolved">Resolved</option>
                            <option value="ongoing">Ongoing</option>
                            <option value="critical">Critical</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Action Taken</label>
                        <textarea class="form-control" name="action" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Consumption Log Modal -->
<div class="modal fade" id="consumptionLogModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Consumption Log</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="consumptionLogForm">
                    <input type="hidden" name="inventoryDeviceID" id="consumptionLogDeviceID">
                    <div class="form-group">
                        <label>Start Timestamp</label>
                        <input type="datetime-local" class="form-control" name="startStamp" required>
                    </div>
                    <div class="form-group">
                        <label>End Timestamp</label>
                        <input type="datetime-local" class="form-control" name="endStamp" required>
                    </div>
                    <div class="form-group">
                        <label>Consumption</label>
                        <input type="number" class="form-control" name="consumption" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
