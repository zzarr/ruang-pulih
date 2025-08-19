 <!-- TAB 1: Data Laporan -->
 <div class="tab-pane mt-5" id="laporan" role="tabpanel">
     @if (optional(auth()->user())->role == 'kader')
         <div class="mb-3">
             <label for="media_pengaduan">Media Pengaduan</label>
             <select name="media_pengaduan" id="media_pengaduan" class="form-control">
                 <option value="Call Center">Call Center</option>
                 <option value="WhatsApp">WhatsApp</option>
                 <option value="Datang Langsung">Datang Langsung</option>
             </select>
         </div>
     @endif



     <div class="row">
         <div class="col-md-6 mb-3">
             <label>Tanggal Kejadian</label>
             <input type="date" name="tanggal_kejadian" class="form-control">
         </div>
         <div class="col-md-6 mb-3">
             <label>Alamat Kejadian</label>
             <textarea name="alamat_kejadian" class="form-control"></textarea>
         </div>
     </div>

     <div class="row">
         <div class="col-6 col-md-6 mb-3">
             <label for="provinsi">Provinsi</label>
             <input type="text" name="provinsi" class="form-control" id="provinsi">
         </div>
         <div class="col-6 col-md-6 mb-3">
             <label for="kabupaten_kota">Kabupaten/Koa</label>
             <input type="text" name="kabupaten_kota" class="form-control" id="kabupaten_kota">
         </div>
     </div>
     <div class="row">
         <div class="col-6 col-md-6 mb-3">
             <label for="kecamatan">Kecamatan</label>
             <input type="text" name="kecamatan" class="form-control" id="kecamatan">
         </div>
         <div class="col-6 col-md-6 mb-3">
             <label for="desa_kelurahan">Desa/Kelurahan</label>
             <input type="text" name="desa_kelurahan" class="form-control" id="desa_kelurahan">
         </div>
     </div>
     <div class="row">
         <div class="col-6 col-md-6 mb-3">
             <label for="rt">RT</label>
             <input type="text" name="rt" class="form-control" id="rt">
         </div>
         <div class="col-6 col-md-6 mb-3">
             <label for="rw">RW</label>
             <input type="text" name="rw" class="form-control" id="rw">
         </div>
     </div>

     <div class="mb-3">
         <label class="form-label">Jenis Kasus</label>
         <div class="row">
             @foreach (['Fisik', 'Psikis', 'Seksual', 'Eksploitasi', 'Penelantaran', 'Hak Asuh Anak'] as $kasus)
                 <div class="col-6 col-md-4 mb-2">
                     <div class="form-check">
                         <input class="form-check-input" type="checkbox" name="jenis_kasus[]"
                             value="{{ $kasus }}" id="kasus-{{ $kasus }}">
                         <label class="form-check-label" for="kasus-{{ $kasus }}">
                             {{ $kasus }}
                         </label>
                     </div>
                 </div>
             @endforeach

             <!-- Checkbox Lainnya -->
             <div class="col-6 col-md-4 mb-2">
                 <div class="form-check">
                     <input class="form-check-input" type="checkbox" id="kasusLainnya" name="jenis_kasus[]"
                         value="Lainnya">
                     <label class="form-check-label" for="kasusLainnya">Lainnya</label>
                 </div>
             </div>

             <!-- Input text di bawah semua checkbox -->
             <div class="col-12">
                 <input type="text" name="kasus_lainnya" id="inputKasusLainnya" class="form-control mt-2"
                     placeholder="Tuliskan jenis kasus lainnya" style="display:none;">
             </div>
         </div>
     </div>
     <div class="mb-3">
         <label>Deskripsi Kasus/kronologi</label>
         <textarea name="kronologi" class="form-control" rows="3"></textarea>
     </div>
     <div class="mb-3">
         <label>Bukti (optional)</label>
         <input type="file" name="bukti_path" class="form-control">
     </div>
 </div>
