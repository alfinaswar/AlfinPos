@if(is_null($absenHariIni))

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
                            <select class="form-select" id="shift" name="Shift" required>
                                <option value="">Pilih Shift</option>
                                @foreach($shift as $s)
                                    <option value="{{ $s->id }}">{{ $s->NamaShift }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <select class="form-select" id="keterangan" name="Jenis" required>
                                <option value="">Pilih Keterangan</option>
                                <option value="Hadir">Hadir</option>
                                <option value="Izin">Izin</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Cuti">Cuti</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan (Opsional)</label>
                            <textarea class="form-control" id="catatan" name="Catatan" rows="2" maxlength="255"
                                oninput="document.getElementById('charCount').innerText = this.value.length + '/255';"></textarea>
                            <div class="form-text text-end"><span id="charCount">0/255</span></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Absen Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endif
@push('js')
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif
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
@endpush
