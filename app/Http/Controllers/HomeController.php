<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\url;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $items = DB::table('url')->select('id','url')->get();

        return view('painel_administrativo', [
                                                'urls' => url::where('users_id', auth()->user()->id)->orderBy('created_at','desc')->paginate(10)
                                            ]);
    }

    private function getStatusUrl(String $url){
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_TIMEOUT,10);
        $output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $httpcode;
    }
}
