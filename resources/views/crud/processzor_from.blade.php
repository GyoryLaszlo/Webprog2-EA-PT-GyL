@csrf
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Gyártó</label>
        <input name="gyarto" class="form-control" required
               value="{{ old('gyarto', $processzor->gyarto ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Típus</label>
        <input name="tipus" class="form-control" required
               value="{{ old('tipus', $processzor->tipus ?? '') }}">
    </div>
    <div class="col-12 d-flex gap-2">
        <button class="btn btn-primary">Mentés</button>
        <a href="{{ route('crud.processzorok.index') }}" class="btn btn-secondary">Mégse</a>
    </div>
</div>
