<?php
class Order
{
    public $status_code;
    public $message;
    public $reason = "";
    public function __construct($status_code, $reason = "")
    {
        switch ($status_code) {
            case 0: {
                // Đang chờ duyệt
                $this->message = "Đang chờ duyệt";
                    break;
                }
            case 1: {
                $this->message = "Đang giao hàng";
                    break;
                }
            case 2: {
                $this->message = "Đã giao hàng";
                    break;
                }
            case 3: {
                $this->message = "Đã hủy";
                $this->reason = $reason;
                    break;
                }
        }
    }
}
