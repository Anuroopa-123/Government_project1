@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Job Applications</h2>
    <table 
        class="table table-striped"
        data-toggle="table"
        data-filter-control="true"
        data-pagination="true"
        data-page-size="10"
        data-sort-reset="true"
    >
        <thead>
            <tr>
                <th data-field="id" data-sortable="true" data-filter-control="input" data-filter-control-placeholder="Enter ID">ID</th>
                <th data-field="role" data-sortable="true" data-filter-control="select" data-filter-control-placeholder="Select Role">Role</th>
                <th data-field="name" data-sortable="true" data-filter-control="input" data-filter-control-placeholder="Enter Name">Name</th>
                <th data-field="email" data-sortable="true" data-filter-control="input" data-filter-control-placeholder="Enter Email">Email</th>
                <th data-field="contact_number" data-sortable="true" data-filter-control="input" data-filter-control-placeholder="Enter Contact">Contact</th>
                <th data-field="resume" data-sortable="false">Resume</th>
                <th data-field="status" data-sortable="true" data-filter-control="select" data-filter-control-placeholder="Select Status" style="min-width: 160px;">Status</th>
                <th data-field="change_status" data-sortable="false">Change Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobApplications as $app)
            <tr>
                <td>{{ $app->id }}</td>
                <td>{{ $app->role }}</td>
                <td>{{ $app->name }}</td>
                <td>{{ $app->email }}</td>
                <td>{{ $app->contact_number }}</td>
                <td class="text-center">
                    <button class="btn btn-transparent" data-bs-toggle="modal" data-bs-target="#resumeModal{{ $app->id }}"><i class="bi bi-eye-fill text-black text-2xl"></i></button>

                    <!-- Modal -->
                    <div class="modal fade" id="resumeModal{{ $app->id }}" tabindex="-1" aria-labelledby="resumeModalLabel{{ $app->id }}" aria-hidden="true">
                      <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="resumeModalLabel{{ $app->id }}">Resume Preview</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body" style="height:80vh;">
                            <iframe 
                                data-src="{{ url("/jobApplications/{$app->id}/resume") }}" 
                                width="100%" 
                                height="100%" 
                                style="border:none;">
                            </iframe>
                          </div>
                        </div>
                      </div>
                    </div>
                </td>
                <td class="text-center">
                    @php
                        $color = match($app->status) {
                            'applied', 'waiting list' => 'badge bg-warning text-dark',
                            'shortlisted' => 'badge bg-success',
                            'rejected' => 'badge bg-danger',
                            default => 'badge bg-secondary'
                        };
                        $label = ucfirst($app->status);
                    @endphp
                    <span class="{{ $color }}">{{ $label }}</span>
                </td>
                <td>
                    <select class="form-select form-select-sm status-select" data-id="{{ $app->id }}">
                        <option value="applied" {{ $app->status == 'applied' ? 'selected' : '' }}>Applied</option>
                        <option value="waiting list" {{ $app->status == 'waiting list' ? 'selected' : '' }}>Waiting List</option>
                        <option value="shortlisted" {{ $app->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                        <option value="rejected" {{ $app->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('styles')
<style>
    th .filter-control, 
    td .filter-control {
        min-width: 200px !important;
        width: 100% !important;
        padding-left: 10px;
        padding-right: 10px;
        box-sizing: border-box;
    }
    th {
        text-align: center !important;
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = document.querySelector('table[data-toggle="table"]');
    table.addEventListener('change', function(e) {
        if (e.target.classList.contains('status-select')) {
            const id = e.target.dataset.id;
            const status = e.target.value;
            fetch(`/jobApplications/${id}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    const badge = e.target.closest('tr').querySelector('td:nth-child(7) span');
                    let color = 'badge bg-secondary', label = status.charAt(0).toUpperCase() + status.slice(1);
                    if (status === 'applied' || status === 'waiting list') color = 'badge bg-warning text-dark';
                    if (status === 'shortlisted') color = 'badge bg-success';
                    if (status === 'rejected') color = 'badge bg-danger';
                    badge.className = color;
                    badge.textContent = label;
                } else {
                    alert('Status update failed');
                }
            });
        }
    });

    // Use event delegation for modal events
    document.addEventListener('show.bs.modal', function (event) {
        const modal = event.target;
        const iframe = modal.querySelector('iframe');
        if (iframe && !iframe.src) {
            iframe.src = iframe.getAttribute('data-src');
        }
    });

    document.addEventListener('hidden.bs.modal', function (event) {
        const modal = event.target;
        const iframe = modal.querySelector('iframe');
        if (iframe) {
            iframe.src = '';
        }
    });
});
</script>
@endsection