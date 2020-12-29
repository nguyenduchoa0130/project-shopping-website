<?php
require_once __DIR__ . "/../autoload/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function handleDataForm($data)
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
        <form action='' method='post' id='formUpdateProduct' accept-charset='utf-8'>
            <div class='row'>
                <div class='col-xs-8 col-sm-8 col-md-8 col-lg-8'>
                    <div class='form-group d-none'>
                        <input class='form-control' id='id_product' name='id_product' type='text' value='{$product->get_IdProduct()}' readonly>
                    </div>
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
    if ($imgs) {
        foreach ($imgs as $img) {
            $middle_start .= "
                            <div class='card mb-3' style='width: 80%;'>
                                <img class='card-img-top' src='{$img->get_Link()}' alt='Hình Ảnh Sản Phẩm'>
                            </div>
                            ";
        }
    }
    $middel_end = "
                 </div>
            </div>
    ";
    $foot = "
            <div class='row'>
                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                    <div class='modal-footer'>
                        <button type='submit' class='btn btn-success m-auto  waves-effect waves-light'>Cập Nhật</button>
                        <button type='button' class='btn btn-danger m-auto waves-effect waves-light' data-toggle='modal' data-target='#verifyDelete'>Xóa</button>
                    </div>
                </div>
            </div>
        </form>
                ";
    return $head . $middle_start . $middel_end . $foot;
}
function root()
{
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
function checkData($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function sendEmail($to, $subject, $content)
{
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'duynguyen2510abc@gmail.com';                     // SMTP username
        $mail->Password   = '123abcxyz~';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        $mail->CharSet = 'UTF-8';
        //Recipients
        $mail->setFrom('duynguyen2510abc@gmail.com', "Happy Shopping");
        $mail->addAddress($to);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
function createFormVerifyOTP($email){
    return 
    "
    <h5 class='card-title text-center text-success font-weight-bold'><span><i class='fas fa-user-plus'></i></span> Xác Thực Tài Khoản</h5>
    <hr>
    <form class='form-signin' action='' method='post' id='register-form-verify-otp'>
        <div class='form-label-group'>
            <h6 class='card-title text-center text-primary font-weight-bold'> 
                Chúng tôi đã gửi 1 mã xác thực tới {$email}
            </h6>
        </div>
        <hr>
        <div class='form-label-group'>
            <input type='text' id='otp' name='otp' class='form-control text-center' placeholder='OTP' required autofocus>
            <label for='otp'>OTP</label>
        </div>
        <div class='my-3 px-3' id='register-notification'>
        
        </div>
        <div class='form-label-group'>
            <button class='btn btn-lg btn-primary btn-block text-uppercase' type='submit'><span><i class='fas fa-envelope'></i></span> Xác thực</button>
        </div>
    </form>
    ";
}