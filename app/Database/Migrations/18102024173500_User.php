<?php

namespace App\Database\Migrations;


class User extends \CodeIgniter\Database\Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
                'null' => false,
                'unsigned' => true
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type' => 'TEXT',
                'constraint' => '100',
            ],
            'phone' => [
                'type' => 'TEXT',
                'constraint' => '100',
            ],
            'password' => [
                'type' => 'TEXT',
                'constraint' => '100',
            ],
            'user_type' => [
                'type'    => 'ENUM',
                'constraint' => ['admin', 'user'], 
                'default' => 'user',
                'null'    => false,
            ],
            'profile_image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
