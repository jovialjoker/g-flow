<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migration_add_list_tasks extends Migration
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
			'text' => [
				'type' => 'VARCHAR',
				'constraint' => 256
			],
			'user_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE
			],
			'list_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE
			],
			'priority' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE
			],
			'created_at' => [
				'type' => 'TIMESTAMP'
			],
			'completed_at' => [
				'type' => 'TIMESTAMP',
				'null' => TRUE
			]
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('list_tasks');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('list_tasks');
	}
}
