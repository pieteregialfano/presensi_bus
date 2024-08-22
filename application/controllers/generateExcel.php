<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class GenerateExcel extends CI_Controller
{
    public function setdatagenerate()
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
    public function excel()
    {
        $data['user'] = $this->db->get_where('master_user', ['email' => $this->session->userdata('email')])->row_array();
        $periode = $this->session->userdata('periode');
        $perusahaan_bus = $this->session->userdata('perusahaan_bus');
        $tagihan = $this->session->userdata('tagihan');
        $total = $this->session->userdata('total');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Judul
        $sheet->mergeCells('F1:I1');
        $sheet->setCellValue('F1', 'Report Sewa Bus');

        // Perusahaan Bus
        $sheet->setCellValue('F2', 'Per Oto Bus');
        $sheet->setCellValue('G2', 'Perusahaan Bus Value'); // G2 diambil dari proses filter periode

        // Header
        $sheet->setCellValue('B6', 'Route Bus');
        $sheet->setCellValue('C6', 'No Bus');
        $sheet->setCellValue('D6', 'Type Bus');
        $sheet->setCellValue('E6', 'Jumlah Rit');
        $sheet->setCellValue('F6', 'Harga Per Rit');
        $sheet->setCellValue('G6', 'Harga Kontrak Bus');
        $sheet->setCellValue('H6', 'Jumlah Rit Denda');
        $sheet->setCellValue('I6', 'Denda');
        $sheet->setCellValue('J6', '% EGM/MI');
        $sheet->setCellValue('K6', 'Sewa EGM/MI');
        $sheet->setCellValue('L6', '% MKR');
        $sheet->setCellValue('M6', 'Sewa MKR');
        $sheet->setCellValue('N6', '% MGF');
        $sheet->setCellValue('O6', 'Sewa MGF');
        $sheet->setCellValue('P6', '% MGC');
        $sheet->setCellValue('Q6', 'Sewa MGC');
        $sheet->setCellValue('R6', 'Total Sewa');

        // Data
        $row = 7; // Mulai dari baris ke-7
        foreach ($tagihan as $item) {
            // Isi data sesuai dengan urutan yang diinginkan
            $sheet->setCellValue('B' . $row, $item['master_bus_data'][0]['route']);
            $sheet->setCellValue('C' . $row, $item['master_bus_data'][0]['no_bus']);
            $sheet->setCellValue('D' . $row, $item['master_bus_data'][0]['type_bus']);
            $sheet->setCellValue('E' . $row, $item['master_bus_data'][0]['jum_rit_act']);
            $sheet->setCellValue('F' . $row, $item['master_bus_data'][0]['hrg_sewa']);
            // $sheet->setCellValue('G' . $row, $item['totalKontrakBus']);// Sesuaikan dengan variabel yang sesuai
            // $sheet->setCellValue('H' . $row, $item[totalDenda]);
            // $sheet->setCellValue('I' . $row, $denda);
            // $sheet->setCellValue('J' . $row, $item['master_bus_presentase'][0]['persentase_egm']);
            // $sheet->setCellValue('K' . $row, $harga_sewa_egm);
            // $sheet->setCellValue('L' . $row, $item['master_bus_presentase'][0]['persentase_mkr']);
            // $sheet->setCellValue('M' . $row, $harga_sewa_mkr);
            // $sheet->setCellValue('N' . $row, $item['master_bus_presentase'][0]['persentase_mgf']);
            // $sheet->setCellValue('O' . $row, $harga_sewa_mgf);
            // $sheet->setCellValue('P' . $row, $item['master_bus_presentase'][0]['persentase_mgc']);
            // $sheet->setCellValue('Q' . $row, $harga_sewa_mgc);
            // $sheet->setCellValue('R' . $row, $totalBayar);

            $row++;
        }

        // Sub Total
        $sheet->setCellValue('B' . $row, 'Sub Total');
        $sheet->setCellValue('G' . $row, '=SUM(G7:G' . ($row - 1) . ')'); // Sesuaikan dengan kolom yang sesuai

        // Save Excel file
        $filename = 'Report_Sewa_Bus.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);

        // Download file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}
