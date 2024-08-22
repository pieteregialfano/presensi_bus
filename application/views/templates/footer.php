<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Presensi Bus Antar Jemput Karyawan <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/'); ?>js/demo/datatables-demo.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

<script src="<?= base_url('assets/'); ?>vendor/jquery-ui/jquery-ui.js"></script>

<script src="<?= base_url('assets/'); ?>datepicker/js/bootstrap-datepicker.min.js"></script>

<script src="<?= base_url('assets/'); ?>select2/js/select2.min.js"></script>

<script src="<?= base_url('assets/'); ?>timepicker/js/bootstrap-timepicker.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.38.0/js/tempusdominus-bootstrap-4.min.js" crossorigin="anonymous"></script> -->


<script>
    $(document).ready(function() {

        // Script untuk datepicker tgl_presensi
        $("#tgl_presensi").datepicker({
            format: "yyyy/mm/dd", // Format tanggal yang diinginkan
            changeMonth: true,
            changeYear: true,
            yearRange: "2000:2050", // Rentang tahun yang diizinkan
            autoclose: true, // Menutup datepicker setelah memilih tanggal
            showButtonPanel: true, // Menampilkan tombol kalender
            todayHighlight: true, // Menyoroti tanggal hari ini
            clearBtn: true, // Menampilkan tombol "Hapus" di datepicker
        });
        $(".tgl_presensi_edit").datepicker({
            format: "yyyy/mm/dd", // Format tanggal yang diinginkan
            changeMonth: true,
            changeYear: true,
            yearRange: "2000:2050", // Rentang tahun yang diizinkan
            autoclose: true, // Menutup datepicker setelah memilih tanggal
            showButtonPanel: true, // Menampilkan tombol kalender
            todayHighlight: true, // Menyoroti tanggal hari ini
            clearBtn: true, // Menampilkan tombol "Hapus" di datepicker
        });
        // Tambahkan event handler untuk menangani perubahan nilai pada datepicker
        $("#tgl_presensi_edit").on("changeDate", function(event) {
            let selectedDate = event.format(); // Mengambil tanggal yang dipilih
            console.log("Nilai yang dipilih: " + selectedDate);
        });

        // script untuk kolom jam_masuk menggunakan bootstrap-timepicker
        $("#jam_masuk").timepicker({
            timeFormat: 'HH:mm:ss',
            showSeconds: true,
            showInputs: false,
            showMeridian: false,
            maxHour: 20,
            maxMinutes: 30,
            interval: 1
        });

        $(".jam_masuk_edit").timepicker({
            timeFormat: 'HH:mm:ss',
            showSeconds: true,
            showInputs: false,
            showMeridian: false,
            maxHour: 20,
            maxMinutes: 30,
            interval: 1
        });
        $("#jam_masuk_edit").on('changeTime', function(e) {
            let selectedValue = e.time.value;
            console.log("Nilai yang dipilih: " + selectedValue);
        });

        $("#jam_keluar").timepicker({
            timeFormat: 'HH:mm:ss',
            showSeconds: true,
            showInputs: false,
            showMeridian: false,
            maxHour: 20,
            maxMinutes: 30,
            interval: 1
        });

        $(".jam_keluar_edit").timepicker({
            showSeconds: true,
            showInputs: false,
            showMeridian: false,
            maxHour: 20,
            maxMinutes: 30,
            interval: 1
        });
        $("#jam_keluar_edit").on('changeTime', function(e) {
            let selectedValue = e.time.value;
            console.log("Nilai yang dipilih: " + selectedValue);
        });

        $("#tgl_masuk").datepicker({
            format: "yyyy/mm/dd", // Format tanggal yang diinginkan
            changeMonth: true,
            changeYear: true,
            yearRange: "2000:2050", // Rentang tahun yang diizinkan
            autoclose: true, // Menutup datepicker setelah memilih tanggal
            showButtonPanel: true, // Menampilkan tombol kalender
            todayHighlight: true, // Menyoroti tanggal hari ini
            clearBtn: true, // Menampilkan tombol "Hapus" di datepicker
        });

        $(".tgl_masuk_edit").datepicker({
            format: "yyyy/mm/dd", // Format tanggal yang diinginkan
            changeMonth: true,
            changeYear: true,
            yearRange: "2000:2050", // Rentang tahun yang diizinkan
            autoclose: true, // Menutup datepicker setelah memilih tanggal
            showButtonPanel: true, // Menampilkan tombol kalender
            todayHighlight: true, // Menyoroti tanggal hari ini
            clearBtn: true, // Menampilkan tombol "Hapus" di datepicker
        });
        // Tambahkan event handler untuk menangani perubahan nilai pada datepicker
        $("#tgl_masuk_edit").on("changeDate", function(event) {
            let selectedDate = event.format(); // Mengambil tanggal yang dipilih
            console.log("Nilai yang dipilih: " + selectedDate);
        });

        //Script untuk datepicker tgl_keluar
        $("#tgl_keluar").datepicker({
            format: "yyyy/mm/dd", // Format tanggal yang diinginkan
            changeMonth: true,
            changeYear: true,
            yearRange: "2000:2050", // Rentang tahun yang diizinkan
            autoclose: true, // Menutup datepicker setelah memilih tanggal
            showButtonPanel: true, // Menampilkan tombol kalender
            todayHighlight: true, // Menyoroti tanggal hari ini
            clearBtn: true, // Menampilkan tombol "Hapus" di datepicker
        });

        //Script untuk datepicker tgl_keluar
        $(".tgl_keluar_edit").datepicker({
            format: "yyyy/mm/dd",
            changeMonth: true,
            changeYear: true,
            yearRange: "2000:2050",
            autoclose: true,
            showButtonPanel: true,
            todayHighlight: true,
            clearBtn: true,
        });

        // Tambahkan event handler untuk menangani perubahan nilai pada datepicker
        $("#tgl_keluar_edit").on("changeDate", function(event) {
            let selectedDate = event.format(); // Mengambil tanggal yang dipilih
            console.log("Nilai yang dipilih: " + selectedDate);
        });
    });

    $(document).ready(function() {
        $('#valid_from').datepicker({
            format: "yyyy/mm/dd",
            changeMonth: true,
            changeYear: true,
            yearRange: "2000:2050",
            autoclose: true,
            showButtonPanel: true,
            todayHighlight: true,
            clearBtn: true,
        });


        $(".valid_from_edit").datepicker({
            format: "yyyy/mm/dd", // Format tanggal yang diinginkan
            changeMonth: true,
            changeYear: true,
            yearRange: "2000:2050", // Rentang tahun yang diizinkan
            autoclose: true, // Menutup datepicker setelah memilih tanggal
            showButtonPanel: true, // Menampilkan tombol kalender
            todayHighlight: true, // Menyoroti tanggal hari ini
            clearBtn: true, // Menampilkan tombol "Hapus" di datepicker
        });
        // Tambahkan event handler untuk menangani perubahan nilai pada datepicker
        $("#valid_from_edit").on("changeDate", function(event) {
            let selectedDate = event.format(); // Mengambil tanggal yang dipilih
            console.log("Nilai yang dipilih: " + selectedDate);
        });

        $("#valid_to").datepicker({
            format: "yyyy/mm/dd",
            changeMonth: true,
            changeYear: true,
            yearRange: "2000:2050",
            autoclose: true,
            showButtonPanel: true,
            todayHighlight: true,
            clearBtn: true,
        });

        $(".valid_to_edit").datepicker({
            format: "yyyy/mm/dd", // Format tanggal yang diinginkan
            changeMonth: true,
            changeYear: true,
            yearRange: "2000:2050", // Rentang tahun yang diizinkan
            autoclose: true, // Menutup datepicker setelah memilih tanggal
            showButtonPanel: true, // Menampilkan tombol kalender
            todayHighlight: true, // Menyoroti tanggal hari ini
            clearBtn: true, // Menampilkan tombol "Hapus" di datepicker
        });
        // Tambahkan event handler untuk menangani perubahan nilai pada datepicker
        $("#valid_to_edit").on("changeDate", function(event) {
            let selectedDate = event.format(); // Mengambil tanggal yang dipilih
            console.log("Nilai yang dipilih: " + selectedDate);
        });
    });

    $(document).ready(function() {
        $('#periode_bus').datepicker({
            format: "yyyy/mm/dd",
            changeMonth: true,
            changeYear: true,
            yearRange: "2000:2050",
            autoclose: true,
            showButtonPanel: true,
            todayHighlight: true,
            clearBtn: true,
        });


        $(".edit_periode").datepicker({
            format: "yyyy/mm/dd", // Format tanggal yang diinginkan
            changeMonth: true,
            changeYear: true,
            yearRange: "2000:2050", // Rentang tahun yang diizinkan
            autoclose: true, // Menutup datepicker setelah memilih tanggal
            showButtonPanel: true, // Menampilkan tombol kalender
            todayHighlight: true, // Menyoroti tanggal hari ini
            clearBtn: true, // Menampilkan tombol "Hapus" di datepicker
        });
        // Tambahkan event handler untuk menangani perubahan nilai pada datepicker
        $("#edit_periode").on("changeDate", function(event) {
            let selectedDate = event.format(); // Mengambil tanggal yang dipilih
            console.log("Nilai yang dipilih: " + selectedDate);
        });
    });

    //change access role oleh admin
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin/changeaccess'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
            }
        });
    });

    //Memanggil data yang ada di kolom per_oto_bus, type_bus dan route ketika menginputkan no_bus
    $(document).ready(function() {
        // Meng-handle perubahan dropdown no_bus
        $('#no_bus').change(function() {
            let selectedNoBus = $(this).val();
            if (selectedNoBus !== '') {
                $.ajax({
                    url: '<?= base_url('user/get_bus_info'); ?>',
                    type: 'post',
                    data: {
                        no_bus: selectedNoBus
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response) {
                            $('#per_oto_bus').val(response.per_oto_bus);
                            $('#type_bus').val(response.type_bus);
                            $('#route').val(response.route);
                        } else {
                            // Handle jika no_bus tidak ditemukan
                            alert('No. Bus tidak ditemukan.');
                            $('#per_oto_bus').val('');
                            $('#type_bus').val('');
                            $('#route').val('');
                        }
                    }
                });
            } else {
                // Kosongkan kolom-kolom terkait jika no_bus kosong
                $('#per_oto_bus').val('');
                $('#type_bus').val('');
                $('#route').val('');
            }
        });
    });


    //Select option Keterangan Denda //Script untuk inisialisasi select2 di dalam modal
    $(document).ready(function() {
        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
        var day = currentDate.getDate().toString().padStart(2, '0');
        var formattedDate = year + '/' + month + '/' + day;

        // Set nilai tanggal pada input #tgl_presensi
        $('#tgl_presensi').val(formattedDate);

        // Inisialisasi Select2 pada elemen #ket_denda di modal presensiModal
        $('.js-example-basic-single').select2({
            closeOnSelect: true,
            allowClear: true
        });

        // Tangani perubahan pada elemen #ket_denda dalam modal presensiModal
        $('#presensiModal').on('show.bs.modal', function() {
            $('#ket_denda').on('change', function() {
                let selectedValue = $(this).val();
                console.log("Nilai yang dipilih: " + selectedValue);

                // Kirim permintaan AJAX untuk mengambil data dari database
                $.ajax({
                    url: '<?= base_url('user/get_jumlah_denda'); ?>',
                    method: 'post',
                    data: {
                        reason: selectedValue
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response) {
                            $('#jml_denda').val(response);
                            $('.js-example-basic-single').select2("close");
                        } else {
                            $('#jml_denda').val('');
                        }
                    }
                });
            });
        });

        $('.ket_denda_edit').select2({
            closeOnSelect: true,
            allowClear: true
            // dropdownParent: $('#editPresensiModal').find('.modal-content')
        });

    });


    $('addPresensiButton').click(function() {
        // Lakukan AJAX request atau action form submission di sini

        // Setelah berhasil menambahkan data, tampilkan SweetAlert2
        Swal.fire({
            icon: 'success',
            title: 'Data berhasil ditambahkan!',
            showConfirmButton: true
        });
    });
    // =============================================================================================================================================






    // ======================================================================================================================
    // PROSES FILTER DATA, CETAK LAPORAN, GENERATE PDF
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        const table = $('#dataTableTagihan').DataTable({
            "pageLength": 10,

        });

        function formatCurrency(value) {
            return 'Rp. ' + value.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).replace(/^(\D+)/, ''); // Remove any non-digit characters from the beginning
        }



        // Initialize datepickers
        $('#periode').datepicker({
            viewMode: "months",
            minViewMode: "months",
            format: "yyyy-mm",
            todayHighlight: true,
            showButtonPanel: true,
            autoclose: true
        });

        $('#dataTableTagihan').on('draw.dt', function() {
            console.log(table.page.info())
        });
        // Handle change event on perusahaan_bus, start_date, and end_date
        $('#tampilData').on('click', function() {
            let dataTagihan = [];
            let totalTagihan;
            let selectedVendor = $('#perusahaan_bus').val();
            let periode = $('#periode').val();
            let date = new Date(periode),
                y = date.getFullYear(),
                m = date.getMonth();
            let firstDate = new Date(y, m, 1);
            let lastDate = new Date(y, m + 1, 0);

            let selectedTipe = $('#tipe_bus').val();
            let tableBody = $('#table-body');
            tableBody.empty();
            let uniqueNoBus = [];
            let uniqueNoBusCount = {};
            let accumulatedDenda = {};

            let grandTotalDenda = 0;
            let grandTotalSewaEGM = 0;
            let grandTotalSewaMKR = 0;
            let grandTotalSewaMGF = 0;
            let grandTotalSewaMGC = 0;
            let totalNilaiKontrak = 0;
            let grandTotalTagihan = 0;

            // Send AJAX request to fetch filtered data
            $.ajax({
                url: '<?= base_url('user/get_filtered_presensi'); ?>',
                type: 'post',
                data: {
                    page: table.page.info().page,
                    pageSize: table.page.info().length,
                    per_oto_bus: selectedVendor,
                    date_from: firstDate.toISOString(),
                    date_to: lastDate.toISOString(),
                    type_bus: selectedTipe
                },
                dataType: 'json',
                success: function(data) {

                    $.each(data, function(index, item) {
                        // Check if master_bus_data array exists and has elements
                        if (item.master_bus_data && item.master_bus_data.length > 0) {
                            var noBus = item.master_bus_data[0].no_bus;

                            // Check if the bus number is not in uniqueNoBusCount
                            if (!uniqueNoBusCount.hasOwnProperty(noBus)) {
                                uniqueNoBusCount[noBus] = 0; // Initialize count to 0
                            }

                            // Increment the count for the current bus number
                            uniqueNoBusCount[noBus]++;

                            // Check if the bus number is not in accumulatedDenda
                            if (!accumulatedDenda.hasOwnProperty(noBus)) {
                                accumulatedDenda[noBus] = 0; // Initialize accumulated denda to 0
                            }

                            // Accumulate the jml_denda for the current bus number
                            accumulatedDenda[noBus] += parseFloat(item.presensi.jml_denda) || 0;

                            if (uniqueNoBus.findIndex(existingItem => existingItem.master_bus_data[0].no_bus === noBus) === -1) {
                                uniqueNoBus.push(item);
                            }
                        }
                    });

                    uniqueNoBus.sort((a, b) => (a.master_bus_data[0].type_bus > b.master_bus_data[0].type_bus) ? 1 : -1);

                    $.each(uniqueNoBus, function(index, item) {
                        let jumritact = uniqueNoBusCount[item.master_bus_data[0].no_bus];
                        let totalDenda = accumulatedDenda[item.master_bus_data[0].no_bus] || 0;

                        let totalKontrakBus = uniqueNoBusCount[item.master_bus_data[0].no_bus] * item.master_bus_data[0].hrg_sewa;
                        totalNilaiKontrak += totalKontrakBus;

                        let denda = totalDenda * item.master_bus_data[0].hrg_sewa;

                        let harga_sewa_egm = (uniqueNoBusCount[item.master_bus_data[0].no_bus] * item.master_bus_data[0].hrg_sewa * item.master_bus_presentase[0].persentase_egm / 100) - (denda * (item.master_bus_presentase[0].persentase_egm / 100));

                        let harga_sewa_mkr = (uniqueNoBusCount[item.master_bus_data[0].no_bus] * item.master_bus_data[0].hrg_sewa * item.master_bus_presentase[0].persentase_mkr / 100) - (denda * (item.master_bus_presentase[0].persentase_mkr / 100));

                        let harga_sewa_mgf = (uniqueNoBusCount[item.master_bus_data[0].no_bus] * item.master_bus_data[0].hrg_sewa * item.master_bus_presentase[0].persentase_mgf / 100) - (denda * (item.master_bus_presentase[0].persentase_mgf / 100));

                        let harga_sewa_mgc = (uniqueNoBusCount[item.master_bus_data[0].no_bus] * item.master_bus_data[0].hrg_sewa * item.master_bus_presentase[0].persentase_mgc / 100) - (denda * (item.master_bus_presentase[0].persentase_mgc / 100));


                        // Update grand totals
                        grandTotalDenda += totalDenda * item.master_bus_data[0].hrg_sewa;
                        grandTotalSewaEGM += parseFloat(harga_sewa_egm);
                        grandTotalSewaMKR += parseFloat(harga_sewa_mkr);
                        grandTotalSewaMGF += parseFloat(harga_sewa_mgf);
                        grandTotalSewaMGC += parseFloat(harga_sewa_mgc);

                        let totalBayar = parseFloat(harga_sewa_egm) + parseFloat(harga_sewa_mkr) + parseFloat(harga_sewa_mgf) + parseFloat(harga_sewa_mgc);
                        grandTotalTagihan += totalBayar;

                        tableBody.append(
                            '<tr>' +
                            '<th>' + item.master_bus_data[0].no_bus + '</th>' + //Nobus
                            '<td>' + item.master_bus_data[0].route + '</td>' + //Route
                            '<td>' + item.master_bus_data[0].type_bus + '</td>' + //TypeBus
                            '<td style="text-align:right;">' + item.master_bus_data[0].jum_hk + '</td>' + //Hari Kerja
                            '<td style="text-align:right;">' + jumritact + '</td>' + //jum rit ACT
                            '<td style="text-align:right;">' + item.master_bus_data[0].jum_rit_b + '</td>' + //Ju Rit Master
                            '<td style="text-align:right;">' + formatCurrency((item.master_bus_data[0].hrg_sewa)) + '</td>' + //Harga Sewa Bus dari Master
                            '<td style="text-align:right;">' + formatCurrency(totalKontrakBus) + '</td>' + //Nilai Kontrak Bus
                            '<td style="text-align:right;">' + totalDenda + '</td>' + //Berapa total rit denda
                            '<td style="text-align:right;">' + formatCurrency(denda) + '</td>' + //Bayar denda sesuai rit
                            '<td style="text-align:right;">' + item.master_bus_presentase[0].persentase_egm + '</td>' + //presentase egm
                            '<td style="text-align:right;">' + formatCurrency(harga_sewa_egm.toFixed(0)) + '</td>' + //bayar egm
                            '<td style="text-align:right;">' + item.master_bus_presentase[0].persentase_mkr + '</td>' + //presentase mkr
                            '<td style="text-align:right;">' + formatCurrency(harga_sewa_mkr.toFixed(0)) + '</td>' + //bayar mkr
                            '<td style="text-align:right;">' + item.master_bus_presentase[0].persentase_mgf + '</td>' + //presentase mgf
                            '<td style="text-align:right;">' + formatCurrency(harga_sewa_mgf.toFixed(0)) + '</td>' + //bayar mgf
                            '<td style="text-align:right;">' + item.master_bus_presentase[0].persentase_mgc + '</td>' + //presentase mgc
                            '<td style="text-align:right;">' + formatCurrency(harga_sewa_mgc.toFixed(0)) + '</td>' + //bayar mgc
                            '<td style="text-align:right;">' + formatCurrency(totalBayar.toFixed(0)) + '</td>' + //Total Sewa
                            '</tr>'
                        );
                        dataTagihan.push({
                            routes: item.master_bus_data[0].route,
                            type: item.master_bus_data[0].type_bus,
                            rit: item.master_bus_data[0].jum_rit_b,
                            act: jumritact,
                            sewa: item.master_bus_data[0].hrg_sewa,
                            kontrak: totalKontrakBus,
                            ritDenda: totalDenda,
                            jmlDenda: denda,
                            EGM: harga_sewa_egm.toFixed(0),
                            MKR: harga_sewa_mkr.toFixed(0),
                            MGF: harga_sewa_mgf.toFixed(0),
                            MGC: harga_sewa_mgc.toFixed(0),
                            tagihan: totalBayar.toFixed(0),
                        })
                    });
                    totalTagihan = {
                        totalNilaiKontrak: totalNilaiKontrak.toFixed(0),
                        grandTotalDenda: grandTotalDenda.toFixed(0),
                        grandTotalSewaEGM: grandTotalSewaEGM.toFixed(0),
                        grandTotalSewaMKR: grandTotalSewaMKR.toFixed(0),
                        grandTotalSewaMGF: grandTotalSewaMGF.toFixed(0),
                        grandTotalSewaMGC: grandTotalSewaMGC.toFixed(0),
                        grandTotalTagihan: grandTotalTagihan.toFixed(0),
                    }
                    $('#totalNilaiKontrak').text(formatCurrency(parseFloat(totalNilaiKontrak)));
                    $('#grandTotalDenda').text(formatCurrency(parseFloat(grandTotalDenda)));
                    $('#grandTotalSewaEGM').text(formatCurrency(parseFloat(grandTotalSewaEGM)));
                    $('#grandTotalSewaMKR').text(formatCurrency(parseFloat(grandTotalSewaMKR)));
                    $('#grandTotalSewaMGF').text(formatCurrency(parseFloat(grandTotalSewaMGF)));
                    $('#grandTotalSewaMGC').text(formatCurrency(parseFloat(grandTotalSewaMGC)));
                    $('#grandTotalTagihan').text(formatCurrency(parseFloat(grandTotalTagihan)));

                },
                error: function() {
                    console.log('Error fetching data.');
                }
            }).done(() => {
                let perusahaan_bus = $('#perusahaan_bus').val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('generatePdf/setPerusahaanBus'); ?>",
                    data: {
                        periode: periode,
                        perusahaan_bus: perusahaan_bus,
                        tagihanData: JSON.stringify(dataTagihan),
                        totalTagihan: JSON.stringify(totalTagihan)
                    },
                    success: function(response) {
                        console.log(response);

                        // After setting session data, trigger PDF generation
                        generatePdf();
                    }
                });
            });

            function generatePdf() {
                // Send another AJAX request to trigger PDF generation
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('generatePdf/generate'); ?>",
                    success: function(response) {
                        // Handle the response if needed
                        console.log(response);
                    }
                });
            }
        });
    });
    // =============================================================================================================================================




    // =============================================================================================================================================
    //Alert agar jumlah nya EGM, MGC, MKR, dan MGF tidak melebihi jumlah penumpang
    $(document).ready(function() {

        // Fungsi untuk menampilkan alert jika total jumlah penumpang melebihi batas
        function showAlertIfExceedLimit() {
            let jum_pnp = parseInt($('#jum_pnp').val()) || 0;
            let jum_pnp_egm = parseInt($('#jum_pnp_egm').val()) || 0;
            let jum_pnp_mgc = parseInt($('#jum_pnp_mgc').val()) || 0;
            let jum_pnp_mkr = parseInt($('#jum_pnp_mkr').val()) || 0;
            let jum_pnp_mgf = parseInt($('#jum_pnp_mgf').val()) || 0;

            let total_pnp = jum_pnp_egm + jum_pnp_mgc + jum_pnp_mkr + jum_pnp_mgf;

            // Tampilkan alert jika total melebihi batas
            if (total_pnp > jum_pnp) {
                alert('Total Jumlah Penumpang EGM, MGC, MKR, dan MGF tidak boleh melebihi Jumlah Penumpang utama.');
            }
        }

        // Panggil fungsi showAlertIfExceedLimit saat nilai input berubah
        $('#jum_pnp_egm, #jum_pnp_mgc, #jum_pnp_mkr, #jum_pnp_mgf').on('input', function() {
            showAlertIfExceedLimit();
        });
    });
    // =============================================================================================================================================

    // Tambahkan validasi jumlah penumpang di presensi bus tidak melebihi jumlah penumpang yang ada di maaster bus



    // =============================================================================================================================================
    //Js untuk dataTable presentase Bus
    $(document).ready(function() {
        $('#dataTablePresentase').DataTable();
        // Meng-handle perubahan dropdown no_bus
        $('#No_Bus_P').change(function() {
            let selectedNoBus = $(this).val();
            if (selectedNoBus !== '') {
                $.ajax({
                    url: '<?= base_url('user/get_bus_nomor'); ?>',
                    type: 'post',
                    data: {
                        No_Bus: selectedNoBus
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response) {
                            const {
                                type_bus,
                                per_oto_bus,
                                jum_pnp_egm,
                                jum_pnp_mkr,
                                jum_pnp_mgf,
                                jum_pnp_mgc
                            } = response;
                            const totalPNP = parseInt(jum_pnp_egm) + parseInt(jum_pnp_mkr) + parseInt(jum_pnp_mgf) + parseInt(jum_pnp_mgc);
                            let persentase_egm;
                            let persentase_mkr;
                            let persentase_mgf;
                            let persentase_mgc;
                            if (type_bus == "AC") {
                                persentase_egm = (parseInt(jum_pnp_egm) / totalPNP) * 100;
                                persentase_mkr = (parseInt(jum_pnp_mkr) / totalPNP) * 100;
                                persentase_mgf = (parseInt(jum_pnp_mgf) / totalPNP) * 100;
                                persentase_mgc = (parseInt(jum_pnp_mgc) / totalPNP) * 100;
                            } else {
                                persentase_egm = (parseInt(jum_pnp_egm) / totalPNP) * 100;
                                persentase_mkr = (parseInt(jum_pnp_mkr) / totalPNP) * 100;
                                persentase_mgf = (parseInt(jum_pnp_mgf) / totalPNP) * 100;
                                persentase_mgc = (parseInt(jum_pnp_mgc) / totalPNP) * 100;
                            }
                            $('#Type_Bus').val(type_bus);
                            $('#PO_Bus').val(per_oto_bus);
                            $('#t_pnp_egm').val(jum_pnp_egm);
                            $('#t_pnp_mkr').val(jum_pnp_mkr);
                            $('#t_pnp_mgf').val(jum_pnp_mgf);
                            $('#t_pnp_mgc').val(jum_pnp_mgc);
                            $('#t_pnp').val(totalPNP);
                            $('#persentase_egm').val(persentase_egm.toFixed(2));
                            $('#persentase_mkr').val(persentase_mkr.toFixed(2));
                            $('#persentase_mgf').val(persentase_mgf.toFixed(2));
                            $('#persentase_mgc').val(persentase_mgc.toFixed(2));

                        } else {
                            // Handle jika no_bus tidak ditemukan
                            alert('No. Bus tidak ditemukan.');
                            $('#Type_Bus').val('');
                            $('#PO_Bus').val('');
                            $('#t_pnp_egm').val('');
                            $('#t_pnp_mkr').val('');
                            $('#t_pnp_mgf').val('');
                            $('#t_pnp_mgc').val('');
                        }
                    }
                });
            } else {
                // Kosongkan kolom-kolom terkait jika no_bus kosong
                $('#Type_Bus').val('');
                $('#PO_Bus').val('');
                $('#t_pnp_egm').val('');
                $('#t_pnp_mkr').val('');
                $('#t_pnp_mgf').val('');
                $('#t_pnp_mgc').val('');
            }
        });
    });
</script>

</body>

</html>