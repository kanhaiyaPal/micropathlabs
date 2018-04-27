<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user_types = ['admin','inventory','department','account','center','doctor'];
    	$modules = ['global_settings','patient','departments','tests','signatures','center'];

    	
		foreach ($modules as $mod_value) {
			foreach ($user_types as $user_value) {
				$all_val = 0;
				if($user_value == 'admin'){
					$all_val = 1;
				}

				DB::table('roles')->insert([
		            'role_name' => $user_value,
		            'module_name' => $mod_value,
		            'read_module' => $all_val,
		            'write_module' => $all_val,
		            'modify_module' => $all_val,
		            'delete_module' => $all_val,
		            'view_module' => $all_val		           
		        ]);
			}
		}       
    }
}
