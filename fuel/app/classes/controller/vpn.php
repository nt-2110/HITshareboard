<?php

class Controller_Vpn extends Controller_Template
{

	public function action_index()
	{
		$view = View::forge('vpn/index');
		return $view;
	}

}
