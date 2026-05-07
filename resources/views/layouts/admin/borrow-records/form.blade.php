<div class="row g-3">

    <div class="col-md-6">
        <label class="form-label">Member</label>

        <select name="member_id"
                class="form-select @error('member_id') is-invalid @enderror">

            <option value="">Select Member</option>

            @foreach($members as $member)

                <option value="{{ $member->id }}"
                    @selected(old('member_id') == $member->id)>

                    {{ $member->name }}

                </option>

            @endforeach

        </select>

        @error('member_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Book</label>

        <select name="book_id"
                class="form-select @error('book_id') is-invalid @enderror">

            <option value="">Select Book</option>

            @foreach($books as $book)

                <option value="{{ $book->id }}"
                    @selected(old('book_id') == $book->id)>

                    {{ $book->title }}
                    ({{ $book->available_copies_count }} available)

                </option>

            @endforeach

        </select>

        @error('book_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Borrow Date</label>

        <input type="date"
               name="borrow_date"
               value="{{ old('borrow_date', now()->toDateString()) }}"
               class="form-control @error('borrow_date') is-invalid @enderror">

        @error('borrow_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Due Date</label>

        <input type="date"
               name="due_date"
               value="{{ old('due_date', now()->addDays(7)->toDateString()) }}"
               class="form-control @error('due_date') is-invalid @enderror">

        @error('due_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</div>