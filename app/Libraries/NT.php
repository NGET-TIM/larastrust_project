<?php
namespace APP\Libraries;
use App\Models\Settings\Settings;

Class NT {


    public static function payment_status($status) {
        $text = "";
        if($status == "paid") {
            $text = "<span class=\"btn text-capitalize btn-xs btn-primary\">".$status."</span>";
        } else if($status == "pending") {
            $text = "<span class=\"btn text-capitalize btn-xs btn-warning\">".$status."</span>";
        }  else if($status == "due") {
            $text = "<span class=\"btn text-capitalize btn-xs btn-danger\">".$status."</span>";
        } else {
            $text = "<span class=\"btn text-capitalize btn-xs btn-secondary\">".$status."</span>";
        }
        return $text;
    }

    public static function Settings() {
        return Settings::findOrFail(1);
    }



}




?>
