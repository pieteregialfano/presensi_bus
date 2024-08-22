<?php
class generatePdf extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
    }

    public function setPerusahaanBus()
    {
        $periode = $this->input->post('periode');
        $perusahaan_bus = $this->input->post('perusahaan_bus');
        $tagihanData = json_decode($this->input->post('tagihanData'), true);
        $totalTagihan = json_decode($this->input->post('totalTagihan'), true);
        $this->session->set_userdata('perusahaan_bus', $perusahaan_bus);
        $this->session->set_userdata('periode', $periode);
        $this->session->set_userdata('tagihan', $tagihanData);
        $this->session->set_userdata('total',  $totalTagihan);
    }

    public function generate()
    {
        // $data['title'] = "Convert PDF";
        $data['user'] = $this->db->get_where('master_user', ['email' => $this->session->userdata('email')])->row_array();
        $periode = $this->session->userdata('periode');
        $perusahaan_bus = $this->session->userdata('perusahaan_bus');
        $tagihan = $this->session->userdata('tagihan');
        $total = $this->session->userdata('total');

        //date converting
        $date = new DateTime($periode);
        $y = $date->format('Y');
        $m = $date->format('n');

        // Mendapatkan nama bulan dari angka bulan
        $nama_bulan = DateTime::createFromFormat('!m', $m)->format('F');

        $periode_tampilan = $nama_bulan . ' - ' . $y;

        $firstDate = new DateTime("$y-$m-01");
        $lastDate = new DateTime("$y-$m-" . date('t', strtotime("$y-$m-01")));


        $data['bus_presensi'] = $this->db->get_where('bus_presensi', [
            'per_oto_bus' => $perusahaan_bus,
            'tgl_masuk >=' => $firstDate->format('Y-m-d'),
            'tgl_masuk <=' => $lastDate->format('Y-m-d')
        ])->result_array();

        $data['bus_master'] = $this->db->get('bus_master')->result_array();

        $this->load->library('Pdf');

        // create new PDF document
        $pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();

        $pdf->SetFont('courier', 'B', 24);
        $pdf->Cell(0, 22, 'Laporan Tagihan Bus', 0, 1, 'C', 0, '', false, 'M');
        $pdf->SetFont('courier', '', 12);
        $pdf->Cell(0, 15, 'Periode : ' . $periode_tampilan, 0, 1, 'C', 0, '', false, 'M', 'M');

        $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => '2', 'phase' => 10);
        $pdf->Line(40, 28, 250, 28, $style);

        $pdf->setFont('courier', '', 10);
        $pdf->ln(-2);
        $pageNumber = $pdf->getAliasNumPage();
        $totalPages = $pdf->getAliasNbPages();
        $pdf->Cell(90, 15, "Page        : $pageNumber of $totalPages", 0, 1, 'L', 0, '', false, 'M', 'M');

        date_default_timezone_set('Asia/Jakarta');
        $pdf->Cell(90, 15, 'Print       : ' . date('d-m-Y H:i:s'), 0, 1, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(90, 15, 'Opr.        : ' . $data['user']['name'], 0, 1, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(90, 15, 'Per. Otobus : ' . $perusahaan_bus, 0, 1, 'L', 0, '', false, 'M', 'M');

        $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => '2', 'phase' => 10);
        $pdf->Line(10, 64, 285, 64, $style);

        $pdf->setFont('courier', '', 8);
        $pdf->ln(1);

        $pdf->Cell(70, 15, 'Route', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(16, 15, 'Type', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(17, 15, 'Jumlah', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(16, 15, 'Harga', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(22, 15, 'Nilai', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(32, 15, 'Jml Denda', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, 'Sewa', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, 'Sewa', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, 'Sewa', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, 'Sewa', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, 'Total', 0, 1, 'L', 0, '', false, 'M', 'M');

        $pdf->ln(-2);
        $pdf->Cell(70, 15, 'Bus', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(14, 15, 'Bus', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(9, 15, 'Rit', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(10, 15, 'ACT', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(16, 15, 'Sewa', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, 'Kontrak', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(12, 15, 'Rit', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, 'Rp. ', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, 'EGM', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, 'MKR ', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, 'MGF ', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, 'MGC ', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, 'Tagihan ', 0, 0, 'L', 0, '', false, 'M', 'M');

        $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => '2', 'phase' => 10);
        $pdf->Line(10, 78, 285, 78, $style);

        $counter = 0; // Counter for tracking the number of items on the current page
        $maxItemsPerPage = 5;
        foreach ($tagihan as $item) {
            if ($counter == $maxItemsPerPage) {
                // Add a new page for the next set of data
                $pdf->AddPage();
                $counter = 0;

                // Existing code for header and other details on the new page
                $pdf->SetFont('courier', 'B', 24);
                $pdf->Cell(0, 22, 'Laporan Tagihan Bus', 0, 1, 'C', 0, '', false, 'M');
                $pdf->SetFont('courier', '', 12);
                $pdf->Cell(0, 15, 'Periode : ' . $periode_tampilan, 0, 1, 'C', 0, '', false, 'M', 'M');

                $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => '2', 'phase' => 10);
                $pdf->Line(40, 28, 250, 28, $style);

                $pdf->setFont('courier', '', 10);
                $pdf->ln(-2);
                $pageNumber = $pdf->getAliasNumPage();
                $totalPages = $pdf->getAliasNbPages();
                $pdf->Cell(90, 15, "Page        : $pageNumber of $totalPages", 0, 1, 'L', 0, '', false, 'M', 'M');
                date_default_timezone_set('Asia/Jakarta');
                $pdf->Cell(90, 15, 'Print       : ' . date('d-m-Y H:i:s'), 0, 1, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(90, 15, 'Opr.        : ' . $data['user']['name'], 0, 1, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(90, 15, 'Per. Otobus : ' . $perusahaan_bus, 0, 1, 'L', 0, '', false, 'M', 'M');

                $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => '2', 'phase' => 10);
                $pdf->Line(10, 64, 285, 64, $style);

                $pdf->setFont('courier', '', 8);
                $pdf->ln(1);

                $pdf->Cell(70, 15, 'Route', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(16, 15, 'Type', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(17, 15, 'Jumlah', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(16, 15, 'Harga', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(22, 15, 'Nilai', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(32, 15, 'Jml Denda', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(21, 15, 'Sewa', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(21, 15, 'Sewa', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(21, 15, 'Sewa', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(21, 15, 'Sewa', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(21, 15, 'Total', 0, 1, 'L', 0, '', false, 'M', 'M');

                $pdf->ln(-2);
                $pdf->Cell(70, 15, 'Bus', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(14, 15, 'Bus', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(9, 15, 'Rit', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(10, 15, 'ACT', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(16, 15, 'Sewa', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(21, 15, 'Kontrak', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(12, 15, 'Rit', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(21, 15, 'Rp. ', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(21, 15, 'EGM', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(21, 15, 'MKR ', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(21, 15, 'MGF ', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(21, 15, 'MGC ', 0, 0, 'L', 0, '', false, 'M', 'M');
                $pdf->Cell(21, 15, 'Tagihan ', 0, 0, 'L', 0, '', false, 'M', 'M');

                $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => '2', 'phase' => 10);
                $pdf->Line(10, 78, 285, 78, $style);
            }
            $pdf->setFont('courier', '', 8);
            $pdf->ln(8);
            $pdf->Cell(70, 15, $item['routes'], 0, 0, 'L', 0, '', false, 'M', 'M');
            $pdf->Cell(14, 15, $item['type'], 0, 0, 'L', 0, '', false, 'M', 'M');
            $pdf->Cell(9, 15, $item['rit'], 0, 0, 'L', 0, '', false, 'M', 'M');
            $pdf->Cell(10, 15, $item['act'], 0, 0, 'L', 0, '', false, 'M', 'M');
            $pdf->Cell(16, 15, $item['sewa'], 0, 0, 'L', 0, '', false, 'M', 'M');
            $pdf->Cell(21, 15, $item['kontrak'], 0, 0, 'L', 0, '', false, 'M', 'M');
            $pdf->Cell(12, 15, $item['ritDenda'], 0, 0, 'L', 0, '', false, 'M', 'M');
            $pdf->Cell(21, 15, $item['jmlDenda'], 0, 0, 'L', 0, '', false, 'M', 'M');
            $pdf->Cell(21, 15, $item['EGM'], 0, 0, 'L', 0, '', false, 'M', 'M');
            $pdf->Cell(21, 15, $item['MKR'], 0, 0, 'L', 0, '', false, 'M', 'M');
            $pdf->Cell(21, 15, $item['MGF'], 0, 0, 'L', 0, '', false, 'M', 'M');
            $pdf->Cell(21, 15, $item['MGC'], 0, 0, 'L', 0, '', false, 'M', 'M');
            $pdf->Cell(21, 15, $item['tagihan'], 0, 0, 'L', 0, '', false, 'M', 'M');
            $counter++;
        }

        for ($i = $counter; $i < $maxItemsPerPage; $i++) {
            $pdf->ln(8);
        }

        $pdf->ln(6);
        $pdf->Cell(70, 15, 'Total : ', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(16, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(10, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(12, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(11, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(20, 15, $total['totalNilaiKontrak'], 0, 0, 'L', 0, '', false, 'M', 'M'); //harus diiisi sama total yang gapake denda
        $pdf->Cell(16, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(18, 15, $total['grandTotalDenda'], 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, $total['grandTotalSewaEGM'], 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, $total['grandTotalSewaMKR'], 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, $total['grandTotalSewaMGF'], 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, $total['grandTotalSewaMGC'], 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, $total['grandTotalTagihan'], 0, 0, 'L', 0, '', false, 'M', 'M');

        $pdf->ln(6);
        $pdf->Cell(70, 15, 'PPN 11 % : ', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(16, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(10, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(12, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(11, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(24, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(16, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(14, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M'); //Total PP yang harus diisi

        $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => '2', 'phase' => 10);
        $pdf->Line(92, 130, 285, 130, $style);

        $pdf->ln(8);
        $pdf->Cell(70, 15, 'Grand Total : ', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(16, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(10, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(12, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(11, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(20, 15, $total['totalNilaiKontrak'], 0, 0, 'L', 0, '', false, 'M', 'M'); //Harus diisi total without dendanya
        $pdf->Cell(16, 15, '', 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(18, 15, $total['grandTotalDenda'], 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, $total['grandTotalSewaEGM'], 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, $total['grandTotalSewaMKR'], 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, $total['grandTotalSewaMGF'], 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, $total['grandTotalSewaMGC'], 0, 0, 'L', 0, '', false, 'M', 'M');
        $pdf->Cell(21, 15, $total['grandTotalTagihan'], 0, 0, 'L', 0, '', false, 'M', 'M');

        $style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => '2', 'phase' => 10);
        $pdf->Line(92, 138, 285, 138, $style);

        $pdf->ln(11);
        $pdf->Cell(108, 15, 'Dicetak oleh', 0, 0, 'C', 0, '', false, 'M', 'M');
        $pdf->Cell(60, 15, 'Disetujui oleh', 0, 0, 'C', 0, '', false, 'M', 'M');
        $pdf->Cell(110, 15, 'Disetujui oleh', 0, 0, 'C', 0, '', false, 'M', 'M');

        $pdf->ln(6);
        $pdf->Cell(97, 15, '', 0, 0, 'C', 0, '', false, 'M', 'M');
        $pdf->Cell(80, 15, 'Kontraktor', 0, 0, 'C', 0, '', false, 'M', 'M');
        $pdf->Cell(95, 15, 'HOD', 0, 0, 'C', 0, '', false, 'M', 'M');


        $pdf->ln(22);
        $pdf->Cell(109, 15, '(................................)', 0, 0, 'C', 0, '', false, 'M', 'M');
        $pdf->Cell(58, 15, '(.................................)', 0, 0, 'C', 0, '', false, 'M', 'M');
        $pdf->Cell(114, 15, '(.................................)', 0, 0, 'C', 0, '', false, 'M', 'M');
        ob_end_clean();
        $pdf->Output('Tagihan Vendor_' . $perusahaan_bus . '_' . $periode_tampilan . '.pdf', 'I');
    }
}
