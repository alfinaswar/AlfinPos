@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Manajemen Akun</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Edit User</li>
                </ul>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Terjadi kesalahan!</strong> Silakan periksa input Anda.<br><br>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="card-title mb-0">Formulir Edit Akun</h4>
                    <p class="card-text mb-0">
                        Silakan ubah data pengguna di bawah ini.
                    </p>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label for="username" class="form-label"><strong>Username</strong></label>
                                <input type="text" name="username" class="form-control" id="username"
                                    placeholder="Username" value="{{ old('username', $user->username) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="name" class="form-label"><strong>Nama</strong></label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nama"
                                    value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label"><strong>Email</strong></label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                                    value="{{ old('email', $user->email) }}">
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label"><strong>Password</strong></label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Kosongkan jika tidak ingin mengubah password">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                            </div>
                            <div class="col-md-6">
                                <label for="nohp" class="form-label"><strong>No HP</strong></label>
                                <input type="text" name="nohp" class="form-control" id="nohp"
                                    placeholder="Nomor HP" value="{{ old('nohp', $user->nohp) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="alamat" class="form-label"><strong>Alamat</strong></label>
                                <input type="text" name="alamat" class="form-control" id="alamat"
                                    placeholder="Alamat" value="{{ old('alamat', $user->alamat) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="provinsi" class="form-label"><strong>Provinsi</strong></label>
                                @php
                                    $provinces = new App\Http\Controllers\DependentDropdownController();
                                    $provinces = $provinces->provinces();
                                @endphp
                                <select class="form-select" name="provinsi" id="provinsi">
                                    <option value="">==Pilih Salah Satu==</option>
                                    <option value="{{ $user->getProvinsi->id ?? '' }}" selected>
                                        {{ $user->getProvinsi->name ?? '' }}</option>
                                    @foreach ($provinces as $item)
                                        <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="kota" class="form-label"><strong>Kabupaten / Kota</strong></label>
                                <select class="form-select" name="kota" id="kota">
                                    <option value="{{ $user->getKota->id ?? '' }}" selected>
                                        {{ $user->getKota->name ?? '' }}</option>
                                    <option value="">==Pilih Salah Satu==</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="kecamatan" class="form-label"><strong>Kecamatan</strong></label>
                                <select class="form-select" name="kecamatan" id="kecamatan">
                                    <option value="{{ $user->getKecamatan->id ?? '' }}" selected>
                                        {{ $user->getKecamatan->name ?? '' }}</option>
                                    <option value="">==Pilih Salah Satu==</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="kelurahan" class="form-label"><strong>Kelurahan</strong></label>
                                <select class="form-select" name="kelurahan" id="desa">
                                    <option value="{{ $user->getKelurahan->id ?? '' }}" selected>
                                        {{ $user->getKelurahan->name ?? '' }}</option>
                                    <option value="">==Pilih Salah Satu==</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_lahir" class="form-label"><strong>Tanggal Lahir</strong></label>
                                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                                    value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="jenis_kelamin" class="form-label"><strong>Jenis Kelamin</strong></label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki"
                                        {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="Perempuan"
                                        {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="foto_profil" class="form-label"><strong>Foto Profil</strong></label>
                                <input type="file" name="foto_profil" class="form-control" id="foto_profil">
                                @if ($user->foto_profil)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/foto_profil/' . $user->foto_profil) }}"
                                            alt="Foto Profil" width="80">
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="pekerjaan" class="form-label"><strong>Pekerjaan</strong></label>
                                <input type="text" name="pekerjaan" class="form-control" id="pekerjaan"
                                    placeholder="Pekerjaan" value="{{ old('pekerjaan', $user->pekerjaan) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="status_perkawinan" class="form-label"><strong>Status
                                        Perkawinan</strong></label>
                                <select name="status_perkawinan" id="status_perkawinan" class="form-select">
                                    <option value="">Pilih Status</option>
                                    <option value="Belum Menikah"
                                        {{ old('status_perkawinan', $user->status_perkawinan) == 'Belum Menikah' ? 'selected' : '' }}>
                                        Belum Menikah
                                    </option>
                                    <option value="Menikah"
                                        {{ old('status_perkawinan', $user->status_perkawinan) == 'Menikah' ? 'selected' : '' }}>
                                        Menikah</option>
                                    <option value="Cerai"
                                        {{ old('status_perkawinan', $user->status_perkawinan) == 'Cerai' ? 'selected' : '' }}>
                                        Cerai
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="shift" class="form-label"><strong>Shift</strong></label>
                                <select name="shift" id="shift" class="form-select">
                                    <option value="">Pilih Shift</option>
                                    @foreach ($shift as $s)
                                        <option value="{{ $s->id }}"
                                            {{ old('shift') == $user->Shift ? 'selected' : '' }}>
                                            {{ $s->NamaShift }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="roles" class="form-label"><strong>Peran</strong></label>
                                <select name="roles[]" id="roles" class="form-select" multiple>
                                    @foreach ($roles as $key => $role)
                                        <option value="{{ $key }}"
                                            {{ collect(old('roles', $userRoleIds ?? []))->contains($key) ? 'selected' : '' }}>
                                            {{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 text-end mt-3">
                                <a href="{{ route('users.index') }}" class="btn btn-secondary me-2"><i
                                        class="fa fa-arrow-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan
                                    Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function onChangeSelect(url, id, name) {
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#' + name).empty();
                    $('#' + name).append('<option>==Pilih Salah Satu==</option>');
                    $.each(data, function(key, value) {
                        $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
        $(function() {
            $('#provinsi').on('change', function() {
                onChangeSelect('{{ route('cities') }}', $(this).val(), 'kota');
                $('#kota').empty().append('<option value="">==Pilih Salah Satu==</option>');
                $('#kecamatan').empty().append('<option value="">==Pilih Salah Satu==</option>');
                $('#desa').empty().append('<option value="">==Pilih Salah Satu==</option>');
            });
            $('#kota').on('change', function() {
                onChangeSelect('{{ route('districts') }}', $(this).val(), 'kecamatan');
                $('#kecamatan').empty().append('<option value="">==Pilih Salah Satu==</option>');
                $('#desa').empty().append('<option value="">==Pilih Salah Satu==</option>');
            })
            $('#kecamatan').on('change', function() {
                onChangeSelect('{{ route('villages') }}', $(this).val(), 'desa');
                $('#desa').empty().append('<option value="">==Pilih Salah Satu==</option>');
            })
        });
    </script>
@endpush
