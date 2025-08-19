@extends('layout.app') {{-- Ganti dengan layout kamu jika berbeda --}}
@section('title', 'kelola akun')
@section('content')
    <div class="container-fluid mb-5">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div class="">
                <h1 class="page-title fw-semibold fs-20 mb-0">
                    Kelola Akun
                </h1>
                <div class="">
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Kelola Akun
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <button class="btn btn-primary btn-sm" id="btnTambahAkun">
                        <i class="la la-plus"></i> Tambah Akun
                    </button>
                </div>

                <div class="table-responsive">
                    <table id="akunTable" class="table table-bordered table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm btn-edit"
                                            data-id="{{ $user->id }}">Edit</a>
                                        @if ($user->id !== auth()->id())
                                            <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $user->id }}">
                                                Hapus
                                            </button>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('akun.create-modal')
    @include('akun.update-modal')
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#akunTable').DataTable({
                responsive: true,
            });

            $('#btnTambahAkun').click(function() {
                $('#formTambahAkun')[0].reset(); // reset form
                let modalTambah = new bootstrap.Modal(document.getElementById('modalTambahAkun'));
                modalTambah.show();
            });

            $('#formTambahAkun').submit(function(e) {
                e.preventDefault();

                let formData = $(this).serialize(); // karena form text saja

                $.ajax({
                    url: "{{ route('admin.akun.store') }}",
                    type: "POST",
                    data: formData,
                    success: function(res) {
                        alert('Akun berhasil ditambahkan!');
                        $('#modalTambahAkun').modal('hide');
                        location.reload(); // reload tabel agar muncul akun baru
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let msg = '';
                        $.each(errors, function(key, value) {
                            msg += value[0] + '\n';
                        });
                        alert(msg);
                    }
                });
            });

            $(document).on('click', '.btn-edit', function(e) {
                e.preventDefault();
                let id = $(this).data('id');

                $.ajax({
                    url: "/admin/akun/" + id + "/edit",
                    type: "GET",
                    success: function(res) {
                        $('#editUserId').val(res.id);
                        $('#editName').val(res.name);
                        $('#editEmail').val(res.email);
                        $('#editRole').val(res.role);
                        $('#editKontak').val(res.kontak);
                        $('#editAlamat').val(res.alamat);

                        let modalEdit = new bootstrap.Modal(document.getElementById(
                            'modalEditAkun'));
                        modalEdit.show();
                    },
                    error: function() {
                        alert('Gagal mengambil data akun!');
                    }
                });
            });

            $('#formEditAkun').submit(function(e) {
                e.preventDefault();

                let id = $('#editUserId').val();
                let formData = $(this).serialize();

                $.ajax({
                    url: "/admin/akun/" + id,
                    type: "POST", // karena pakai method spoofing PUT
                    data: formData,
                    success: function(res) {
                        alert('Akun berhasil diperbarui!');
                        $('#modalEditAkun').modal('hide');
                        location.reload();
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let msg = '';
                        $.each(errors, function(key, value) {
                            msg += value[0] + '\n';
                        });
                        alert(msg);
                    }
                });
            });

            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                let id = $(this).data('id');

                if (!confirm('Apakah Anda yakin ingin menghapus akun ini?')) {
                    return;
                }

                $.ajax({
                    url: "/admin/akun/" + id,
                    type: "POST", // karena pakai method spoofing DELETE
                    data: {
                        _method: 'DELETE',
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        alert('Akun berhasil dihapus!');
                        location.reload(); // reload tabel agar update tampilan
                    },
                    error: function() {
                        alert('Gagal menghapus akun!');
                    }
                });
            });

        });
    </script>
@endpush
