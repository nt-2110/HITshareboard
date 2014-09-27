<?php

class Presenter_Layout_System extends Presenter
{

	public function view()
	{
		$this->latest_number = Model_Bulletin::query()->where('created_at' ,'>' ,(time() - (3600 * 24)))->where('state','2')->count();
	}

}

?>
