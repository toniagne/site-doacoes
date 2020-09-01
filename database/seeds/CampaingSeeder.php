<?php

use Illuminate\Database\Seeder;

class CampaingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campaigns')->insert(
                [
                'title'         => 'Lunch for the Children',
                'introduction'  => 'Help feed hungry children and ensure that all children get the food they need.',
                'image'         => 'lunch-for-the-children-campaign.jpg',
                'image_slide'   => 'lunch-for-the-children.png',
                'slug'          => 'lunch-for-the-children',
                'status'        => 'active',
                'victims'       => '135.000',
                'amounts'       => 8,
                'vlr'           => '157000.00',
                'color'         => '255, 99, 132'
            ]);

            DB::table('campaigns')->insert([
                'title'         => 'Bitchain Charity for Study ',
                'introduction'  => 'Help needy children to get education, medical care and a more dignified life!',
                'image'         => 'bitchain-for-study.jpg',
                'image_slide'   => 'bitchain-for-study.png',
                'slug'          => 'bitchain-charity-for-study',
                'status'        => 'active',
                'victims'       => '75.000',
                'amounts'       => 8,
                'vlr'           => '427000.00',
                'color'         => '54, 162, 235'
            ]);

        DB::table('campaigns')->insert([
                'title'         => 'Project for Refugees',
                'introduction'  => 'Helping refugees, taking joint actions to improve the lives of refugees.',
                'image'         => 'project-for-refugees.jpg',
                'image_slide'   => 'project-for-refugees.png',
                'slug'          => 'project-for-refugees',
                'status'        => 'active',
                'victims'       => '300.000',
                'amounts'       => 1,
                'vlr'           => '254500.00',
                'color'         => '55, 206, 86',
            ]);

        DB::table('campaigns')->insert([
                'title'         => 'Health campaign',
                'introduction'  => 'Be a donor helping our health campaign, helping needy sick people in the world',
                'image'         => 'health-campaign.jpg',
                'image_slide'   => 'health-campaign.png',
                'slug'          => 'health-campaing',
                'status'        => 'active',
                'victims'       => '147.000',
                'amounts'       => 5,
                'vlr'           => '248000.00',
                'color'         => '75, 192, 192,'
            ]);

    }
}
