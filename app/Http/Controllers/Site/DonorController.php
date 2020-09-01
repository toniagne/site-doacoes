<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\About;
use App\Models\Partner;
use View;


class DonorController extends Controller
{
    public function __construct()
    {
        // variável pública listando as campanhas do site
        View::share('campaigns', Campaign::All());

        // variável publica buscando os dados do site
        View::share('about', About::All()->first());

        // variável publica buscando os dados do site
        View::share('partners', Partner::All());

        // variável estanciada das campanhas
        $this->campaigns = new Campaign();
    }

   public function donors(){
       return view('donors.list', array(
           'donors' => Donor::where('status', 'done')->whereNotNull('txid')->get()
       ));
   }
}
