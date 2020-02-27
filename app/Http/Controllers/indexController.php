<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class indexController extends Controller
{
    public function index()
    {
        if (request()->input('DateFrom') == null) {
            $from = "";
            $to = "";
        }else{
            $from = request()->input('DateFrom');
            $to = request()->input('DateEnd');
        }

        $dataHotel = array(
            'hotel_id' => 10019,
            'from' => $from,
            'to' => $to,
            'token' => 'mzoc1CEq401565108119FTd7QvbGea',
        );


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://recepshen.ir/api/fetchRooms");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataHotel));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        $response = json_decode(curl_exec($ch));
        // dd($response);
        $rec = $response->data;
        return view('/index')->with(compact('rec'));

    }
}
