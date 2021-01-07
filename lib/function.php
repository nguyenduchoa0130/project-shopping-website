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
        <form action='/project-shopping-website/admin/modules/product/update-product.php' method='post' id='formUpdateProduct' accept-charset='utf-8'>
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
    return $head . $foot;
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
        ";
}
function createFormForgetPassword($username)
{
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
        ";
}
function hashPassword($password)
{
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
function convertImageToBase64($name_input)
{
    if (getimagesize($_FILES["{$name_input}"]["tmp_name"])) {
        $img = addslashes($_FILES["{$name_input}"]["tmp_name"]);
        $name = addslashes($_FILES["{$name_input}"]["name"]);
        $img = file_get_contents($img);
        $img = base64_encode($img);
        return array("name" => $name, "image" => $img);
    } else {
        return null;
    }
}
function isExistsImage(array $data_img, $number_order)
{
    foreach ($data_img as $data) {
        $img = new ImageProduct($data);
        if ($img->number_order == $number_order) {
            return $img;
        }
    }
    return null;
}
function createStarRating($star)
{
    $star = ($star/10 >5) ? 5 :  ($star/10);
    $str = "";
    for ($i = 0; $i < (int)$star; $i++) {
        $str .= "<span class='h3 m-0'><i class='fa fa-star text-waring'></i></span>";
    }
    for ($i = 0; $i < (int)(5 - $star); $i++) {
        $str .= "<span class='h3 m-0'><i class='fa fa-star text-muted'></i></span>";
    }
    $str .= "<span class='h3 m-0'><span class='ml-2 badge badge-warning'>{$star}</span></span>";
    return $str;
}
function createSrcImage($strBase64)
{
    return "data:image;base64, {$strBase64}";
}
function createCardProduct($product, $img)
{
    $img = resizeImage($img, 200, 200);
    $url = ROOT . "/modules/product/index.php?id_product={$product->id_product}";
    $src = createSrcImage($img['image']);
    $header =
        "
    <div class='card border border-secondary mb-4 mr-2 col-xs-2 col-sm-2 col-md-3 col-lg-3'>
    <a href='{$url}' class='position-relative d-block m-auto'>
        <img src='{$src}' alt='image'>
    </a>
    <div class='card-body'>
            <a href='{$url}' class='text-decoration-none'>
                <h4 class='font-weight-normal'>{$product->name_product}</h4>
            </a>
        
        <div class='post-meta'>
            <span class='small lh-120'><i class='fas fa-map-marker-alt mr-2'></i>Sản xuất tại: {$product->produced_at}</span>
        </div>
        <div class='d-flex my-4'>
    ";
    $star = $product->star / 10;
    $star = ($star > 5) ? 5 : $star;
    $middle = "";
    for ($i = 0; $i < (int)$star; $i++) {
        $middle .= " <i class='star fas fa-star text-warning'></i>";
    }
    for ($i = 0; $i < (5 - (int)$star); $i++) {
        $middle .= " <i class='star fas fa-star text-muted'></i>";
    }

    $footer = "
    <span class='badge badge-pill badge-success ml-2'>{$star}</span>
        </div>
        <div class='d-flex justify-content-between text-wrap'>
            <div class='col pl-0 text-center' style='border-right: 2px solid #E9EDDC;'>
                <span class='text-success h3 d-block mb-2'>
                    <i class='fas fa-money-bill-wave'></i>
                </span>
                <span class='h5 text-success font-weight-bold text-wrap'>{$product->price}</span>
            </div>
            <div class='col text-center' style='border-right: 2px solid #E9EDDC; color: red;'>
                <span class='h3 d-block mb-2'>
                    <i class='fas fa-heart'></i></i>
                </span>
                <span class='h5 font-weight-bold' style='color:red;'>{$product->number_liked}</span>
            </div>
            <div class='col pr-0 text-center'>
                <span class='text-info h3 d-block mb-2'>
                    <i class='fas fa-boxes'></i>
                </span>
                <span class='h5 font-weight-bold'>0</span>
            </div>
        </div>
    </div>
</div> 
    ";
    return $header . $middle . $footer;
}
function createCardProductLike($product, $img)
{
    $url = ROOT. "/modules/product/index.php?id_product={$product->id_product}";
    $img = resizeImage($img, 250, 150);
    $src = createSrcImage($img["image"]);
    return "
    <div class='card shadow-sm border-primary mb-4 p-0 col-xs-3 col-sm-3 col-md-3 col-lg-3 '>
        <a href='{$url}' class='text-decoration-none position-relative '>
            <img src='{$src}' class='card-img-top' alt='image'> </a>
        <div class='card-body  position-relative'>
            <a href='{$url}' class='text-decoration-none'>
                <h5 class='font-weight-normal mb-4'>{$product->name_product}</h5>
            </a>
            <div class='d-flex my-2'>
            ".
            createStarRating($product->star)
            ."
            </div>
            <div class='row p-2'>
                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 p-2'>
                    <p class='text-primary font-italic h5 mx-1'>Số Lượng: </p>
                    <div class='input-group'>
                        <span class='input-group-prepend'>
                            <button type='button' class='btn btn-outline-danger btn-number' disabled='disabled' data-type='minus' data-field='quant[1]'>
                                <span class='fa fa-minus'></span>
                            </button>
                        </span>
                        <input type='text' id='quantity' name='quant[1]' class='form-control input-number text-center font-weight-bold' value='1' min='1' max='{$product->quantity}'>
                        <span class='input-group-append'>
                            <button type='button' class='btn btn-outline-success btn-number' data-type='plus' data-field='quant[1]'>
                                <span class='fa fa-plus'></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class='row container-fluid d-flex justify-content-around m-0 p-0'>
                <div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center my-2 w-100'>
                    <a class='btn btn-success w-100 py-2 px-6' href='{$url}'>
                        <i class='fas fa-file-invoice h3 m-0'></i>
                    </a>
                </div>
                <div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center my-2 w-100'>
                    <button class='btn btn-primary w-100 py-2 px-6' id='btn-add-to-cart' data-id='{$product->id_product}'>
                        <i class='fas fa-cart-plus h3 m-0'></i>
                    </button>
                </div>
                <div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center my-2 w-100'>
                    <button class='btn btn-danger w-100 py-2 px-6' id='btn-dislike'  data-id='{$product->id_product}'>
                        <i class='fas fa-heart-broken h3 m-0'></i>
                    </button>
                </div>

            </div>
        </div>
</div>
            ";
}
function createCardProductCart($id_product, $name_product, $price, $quantitySelect, $quantityRemain, $img){
    $img = resizeImage($img, 150, 150);
    $src = createSrcImage($img["image"]);
    return "
    <div class='card mb-3 mt-2 border border-primary container'>
        <div class='row'>
            <div class='col-xs-1 col-sm-1 col-md-1 col-lg-1 p-0 m-0' style='border-right: 1px solid #1B8AF2'>
                <div class='container h-100 d-flex justify-content-center align-items-center mt-2'>
                    <input type='checkbox' style='transform: scale(2);' class='select-product'>
                </div>
            </div>
            <div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 py-2 d-flex justify-content-center align-items-center' style='border-right: 1px solid #1B8AF2'>
                <img src='{$src}' alt='Image product'>
            </div>
            <div class='col-xs-7 col-sm-7 col-md-7 col-lg-7'>
                <div class='card-body'>
                    <h5 class='card-title h3 text-primary name'> {$name_product} </h5>
                    <p class='card-text h3 text-danger price'>Giá: {$price}</p>
                    <p class='card-text h6 text-info font-italic'>(Chỉ còn {$quantityRemain} sản phẩm)</p>
                    <div class='input-group w-50'>
                        <span class='input-group-prepend'>
                            <button type='button' class='btn btn-outline-danger btn-number' disabled='disabled' data-type='minus' data-field='quant[1]'>
                                <span class='fa fa-minus'></span>
                            </button>
                        </span>
                        <input type='text' id='quantity-{$id_product}' name='quant[1]' class='form-control input-number text-center font-weight-bold quantity' value='{$quantitySelect}' min='1' max='{$quantityRemain}'>
                        <span class='input-group-append'>
                            <button type='button' class='btn btn-outline-success btn-number' data-type='plus' data-field='quant[1]'>
                                <span class='fa fa-plus'></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class='col-xs-1 col-sm-1 col-md-1 col-lg-1 p-1 m-0 d-flex justify-content-end align-items-start'>
                <button class='btn btn-danger' id='btn-remove-product-cart'><span class='h3 m-0'>×</span></button>
            </div>
        </div>
    </div>
                            ";
}
function resizeImage($img, $new_width, $new_height)
{
    $WIDTH = $new_width;
    $HEIGHT = $new_height;
    $theme_image_little = imagecreatefromstring(base64_decode($img["image"]));
    $image_little = imagecreatetruecolor($WIDTH, $HEIGHT);
    $size = getimagesizefromstring(base64_decode($img["image"]));
    $org_w = $size[0];
    $org_h = $size[1];
    // $org_w and org_h depends of your image, in your case, i guess 800 and 600
    imagecopyresampled($image_little, $theme_image_little, 0, 0, 0, 0, $WIDTH, $HEIGHT, $org_w, $org_h);

    // Thanks to Michael Robinson
    // start buffering
    ob_start();
    imagepng($image_little);
    $contents =  ob_get_contents();
    ob_end_clean();

    $theme_image_enc_little = base64_encode($contents);
    $img["image"] = $theme_image_enc_little;
    return $img;
}
