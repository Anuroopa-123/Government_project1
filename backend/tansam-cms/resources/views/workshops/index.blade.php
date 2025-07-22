@extends('layouts.app')

@section('content')
<div class="container">
    <div class="top-section d-flex justify-content-between align-items-center pt-3 pb-3">
        <div>
            <h2 class="mb-0">Workshops</h2>
            <div class="text-muted" style="font-size: 1rem;">Manage all workshops from here.</div>
        </div>
        <a href="{{ route('workshops.create') }}" class="btn btn-primary mb-3 d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle" style="font-size: 1.2rem;"></i> Add New
        </a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-striped table-bordered align-middle">
        <thead>
            <tr>
                <th class="align-middle">Workshop</th>
                <th class="align-middle">Video</th> 
                <th style="width: 80px;" class="align-middle text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($workshops as $workshop)
            <tr>
                <td class="align-middle">
                    <a href="{{ route('workshops.editForm', $workshop->id) }}"
                       class="text-decoration-none fw-semibold"
                       style="color:var(--tansam-bg); font-size:1.08rem;">
                        Workshop - {{ $workshop->id }}
                    </a>
                </td>
                      
        <!-- Add this Video column -->
        <td class="align-middle text-center">
          @if($workshop->video)
    <video width="320" height="240" controls>
        <source src="{{ asset($workshop->video) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
@else
    No video
@endif

        </td>
                <td class="align-middle text-center">
                    <button class="delete-btn btn btn-link p-0" data-id="{{ $workshop->id }}" title="Delete" style="color: red;">
                        <i class="bi bi-trash3-fill" style="font-size:1.2rem;"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        if(confirm('Are you sure you want to delete?')) {
            fetch(`/workshops/delete/${this.dataset.id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    location.reload();
                } else {
                    alert('Delete failed');
                }
            });
        }
    });
});
</script>
@endsection