<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Produksi.php');
include('classes/Genre.php');
include('classes/Kartun.php');
include('classes/Template.php');

$kartun = new kartun($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$kartun->open();
$temp = new kartun($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$temp->open();
$genre = new genre($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$genre->open();
$produksi = new Produksi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$produksi->open();

$opt_genre = null;
$opt_produksi = null;

$img_edit = "";
$nama_edit = "";
$produksi_edit = "";
$genre_edit = "";

$view_form = new Template('templates/skintambah.html');
if (!isset($_GET['edit'])) {

    if (isset($_POST['submit'])) {
        if ($kartun->addData($_POST, $_FILES) > 0) {
            echo "
                <script>
                    alert('Data berhasil ditambahkan!');
                    document.location.href = 'index.php';
                </script>
                ";
        }
    }


    $genre->getGenre();
    while ($row = $genre->getResult()) {
        $opt_genre .= "<option value=" . $row['genre_id'] . ">" . $row['genre_nama'] . "</option>";
    }

    $produksi->getProduksi();
    while ($row = $produksi->getResult()) {
        $opt_produksi .= "<option value=" . $row['produksi_id'] . ">" . $row['produksi_nama'] . "</option>";
    }
} else if (isset($_GET['edit'])) {
    $_ID = $_GET['edit'];
    $temp->getKartun();
    $temp->getKartunById($_ID);
    $temp_fnl = $temp->getResult();
    $temp_img = $temp_fnl['kartun_foto'];

    if (isset($_POST['submit'])) {
        if ($kartun->updateData($_ID, $_POST, $_FILES, $temp_img) > 0) {
            echo "
                <script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'index.php';
                </script>
                ";
        } else {
            echo "
                <script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'tambah.php';
                </script>
                ";
        }
    }

    $kartun->getKartunById($_ID);

    $row = $kartun->getResult();
    $nama_edit = $row['nama'];
    $img_edit = $row['kartun_foto'];
    $genre_edit = $row['genre_id'];
    $produksi_edit = $row['produksi_id'];

    $genre->getGenre();
    while ($row = $genre->getResult()) {
        $select = ($row['genre_id'] == $genre_edit) ? 'selected' : "";
        $opt_genre .= "<option value=" . $row['genre_id'] . " . $select . >" . $row['genre_nama'] . "</option>";
    }

    $produksi->getProduksi();
    while ($row = $produksi->getResult()) {
        $select = ($row['produksi_id'] == $produksi_edit) ? 'selected' : "";
        $opt_produksi .= "<option value=" . $row['produksi_id'] . " . $select . >" . $row['produksi_nama'] . "</option>";
    }
}

$view_form->replace('NAMA_DATA', $nama_edit);
$view_form->replace('IMAGE_DATA', $img_edit);
$view_form->replace('GENRE_DATA', $genre_edit);
$view_form->replace('GENRE_OPTION', $opt_genre);
$view_form->replace('PRODUKSI_DATA', $produksi_edit);
$view_form->replace('PRODUKSI_OPTION', $opt_produksi);

$view_form->write();

$kartun->close();
$genre->close();
$produksi->close();