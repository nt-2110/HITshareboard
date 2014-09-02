<?php

class Model_Bulletin extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'data',
		'ext',
		'user_id',
		'board_id',
		'state',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_table_name = 'bulletins';

	public static function add($file = array())
	{
		$imagick = new \Imagick();
		$imagick->readImage($file['file']);
		$orientation = $imagick->getImageOrientation();
		$isRotated = false;
		if($orientation === \Imagick::ORIENTATION_RIGHTTOP){
			$imagick->rotateImage('none',90);
			$isRotated = true;
		}else if($orientation === \Imagick::ORIENTATION_BOTTOMRIGHT){
			$imagick->rotateImage('none',180);
			$isRotated = true;
		}else if($orientation === \Imagick::ORIENTATION_LEFTBOTTOM){
			$imagick->rotateImage('none',270);
			$isRotated = true;
		}
		if($isRotated){
			$imagick->setImageOrientation(\Imagick::ORIENTATION_TOPLEFT);
		}
		$data = array(
			'data' => file_get_contents($file['file']),
			'ext' => $file['extension'],
			'user_id' => 1,
			'board_id' => 1,
			'state' => 4,
		);
		return static::forge($data)->save();
	}
}
