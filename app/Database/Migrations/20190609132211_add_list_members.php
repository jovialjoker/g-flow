<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migration_add_list_members extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'user_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
			],
			'list_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
			],
			'entered_at' => [
				'type' => 'TIMESTAMP'
			],
			'left_at' => [
				'type' => 'TIMESTAMP'
			]
		]);
		
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('list_members');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('list_members');
	}
}
