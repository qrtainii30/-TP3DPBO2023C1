<?php

class Produksi extends DB
{
    function getProduksi()
    {
        $query = "SELECT * FROM produksi";
        return $this->execute($query);
    }

    function getProduksiById($id)
    {
        $query = "SELECT * FROM produksi WHERE produksi_id=$id";
        return $this->execute($query);
    }

    function addProduksi($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO produksi VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateProduksi($id, $data)
    {
        $produksi_nama = $data['nama'];
        $query = "UPDATE produksi SET produksi_nama = '$produksi_nama' WHERE produksi_id=$id";
        return $this->executeAffected($query);
    }

    function deleteProduksi($id)
    {
        $query = "DELETE FROM produksi WHERE produksi_id = $id";
        return $this->executeAffected($query);
    }
}
