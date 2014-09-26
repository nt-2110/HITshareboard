<?php

namespace Fuel\Migrations;

class Create_faculties
{
	public function up()
	{
		\DBUtil::create_table('faculties', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'faculty_name' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	
		$table = 'faculties';
\DB::insert($table)->set(array('faculty_name' => '全学部'))->execute();
\DB::insert($table)->set(array('faculty_name' => '工学部'))->execute();
\DB::insert($table)->set(array('faculty_name' => '情報学部'))->execute();
\DB::insert($table)->set(array('faculty_name' => '環境学部'))->execute();
\DB::insert($table)->set(array('faculty_name' => '生命学部'))->execute();

	}

	public function down()
	{
		\DBUtil::drop_table('faculties');
	}
}
