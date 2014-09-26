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
		$view = View::forge('layout/application');
		$view->contents = View::forge('top/info');
		return $view;
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
