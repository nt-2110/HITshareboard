<?php

class Model_Bulletin extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'data',
		'thumbnail',
		'ext',
		'user_id',
		'facility_id',
		'depart_id',
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

	public static function add($file = array(), $depart_id = null)
	{
//		$exif = exif_read_data($file['file'],'FILE');
		$imagick = new \Imagick();
		$imagick->readImageBlob(file_get_contents($file['file']));
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
		$thumbnail = new \Imagick();
		$thumbnail->readImageBlob($imagick->getImageBlob());
//		$thumbnail->cropThumbnailImage(200,160);
		$x = ( $thumbnail->getImageWidth() / 2 ) - 400;
		$thumbnail->cropImage(800,640,$x,0);
		$thumbnail->scaleImage(200,160,true);
//		$thumbnail->cropImage(200,160,0,0);
		$data = array(
//			'data' => file_get_contents($file['file']),
			'data' => $imagick->getImageBlob(),
			'thumbnail' => $thumbnail->getImageBlob(),
			'ext' => $file['extension'],
			'user_id' => 1,
			'facility_id' => 1,
			'depart_id' => $depart_id,
			'state' => 4,
		);
		return static::forge($data)->save();
	}
}
