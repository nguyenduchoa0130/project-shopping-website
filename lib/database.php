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
    public function getNameProduct($id_product)
    {
        $sql = "SELECT `name_product` FROM `tbl_product` WHERE `id_product` = {$id_product}";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchColumn();
    }
    public function findProductLike($id_user, $id_product)
    {
        $sql = "SELECT * FROM `tbl_like` WHERE `id_user` = {$id_user} AND `id_product` = {$id_product}";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function deleteProductLike($id_user, $id_product)
    {
        $sql = "DELETE FROM `tbl_like` WHERE `id_user` = {$id_user} AND `id_product` = {$id_product}";
        $query = $this->connection->prepare($sql);
        return $query->execute();
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
    public function getNumberRow($table_name)
    {
        $sql = "SELECT COUNT(*) FROM `{$table_name}`";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchColumn();
    }
    public function addLike($id_product)
    {
        $sql = "UPDATE tbl_product set `number_liked` = `number_liked` + 1 WHERE `id_product` = {$id_product}";
        $query = $this->connection->prepare($sql);
        $query->execute();
    }
    public function subLike($id_product)
    {
        $sql = "UPDATE `tbl_product` set `number_liked` = `number_liked` - 1 WHERE `id_product` = {$id_product} AND `number_liked` > 0";
        $query = $this->connection->prepare($sql);
        $query->execute();
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
        $query->execute();
        return $this->connection->lastInsertId();
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
    public function getPriceProduct($id_product)
    {
        $sql = "SELECT * FROM `tbl_product` WHERE `id_product` = {$id_product}";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC)["price"];
    }
    public function getCart($id_user)
    {
        $sql = "SELECT * FROM `tbl_cart` WHERE `id_user` = {$id_user}";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getCartDetail($id_cart, $id_product)
    {
        $sql = "SELECT * FROM `tbl_cart_detail` WHERE `id_cart` = {$id_cart} AND `id_product` = {$id_product}";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getCartDetailLimit($id_user, $start, $limit)
    {
        $cart = $this->getCart($id_user);
        $sql = "SELECT * FROM `tbl_cart_detail` WHERE `id_cart` = {$cart['id_cart']} LIMIT {$start}, {$limit}";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getProductNewest($start, $limit)
    {
        $sql = "SELECT * FROM `tbl_product` WHERE `quantity` > 0 ORDER BY `date_created` DESC LIMIT {$start}, {$limit};";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getProductLikest($start, $limit)
    {
        $sql = "SELECT * FROM `tbl_product` WHERE `quantity` > 0 ORDER BY `number_liked` DESC  LIMIT {$start}, {$limit};";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getProductSellest($start, $limit)
    {
        $sql = "SELECT p.id_product, COUNT(*) 
                FROM `tbl_product` AS p, `tbl_order` AS o, `tbl_order_detail` AS od 
                WHERE o.id_order = od.id_order AND od.id_product = p.id_product AND o.status IN (2, 3)
                GROUP BY p.id_product ORDER BY  COUNT(*) DESC LIMIT {$start}, {$limit}";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getProductLike($id_user, $start, $limit)
    {
        $sql = "SELECT * FROM `tbl_like` WHERE `id_user` = {$id_user} LIMIT {$start}, {$limit}";
        $query = $this->connection->prepare($sql);
        $query->execute();
        $infoProduct =  $query->fetchAll();
        $listProduct = array();
        foreach ($infoProduct as $info) {
            $product = new Product($this->fetchDataById("tbl_product", "id_product", $info["id_product"])[0]);
            array_push($listProduct, $product);
        }
        return $listProduct;
    }
    public function getComment($id_product, $start, $limit)
    {
        $sql = "SELECT * FROM `tbl_review` WHERE `id_product` = {$id_product} ORDER BY `date_review` DESC LIMIT {$start}, {$limit}";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function addStar($id_product, $star)
    {
        $sql = "UPDATE `tbl_product` SET `star` = `star` + $star WHERE `id_product` = $id_product";
        $query = $this->connection->prepare($sql);
        return $query->execute();
    }
    public function getOrderByStatus($status)
    {
        $sql =  "SELECT * FROM `tbl_order` WHERE `status` = {$status}";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function updateStatusOrder($id_order, $status, $date_delevery = null, $date_completed = null, $note = null)
    {
        $sql = "UPDATE `tbl_order` SET `status` = ?, `date_delevery` = ?, `date_completed` = ?, `note` = ? WHERE `id_order` = ?";
        $query = $this->connection->prepare($sql);
        return $query->execute(array($status, $date_delevery,  $date_completed, $note, $id_order));
    }
    public function updateQuantityProduct($id_product, $quantity)
    {
        $sql = "SELECT `quantity` FROM `tbl_product` WHERE `id_product` = {$id_product}";
        $query = $this->connection->prepare($sql);
        $query->execute();
        $remain = $query->fetchColumn();
        if ($remain < $remain) {
            $sql = "UPDATE `tbl_product` SET `quantity` = 0 WHERE `id_product` = {$id_product}";
            $query = $this->connection->prepare($sql);
            $query->execute();
        } else {
            $sql = "UPDATE `tbl_product` SET `quantity` = `quantity` - {$quantity} WHERE `id_product` = {$id_product}";
            $query = $this->connection->prepare($sql);
            $query->execute();
        }
    }
    public function getSold($id_product)
    {
        $sql = "SELECT COUNT(*) 
                FROM `tbl_product` AS p, `tbl_order` AS o, `tbl_order_detail` AS od 
                WHERE o.id_order = od.id_order AND od.id_product = p.id_product AND o.status IN (2, 3) and p.id_product = $id_product";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchColumn();
    }
    public function findProduct($key, $start = null, $limit = null)
    {
        if (!is_null($start) &&!is_null($limit)) {
            $sql = "SELECT * FROM `tbl_product` WHERE LOWER(`name_product`) LIKE LOWER('%{$key}%') AND `quantity` > 0 LIMIT {$start}, {$limit}";
        } else {
            $sql = "SELECT * FROM `tbl_product` WHERE LOWER(`name_product`) LIKE LOWER('%{$key}%') AND `quantity` > 0";
        }
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}
