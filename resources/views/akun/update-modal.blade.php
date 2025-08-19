<div class="modal fade" id="modalEditAkun" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">Edit Akun</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form id="formEditAkun">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" id="editUserId">

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="name" id="editName" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="editEmail" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password (biarkan kosong jika tidak diubah)</label>
                        <input type="password" class="form-control" name="password" id="editPassword">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-control" id="editRole" required>
                            <option value="">Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="konselor">Konselor</option>
                            <option value="petugas">Petugas</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kontak</label>
                        <input type="text" class="form-control" name="kontak" id="editKontak">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="editAlamat" rows="3"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
