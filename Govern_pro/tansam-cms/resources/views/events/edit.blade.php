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

<h4 class="mb-5">Edit Event</h4>
<form method="POST" action="{{ route('events.edit', $event->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Title *</label>
            <input name="title" value="{{ old('title', $event->title) }}" required class="form-control" autocomplete="off">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Category *</label>
            <select name="category" class="form-control" required>
                <option value="">Select Category</option>
                <option value="MoU" {{ old('category', $event->category) == 'MoU' ? 'selected' : '' }}>MoU</option>
                <option value="Official" {{ old('category', $event->category) == 'Official' ? 'selected' : '' }}>Official</option>
                <option value="Industrial Visit" {{ old('category', $event->category) == 'Industrial Visit' ? 'selected' : '' }}>Industrial Visit</option>
                <option value="Naan Mudhalvan" {{ old('category', $event->category) == 'Naan Mudhalvan' ? 'selected' : '' }}>Naan Mudhalvan</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Date *</label>
            <input name="date" type="date" value="{{ old('date', $event->date) }}" required class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Image (Supported Types: JPG, PNG, JPEG, GIF)</label>
            <input type="file" name="image" class="form-control">
            <div class="form-text">Leave blank to keep current image.
                @if($event->image)
                    <a href="{{ asset($event->image) }}" target="_blank" rel="noopener" class="link-primary text-decoration-underline">
                        View current image
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Description *</label>
        <x-forms.tinymce-editor content="{{ $event->description }}"/>
    </div>

    <div class="published d-flex align-items-center justify-content-center mb-4" style="gap: 1rem;">
        <span class="fw-bold" style="font-size: 1.1rem;">
            Published
            <span id="publish-status" class="ms-2 {{ $event->is_published ? 'text-success' : 'text-secondary' }}" style="font-size: 1rem;">
                {{ $event->is_published ? '(Active)' : '(Inactive)' }}
            </span>
        </span>
        <label class="relative inline-flex items-center cursor-pointer" style="vertical-align: middle;">
            <input type="checkbox" name="is_published" value="1" class="sr-only peer" id="is_published_checkbox"
                {{ old('is_published', $event->is_published) ? 'checked' : '' }}>
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
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('events.list') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
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