<?php

class Controller_Top extends Controller_Template
{

	public function action_latest()
	{
		$cookie = Cookie::get('user_cookie_id',null);
		if(empty($cookie)){
			$new_user = Model_User::forge(array('authority_id' => 1));
			$new_user->save();
			Cookie::set('user_cookie_id',md5($new_user->id));
			$new_user->cookie = md5($new_user->id);
			$new_user->save();
		}
		$view = Presenter::forge('layout/application');
		$view->contents = View::forge('top/latest');
		return $view;
	}

	public function action_info()
	{
		$view = Presenter::forge('layout/application');
		$view->contents = View::forge('top/info');
		return $view;
	}

	public function action_terms()
	{
		Cookie::set('terms_check','OK');
		$view = Presenter::forge('layout/application');
		$view->contents = View::forge('top/terms');
		return $view;
	}

	public function action_upload()
	{
		$cookie = Cookie::get('user_cookie_id',null);
		if(empty($cookie)){
			$new_user = Model_User::forge(array('authority_id' => 1));
			$new_user->save();
			Cookie::set('user_cookie_id',md5($new_user->id));
			$new_user->cookie = md5($new_user->id);
			$new_user->save();
		}else{
			$user = Model_User::find('first',array('where' => array('cookie' => $cookie)));
			$user->updated_at = time();
			$user->save();
		}
		$data['faculties'] = Model_Faculty::find('all');
		$data['departs'] = Model_Depart::find('all');
		$view = Presenter::forge('layout/application');
		$view->contents = View::forge('top/upload',$data);
		return $view;
	}

	public function action_termswindow()
	{
		$view = View::forge('top/termswindow');
		$view->contents = View::forge('top/terms');
		return $view;
	}
}
