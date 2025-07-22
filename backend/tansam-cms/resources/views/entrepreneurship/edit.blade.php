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

<h4 class="mb-5">Edit Entrepreneurship</h4>
<form method="POST" action="{{ route('entrepreneurship.edit', $entrepreneurship->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Course image * (Supported Types: JPG, PNG, JPEG, GIF)</label>
            <input type="file" name="course_image" class="form-control" accept="image/*">
            <div class="form-text">Leave blank to keep current image.
                @if($entrepreneurship->course_image)
                    <a href="{{ asset($entrepreneurship->course_image) }}" target="_blank" rel="noopener" class="link-primary text-decoration-underline">
                        View current image
                    </a>
                @endif
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Course title *</label>
            <input name="course_title" value="{{ old('course_title', $entrepreneurship->course_title) }}" required class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Course lab *</label>
            <select name="course_lab" required class="form-control">
                <option value="">Select Lab</option>
                <option value="Innovative Manufacturing" {{ old('course_lab', $entrepreneurship->course_lab) == 'Innovative Manufacturing' ? 'selected' : '' }}>Innovative Manufacturing</option>
                <option value="Product Innovation Center" {{ old('course_lab', $entrepreneurship->course_lab) == 'Product Innovation Center' ? 'selected' : '' }}>Product Innovation Center</option>
                <option value="Predictive Engineering" {{ old('course_lab', $entrepreneurship->course_lab) == 'Predictive Engineering' ? 'selected' : '' }}>Predictive Engineering</option>
                <option value="Smart Factory Center" {{ old('course_lab', $entrepreneurship->course_lab) == 'Smart Factory Center' ? 'selected' : '' }}>Smart Factory Center</option>
                <option value="AR | VR | MR Research Centre" {{ old('course_lab', $entrepreneurship->course_lab) == 'AR | VR | MR Research Centre' ? 'selected' : '' }}>AR | VR | MR Research Centre</option>
                <option value="Research Centre For PLM" {{ old('course_lab', $entrepreneurship->course_lab) == 'Research Centre For PLM' ? 'selected' : '' }}>Research Centre For PLM</option>
                <option value="Research Centre For Asset Performance" {{ old('course_lab', $entrepreneurship->course_lab) == 'Research Centre For Asset Performance' ? 'selected' : '' }}>Research Centre For Asset Performance</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Start date *</label>
            <input name="start_date" type="date" value="{{ old('start_date', $entrepreneurship->start_date) }}" required class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">From time *</label>
            <input name="from_time" type="time" value="{{ old('from_time', $entrepreneurship->from_time) }}" required class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">To time *</label>
            <input name="to_time" type="time" value="{{ old('to_time', $entrepreneurship->to_time) }}" required class="form-control">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Mode *</label>
        <select name="mode" required class="form-control">
            <option value="">Select Mode</option>
            <option value="Offline" {{ old('mode', $entrepreneurship->mode) == 'Offline' ? 'selected' : '' }}>Offline</option>
            <option value="Online" {{ old('mode', $entrepreneurship->mode) == 'Online' ? 'selected' : '' }}>Online</option>
        </select>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Contact person *</label>
            <input name="contact_person" value="{{ old('contact_person', $entrepreneurship->contact_person) }}" required class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Contact mail *</label>
            <input name="contact_mail" type="email" value="{{ old('contact_mail', $entrepreneurship->contact_mail) }}" required class="form-control">
        </div>
    </div>

    <div class="published d-flex align-items-center justify-content-center mb-4" style="gap: 1rem;">
        <span class="fw-bold" style="font-size: 1.1rem;">
            Published
            <span id="publish-status" class="ms-2 {{ $entrepreneurship->is_published ? 'text-success' : 'text-secondary' }}" style="font-size: 1rem;">
                {{ $entrepreneurship->is_published ? '(Active)' : '(Inactive)' }}
            </span>
        </span>
        <label class="relative inline-flex items-center cursor-pointer" style="vertical-align: middle;">
            <input type="checkbox" name="is_published" value="1" class="sr-only peer" id="is_published_checkbox"
                {{ $entrepreneurship->is_published ? 'checked' : '' }}>
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
        <a href="{{ route('entrepreneurship.list') }}" class="btn btn-secondary">Cancel</a>
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