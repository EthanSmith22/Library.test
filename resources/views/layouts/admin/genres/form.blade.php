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

    <div class="col-12">

        <label class="form-label">
            Genre Name
        </label>

        <input type="text"
               name="name"
               value="{{ old('name', $genre->name ?? '') }}"
               class="form-control @error('name') is-invalid @enderror"
               placeholder="Example: Fiction">

        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

    <div class="col-12">

        <label class="form-label">
            Description
        </label>

        <textarea name="description"
                  rows="4"
                  class="form-control @error('description') is-invalid @enderror"
                  placeholder="Optional genre description">{{ old('description', $genre->description ?? '') }}</textarea>

        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

</div>