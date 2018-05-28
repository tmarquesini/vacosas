<?php

namespace App\Helpers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Functions
{
    /**
     * @return string
     */
    public static function percent($value, $total)
    {

        if ($total == 0) {
            return 0;
        }
        $values = ($value * 100) / $total;
        return number_format($values, 0, ".", "");
    }
 /**
     * @return string
     */
    public static function status($status)
    {


        if ($status == "aberta") {
            $st = '<span class="badge badge-success">Aberta</span>';
        }elseif($status == "fechada"){
            $st = '<span class="badge badge-danger">Fechada</span>';
        }

        return $st;
    }
 public static function statusUsers($status)
    {

        if ($status == 0) {
            $st = '<span class="badge badge-success">Ativo</span>';
        }else{
            $st = '<span class="badge badge-danger">Bloqueado</span>';
        }

        return $st;
    }

    public static function diffDateContri($date)
    {

        $today = Carbon::now();
        $diff = new Carbon($date);
        return ($date!=""?$diff->diffForHumans($today):" - ");
    }

}