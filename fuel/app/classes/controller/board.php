<?php

class Controller_Board extends Controller_Template
{

	public function action_latest()
	{
		$data['url'] = '/top/latest';
		$data['part'] = Input::get('part');
		if(empty($data['part']))
		{
			$data['part'] = 1;
		}
		$data['bulletins'] = Model_Bulletin::find('all', array('where' => array('state' => '4'),'order_by' => array('id' => 'desc'),'offset' => ($data['part'] - 1) * 9,'limit' => '9' ));
		$data['max_part'] = (int)(Model_Bulletin::query()->where('state','4')->count() / 9);
		$view = View::forge('layout/application');
		$view->contents = View::forge('board/list', $data);
		return $view;
	}

	public function action_depart($id = null)
	{
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
		$data['bulletins'] = Model_Bulletin::find('all', array('where' => array('depart_id' => $id,'state' => '4'),'order_by' => array('id' => 'desc'),'offset' => ($data['part'] - 1) * 9,'limit' => '9'));
		$data['max_part'] = (int)(Model_Bulletin::query()->where('depart_id',$id)->where('state','4')->count() / 9);
		$view = View::forge('layout/application');
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
		$data['bulletins'] = Model_Bulletin::find('all', array('where' => array('facility_id' => $id),'order_by' => array('id' => 'desc'),'offset' => ($data['part'] - 1) * 9,'limit' => '9'));
		$data['max_part'] = (int)(Model_Bulletin::query()->where('facility_id',$id)->where('state','4')->count() / 9);
		$view = View::forge('layout/application');
		$view->contents = View::forge('board/list', $data);
		return $view;
	}

}
