<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Produksi.php');
include('classes/Template.php');

$produksi = new Produksi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$produksi->open();
$produksi->getProduksi();

if (!isset($_GET['produksi_id'])) {
    if (isset($_POST['submit'])) {
        if ($produksi->addProduksi($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'produksi.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'produksi.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Produksi';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama produksi</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'Produksi';

while ($pro = $produksi->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $pro['produksi_nama'] . '</td>
    <td style="font-size: 22px;">
        <a href="produksi.php?id=' . $pro['produksi_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="produksi.php?hapus=' . $pro['produksi_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['produksi_id'])) {
    $id = $_GET['produksi_id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($produksi->updateProduksi($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'produksi.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'produksi.php';
            </script>";
            }
        }

        $produksi->getProduksiById($id);
        $row = $produksi->getResult();

        $dataUpdate = $row['produksi_nama'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($produksi->deleteProduksi($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'produksi.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'produksi.php';
            </script>";
        }
    }
}

$produksi->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
