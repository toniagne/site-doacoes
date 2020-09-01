<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Curl\Curl;
use App\Models\Campaign;
use App\Models\About;
use App\Models\Partner;
use App\Models\Donor;
use View;

class DonationController extends Controller
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

        $this->curl = new Curl();
    }

    public function create(Request $request){

       // $curl = new Curl('http://eth.bitchainexchanges.com');

       // $curl->setBasicAuthentication(config('app.payments_config.username'), config('app.payments_config.password'));

        return view('donations.create', array('campaign' => $this->campaigns->get($request->slug)));
    }

    public function openly(Request $request){

        if ($request->post()){

            return view('donations.openly', [
                'campaign' => $this->campaigns->get($request->slug),
                'donor'    => $request->all()
            ]);
        }
    }

    public function completed(Request $request){

        if ($request->post()){

            $donor =  Donor::create($request->all());

            return view('donations.completed', [
                'campaign' => $this->campaigns->get($request->slug),
                'donor'    => $donor
            ]);
        }
    }
    public function checktxid(Request $request){

        // LOCALIZA CADASTRO DO DOADOR
        $donor = Donor::find($request->donor_id);

        // ROTINA BTC
        if ($request->currency == "BTC"){

            // CONSULTA TXID API BTC
            $this->curl->get('https://blockchain.info/rawtx/'.$request->txid, array(
                'format' => 'json'
            ));

            // RETORNA POSIÇÃO DA API (BTC)
            $response = isset($this->curl->response->hash);


        } else {
            // CONSULTA TXID API ETH
            $this->curl->get('https://api.etherscan.io/api', array(
                'module' => 'proxy',
                'action' => 'eth_getTransactionByHash',
                'txhash' => $request->txid,
                'apikey' => 'SK72PN5W4NV36ACU8CQ91XX6A9F98WGJFR'
            ));

            // RETORNA POSIÇÃO DA API (ETC)
            $response = isset($this->curl->response->result->hash);

        }

        // ATUALIZA CAMPO TXID CASO API SEJA VERDADEIRO
        if ($response)
            $donor->update(['txid'=>$request->txid]);


        // RETORNA RESULTADO DA PESQUISA PARA REQ AJAX (JSON)
        return response()->json( ['txid'=>$response]);



    }

    public function done(Donor $donor){

        $donor->update([
            'status' => 'done'
        ]);

        return view('donations.done', [
            'campaign' => $donor->campaign,
            'donor'    => $donor
        ]);
    }

}
