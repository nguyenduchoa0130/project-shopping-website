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
        return $query->fetchAll();
    }
    public function insert($table, array $data)
    {
        $sqlStr = createInsertSql($table, $data);
        $query = $this->connection->prepare($sqlStr);
        $query->execute();
        return $this->connection->lastInsertId();
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
    public function findAccountByUsername($name)
    {
        $sql = "SELECT * FROM `tbl_account` WHERE username = ?";
        $query = $this->connection->prepare($sql);
        $query->execute(array($name));
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function findAccountByEmail($email)
    {
        $sql = "SELECT * FROM `tbl_account` WHERE `email` = ?";
        $query = $this->connection->prepare($sql);
        $query->execute(array($email));
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function findOTPByUsername($name)
    {
        $sql = "SELECT * FROM `tbl_account_otp` WHERE `username` = ?";
        $query = $this->connection->prepare($sql);
        $query->execute(array($name));
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function executeNonQuery($sql)
    {
        $query =  $this->connection->prepare($sql);
        return $query->execute();
    }
    public function executeQuery($sql)
    {
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getCurrentUser()
    {
        if (isset($_SESSION['username'])) {
            return $this->findAccountByUsername($_SESSION["username"]);
        }
        return null;
    }
}
