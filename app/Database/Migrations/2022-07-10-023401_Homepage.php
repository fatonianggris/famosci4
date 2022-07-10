<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Homepage extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_homepage' => [
                'type' => 'INT',
                'null'=> false,
                'constraint' => 10,
                'auto_increment' => true
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'sub_title' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null'=> true,
            ],
            'company' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null'=> true,
            ],
            'phone_number' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null'=> true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null'=> true,
            ],
            'desc' => [
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
            'contact_status' => [
                'type' => 'TINYINT',
                'constraint' => 5,
                'default'=> 0,
            ],
        ]);
        $this->forge->addKey('id_homepage', true);
        $this->forge->createTable('homepage');
    }

    public function down()
    {
        $this->forge->dropTable('homepage');
    }
}
