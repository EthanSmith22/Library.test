@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Author Name</label>
        <input type="text" name="name" value="{{ old('name', $author->name ?? '') }}" class="form-control @error('name') is-invalid @enderror">
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Date of Birth</label>
        <input type="date" name="dob" value="{{ old('dob', $author->dob ?? '') }}" class="form-control @error('dob') is-invalid @enderror">
        @error('dob') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $author->description ?? '') }}</textarea>
        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>