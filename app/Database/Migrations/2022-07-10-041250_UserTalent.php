<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserTalent extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user_talent' => [
                'type' => 'INT',
                'null'=> false,
                'constraint' => 10,
                'auto_increment' => true
            ],
            'fullname' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null'=> true,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null'=> true,
            ],
            'password' => [
                'type' => 'TEXT',
                'null'=> true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null'=> true,
            ],
            'number_phone' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null'=> true,
            ],
            'bank_number' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null'=> true,
            ],
            'education' => [
                'type' => 'TEXT',
                'null'=> true,
            ],
            'talent_level' => [
                'type' => 'TINYINT',
                'constraint' => 5,
                'default'=> 1,
            ],
            'desc_user' => [
                'type' => 'TEXT',
                'null'=> true,
            ],
            'image' => [
                'type' => 'TEXT',
                'null'=> true,
            ],
            'image_thumb' => [
                'type' => 'TEXT',
                'null'=> true,
            ],
            'created_at datetime not null default current_timestamp',
            'updated_at' => [
                'type' => 'timestamp',
                'null'=> true,
            ],
            'deleted_at' => [
                'type' => 'timestamp',
                'null'=> true,
            ],
            'user_status' => [
                'type' => 'TINYINT',
                'constraint' => 5,
                'default'=> 0,
            ],
        ]);
        $this->forge->addKey('id_user_talent', true);
        $this->forge->createTable('user_talent');
    }

    public function down()
    {
        $this->forge->dropTable('user_talent');
    }
}
