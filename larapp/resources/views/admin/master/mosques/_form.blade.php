<div>
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-input" value="{{ old('name', $mosque->name ?? '') }}" required />
  </div>
  <div class="mb-3">
    <label class="form-label">Province</label>
    <input type="text" name="province" class="form-input" value="{{ old('province', $mosque->province ?? '') }}" />
  </div>
  <div class="mb-3">
    <label class="form-label">Region</label>
    <select name="region_id" class="form-input">
      <option value="">-- Select Region --</option>
      @foreach($regions as $r)
        <option value="{{ $r->id }}" {{ (old('region_id', $mosque->region_id ?? '') == $r->id) ? 'selected' : '' }}>{{ $r->name }}</option>
      @endforeach
    </select>
  </div>
</div>
