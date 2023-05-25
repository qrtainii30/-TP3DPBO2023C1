<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Genre.php');
include('classes/Produksi.php');
include('classes/Kartun.php');
include('classes/Template.php');

$kartun = new Kartun($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$kartun->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $kartun->getKartunById($id);
        $row = $kartun->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['kartun_nama'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['kartun_foto'] . '" class="img-thumbnail" alt="' . $row['kartun_foto'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['kartun_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Tahun</td>
                                    <td>:</td>
                                    <td>' . $row['kartun_tahunRilis'] . '</td>
                                </tr>
                                <tr>
                                    <td>Genre</td>
                                    <td>:</td>
                                    <td>' . $row['genre_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Produksi</td>
                                    <td>:</td>
                                    <td>' . $row['produksi_nama'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="#"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="#"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    if ($id > 0) {
        if ($kartun->deleteData($id) > 0) {
            echo
            "
            <script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>
            ";
        } else {
            echo
            "
            <script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
            </script>
            ";
        }
    }
}

$kartun->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_KARTUN', $data);
$detail->write();
