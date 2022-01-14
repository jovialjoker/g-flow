<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migration_add_notifications extends Migration
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
			'action' => [
				'type' => 'VARCHAR',
				'constraint' => 64
			],
			'created_at' => [
				'type' => 'TIMESTAMP'
			],
			'viewed_at' => [
				'type' => 'TIMESTAMP',
				'null' => true,
				'default' => NULL
			]
		]);
		
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('notifications');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('notifications');
	}
}
