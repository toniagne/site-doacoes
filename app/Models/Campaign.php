<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaigns';
    protected $primaryKey = 'campaign_id';
    protected $BTC_value;
    protected $ETH_value;

    public function __construct(array $attributes = [])
    {
        $urlBTC = "https://blockchain.info/stats?format=json";
        $urlETH = "https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=ethereum";

        $statsBTC = json_decode(file_get_contents($urlBTC), true);
        $statsETH = json_decode(file_get_contents($urlETH), true);


        $this->ETH_value = $statsETH[0]['current_price'];
        $this->BTC_value = $statsBTC['market_price_usd'];
    }

    public function donors()
    {
        return $this->hasMany('App\Models\Donor', 'campaign_id', 'campaigns_id');
    }

    public static function get($slug){
        return  self::where('slug', '=', $slug)->first();
    }

    public  function totalDonations(){
        $donorsAmounts = [];
        foreach ($this->donors()->whereNotNull('txid')->get() as $donors){
            if (empty($donors->amount)){
                $donorsAmounts[$donors->currency][] = 0;
            } else {
                $donorsAmounts[$donors->currency][] = $donors->amount;
            }
        }
        if (empty($donorsAmounts['BTC'])){ $BTC_sum = 0; } else {
            $BTC_sum = array_sum($donorsAmounts['BTC']) * $this->BTC_value;
        }

        if (empty($donorsAmounts['ETH'])){ $ETH_sum = 0; } else {
            $ETH_sum = array_sum($donorsAmounts['ETH']) * $this->ETH_value;
        }

        $sumAll  = $BTC_sum + $ETH_sum;
        $percent1 = $sumAll / $this->vlr;

        $percent2 = $percent1 * 100;

        if ($percent2 > 100){
            $percent = 100;
        } else {
            $percent = $percent2;
        }

        return round($percent, 4);

    }

    public  function totalDonationsAmounts(){
        $donorsAmounts = [];
        foreach ($this->donors()->whereNotNull('txid')->get() as $donors){
            if (empty($donors->amount)){
                $donorsAmounts[$donors->currency][] = 0;
            } else {
                $donorsAmounts[$donors->currency][] = $donors->amount;
            }
        }
        if (empty($donorsAmounts['BTC'])){ $BTC_sum = 0; } else {
            $BTC_sum = array_sum($donorsAmounts['BTC']) * $this->BTC_value;
        }

        if (empty($donorsAmounts['ETH'])){ $ETH_sum = 0; } else {
            $ETH_sum = array_sum($donorsAmounts['ETH']) * $this->ETH_value;
        }

        $sumAll  = $BTC_sum + $ETH_sum;
        return round($sumAll, 2);

    }
}
