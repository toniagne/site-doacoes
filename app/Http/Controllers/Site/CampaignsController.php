<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\About;
use App\Models\Partner;
use Illuminate\Support\Facades\DB;
use View;

class CampaignsController extends Controller
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

    public function index(){

        return view('campaings.index', array(
            'campaigns' => Campaign::All()
        ));
    }

    public function details(Request $request){

        $campaign = Campaign::where('slug', $request->slug)->first();

        return view('campaings.details', array(
            'singleCampaign' => $campaign,
            'donors'         => $campaign->donors()->whereNotNull('txid')->get()
        ));
    }



}
