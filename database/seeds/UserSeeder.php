<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Industries;
use App\Content;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $users = [           
            [
                'name'=>'admin',
                'email'=>'admin@panasonic.com',
                'password'=> Hash::make('12345678')
            ]
        ];

        // Looping and Inserting Array's Users into User Table
        foreach($users as $user){
            User::create($user);
        }

        $industries = [           
            [
                'title'=>'Retail Industry',
                'slug'=>'retail-industry',
                'content'=> 'Retail Industry',
                'banner_image'=>'170772268665c9c7be4e4e4.svg',
                'active'=>'1'
            ],
            [
                'title'=>'QSR Industry',
                'slug'=>'qsr-industry',
                'content'=> 'QSR Industry',
                'banner_image'=>'170772271265c9c7d8591b3.svg',
                'active'=>'1'
            ],
            [
                'title'=>'Meeting Room',
                'slug'=>'meeting-room',
                'content'=> 'Meeting Room',
                'banner_image'=>'170772275465c9c802625cd.svg',
                'active'=>'1'
            ],
            [
                'title'=>'Hospitality',
                'slug'=>'hospitality',
                'content'=> 'Hospitality',
                'banner_image'=>'170772277365c9c81503854.svg',
                'active'=>'1'
            ],
            [
                'title'=>'Airports/ Railways',
                'slug'=>'airports-railways',
                'content'=> 'Airports/ Railways',
                'banner_image'=>'170772279665c9c82c218d9.svg',
                'active'=>'1'
            ],
            [
                'title'=>'Education Institutions',
                'slug'=>'education-institutions',
                'content'=> 'Education Institutions',
                'banner_image'=>'170772285065c9c862efd57.svg',
                'active'=>'1'
            ]
        ];

        // Looping and Inserting Array's Users into User Table
        foreach($industries as $industry){
            Industries::create($industry);
        }

        $contents = [           
            [
                'title'=>'THE SOLUTION FOR ALL YOUR DISPLAY NEEDS',                
                'content'=> '<p>Panasonic&rsquo;s Digital Signage Solution ecosystem includes&nbsp;hardware, software, and services&nbsp;that work holistically together to provide the right-sized display for any scenario. Our exceptional solutions combine the highest quality high-definition (HD) and 4K professional displays, interactive technologies and network-based multimedia content into dynamic systems that work for your business.</p>',                
                'status'=>'1',
                'section_type'=>'first_section',
                'page'=>'HOME'
            ],
            [
                'title'=>'END-TO-END DISPLAY SOLUTIONS',                
                'content'=> '',                
                'status'=>'1',
                'section_type'=>'second_section',
                'page'=>'HOME'
            ],
            [
                'title'=>'OUR DISPLAY, YOUR INDUSTRY',                
                'content'=> '<p>Check out which offerings from our digital signage solution best serve your business&rsquo;s existing or upcoming needs.</p>',                
                'status'=>'1',
                'section_type'=>'third_section',
                'page'=>'HOME'
            ],
            [
                'title'=>'INDUSTRIES SERVES',                
                'content'=> 'Retail Industry',                
                'status'=>'1',
                'section_type'=>'fourth_section',
                'page'=>'HOME'
            ],
            [
                'title'=>'SUCCESS STORIES',                
                'content'=> '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata</p>',                
                'status'=>'1',
                'section_type'=>'fifth_section',
                'page'=>'HOME'
            ],
            [
                'title'=>'NEWSROOM',                
                'content'=> '',                
                'status'=>'1',
                'section_type'=>'sixth_section',
                'page'=>'HOME'
            ]
        ];

        // Looping and Inserting Array's Users into User Table
        foreach($contents as $content){
            Content::create($content);
        }

    }
}
