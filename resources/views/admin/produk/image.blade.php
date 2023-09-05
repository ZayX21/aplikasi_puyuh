<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Modal Foto Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="imageForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id-image" value="">
                    <div class="mb-3">
                        <label for="foto" class="form-label">Upload Foto</label>
                        <input class="form-control" type="file" id="foto" name="foto" />
                        <div id="foto_error_image" class="text-danger"></div>
                    </div>
                    <button class="btn btn-primary" type="submit">Upload</button>
                </form>
                <br>

                <div id="fotoContainer"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
