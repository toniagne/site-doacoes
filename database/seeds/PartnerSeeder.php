<?php

use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('partners')->insert(
            [
                'title'     => 'WAS',
                'image'     => 'was.png'
            ],
            [
                'title'     => 'WALLET',
                'image'     => 'wallet.png'
            ],
            [
                'title'     => 'USAEXCHANG',
                'image'     => 'usaexchang.png'
            ],
            [
                'title'     => 'BITCHAIN',
                'image'     => 'bitchain.png'
            ]
        );
    }
}
