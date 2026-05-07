@if ($errors->any())
    <div class="alert alert-danger border-0 shadow-sm">
        <p class="fw-semibold mb-2">Please fix the following errors:</p>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label fw-semibold">Stand Code</label>
        <input
            type="text"
            name="code"
            value="{{ old('code', $bookStand->code ?? '') }}"
            class="form-control @error('code') is-invalid @enderror"
            placeholder="Example: A-01"
        >
        @error('code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Floor</label>
        <input
            type="text"
            name="floor"
            value="{{ old('floor', $bookStand->floor ?? '') }}"
            class="form-control @error('floor') is-invalid @enderror"
            placeholder="Example: Ground Floor"
        >
        @error('floor')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Section</label>
        <select name="section" class="form-select @error('section') is-invalid @enderror">
            <option value="">Select Section</option>
    
            @foreach($genres as $genre)
                <option value="{{ $genre->name }}"
                    @selected(old('section', $bookStand->section ?? '') == $genre->name)>
                    {{ $genre->name }}
                </option>
            @endforeach
        </select>
    
        @error('section')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea
            name="description"
            rows="4"
            class="form-control @error('description') is-invalid @enderror"
            placeholder="Optional note about this stand location"
        >{{ old('description', $bookStand->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>