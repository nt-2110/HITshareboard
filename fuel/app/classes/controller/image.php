<?php

class Controller_Image extends Controller_Template
{

	public function action_upload()
	{
		if(Input::method('POST')){
			$config = array(
				'path' => DOCROOT.DS.'files',
				'randomize' => true,
			);
			Upload::process($config);
			if(Upload::is_valid()){
				$files = Upload::get_files();
				foreach($files as $file){
					Model_Bulletin::add($file);
				}
			}
		}
		Response::redirect('/top/upload');
	}

}
