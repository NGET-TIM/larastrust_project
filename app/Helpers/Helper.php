<?php
namespace App\Helpers;

use Illuminate\Support\Collection;

class Helper
{

    public static function IDGenerator($model, $trow, $length = 4, $prefix){
        $data = $model::orderBy('id','desc')->first();
        if(!$data){
            $og_length = $length;
            $last_number = '';
        }else{
            $code = substr($data->$trow, strlen($prefix)+1);
            $actial_last_number = ($code/1)*1;
            $increment_last_number = ((int)$actial_last_number)+1;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;
        }
        $zeros = "";
        for($i=0;$i<$og_length;$i++){
            $zeros.="0";
        }
        return $prefix.'-'.$zeros.$last_number;
    }

    protected static $_status = [
        1=> [
            'value' => 1,
            'displayName' => 'Active',
        ],
        2 => [
            'value' => 2,
            'displayName' => 'Inactive',
        ],
        3 => [
            'value' => 3,
            'displayName' => 'Delete',
        ],

    ];

    public static function getStatusesList()
    {
        $status = (new Collection(self::$_status))->pluck('displayName', 'value')->toArray();
        return $status;
    }
    public static function formatMoney($money)
    {
        return number_format($money, 2);
    }
    public static function formatNmuber($money)
    {
        return number_format($money);
    }
}
?>
