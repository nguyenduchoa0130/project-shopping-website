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
                <div class='col-xs-7 col-sm-7 col-md-7 col-lg-7'>
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
                        <label for='category'>Mục</label>
                        <input class='form-control' id='category' name='category' type='text' value='{$name_category}' readonly>
                    </div>
                </div>
                <div class='col-xs-5 col-sm-5 col-md-5 col-lg-5'>
                    <div class='container-fluid'>
                        <div class='form-group'>
                            <label for='image1'>Cập nhật hình ảnh</label>
                            <input type='file' class='form-control-file text-wrap' id='image1' name='image1' accept='image/*'>
                            <div class='container-fluid image-preview'>
                                <img>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='image2'>Cập nhật hình ảnh</label>
                            <input type='file' class='form-control-file text-wrap' id='image2' name='image2' accept='image/*'>
                            <div class='container-fluid image-preview'>
                                <img>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='image3'>Cập nhật hình ảnh</label>
                            <input type='file' class='form-control-file text-wrap' id='image3' name='image3' accept='image/*'>
                            <div class='container-fluid image-preview'>
                                <img>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
                ";
    $foot = "
            
            <div class='row'>
                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                    <div class='modal-footer'>
                        <button type='submit' class='btn btn-success m-auto  waves-effect waves-light'>Cập Nhật</button>
                        <button type='button' class='btn btn-danger m-auto waves-effect waves-light' data-toggle='modal' data-target='#product-verifyDelete'>Xóa</button>
                    </div>
                </div>
            </div>
        </form>
                ";
    return $head.$foot;
}
function createFormVerifyOTP($username, $email)
{
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
        <div class='form-label-group d-none'>
            <input type='text' id='username' name='username' class='form-control text-center' value='{$username}'>
        </div>
        <div class='form-group'>
            <input type='text' id='otp' name='otp' class='form-control text-center font-weight-bold' placeholder='Mã OTP' required autofocus>
        </div>
        <div class='my-3 px-3' id='register-notification'>
        
        </div>
        <div class='form-label-group'>
            <button class='btn btn-lg btn-primary btn-block text-uppercase' type='submit'><span><i class='fas fa-envelope'></i></span> Xác thực</button>
        </div>
    </form>
    ";
}
function createFormVerifyProfileUser(array $account)
{
    return 
    "
    <div class='card-body'>
        <h5 class='card-title text-center text-primary font-weight-bold'><span><i class='fas fa-user-plus'></i></span> Thông Tin Tài Khoản</h5>
        <hr class='my-4'>
        <form class='form-signin' action='' method='post' id='register-form-complete-profile'>
            <div class='row'>
                <div class='col-xs-6 col-sm-6 col-md-6 col-lg-6'>
                    <div class='form-label-group'>
                        <input type='text' id='username' name='username' class='form-control' placeholder='Tên đăng nhập...' value='{$account['username']}' required readonly>
                        <label for='username'>Tên Đăng Nhập</label>
                    </div>
                    <div class='form-label-group'>
                        <input type='password' id='password' name='password' class='form-control' placeholder='Password' value='{$account['password']}' required readonly>
                        <label for='password'>Mật Khẩu</label>
                    </div>
                    <div class='form-label-group'>
                        <input type='email' id='email' name='email' class='form-control' placeholder='Địa chỉ email..' value='{$account['email']}' required readonly>
                        <label for='email'>Địa Chỉ Email</label>
                    </div>
                </div>
                <div class='col-xs-6 col-sm-6 col-md-6 col-lg-6'>
                    <div class='form-label-group'>
                        <input type='text' id='fullname' name='fullname' class='form-control' placeholder='Họ và tên' required autofocus>
                        <label for='fullname'>Họ và tên</label>
                    </div>
                    <div class='form-label-group'>
                        <div class='container-fluid d-flex justify-content-around'>
                            <div class='form-check form-check-inline'>
                                <input class='form-check-input' type='radio' name='gender' id='male' value='Nam' checked>
                                <label class='form-check-label font-weight-bold' style='font-size: 18px !important;' for='male'>Nam</label>
                            </div>
                            <div class='form-check form-check-inline'>
                                <input class='form-check-input' type='radio' name='gender' id='female' value='Nữ'>
                                <label class='form-check-label font-weight-bold' style='font-size: 18px !important;' for='female'>Nữ</label>
                            </div>
                        </div>

                    </div>
                    <div class='form-label-group'>
                        <input type='birth' id='birth' name='birth' class='form-control' placeholder='Ngày sinh' required>
                        <label for='birth'>Ngày sinh</label>
                    </div>
                    <div class='form-label-group'>
                        <input type='phone' id='phone' name='phone' class='form-control' placeholder='Số điện thoại' required>
                        <label for='phone'>Số điện thoại</label>
                    </div>
                    <div class='form-label-group'>
                        <input type='address' id='address' name='address' class='form-control' placeholder='Địa chỉ' required>
                        <label for='address'>Địa chỉ</label>
                    </div>
                </div>
            </div>
            <div class='row'>
            <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                <div class='my-3 px-3' id='register-notification'>

                </div>
            </div>
             </div>
            <div class='row'>
                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                    <div class='form-label-group'>
                        <button class='btn btn-lg btn-primary btn-block text-uppercase' type='submit'><span><i class='fas fa-user-plus'></i></span> Hoàn Tất Đăng Ký</button>
                    </div>
                </div>
            </div>
        </form>
        <a class='btn-additional btn btn-lg btn-google btn-block text-uppercase' href='login.php'><span><i class='fas fa-sign-in-alt'></i></span> Đăng Nhập</a>
        <a class='btn-additional btn btn-lg btn-success btn-block text-uppercase' href='../../index.php'><span><i class='fas fa-arrow-left'></i></span> Trở về trang chủ</a>
    </div> 
        "
    ;
}
function createFormForgetPassword($username){
    return 
    "
    <div class='card-body' id='forget-password-content'>
        <h5 class='card-title text-center text-primary font-weight-bold'><span><i class='fas fa-user-plus'></i></span> Mật Khẩu Mới</h5>
        <hr class='my-4'>
        <form class='form-signin' action='' method='post' id='forget-password-form-complete-password'>
            <div class='row'>
                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                    <div class='form-label-group d-none'>
                        <input type='text' id='username' name='username' class='form-control text-center' value='{$username}'>
                    </div>
                    <div class='form-label-group'>
                        <input type='password' id='password' name='password' class='form-control' placeholder='Mật khẩu' required >
                        <label for='password'>Mật Khẩu</label>
                    </div>
                    <div class='form-label-group'>
                        <input type='password' id='confirm-password' name='confirm-password' class='form-control' placeholder='Nhập lại mật khẩu' required >
                        <label for='confirm-password'>Nhập lại mật khẩu</label>
                    </div>
                </div>      
            </div>
            <div class='row'>
                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                    <div class='my-3 px-3' id='forget-password-notification'>

                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                    <div class='form-label-group'>
                        <button class='btn btn-lg btn-primary btn-block text-uppercase' type='submit'><span><i class='fas fa-search' aria-hidden='true'></i></span> Hoàn Tất</button>
                    </div>
                </div>
            </div>
        </form>
        <a class='btn-additional btn btn-lg btn-google btn-block text-uppercase' href='login.php'><span><i class='fas fa-sign-in-alt'></i></span> Đăng Nhập</a>
        <a class='btn-additional btn btn-lg btn-success btn-block text-uppercase' href='../../index.php'><span><i class='fas fa-arrow-left'></i></span> Trở về trang chủ</a>
    </div> 
        "
    ;
}
function hashPassword($password){
    return password_hash($password, PASSWORD_DEFAULT);
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
function convertImageToBase64($name_input){
    if (getimagesize($_FILES["{$name_input}"]["tmp_name"])) {
        $img = addslashes($_FILES["{$name_input}"]["tmp_name"]);
        $name = addslashes($_FILES["{$name_input}"]["name"]);
        $img = file_get_contents($img);
        $img = base64_encode($img);
        return array("name" => $name, "image" => $img);
    }else{
        return null;
    }
}
