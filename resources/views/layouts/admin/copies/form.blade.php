
<div class="mb-3">
    <label class="form-label">Book</label>
    <select name="book_id" class="form-select @error('book_id') is-invalid @enderror">
        <option value="">Select Book</option>
        @foreach($books as $book)
            <option value="{{ $book->id }}" @selected(old('book_id', $copy->book_id ?? request('book_id')) == $book->id)>
                {{ $book->title }}
            </option>
        @endforeach
    </select>
    @error('book_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Book Stand</label>
    <select name="book_stand_id" class="form-select @error('book_stand_id') is-invalid @enderror">
        <option value="">No Stand</option>
        @foreach($stands as $stand)
            <option value="{{ $stand->id }}" @selected(old('book_stand_id', $copy->book_stand_id ?? '') == $stand->id)>
                {{ $stand->code }} - {{ $stand->floor }} / {{ $stand->section }}
            </option>
        @endforeach
    </select>
    @error('book_stand_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
@if (!isset($copy))
    <div class="mb-3">
        <label class="form-label">Quantity</label>
        <input
            type="number"
            name="quantity"
            value="{{ old('quantity', 1) }}"
            min="1"
            max="100"
            class="form-control @error('quantity') is-invalid @enderror"
        >
        @error('quantity')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
@endif
    <div class="mb-3">
        <label class="form-label">
        Accession Prefix / No
    </label>
    <small class="text-muted d-block mb-1">
        Example: HP. If quantity is 3, system creates HP-001, HP-002, HP-003.
    </small>
    <input type="text" name="accession_no" value="{{ old('accession_no', $copy->accession_no ?? '') }}" class="form-control @error('accession_no') is-invalid @enderror">
    @error('accession_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Condition</label>
    <select name="condition" class="form-select @error('condition') is-invalid @enderror">
        @foreach(['new','good','fair','damaged'] as $condition)
            <option value="{{ $condition }}" @selected(old('condition', $copy->condition ?? 'good') == $condition)>
                {{ ucfirst($condition) }}
            </option>
        @endforeach
    </select>
    @error('condition') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select @error('status') is-invalid @enderror">
        @foreach(['available','borrowed','pending_return','reserved','lost','damaged'] as $status)
            <option value="{{ $status }}" @selected(old('status', $copy->status ?? 'available') == $status)>
                {{ ucwords(str_replace('_', ' ', $status)) }}
            </option>
        @endforeach
    </select>
    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

