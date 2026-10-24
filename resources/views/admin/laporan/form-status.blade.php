<div class="card">
    <div class="card-header">
        Update Status Aspirasi
    </div>
    <div class="card-body">
        <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="proses"
                        {{ $laporan->aspirasi?->status === 'proses' ? 'selected' : '' }}>
                        Proses
                    </option>
                    <option value="selesai"
                        {{ $laporan->aspirasi?->status === 'selesai' ? 'selected' : '' }}>
                        Selesai
                    </option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
<a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary w-100 mt-3">
    Kembali
</a>