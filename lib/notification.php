<?php
    class Notification{
        public $noti_code;
        public $message;
        /*
        * @param noti_code
        *   0. Lỗi
        *   1. Thành công
        *   2. Thêm (chỉ áp dụng cho bảng tbl_like)
        *   3. Xóa (chỉ áp dụng cho bảng tbl_like)
        */
        public function __construct($noti_code, $message)
        {
            $this->noti_code = $noti_code;
            if($this->noti_code == 0){
                $this->message = "<p class='h6 text-danger font-weight-bold'><i class='fas fa-times'></i> ".$message."</p>";
            }else if($this->noti_code == 1){
                $this->message = "<p class='h3 text-success text-center font-weight-bold'><i class='fas fa-envelope'></i></p>".$message;
            }else{
                $this->message = $message;
            }
        }
    }
?>