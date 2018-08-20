<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
	    $faker = app(Faker\Generator::class);
	    $notices = App\Notice::all();

	    $sqlite = in_array(config('database.default'), ['sqlite', 'testing'], true);
	    if (! $sqlite) {
		    DB::statement('SET FOREIGN_KEY_CHECKS=0');
	    }

	    $notices->each(function ($notice) {
		    $notice->comments()->save(factory(App\Comment::class)->make());
		    $notice->comments()->save(factory(App\Comment::class)->make());
	    });
	    // 댓글의 댓글(자식 댓글)
	    $notices->each(function ($notice) use ($faker){
		    $commentIds = App\Comment::pluck('id')->toArray();
		    foreach(range(1,5) as $index) {
			    $notice->comments()->save(
				    factory(App\Comment::class)->make([
					    'parent_id' => $faker->randomElement($commentIds),
				    ])
			    );
		    }
	    });
	    $this->command->info('Seeded: comments table');

	    if (! $sqlite) {
		    DB::statement('SET FOREIGN_KEY_CHECKS=1');
	    }
    }
}
