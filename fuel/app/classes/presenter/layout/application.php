<?php

class Presenter_Layout_Application extends Presenter
{

	public function view()
	{
		$this->latest_number = Model_Bulletin::query()->where('created_at' ,'>' ,(time() - (3600 * 24)))->where('state', '3')->count();
//		$this->today_users = Model_User::query()->where('created_at','>',(time() - (3600 * 24)))->count();
		$this->today_users = Model_User::query()->where('created_at','>',mktime(0,0,0,date('n'),date('j')))->count();
		$this->all_users = Model_User::query()->count();
	}

}

?>
