<?php

class Model_Bulletin extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'data',
		'date',
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
		$exif = exif_read_data($file['file'],'FILE');
		$data = array(
			'data' => file_get_contents($file['file']),
			'date' => $exif['FileDateTime'],
			'ext' => $file['extension'],
			'user_id' => 1,
			'board_id' => 1,
			'state' => 4,
		);
		return static::forge($data)->save();
	}
}
