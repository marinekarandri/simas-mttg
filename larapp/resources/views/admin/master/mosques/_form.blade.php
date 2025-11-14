<div>
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-input" value="{{ old('name', $mosque->name ?? '') }}" required />
  </div>
  <div class="mb-3">
    <label class="form-label">Regional</label>
    <select name="regional_id" class="form-input">
      <option value="">-- Select Regional --</option>
      @foreach(($regionals ?? []) as $r)
        <option value="{{ $r->id }}" {{ (old('regional_id', $mosque->regional_id ?? '') == $r->id) ? 'selected' : '' }}>{{ $r->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Witel</label>
    <select name="witel_id" class="form-input">
      <option value="">-- Select Witel --</option>
      @foreach(($witels ?? []) as $w)
        <option value="{{ $w->id }}" {{ (old('witel_id', $mosque->witel_id ?? '') == $w->id) ? 'selected' : '' }}>{{ $w->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">STO</label>
    <select name="sto_id" class="form-input">
      <option value="">-- Select STO --</option>
      @foreach(($stos ?? []) as $s)
        <option value="{{ $s->id }}" {{ (old('sto_id', $mosque->sto_id ?? '') == $s->id) ? 'selected' : '' }}>{{ $s->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Address</label>
    <input type="text" name="address" class="form-input" value="{{ old('address', $mosque->address ?? '') }}" />
  </div>
  <div class="mb-3">
    <label class="form-label">Tahun Didirikan</label>
    <input type="number" name="tahun_didirikan" class="form-input" value="{{ old('tahun_didirikan', $mosque->tahun_didirikan ?? '') }}" />
  </div>
  <div class="mb-3">
    <label class="form-label">Jumlah BKM (pengurus)</label>
    <input type="number" name="jml_bkm" class="form-input" value="{{ old('jml_bkm', $mosque->jml_bkm ?? 0) }}" />
  </div>
  <div class="mb-3">
    <label class="form-label">Luas Tanah (m2)</label>
    <input type="number" step="0.01" name="luas_tanah" class="form-input" value="{{ old('luas_tanah', $mosque->luas_tanah ?? '') }}" />
  </div>
  <div class="mb-3">
    <label class="form-label">Daya Tampung</label>
    <input type="number" name="daya_tampung" class="form-input" value="{{ old('daya_tampung', $mosque->daya_tampung ?? '') }}" />
  </div>
</div>
