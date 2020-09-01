<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('about')->insert([
            'title' => 'Sponsor a child',
            'introduction' => 'Sponsoring a child means being their hero. It is giving her the opportunity to live a happy childhood and in the future to become a healthy adult, a responsible citizen and an agent of change',
            'description' => 'A Blockchain Charity Foundation é uma organização sem fins lucrativos dedicada a alcançar o desenvolvimento sustentável global, liberando o poder da blockchain. Desenvolvemos e testamos soluções viáveis que abordam a causa raiz dos problemas sociais para orientar as pessoas a sair da armadilha da pobreza. Esperamos que a transparência e a inclusão do sistema de doação de blockchain desencadeiem a disposição dos doadores de participar e motivem os beneficiários finais a melhorar fundamentalmente suas condições de vida.
                                Acreditamos que ninguém deve ser deixado para trás durante a atual revolução da blockchain e estamos determinados a trazer os benefícios dessa revolução para as pessoas que não tinham acesso à inovação tecnológica antes. A fundação é iniciada pela Binance, a maior bolsa de criptomoedas do mundo em volume de negócios, liderada por Helen Hai, Embaixadora da Boa Vontade da UNIDO, em colaboração com Marie-Louise Coleiro Preca, Presidente de Malta, como Presidente do Conselho Consultivo.',
            'image'      => 'about-image.png'
        ]);
    }
}
