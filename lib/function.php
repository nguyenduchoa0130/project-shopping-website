<?php
require_once __DIR__ . "/../autoload/autoload.php";
function handleDataFormCategory($data)
{
    $props = array();
    $arr = explode("&", $data);
    foreach ($arr as $item) {
        $prop = explode("=", $item);
        $key = $prop[0];
        $value = urldecode($prop[1]);
        $props += [$key => $value];
    }
    return $props;
}
function createFormProductDetail($id_category, $name_category, $product, $imgs)
{
    $head = "
        <form action='' method='post' id='formAddProduct' accept-charset='utf-8'>
            <div class='row'>
                <div class='col-xs-8 col-sm-8 col-md-8 col-lg-8'>
                    <div class='form-group'>
                        <label for='name_product'>Tên Sản Phẩm</label>
                        <input class='form-control' id='name_product' name='name_product' type='text' placeholder='Tên Sản Phẩm' value='{$product->get_NameProduct()}' required>
                    </div>
                    <div class='form-group'>
                        <label for='price'>Giá Sản Phẩm</label>
                        <input class='form-control' id='price' name='price' type='text' placeholder='Tên Sản Phẩm' value='{$product->get_Price()}' required>
                    </div>
                    <div class='form-group'>
                        <label for='quantity'>Số Lượng</label>
                        <input class='form-control' id='quantity' name='quantity' type='number' placeholder='Số Lượng' value='{$product->get_Quantity()}' required>
                    </div>
                    <div class='form-group'>    
                        <label for='produced_at'>Nơi Sản Xuất</label>
                        <input class='form-control' id='produced_at' name='produced_at' type='text' placeholder='Nơi Sản Xuất' value='{$product->get_ProducedAt()}' required>
                    </div>   
                    <div class='form-group'>
                        <label for='description'>Mô Tả</label>
                        <textarea class='form-control' id='description' name='description' rows='3'>{$product->get_Description()}</textarea>
                    </div>
                    <div class='form-group d-none'>
                        <input class='form-control' id='id_category' name='id_category' type='text' value='{$id_category}' readonly>
                    </div>
                    <div class='form-group'>
                        <input class='form-control' id='category' name='category' type='text' value='{$name_category}' readonly>
                    </div>
                </div>
                ";
    $middle_start = "
        <div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'>
        ";
    foreach($imgs as $img){
        $item = new ImageProduct($img);
        $middle_start.= "
                        <div class='card mb-3' style='width: 80%;'>
                            <img class='card-img-top' src='{$item->get_Link()}' alt='Hình Ảnh Sản Phẩm'>
                        </div>
                        ";
    }
    $middel_end = "
                 </div>
            </div>
    ";
    $foot = "
            <div class='row'>
                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                    <div class='modal-footer'>
                        <button type='submit' id='btn-update-info' class='btn btn-success m-auto  waves-effect waves-light'>Cập Nhật</button>
                        <button type='button' id='btn-delete-info' class='btn btn-danger m-auto waves-effect waves-light' data-toggle='modal' data-target='#verifyDelete'>Xóa</button>
                        <button type='button' class='btn btn-warning m-auto' data-dismiss='modal'>Đóng</button> 
                    </div>
                </div>
            </div>
        </form>
                ";
    return $head.$middle_start.$middel_end.$foot;
}
function root(){
    return "http://localhost/project-shopping-website/";
}
function createInsertSql($table, array $data)
{
    $sqlStr = "INSERT INTO `{$table}`(";
    foreach ($data as $key => $value) {
        $sqlStr .= "`" . $key . "`" . ",";
    }
    $sqlStr = substr($sqlStr, 0, strlen($sqlStr) - 1);
    $sqlStr .= ") VALUES(";
    foreach ($data as $key => $value) {
        if (is_string($value)) {
            $sqlStr .= "N'" . ($value) . "'" . ",";
        } else {
            $sqlStr .= $value . ",";
        }
    }
    $sqlStr = substr($sqlStr, 0, strlen($sqlStr) - 1);
    $sqlStr .= ")";
    return $sqlStr;
}
function createUpdateSql($table, $id_name, $val, array $data)
{
    $sqlStr = "UPDATE `{$table}` SET ";
    foreach ($data as $key => $value) {
        if (is_string($value)) {
            $sqlStr .= "`" . $key . "`" . "=" . "N'" . $value . "'" . ",";
        } else {
            $sqlStr .= "`" . $key . "`" . "=" .  $value . ",";
        }
    }
    $sqlStr = substr($sqlStr, 0, strlen($sqlStr) - 1);
    $sqlStr .= " WHERE `{$id_name}` = $val";
    return $sqlStr;
}
