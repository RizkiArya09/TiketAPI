<?php
require_once "koneksi.php";
class barang
{
    public function get_tikets()
    {
        global $koneksi;
        $query = "SELECT * FROM tikets";
        $data = array();
        $result = $koneksi->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' => 'list Tiket berhasil',
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function get_tiket($id = 0)
    {
        global $koneksi;
        $query = "SELECT * FROM tikets";
        if ($id != 0) {
            $query .= " WHERE id=" . $id . " LIMIT 1";
        }
        $data = array();
        $result = $koneksi->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' => 'Get Tiket berhasil',
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function insert_tiket()
    {
        global $koneksi;
        $arrcheckpost = array(
            'nama' => '',
            'no_telp' => '',
            'harga' => '',
            'qty' => '',
            'maskapai' => ''
        );
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if ($hitung == count($arrcheckpost)) {
            $result = mysqli_query($koneksi, "INSERT INTO tikets SET
nama = '$_POST[nama]',
no_telp = '$_POST[no_telp]',
harga = '$_POST[harga]',
qty = '$_POST[qty]',
maskapai = '$_POST[maskapai]'");
            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'Tiket berhasil ditambahkan'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Tiket tidak berhasil ditambahkan'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Parameter Tidak Cocok'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function update_tiket($id)
    {
        global $koneksi;
        $arrcheckpost = array(
            'nama' => '',
            'no_telp' => '',
            'harga' => '',
            'qty' => '',
            'maskapai' => ''
        );
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if ($hitung == count($arrcheckpost)) {
            $result = mysqli_query($koneksi, "UPDATE tikets SET
nama = '$_POST[nama]',
no_telp = '$_POST[no_telp]',
harga = '$_POST[harga]',
qty = '$_POST[qty]',
maskapai = '$_POST[maskapai]'
WHERE id='$id'");
            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'Update Tiket berhasil'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Update Tiket gagal'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Parameter Tidak Cocok'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function delete_tiket($id)
    {
        global $koneksi;
        $query = "DELETE FROM tikets WHERE id=" . $id;
        if (mysqli_query($koneksi, $query)) {
            $response = array(
                'status' => 1,
                'message' => 'Hapus Tiket berhasil'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Hapus Tiket gagal'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}