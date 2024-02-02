<?php

require_once __DIR__ . '/DB.php';

class UsersModel
{
    private $db;

    public function __construct()
    {
        $this->db = DB::connect();
    }

    public function getAll()
    {
        $reponse = $this->getDb()->prepare("SELECT * FROM users");
        $reponse->execute();
        $list = $reponse->fetchAll(PDO::FETCH_ASSOC);

        if ($list) {
            return json_encode(["list" => $list]);
        } else {
            return json_encode(["list" => []]);
        }
    }

    public function getById(int $id)
    {
        $reponse = $this->getDb()->prepare("SELECT * FROM users WHERE id = $id");
        $reponse->execute();
        $item = $reponse->fetchAll(PDO::FETCH_ASSOC);

        if ($item) {
            return json_encode($item);
        } else {
            return json_encode([]);
        }
    }

    public function checkByCpf(string $cpf)
    {
        $reponse = $this->getDb()->prepare("SELECT * FROM users WHERE cpf = $cpf");
        $reponse->execute();
        $item = $reponse->fetchAll(PDO::FETCH_ASSOC);

        if ($item) {
            return true;
        } else {
            return false;
        }
    }

    public function create(array $data)
    {
        $fields = '';
        $values = '';
        foreach ($data as $key => $value) {
            if (!empty($fields)) {
                $fields .= ', ';
                $values .= ', ';
            }
            $fields .= $key;
            $values .= $value;
        }
        $reponse = $this->getDb()->prepare("INSERT INTO users ($fields) VALUE ($values)");
        $reponse->execute();
    }

    public function update(int $id, array $data)
    {
        $fields = '';
        foreach ($data as $key => $value) {
            if (!empty($fields)) {
                $fields .= ', ';
            }
            $fields .= "$key = $value";
        }
        $reponse = $this->getDb()->prepare("UPDATE users SET $fields WHERE id = $id");
        $reponse->execute();
    }

    public function delete(int $id)
    {
        $reponse = $this->getDb()->prepare("DELETE FROM users WHERE id = $id");
        $reponse->execute();
    }


    /**
     * Get the value of db
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Set the value of db
     *
     * @return  self
     */
    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }
}
