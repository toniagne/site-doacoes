<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\About;
use App\Models\Partner;
use Tests\CreatesApplication;
use View;

class HomeController extends Controller
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

        return view('site.home', array(

            // slides basado em 3 itens randômicos da tabela campanhas
            'slides' => $this->campaigns->limit(4)->inRandomOrder()->get(),


        ));
    }

    public function about(){
        return view('site.about', array(
            'about' => About::All()->first()
        ));
    }

    public function privacy(){
        return view('site.privacy');
    }


}
