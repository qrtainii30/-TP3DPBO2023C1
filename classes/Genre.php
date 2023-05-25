<?php

class Genre extends DB
{
    function getGenre()
    {
        $query = "SELECT * FROM genre";
        return $this->execute($query);
    }

    function getGenreById($id)
    {
        $query = "SELECT * FROM genre WHERE genre_id=$id";
        return $this->execute($query);
    }

    function addGenre($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO genre VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateGenre($id, $data)
    {
        $genre_nama = $data['nama'];
        $query = "UPDATE grup SET genre_nama = '$genre_nama' WHERE id_grup='$id'";
        return $this->executeAffected($query);
    }

    function deleteGenre($id)
    {
        $query = "DELETE FROM genre WHERE genre_id = $id";
        return $this->executeAffected($query);
    }
}
