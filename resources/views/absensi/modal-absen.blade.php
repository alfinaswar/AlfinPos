@if(is_null($absenHariIni))
    <!-- Modal Absen -->
    <div class="modal fade" id="modalAbsen" tabindex="-1" aria-labelledby="modalAbsenLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAbsenLabel">Absen Hari Ini</h5>
                    <!-- Tombol close di-nonaktifkan -->
                    <button type="button" class="btn-close" disabled aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <form id="formAbsen" action="{{ route('absen.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="shift" class="form-label">Pilih Shift</label>
                            <select class="form-select" id="shift" name="shift" required>
                                <option value="">Pilih Shift</option>
                                @foreach($shift as $s)
                                    <option value="{{ $s->NamaShift }}">{{ $s->NamaShift }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <select class="form-select" id="keterangan" name="keterangan" required>
                                <option value="">Pilih Keterangan</option>
                                <option value="Hadir">Hadir</option>
                                <option value="Izin">Izin</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Cuti">Cuti</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan (Opsional)</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="2"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Absen Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modalAbsen = document.getElementById('modalAbsen');
            if (modalAbsen) {
                var modal = new bootstrap.Modal(modalAbsen, {
                    backdrop: 'static',
                    keyboard: false
                });
                modal.show();
            }
        });
    </script>
@endif
