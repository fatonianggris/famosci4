<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Contact extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_contact' => [
                'type' => 'INT',
                'null'=> false,
                'constraint' => 10,
                'auto_increment' => true
            ],
            'id_user_client' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'name_contact' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null'=> true,
            ],
            'position' => [
                'type' => 'TINYINT',
                'constraint' => 5,
                'null'=> true,
            ],
            'number_phone' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null'=> true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
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
        $this->forge->addKey('id_contact', true);
        $this->forge->createTable('contact');
    }

    public function down()
    {
        $this->forge->dropTable('contact');
    }
}
