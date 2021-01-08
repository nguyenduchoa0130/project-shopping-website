<?php
class Status
{
    public $status_code;
    public $message;
    public $reason = "";
    public function __construct($status_code, $reason = "")
    {
        $this->status_code = $status_code;
        switch ($status_code) {
            case 1: {
                // Đang chờ duyệt
                $this->message = "Đang chờ duyệt";
                    break;
                }
            case 2: {
                $this->message = "Đang giao hàng";
                    break;
                }
            case 3: {
                $this->message = "Đã giao hàng";
                    break;
                }
            case 4: {
                $this->message = "Đã hủy";
                $this->reason = $reason;
                    break;
                }
        }
    }
}
