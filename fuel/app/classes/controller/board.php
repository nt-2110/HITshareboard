<?php

class Controller_Board extends Controller_Template
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
		}else{
			$user = Model_User::find('first',array('where' => array('cookie' => $cookie)));
			$user->updated_at = time();
			$user->save();
		}
		$terms_alert = Cookie::get('terms_alert',null);
		Cookie::set('terms_alert',$terms_alert+1);
		$data['url'] = '/top/latest';
		$data['part'] = Input::get('part');
		if(empty($data['part']))
		{
			$data['part'] = 1;
		}
//		$data['bulletins'] = Model_Bulletin::find('all', array('where' => array('state' => '3'),'order_by' => array('id' => 'desc'),'offset' => ($data['part'] - 1) * 9,'limit' => '9' ));
		$data['bulletins'] = DB::query('SELECT b.id AS id,facility_id,depart_id,state,b.created_at,b.updated_at,COUNT(l.id) AS cnt FROM bulletins AS b LEFT JOIN likes AS l ON b.id = l.bulletin_id WHERE state = 3 AND NOT l.bulletin_id IS NULL GROUP BY l.bulletin_id UNION SELECT b.id AS id,facility_id,depart_id,state,b.created_at,b.updated_at,IFNULL(l.id,0) AS cnt FROM bulletins AS b LEFT JOIN likes AS l ON b.id = l.bulletin_id WHERE state = 3 AND l.bulletin_id IS NULL ORDER BY id DESC LIMIT '.(($data['part'] - 1) * 9).',9')->as_object()->execute()->as_array();
//		$departs = Model_depart::find('all');
//		foreach($departs as $depart){
//			$data['labels'][$depart->id] = $depart->faculty_id.'00';
//		}
//		$faculties = Model_Faculty::find('all');
//		foreach($faculties as $faculty){
//			$data['labels'][$faculty->id.'00'] = $faculty->id.'00';
//		}
		$faculties = Model_Faculty::find('all');
		$faculty_icon[1] = '<span class="label label-default">';
		$faculty_icon[2] = '<span class="label label-danger"><span class="glyphicon glyphicon-wrench"></span>';
		$faculty_icon[3] = '<span class="label label-info"><span class="glyphicon glyphicon-phone"></span>';
		$faculty_icon[4] = '<span class="label label-success"><span class="glyphicon glyphicon-globe"></span>';
		$faculty_icon[5] = '<span class="label label-warning"><span class="glyphicon glyphicon-plus"></span>';
		foreach($faculties as $faculty){
			$data['labels'][$faculty->id.'00'] = $faculty_icon[$faculty->id].$faculty->faculty_name.'</span>';
		}
		$departs = Model_depart::find('all');
		foreach($departs as $depart){
			$data['labels'][$depart->id] = $faculty_icon[$depart->faculty_id].$depart->depart_name.'</span>';
		}
		$data['max_part'] = (int)ceil(Model_Bulletin::query()->where('state','3')->count() / 9);
		$view = Presenter::forge('layout/application');
		$view->contents = View::forge('board/list', $data);
		return $view;
	}

	public function action_depart($id = null)
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
		if($id == null){
			Response::redirect('top/latest');
		}
		$data['url'] = '/board/depart/'.$id;
		$data['part'] = Input::get('part');
		if(empty($data['part']))
		{
			$data['part'] = 1;
		}
		$data['depart'] = Model_Depart::find($id);
		$data['boardname'] = $data['depart']->depart_name;
		$faculty_id = $data['depart']->faculty_id.'00';
//		$data['bulletins'] = Model_Bulletin::find('all', array('where' => array(array('state' => '3'),array(array('depart_id' => $id), 'or' => array(array('depart_id' => $faculty_id))),'or' => array(array('depart_id' => 100))),'order_by' => array('id' => 'desc'),'offset' => ($data['part'] - 1) * 9,'limit' => '9'));
//		$data['bulletins'] = DB::query('SELECT b.id AS id,facility_id,depart_id,state,b.created_at,b.updated_at,COUNT(l.id) AS cnt FROM bulletins AS b LEFT JOIN likes AS l ON b.id = l.bulletin_id WHERE state = 3 AND (depart_id = '.$id.' OR depart_id = '.$faculty_id.' OR depart_id = 100) GROUP BY l.bulletin_id ORDER BY b.id DESC LIMIT '.(($data['part'] - 1) * 9).',9')->as_object()->execute()->as_array();
		$data['bulletins'] = DB::query('SELECT b.id AS id,facility_id,depart_id,state,b.created_at,b.updated_at,COUNT(l.id) AS cnt FROM bulletins AS b LEFT JOIN likes AS l ON b.id = l.bulletin_id WHERE state = 3 AND (depart_id = '.$id.' OR depart_id = '.$faculty_id.' OR depart_id = 100) AND NOT l.bulletin_id IS NULL GROUP BY l.bulletin_id UNION SELECT b.id AS id,facility_id,depart_id,state,b.created_at,b.updated_at,IFNULL(l.id,0) AS cnt FROM bulletins AS b LEFT JOIN likes AS l ON b.id = l.bulletin_id WHERE state = 3 AND (depart_id = '.$id.' OR depart_id = '.$faculty_id.' OR depart_id = 100) AND l.bulletin_id IS NULL ORDER BY id DESC LIMIT '.(($data['part'] - 1) * 9).',9')->as_object()->execute()->as_array();
		$data['max_part'] = (int)ceil(Model_Bulletin::query()->where('state','3')->and_where_open()->where('depart_id',$id)->or_where('depart_id',$faculty_id)->or_where('depart_id','100')->and_where_close()->count() / 9);
		$view = Presenter::forge('layout/application');
		$view->contents = View::forge('board/list', $data);
		return $view;
	}

	public function action_facility($id = null)
	{
		if($id == null){
			Response::redirect('top/latest');
		}
		$data['url'] = '/board/facility/'.$id;
		$data['part'] = Input::get('part');
		if(empty($data['part']))
		{
			$data['part'] = 1;
		}
		$data['facility'] = Model_Facility::find($id);
		$data['boardname'] = $data['facility']->facility_name;
		$data['bulletins'] = Model_Bulletin::find('all', array('where' => array('facility_id' => $id,'state' => 3),'order_by' => array('id' => 'desc'),'offset' => ($data['part'] - 1) * 9,'limit' => '9'));
		$data['max_part'] = (int)(Model_Bulletin::query()->where('facility_id',$id)->where('state','3')->count() / 9);
		$view = Presenter::forge('layout/application');
		$view->contents = View::forge('board/list', $data);
		return $view;
	}

}
