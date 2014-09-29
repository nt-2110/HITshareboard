<?php

class Controller_Systemsprivate extends Controller_Template
{

	public function action_login()
	{
		$cookie = Cookie::get('user_cookie_id',null);
		if(empty($cookie)){
			$new_user = Model_User::forge(array('authority_id' => 1));
			$new_user->save();
			Cookie::set('user_cookie_id',md5($new_user->id));
			$new_user->cookie = md5($new_user->id);
			$new_user->save();
		}
		$user = Model_User::find('first',array('where' => array('cookie' => $cookie)));
		if(Input::method() == 'POST'){
			if($login = Model_User::find('first',array('where' => array('username' => Input::post('username'),'password' => md5(Input::post('password')))))){
				$login->cookie = $cookie;
				$login->authority_id = 2;
				$login->save();
			}else{
				$user->username = Input::post('username');
				$user->password = md5(Input::post('password'));
				$user->authority_id = 2;
				$user->save();
			}
		}
		if($user->authority_id == 2){
			Response::redirect('systemsprivate/list');
		}
		$view = Presenter::forge('layout/system');
		$view->contents = View::forge('systemsprivate/login');
		return $view;
	}

	public function action_list()
	{
		$cookie = Cookie::get('user_cookie_id',null);
		if(empty($cookie)){
			Response::redirect('top/latest');
		}
		$user = Model_User::find('first',array('where' => array('cookie' => $cookie)));
		if($user->authority_id != 2){
			Response::redirect('top/latest');
		}
		$data['part'] = Input::get('part');
		if(empty($data['part']))
		{
			$data['part'] = 1;
		}
		$offset = ($data['part'] - 1) * 9;
		$data['bulletins'] = Model_Bulletin::find('all', array('where' => array('state' => '2'),'order_by' => array('id' => 'desc'),'offset' => $offset, 'limit' => '9'));
		$data['max_part'] = (int)ceil(Model_Bulletin::query()->where('state','1')->count() / 9);
		$view = Presenter::forge('layout/system');
		$view->contents = View::forge('systemsprivate/list', $data);
		return $view;
	}

	public function action_activate()
	{
		if(Input::method('POST')){
			$bulletin = Model_Bulletin::find(Input::post('id'));
			$bulletin->state = 3;
			$bulletin->save();
			Response::redirect('systemsprivate/list');
		}
		Respose::redirect('top/latest');
	}

	public function action_image($id = null)
	{
		$cookie = Cookie::get('user_cookie_id',null);
		if(empty($cookie)){
			Response::redirect('top/latest');
		}
		$user = Model_User::find('first',array('where' => array('cookie' => $cookie)));
		if($user->authority_id != 2){
			Response::redirect('top/latest');
		}
		if(empty($id)){
			Response::redirect('top/latest');
		}
		$data['bulletin'] = Model_Bulletin::find($id);
		$view = Presenter::forge('layout/system');
		$view->contents = View::forge('systemsprivate/image',$data);
		return $view;
	}

	public function action_upload()
	{
		$cookie = Cookie::get('user_cookie_id',null);
		if(empty($cookie)){
			Response::redirect('top/latest');
		}
		$user = Model_User::find('first',array('where' => array('cookie' => $cookie)));
		if($user->authority_id != 2){
			Response::redirect('top/latest');
		}
		$data['faculties'] = Model_Faculty::find('all');
		$data['departs'] = Model_Depart::find('all');
		$view = Presenter::forge('layout/system');
		$view->contents = View::forge('systemsprivate/upload',$data);
		return $view;
	}

	public function action_regist()
	{
		if(Input::method('POST')){
			$id = Input::post('id');
			$config = array(
				'path' => DOCROOT.DS.'files',
				'randomize' => true,
			);
			Upload::process($config);
			if(Upload::is_valid()){
				$files = Upload::get_files();
				foreach($files as $file){
					Model_Bulletin::add($file,$id,'3');
				}
			}
			Session::set_flash('success', 1);
		}
		Response::redirect('/systemsprivate/upload');
	}

	public function action_admin()
	{
		$data["subnav"] = array('admin'=> 'active' );
		$this->template->title = 'Systemsprivate &raquo; Admin';
		$this->template->content = View::forge('systemsprivate/admin', $data);
	}

}
