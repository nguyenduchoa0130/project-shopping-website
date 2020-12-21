<?php

class Database
{
    /**
     * Khai báo biến kết nối
     * @var [type]
     */
    public $connect;

    public function __construct()
    {
        $this->connect = mysqli_connect("localhost", "root", "", "db_shopping") or die();
        mysqli_set_charset($this->connect, "utf8");
    }


    /**
     * [insert description] hàm insert 
     * @param  $table
     * @param  array  $data  
     * @return integer
     */
    public function insert($table, array $data)
    {
        
        $sql = "INSERT INTO {$table} ";
        $columns = implode(',', array_keys($data));
        $values  = "";
        $sql .= '(' . $columns . ')';
        foreach ($data as $field => $value) {
            if (is_string($value)) {
                $values .= "'" . mysqli_real_escape_string($this->connect, $value) . "',";
            } else {
                $values .= mysqli_real_escape_string($this->connect, $value) . ',';
            }
        }
        $values = substr($values, 0, -1);
        $sql .= " VALUES (" . $values . ')';
        // _debug($sql);die;
        mysqli_query($this->connect, $sql) or die("Lỗi  query  insert ----" . mysqli_error($this->connect));
        return mysqli_insert_id($this->connect);
    }

    public function updateview($sql)
    {
        $result = mysqli_query($this->connect, $sql)  or die("Lỗi update view " . mysqli_error($this->connect));
        return mysqli_affected_rows($this->connect);
    }
    public function countTable($table)
    {
        $sql = "SELECT id FROM  {$table}";
        $result = mysqli_query($this->connect, $sql) or die("Lỗi Truy Vấn countTable----" . mysqli_error($this->connect));
        $num = mysqli_num_rows($result);
        return $num;
    }


    /**
     * [delete description] hàm delete
     * @param  $table      [description]
     * @param  array  $conditions [description]
     * @return integer             [description]
     */
    public function delete($table,  $id)
    {
        $sql = "DELETE FROM {$table} WHERE id = $id ";

        mysqli_query($this->connect, $sql) or die(" Lỗi Truy Vấn delete   --- " . mysqli_error($this->connect));
        return mysqli_affected_rows($this->connect);
    }

    /**
     * delete array 
     */

    public function deletewhere($table, $data = array())
    {
        foreach ($data as $id) {
            $id = intval($id);
            $sql = "DELETE FROM {$table} WHERE id = $id ";
            mysqli_query($this->connect, $sql) or die(" Lỗi Truy Vấn delete   --- " . mysqli_error($this->connect));
        }
        return true;
    }

    public function fetchsql($sql)
    {
        $result = mysqli_query($this->connect, $sql) or die("Lỗi  truy vấn sql " . mysqli_error($this->connect));
        $data = [];
        if ($result) {
            while ($num = mysqli_fetch_assoc($result)) {
                $data[] = $num;
            }
        }
        return $data;
    }

    public function fetchID($table, $id)
    {
        $sql = "SELECT * FROM {$table} WHERE id = $id ";
        $result = mysqli_query($this->connect, $sql) or die("Lỗi  truy vấn fetchID " . mysqli_error($this->connect));
        return mysqli_fetch_assoc($result);
    }

    public function fetchOne($table, $query)
    {
        $sql  = "SELECT * FROM {$table} WHERE ";
        $sql .= $query;
        $sql .= "LIMIT 1";
        $result = mysqli_query($this->connect, $sql) or die("Lỗi  truy vấn fetchOne " . mysqli_error($this->connect));
        return mysqli_fetch_assoc($result);
    }

    public function deletesql($table,  $sql)
    {
        $sql = "DELETE FROM {$table} WHERE " . $sql;
        mysqli_query($this->connect, $sql) or die(" Lỗi Truy Vấn delete   --- " . mysqli_error($this->connect));
        return mysqli_affected_rows($this->connect);
    }


    public function fetchAll($table)
    {
        $sql = "SELECT * FROM {$table} WHERE 1";
        $result = mysqli_query($this->connect, $sql) or die("Lỗi Truy Vấn fetchAll " . mysqli_error($this->connect));
        $data = [];
        if ($result) {
            while ($num = mysqli_fetch_assoc($result)) {
                $data[] = $num;
            }
        }
        return $data;
    }

}

?>