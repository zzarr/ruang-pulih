 <!-- TAB 4: Data Korban -->
 <div class="tab-pane " id="korban" role="tabpanel">
     <div id="korban-wrapper">
         <div class="korban-item border rounded p-3 mb-3">
             <div class="mb-3">
                 <label>Nama Lengkap</label>
                 <input type="text" name="korban[0][nama_lengkap]" class="form-control">
             </div>
             <div class="mb-3">
                 <label>Hubungan dengan Pelapor</label>
                 <input type="text" name="korban[0][hubungan_pelapor]" class="form-control">
             </div>
             <div class="mb-3">
                 <label>Jenis Kelamin</label>
                 <select name="korban[0][jenis_kelamin]" class="form-control">
                     <option value="L">Laki-laki</option>
                     <option value="P">Perempuan</option>
                 </select>
             </div>
             <div class="mb-3">
                 <label>Usia</label>
                 <input type="number" name="korban[0][usia]" class="form-control">
             </div>
             <div class="mb-3">
                 <label class="form-label d-block">Difabel</label>
                 <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="difabel" id="difabelTidak" value="0"
                         checked>
                     <label class="form-check-label" for="difabelTidak">Tidak</label>
                 </div>
                 <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="difabel" id="difabelYa" value="1">
                     <label class="form-check-label" for="difabelYa">Ya</label>
                 </div>
             </div>
         </div>
     </div>
 </div>
