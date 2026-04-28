<div class="modal fade" id="modalTambahStudent" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <form action="{{ route('store-student') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Tambah Siswa</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <!-- FOTO -->
                        <div class="col-md-4">
                            <label>Foto</label>
                            <div id="drop-area" class="drop-area">
                                <p id="text-drop">Drag & drop / klik</p>
                                <img id="preview-img" style="display:none;">
                                <input type="file" name="foto" id="fileElem" accept="image/*" hidden>
                            </div>
                        </div>

                        <!-- FORM -->
                        <div class="col-md-8">

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="form-row">
                                <div class="col-md-4">
                                    <label>Jenis Kelamin</label>
                                    <select name="jk" class="form-control">
                                        <option value="L">L</option>
                                        <option value="P">P</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>NIS</label>
                                    <input type="text" name="nis" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label>NISN</label>
                                    <input type="text" name="nisn" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-row mt-2">
                                <div class="col-md-4">
                                    <label>Angkatan</label>
                                    <input type="number" name="angkatan" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Jenjang</label>
                                    <select name="jenjang" class="form-control">
                                        <option value="smp">SMP</option>
                                        <option value="smk">SMK</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Status</label>
                                    <select name="ket" class="form-control">
                                        <option value="1">Aktif</option>
                                        <option value="2">Lulus</option>
                                        <option value="3">Pindah</option>
                                        <option value="4">Dikeluarkan</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- FOOTER -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>

            </form>
        </div>
    </div>
</div>