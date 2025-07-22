@extends('layouts.app')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container py-4">
    <h4 class="mb-5">Edit Job</h4>
    <form method="POST" action="{{ route('jobs.edit', $job->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label class="form-label fw-bold">Role *</label>
            <input name="role" value="{{ old('role', $job->role) }}" required class="form-control">
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Posted On *</label>
                <input name="posted_on" type="date" value="{{ old('posted_on', $job->posted_on) }}" required class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Type *</label>
                <select name="type" class="form-control" required>
                    <option value="">-----</option>
                    <option value="Full-Time" {{ old('type', $job->type) == 'Full-Time' ? 'selected' : '' }}>Full-Time</option>
                    <option value="Part-Time" {{ old('type', $job->type) == 'Part-Time' ? 'selected' : '' }}>Part-Time</option>
                    <option value="Contract" {{ old('type', $job->type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                    <option value="Internship" {{ old('type', $job->type) == 'Internship' ? 'selected' : '' }}>Internship</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Description *</label>
            <x-forms.tinymce-editor content="{{ $job->description }}"/>
        </div>
        <div class="published d-flex align-items-center justify-content-center mb-4" style="gap: 1rem;">
            <span class="fw-bold" style="font-size: 1.1rem;">
                Published
                <span id="publish-status" class="ms-2 {{ $job->is_published ? 'text-success' : 'text-secondary' }}" style="font-size: 1rem;">
                    {{ $job->is_published ? '(Active)' : '(Inactive)' }}
                </span>
            </span>
            <label class="relative inline-flex items-center cursor-pointer" style="vertical-align: middle;">
                <input type="checkbox" name="is_published" value="1" class="sr-only peer" id="is_published_checkbox" {{ old('is_published', $job->is_published) ? 'checked' : '' }}>
                <div class="group peer ring-0 bg-rose-400 rounded-full
                    outline-none duration-300 after:duration-300 w-12 h-6
                    shadow-md peer-checked:bg-emerald-500 peer-focus:outline-none after:content-['✖️'] after:rounded-full
                    after:absolute after:bg-gray-50 after:outline-none after:h-5 after:w-5
                    after:top-0.5 after:left-0.5 after:flex after:justify-center after:items-center
                    after:text-[10px] peer-checked:after:translate-x-6 peer-checked:after:content-['✔️'] peer-hover:after:scale-95">
                </div>
            </label>
        </div>
        <div class="d-flex gap-2 justify-content-center">
            <button class="btn btn-success">Save</button>
            <a href="{{ route('jobs.list') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.getElementById('is_published_checkbox');
    const status = document.getElementById('publish-status');
    function updateStatus() {
        status.textContent = checkbox.checked ? '(Active)' : '(Inactive)';
        status.className = checkbox.checked ? 'ms-2 text-success' : 'ms-2 text-secondary';
    }
    checkbox.addEventListener('change', updateStatus);
    updateStatus();
  });
</script>
@endsection