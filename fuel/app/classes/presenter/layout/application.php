<?php

class Presenter_Layout_Application extends Presenter
{

	public function view()
	{
		$this->latest_number = Model_Bulletin::query()->where('created_at' ,'>' ,(time() - (3600 * 24)))->where('state', '3')->count();
//		$this->today_users = Model_User::query()->where('created_at','>',(time() - (3600 * 24)))->count();
//		$this->today_users = Model_User::query()->where('created_at','>',mktime(0,0,0,date('n'),date('j')))->count();
		$today = mktime(0,0,0,date('n'),date('j'));
		$today_create_users = Model_User::query()->where('created_at','>',$today)->count();
		$today_update_users = Model_User::query()->where('updated_at','>',$today)->where('created_at','<',$today)->count();
		$this->today_users = $today_create_users + $today_update_users;
		$this->all_users = Model_User::query()->count();
	}

}

?>
