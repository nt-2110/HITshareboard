<?php

class Controller_Top extends Controller_Template
{

	public function action_latest()
	{
		$view = View::forge('layout/application');
		$view->contents = View::forge('top/latest');
		return $view;
	}

	public function action_info()
	{
		$data["subnav"] = array('info'=> 'active' );
		$this->template->title = 'Top &raquo; Info';
		$this->template->content = View::forge('top/info', $data);
	}

	public function action_upload()
	{
		$data['faculties'] = Model_Faculty::find('all');
		$data['departs'] = Model_Depart::find('all');
		$view = View::forge('layout/application');
		$view->contents = View::forge('top/upload',$data);
		return $view;
	}

}
