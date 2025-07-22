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

<h4 class="mb-5">Add Entrepreneurship Event</h4>
<form method="POST" action="{{ route('entrepreneurship.add') }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Course image * (Supported Types: JPG, PNG, JPEG, GIF)</label>
            <input type="file" name="course_image" class="form-control" required placeholder="Upload course image">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Course title *</label>
            <input name="course_title" value="{{ old('course_title') }}" required class="form-control" placeholder="Enter course title">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Course lab *</label>
            <select name="course_lab" required class="form-control">
                <option value="">Select Lab</option>
                <option value="Innovative Manufacturing" {{ old('course_lab') == 'Innovative Manufacturing' ? 'selected' : '' }}>Innovative Manufacturing</option>
                <option value="Product Innovation Center" {{ old('course_lab') == 'Product Innovation Center' ? 'selected' : '' }}>Product Innovation Center</option>
                <option value="Predictive Engineering" {{ old('course_lab') == 'Predictive Engineering' ? 'selected' : '' }}>Predictive Engineering</option>
                <option value="Smart Factory Center" {{ old('course_lab') == 'Smart Factory Center' ? 'selected' : '' }}>Smart Factory Center</option>
                <option value="AR | VR | MR Research Centre" {{ old('course_lab') == 'AR | VR | MR Research Centre' ? 'selected' : '' }}>AR | VR | MR Research Centre</option>
                <option value="Research Centre For PLM" {{ old('course_lab') == 'Research Centre For PLM' ? 'selected' : '' }}>Research Centre For PLM</option>
                <option value="Research Centre For Asset Performance" {{ old('course_lab') == 'Research Centre For Asset Performance' ? 'selected' : '' }}>Research Centre For Asset Performance</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Start date *</label>
            <input name="start_date" type="date" value="{{ old('start_date') }}" required class="form-control" placeholder="dd-mm-yyyy">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">From time *</label>
            <input name="from_time" type="time" value="{{ old('from_time') }}" required class="form-control" placeholder="Start time">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">To time *</label>
            <input name="to_time" type="time" value="{{ old('to_time') }}" required class="form-control" placeholder="End time">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Mode *</label>
        <select name="mode" required class="form-control">
            <option value="">Select Mode</option>
            <option value="Offline" {{ old('mode') == 'Offline' ? 'selected' : '' }}>Offline</option>
            <option value="Online" {{ old('mode') == 'Online' ? 'selected' : '' }}>Online</option>
        </select>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <label class="form-label fw-bold">Contact person *</label>
            <input name="contact_person" value="{{ old('contact_person') }}" required class="form-control" placeholder="Contact person name">
        </div>
        <div class="col-md-6 mb-4">
            <label class="form-label fw-bold">Contact mail *</label>
            <input name="contact_mail" type="email" value="{{ old('contact_mail') }}" required class="form-control" placeholder="Contact email">
        </div>
    </div>
 
    <div class="published d-flex align-items-center justify-content-center mb-4" style="gap: 1rem;">
        <span class="fw-bold" style="font-size: 1.1rem;">
            Published
            <span id="publish-status" class="ms-2 text-secondary" style="font-size: 1rem;">(Inactive)</span>
        </span>
        <label class="relative inline-flex items-center cursor-pointer" style="vertical-align: middle;">
            <input type="checkbox" name="is_published" value="1" class="sr-only peer" id="is_published_checkbox">
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