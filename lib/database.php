<?php
require_once __DIR__ . "/function.php";
class Database
{
    public $connection = null;
    public function __construct($server, $db, $username, $password)
    {
        $this->connection = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $username, $password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function disconnect()
    {
        $this->connection = null;
    }
    public function fetchSql($sql)
    {
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function fetchDataAll($table)
    {
        $query = $this->connection->prepare("SELECT * FROM `{$table}`");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function fetchDataById($table, $id_name, $val)
    {
        $query = $this->connection->prepare("SELECT * FROM `{$table}` WHERE `{$id_name}` = {$val}");
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    public function insert($table, array $data)
    {
        $sqlStr = createInsertSql($table, $data);
        $query = $this->connection->prepare($sqlStr);
        return $query->execute();
    }
    public function update($table, $id_name, $val, $data)
    {
        $sqlStr = createUpdateSql($table, $id_name, $val, $data);
        $query = $this->connection->prepare($sqlStr);
        return $query->execute();
    }
    public function delete($table, $id_name, $val)
    {
        $sqlStr = "DELETE FROM `{$table}` WHERE `{$id_name}` = {$val}";
        $query = $this->connection->prepare($sqlStr);
        return $query->execute();
    }
}
