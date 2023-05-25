<?php

class Kartun extends DB
{
    function getKartunJoin()
    {
        $query = "SELECT * FROM kartun JOIN produksi ON kartun.produksi_id=produksi.produksi_id JOIN genre ON kartun.genre_id=genre.genre_id ORDER BY kartun.kartun_id";

        return $this->execute($query);
    }

    function getKartun()
    {
        $query = "SELECT * FROM kartun";
        return $this->execute($query);
    }

    function getKartunById($id)
    {
        $query = "SELECT * FROM kartun JOIN produksi ON kartun.produksi_id=produksi.produksi_id JOIN genre ON kartun.genre_id=genre.genre_id WHERE kartun_id=$id";
        return $this->execute($query);
    }

    function searchKartun($keyword)
    {
        $query = "SELECT * FROM kartun JOIN produksi ON kartun.produksi_id=produksi.produksi_id JOIN genre ON kartun.genre_id=genre.genre_id WHERE nama LIKE '%" . $keyword . "%'";
        return $this->execute($query);
    }

    function addData($data, $file)
    {
        $tmp_file = $file['kartun_foto']['tmp_name'];
        $kartun_foto = $file['kartun_foto']['name'];

        $dir = "assets/images/$kartun_foto";
        move_uploaded_file($tmp_file, $dir);

        $nama = $data['nama'];
        $produksi_id = $data['produksi_id'];
        $genre_id = $data['genre_id'];

        $query = "INSERT INTO kartun VALUES ('', '$nama', '$kartun_foto', '$produksi_id', '$genre_id')";
        return $this->executeAffected($query);
    }

    function updateData($id, $data, $file)
    {
        $tmp_file = $file['kartun_foto']['tmp_name'];
        $kartun_foto = $file['kartun_foto']['name'];

        if ($kartun_foto == "") {
            $kartun_foto = $img;
        }

        $dir = "assets/images/$kartun_foto";
        move_uploaded_file($tmp_file, $dir);

        $nama = $data['nama'];
        $produksi_id = $data['produksi_id'];
        $genre_id = $data['genre_id'];

        $query = "UPDATE kartun SET nama = '$nama', kartun_foto = '$kartun_foto', produksi_id = '$produksi_id', genre_id = '$genre_id' WHERE id = '$id'";
        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM kartun WHERE id = $id";
        return $this->executeAffected($query);
    }
}
