<div class="modal fade" id="modalKonsul" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formKonsul">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Mulai Konseling</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="topik" class="form-label">Topik Konseling</label>
                        <textarea class="form-control" id="topik" name="topik" rows="3" required></textarea>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Mulai Konseling</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
