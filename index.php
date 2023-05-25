<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Genre.php');
include('classes/Produksi.php');
include('classes/Kartun.php');
include('classes/Template.php');

// buat instance kartun
$listKartun = new Kartun($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listKartun->open();
// tampilkan data kartun
$listKartun->getKartunJoin();

// cari kartun
if (isset($_POST['btn-cari'])) {
    // methode mencari data kartun
    $listKartun->searchKartun($_POST['cari']);
} else {
    // method menampilkan data kartun
    $listKartun->getKartunJoin();
}

$data = null;

// ambil data kartun
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listKartun->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 kartun-thumbnail">
        <a href="detail.php?id=' . $row['kartun_id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['kartun_foto'] . '" class="card-img-top" alt="' . $row['kartun_foto'] . '">
            </div>
            <div class="card-body">
                <p class="card-text kartun-nama my-0">' . $row['kartun_nama'] . '</p>
                <p class="card-text genre-nama">' . $row['genre_nama'] . '</p>
                <p class="card-text produksi-nama my-0">' . $row['produksi_nama'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listKartun->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_KARTUN', $data);
$home->write();
