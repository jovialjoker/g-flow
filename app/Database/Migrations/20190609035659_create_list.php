<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migration_create_list extends Migration
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
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => TRUE
			],
			'deadline_date' => [
				'type' => 'TIMESTAMP'
			],
			'created_at' => [
				'type' => 'TIMESTAMP'
			],
			'updated_at' => [
				'type' => 'TIMESTAMP'
			]
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('lists');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('lists');
	}
}
