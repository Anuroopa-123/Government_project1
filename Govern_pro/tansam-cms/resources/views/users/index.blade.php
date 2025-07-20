@extends('layouts.app')

@section('content')
<div class="container">
    <div class="top-section d-flex justify-content-between pt-3 pb-3">
        <h2>Users</h2>
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add New</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Users</th>
                <th class="text-center" style="width: 100px;">Actions</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
        @foreach($users as $user)
            <tr>
                <td>
                    {{ $user->email }}
                </td>
                <td class="text-center">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn me-2" title="Edit">
                        <i class="bi bi-pencil-square text-red-600"></i>
                    </a>
                    <button class="delete-btn btn p-0" data-id="{{ $user->id }}" title="Delete" style="background: none; border: none;">
                        <i class="bi bi-trash3-fill text-danger"></i>
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
            fetch(`/entrepreneurship/delete/${this.dataset.id}`, {
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