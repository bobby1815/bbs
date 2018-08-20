<?php

use Illuminate\Database\Seeder;

class NoticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Notice::create([
			'use_yn'        =>'Y',
	        'title'         =>str_random(15),
	        'content'       =>sprintf('%s',str_random(100)),
	        'view_count'    =>rand(1,200),
	        'bbs_sttus'     =>str_random(1),
			'user_id'       =>'duehddjs@gmail.com'
        ]);
    }
}
