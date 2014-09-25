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
	}

	public function down()
	{
		\DBUtil::drop_table('departs');
	}
}
