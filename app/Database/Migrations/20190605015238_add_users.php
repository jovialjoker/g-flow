<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migration_add_users extends Migration
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
			'provider_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE
			],
			'nickname' => [
				'type' => 'VARCHAR',
				'constraint' => 64
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => TRUE
			],
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => TRUE
			],
			'avatar_url' => [
				'type' => 'VARCHAR',
				'constraint' => 128
			],
			'created_at' => [
				'type' => 'TIMESTAMP'
			],
			'updated_at' => [
				'type' => 'TIMESTAMP'
			]
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
