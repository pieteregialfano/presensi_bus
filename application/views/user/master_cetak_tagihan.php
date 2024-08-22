<div class="container-fluid">
    <!-- Page Heading -->
    <div class="col-lg">

        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <h1 for="per_oto_bus" class="h2 text-gray-800">Report Sewa Bus</h1>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="per_oto_bus" class="col-sm-2 col-form-label">Perusahaan Bus</label>
                        <div class="col-sm-4">
                            <select class="js-example-basic-single form-control" id="perusahaan_bus" name="per_oto_bus" aria-haspopup="true" style="width: 100%;">
                                <option value="">=== Pilih Perusahaan Bus ===</option>
                                <?php foreach ($per_oto_bus as $vendor) : ?>
                                    <option value="<?= $vendor['per_oto_bus']; ?>"><?= $vendor['per_oto_bus']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type_bus" class="col-sm-2 col-form-label">Type Bus</label>
                        <div class="col-sm-4">
                            <select class="js-example-basic-single form-control" id="tipe_bus" name="type_bus" aria-haspopup="true" style="width: 100%; height:100%;">
                                <option value="">=== Pilih Type Bus ===</option>
                                <?php foreach ($type_bus as $tipe) : ?>
                                    <option value="<?= $tipe['type_bus']; ?>"><?= $tipe['type_bus']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="periode" class="col-sm-2 col-form-label">Periode</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-info text-white"><i class="fas fa-fw fa-calendar input-prefix"></i></span>
                                </div>
                                <input type="text" class="form-control" id="periode" name="periode" placeholder="periode" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-3">
                            <button type="submit" id="tampilData" class="d-sm-inline-block btn btn-primary">
                                <i class="fas fa-fw fa-filter"></i>Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTableTagihan" width="100%" cellspacing="0" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th scope="col">No. Bus</th>
                                <th scope="col">Route Bus</th>
                                <th scope="col">Type Bus</th>
                                <th scope="col">Jml. HK</th>
                                <th scope="col">Jum.Rit.Act</th>
                                <th scope="col">Jum.Rit</th>
                                <th scope="col">Harga Per Rit</th>
                                <th scope="col">Harga Kontrak Bus</th>
                                <th scope="col">Jml.Rit Denda</th>
                                <th scope="col">Denda</th>
                                <th scope="col">% EGM</th>
                                <th scope="col">Sewa EGM</th>
                                <th scope="col">% MKR</th>
                                <th scope="col">Sewa MKR</th>
                                <th scope="col">% MGF</th>
                                <th scope="col">Sewa MGF</th>
                                <th scope="col">% MGC</th>
                                <th scope="col">Sewa MGC</th>
                                <th scope="col">Total Sewa</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php foreach ($presensi as $pr) : ?>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="7" style="text-align:right">Total:</th>
                                <!-- <th colspan="8" style="text-align:right">Total:</th> -->
                                <th id="totalNilaiKontrak"></th>
                                <th></th>
                                <th id="grandTotalDenda"></th>
                                <th></th>
                                <th id="grandTotalSewaEGM"></th>
                                <th></th>
                                <th id="grandTotalSewaMKR"></th>
                                <th></th>
                                <th id="grandTotalSewaMGF"></th>
                                <th></th>
                                <th id="grandTotalSewaMGC"></th>
                                <th id="grandTotalTagihan"></th>
                            </tr>
                        </tfoot>
                    </table>
                    <!-- <?= $this->pagination->create_links(); ?> -->
                </div>
                <a href="<?= base_url('generatePdf/generate'); ?>" target="_blank" class="btn btn-danger mt-3">
                    <i class="fas fa-fw fa-solid fa-file-pdf"></i> PDF
                </a>
                <!-- <a href="<?= base_url('generateExcel/excel'); ?>" target="_blank" class="btn btn-success mt-3">
                    <i class=" fas fa-fw fa-file-excel"></i>Excel
                </a> -->
            </div>
        </div>
    </div>
</div>
</div>