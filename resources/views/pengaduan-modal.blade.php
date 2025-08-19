<!-- Modal -->
<div class="modal fade" id="modalLaporan" tabindex="-1" aria-labelledby="modalLaporanLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <form id="laporanForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Form Pengaduan Kekerasan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Progress Bar -->
                <div class="px-4 pt-3">
                    <div class="progress" style="height: 6px;">
                        <div id="progressBar" class="progress-bar bg-primary" style="width: 25%;"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <small>Data Laporan</small>
                        <small>Pelapor</small>
                        <small>Terlapor</small>
                        <small>Korban</small>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="step" id="step-0">
                        @include('form-step-laporan')
                    </div>
                    <div class="step d-none" id="step-1">
                        @include('form-step-pelapor')
                    </div>
                    <div class="step d-none" id="step-2">
                        @include('form-step-terlapor')
                    </div>
                    <div class="step d-none" id="step-3">
                        @include('form-step-korban')
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" id="prevStep">Sebelumnya</button>
                    <button type="button" class="btn btn-primary" id="nextStep">Berikutnya</button>
                    <button type="button" class="btn btn-success" id="submitBtn">Kirim Laporan</button>
                </div>
            </form>
        </div>
    </div>
</div>
