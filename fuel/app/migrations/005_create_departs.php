<?php

namespace Fuel\Migrations;

class Create_departs
{
	public function up()
	{
		\DBUtil::create_table('departs', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'depart_name' => array('constraint' => 255, 'type' => 'varchar'),
			'faculty_id' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));

		$table = 'departs';

\DB::insert($table)->set(array('depart_name' => '電子情報工学科', 'faculty_id' => '2'))->execute();
\DB::insert($table)->set(array('depart_name' => '電気システム工学科', 'faculty_id' => '2'))->execute();
\DB::insert($table)->set(array('depart_name' => '機械システム工学科', 'faculty_id' => '2'))->execute();
\DB::insert($table)->set(array('depart_name' => '知能機械工学科', 'faculty_id' => '2'))->execute();
\DB::insert($table)->set(array('depart_name' => '都市デザイン工学科', 'faculty_id' => '2'))->execute();
\DB::insert($table)->set(array('depart_name' => '建築工学科', 'faculty_id' => '2'))->execute();
\DB::insert($table)->set(array('depart_name' => '情報工学科', 'faculty_id' => '3'))->execute();
\DB::insert($table)->set(array('depart_name' => '知的情報システム学科', 'faculty_id' => '3'))->execute();
\DB::insert($table)->set(array('depart_name' => '健康情報学科', 'faculty_id' => '3'))->execute();
\DB::insert($table)->set(array('depart_name' => '環境デザイン学科', 'faculty_id' => '4'))->execute();
\DB::insert($table)->set(array('depart_name' => '地球環境学科', 'faculty_id' => '4'))->execute();
\DB::insert($table)->set(array('depart_name' => '生体医工学科', 'faculty_id' => '5'))->execute();
\DB::insert($table)->set(array('depart_name' => '食品生命科学科', 'faculty_id' => '5'))->execute();

	}

	public function down()
	{
		\DBUtil::drop_table('departs');
	}
}
