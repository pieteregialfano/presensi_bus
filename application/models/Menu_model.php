<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    // Model submenu punya
    public function getSubMenu()
    {
        $query = " SELECT `master_user_sub_menu`.*, `master_user_menu`.`menu`
                    FROM `master_user_sub_menu` JOIN `master_user_menu`
                    ON `master_user_sub_menu`.`menu_id` = `master_user_menu`.`id`
                ";
        return $this->db->query($query)->result_array();
    }

    // Model menghapus data menu
    public function deleteMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('master_user_menu');
    }
    // ======================================================================================================================



    // ======================================================================================================================
    // Model menampilkan presensi di tampilan pertama views presensi
    public function getPresensi()
    {
        $this->db->select('*');
        $this->db->from('bus_presensi');
        $this->db->order_by('tgl_masuk');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function getCetakPresensi()
    {
        return $this->db->get('bus_presensi')->result_array();
    }

    public function getPresensiByNoTransaksi($no_transaksi)
    {
        return $this->db->get_where('bus_presensi', ['no_transaksi' => $no_transaksi])->row_array();
    }


    // Model menampilkan detail data presensi
    public function getdetailPresensi()
    {
        return $this->db->get('bus_presensi')->result_array();
    }

    // Model menampilkan edit presensi
    public function edit_presensi()
    {
        $data = [
            'no_bus' => $this->input->post('no_bus'),
            'per_oto_bus' => $this->input->post('per_oto_bus'),
            'type_bus' => $this->input->post('type_bus'),
            'route' => $this->input->post('route'),
            'no_polisi' => $this->input->post('no_polisi'),
            'shift' => $this->input->post('shift'),
            'tgl_presensi' => $this->input->post('tgl_presensi'),
            'tgl_masuk' => $this->input->post('tgl_masuk'),
            'jam_masuk' => $this->input->post('jam_masuk'),
            'tgl_keluar' => $this->input->post('tgl_keluar'),
            'jam_keluar' => $this->input->post('jam_keluar'),
            'jml_pnp' => $this->input->post('jml_pnp'),
            'ket_denda' => $this->input->post('ket_denda'),
            'jml_denda' => $this->input->post('jml_denda'),
            'ket' => $this->input->post('ket')
        ];
        $this->db->where('no_transaksi', $this->input->post('no_transaksi'));
        $this->db->update('bus_presensi', $data);
    }

    public function insertPresensi($data)
    {
        $this->db->insert('bus_presensi', $data);
    }

    // Model menghapus data presensi
    public function deletePresensi($no_transaksi)
    {
        $this->db->where('no_transaksi', $no_transaksi);
        $this->db->delete('bus_presensi');
    }
    // =============================================================================================================================================



    // =============================================================================================================================================
    // Model menghapus denda
    public function deleteDenda($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('bus_denda');
    }

    public function getdetailDenda()
    {
        return $this->db->get('bus_denda')->result_array();
    }

    // Model menampilkan edit denda
    public function editDenda($id)
    {
        $data = [
            'reason' => $this->input->post('reason'),
            'denda' => $this->input->post('denda')
        ];
        $this->db->where('id', $id); // Menggunakan $id yang diterima sebagai parameter
        $this->db->update('bus_denda', $data);
    }
    // =============================================================================================================================================




    // =============================================================================================================================================
    // Model untuk autofill 3 kolom add presensi bus
    public function getBusInfo($no_bus)
    {
        $this->db->select('per_oto_bus, type_bus, route');
        $this->db->where('no_bus', $no_bus);
        $query = $this->db->get('bus_master');

        return $query->row_array();
    }

    // Model menampilkan dropdown keterangan denda
    public function getDendaReasons()
    {
        return $this->db->get('bus_denda')->result_array();
    }

    public function getJumlahDenda($reason)
    {
        $this->db->select('denda');
        $this->db->where('reason', $reason);
        $query = $this->db->get('bus_denda');

        $result = $query->row();

        return ($result) ? $result->denda : 0;
    }

    public function getNoBusList()
    {
        $this->db->select('no_bus');
        $this->db->from('bus_master');
        $this->db->order_by('no_bus', 'ASC');
        $query = $this->db->get();

        return $query->result_array();
    }

    // =============================================================================================================================================



    // =============================================================================================================================================
    // MASTER_BUS
    public function getPoBus()
    {
        return $this->db->order_by('per_oto_bus', "desc")->get('bus_master')->result_array();
    }

    // Cek no bus yang udah dipake
    public function checkNoBusExists($no_bus)
    {
        $this->db->where('no_bus', $no_bus);
        $query = $this->db->get('bus_master');

        return $query->num_rows() > 0;
    }

    // Model menampilkan edit denda
    public function editPoBus($id)
    {
        $data = [
            'no_bus' => $this->input->post('no_bus'),
            'per_oto_bus' => $this->input->post('per_oto_bus'),
            'valid_from' => $this->input->post('valid_from'),
            'valid_to' => $this->input->post('valid_to'),
            'deletion' => $this->input->post('deletion'),
            'pc' => $this->input->post('pc'),
            'type_bus' => $this->input->post('type_bus'),
            'route' => $this->input->post('route'),
            'jum_rit_b' => $this->input->post('jum_rit_b'),
            'jum_hk' => $this->input->post('jum_hk'),
            'hrg_sewa' => $this->input->post('hrg_sewa'),
            'no_polisi' => $this->input->post('no_polisi'),
            'kap_bus' => $this->input->post('kap_bus'),
            'jum_pnp' => $this->input->post("jum_pnp"),
            'jum_pnp_egm' => $this->input->post('jum_pnp_egm'),
            'jum_pnp_mgc' => $this->input->post('jum_pnp_mgc'),
            'jum_pnp_mkr' => $this->input->post('jum_pnp_mkr'),
            'jum_pnp_mgf' => $this->input->post('jum_pnp_mgf'),
            'ppn' => $this->input->post('ppn')
        ];
        $this->db->where('id', $this->input->post('id')); // Menggunakan $id yang diterima sebagai parameter
        $this->db->update('bus_master', $data);
    }

    // Model menghapus PO. BUS
    public function deletePoBus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('bus_master');
    }

    // Model menampilkan detail data presensi
    public function getdetailPoBus()
    {
        return $this->db->get('bus_master')->result_array();
    }
    // =============================================================================================================================================


    // =============================================================================================================================================
    // FILTERING DATA CETAK LAPORAN
    public function getPerusahaanBus()
    {
        $this->db->select('per_oto_bus');
        $query = $this->db->group_by('per_oto_bus')->get('bus_master'); //kenapa pakai group by supaya data yg diambil dari per_oto_bus tdk ada yg double
        return $query->result_array();
    }

    public function getTypeBus()
    {
        $this->db->select('type_bus');
        $query = $this->db->group_by('type_bus')->get('bus_master'); //kenapa pakai group by supaya data yg diambil dari per_oto_bus tdk ada yg double
        return $query->result_array();
    }

    //Filter di cetak tagihan
    public function getPresensiFiltered($per_oto_bus, $start_date, $end_date, $type_bus)
    {
        if ($per_oto_bus === "") {
            $this->db->select('*');
            $this->db->from('bus_presensi');
            if ($start_date !== "" && $end_date !== "") {
                $this->db->where("tgl_masuk BETWEEN '$start_date' AND '$end_date'");
            }
            // Tambahkan kondisi untuk $type_bus
            if ($type_bus !== "") {
                $this->db->where('type_bus', $type_bus);
            }
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('*');
        $this->db->from('bus_presensi');
        $this->db->where('per_oto_bus', $per_oto_bus);
        if ($start_date !== "" && $end_date !== "") {
            $this->db->where("tgl_masuk BETWEEN '$start_date' AND '$end_date'");
        }
        // Tambahkan kondisi untuk $type_bus
        if ($type_bus !== "") {
            $this->db->where('type_bus', $type_bus);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getFilterCetakMasterBus($no_bus)
    {
        $this->db->select('*');
        $this->db->from('bus_master');
        $this->db->where("no_bus = '$no_bus' ");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getFilterCetakMasterPresentase($no_bus)
    {
        $this->db->select('*');
        $this->db->from('bus_presentase');
        $this->db->where("No_Bus = '$no_bus' ");
        $query = $this->db->get();
        return $query->result_array();
    }
    // =============================================================================================================================================


    // =============================================================================================================================================


    // Model untuk Presentase Bus

    // public function getUrutanPresentaseBus()
    // {
    //     $this->db->select('*');
    //     $this->db->from('bus_presentase');

    //     $query = $this->db->get();
    //     return $query->result();
    // }

    public function insertPresentaseBus($data)
    {
        $this->db->insert('bus_presentase', $data);
    }

    public function getPresentaseBus()
    {
        $this->db->select('*');
        $this->db->from('bus_presentase');
        $this->db->order_by('PO_Bus', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getBusNomor($No_Bus)
    {
        $this->db->select('type_bus, per_oto_bus, jum_pnp_egm, jum_pnp_mkr, jum_pnp_mgf, jum_pnp_mgc');
        $this->db->where('no_bus', $No_Bus);
        $query = $this->db->get('bus_master');

        return $query->row_array();
    }

    public function getdetailPresentaseBus()
    {
        return $this->db->get('bus_presentase')->result_array();
    }

    // Model menampilkan edit presensi
    public function edit_presentasebus($id)
    {
        $data = [
            'No_Bus' => $this->input->post('No_Bus_P'),
            'Type_Bus' => $this->input->post('Type_Bus'),
            'PO_Bus' => $this->input->post('PO_Bus'),
            'periode' => $this->input->post('periode_bus'),
            'T_PNP_EGM' => $this->input->post('t_pnp_egm'),
            'T_PNP_MKR' => $this->input->post('t_pnp_mkr'),
            'T_PNP_MGF' => $this->input->post('t_pnp_mgf'),
            'T_PNP_MGC' => $this->input->post('t_pnp_mgc'),
            'T_PNP' => $this->input->post('t_pnp'),
            'persentase_egm' => $this->input->post('persentase_egm'),
            'persentase_mkr' => $this->input->post('persentase_mkr'),
            'persentase_mgf' => $this->input->post('persentase_mgf'),
            'persentase_mgc' => $this->input->post('persentase_mgc')
        ];
        $this->db->where('id', $id); // Menggunakan $id yang diterima sebagai parameter
        $this->db->update('bus_presentase', $data);
    }

    public function deletePresentaseBus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('bus_presentase');
    }
}
