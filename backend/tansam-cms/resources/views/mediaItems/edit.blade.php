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
    <h4 class="mb-5">Edit Media Item</h4>
    <form method="POST" action="{{ route('mediaItems.edit', $mediaItem->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label class="form-label fw-bold">Title *</label>
            <input name="title" type="text" value="{{ old('title', $mediaItem->title) }}" required class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Category *</label>
            <select name="category" class="form-control" required>
                <option value="">-----</option>
                <option value="Events" {{ old('category',$mediaItem->category) == 'Events' ? 'selected' : '' }}>Events</option>
                <option value="Print Media" {{ old('category',$mediaItem->category) == 'Print Media' ? 'selected' : '' }}>Print Media</option>
                <option value="LinkedIn" {{ old('category',$mediaItem->category) == 'LinkedIn' ? 'selected' : '' }}>LinkedIn</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Image (Supported Types: JPG, PNG, JPEG, GIF)</label>
            <input type="file" name="image" class="form-control">
            <div class="form-text">Leave blank to keep current image.
                @if($mediaItem->image)
                    <a href="{{ asset($mediaItem->image) }}" target="_blank" rel="noopener" class="link-primary text-decoration-underline">
                        View current image
                    </a>
                @endif
            </div>
        </div>
        <div class="published d-flex align-items-center justify-content-center mb-4" style="gap: 1rem;">
            <span class="fw-bold" style="font-size: 1.1rem;">
                Published
                <span id="publish-status" class="ms-2 {{ $mediaItem->is_published ? 'text-success' : 'text-secondary' }}" style="font-size: 1rem;">
                    {{ $mediaItem->is_published ? '(Active)' : '(Inactive)' }}
                </span>
            </span>
            <label class="relative inline-flex items-center cursor-pointer" style="vertical-align: middle;">
                <input type="checkbox" name="is_published" value="1" class="sr-only peer" id="is_published_checkbox" {{ old('is_published', $mediaItem->is_published) ? 'checked' : '' }}>
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
            <a href="{{ route('mediaItems.list') }}" class="btn btn-secondary">Cancel</a>
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