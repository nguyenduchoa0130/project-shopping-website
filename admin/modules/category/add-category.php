<?php
require_once __DIR__ . "/../../../autoload/autoload.php";
if ($_POST["values"]) {
    $data = $_POST["values"];
    $props = handleDataForm($data);
    $result = $database->insert("tbl_category", $props);
    if ($result) {
        echo "<h4 class='modal-title w-100 text-success' id='myModalLabel'>Thêm Thành Công</h4>";
    } else {
        echo "<h4 class='modal-title w-100 text-danger' id='myModalLabel'>Thêm Thất Bại</h4>";
    }
} else {
    echo "Có Lỗi Đã Xảy Ra !!!";
}
