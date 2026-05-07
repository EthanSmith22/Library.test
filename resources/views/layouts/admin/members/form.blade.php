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
        <label class="form-label">Name</label>
        <input type="text" name="name" value="{{ old('name', $member->name ?? '') }}" class="form-control @error('name') is-invalid @enderror">
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ old('email', $member->email ?? '') }}" class="form-control @error('email') is-invalid @enderror">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" value="{{ old('phone', $member->phone ?? '') }}" class="form-control @error('phone') is-invalid @enderror">
        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Joined Date</label>
        <input type="date" name="joined_date" value="{{ old('joined_date', $member->joined_date ?? now()->toDateString()) }}" class="form-control @error('joined_date') is-invalid @enderror">
        @error('joined_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Address</label>
        <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address', $member->address ?? '') }}</textarea>
        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">
            Password
            @if(isset($member))
                <small class="text-muted">(leave blank to keep current password)</small>
            @endif
        </label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>