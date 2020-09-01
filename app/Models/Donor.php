<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Donor extends Model
{
    protected $table = 'donors';
    protected $primaryKey = 'donors_id';

    protected $fillable       = [
        'campaign_id',
        'name',
        'show',
        'amount',
        'currency',
        'email',
        'status',
        'txid'
    ];

    public function campaign()
    {
        return $this->belongsTo('App\Models\Campaign', 'campaign_id', 'campaigns_id');
    }

    public static function isAddress($address) {
        if (!preg_match('/^(0x)?[0-9a-f]{40}$/i',$address)) {
            // check if it has the basic requirements of an address
            return false;
        } else if (!preg_match('/^(0x)?[0-9a-f]{40}$/',$address) || preg_match('/^(0x)?[0-9A-F]{40}$/',$address)) {
            // If it's all small caps or all all caps, return true
            return true;
        } else {
            // Otherwise check each case
            return true;
        }
    }

    public static function isChecksumAddress($address) {
        // Check each case
        $address = str_replace('0x','',$address);
        $addressHash = hash('sha3-256',strtolower($address));

        $addressArray=str_split($address);
        $addressHashArray=str_split($addressHash);

        for($i = 0; $i < 40; $i++ ) {
            // the nth letter should be uppercase if the nth digit of casemap is 1
            if ((intval($addressHashArray[$i], 16) > 7 && strtoupper($addressArray[$i]) !== $addressArray[$i]) || (intval($addressHashArray[$i], 16) <= 7 && strtolower($addressArray[$i]) !== $addressArray[$i])) {
                return false;
            }
        }
        return $addressHash;
    }

    public static function checkAddress($address)
    {
        $origbase58 = $address;
        $dec = "0";

        for ($i = 0; $i < strlen($address); $i++)
        {
            $dec = bcadd(bcmul($dec,"58",0),strpos("123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz",substr($address,$i,1)),0);
        }

        $address = "";

        while (bccomp($dec,0) == 1)
        {
            $dv = bcdiv($dec,"16",0);
            $rem = (integer)bcmod($dec,"16");
            $dec = $dv;
            $address = $address.substr("0123456789ABCDEF",$rem,1);
        }

        $address = strrev($address);

        for ($i = 0; $i < strlen($origbase58) && substr($origbase58,$i,1) == "1"; $i++)
        {
            $address = "00".$address;
        }

        if (strlen($address)%2 != 0)
        {
            $address = "0".$address;
        }

        if (strlen($address) != 50)
        {
            return false;
        }

        if (hexdec(substr($address,0,2)) > 0)
        {
            return false;
        }

        return substr(strtoupper(hash("sha256",hash("sha256",pack("H*",substr($address,0,strlen($address)-8)),true))),0,8) == substr($address,strlen($address)-8);
    }

}
