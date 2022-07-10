<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Project extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_project' => [
                'type' => 'INT',
                'null'=> false,
                'constraint' => 10,
                'auto_increment' => true
            ],
            'id_user_client' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'id_user_talent' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'name_project' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null'=> true,
            ],
            'desc_project' => [
                'type' => 'TEXT',
                'null'=> true,
            ],
            'start_project' => [
                'type' => 'datetime',
                'null'=> true,
            ],
            'deadline_project' => [
                'type' => 'datetime',
                'null'=> true,
            ],
            'price_project' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null'=> true,
            ],
            'file_project' => [
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
            'project_status' => [
                'type' => 'TINYINT',
                'constraint' => 5,
                'default'=> 0,
            ],
        ]);
        $this->forge->addKey('id_project', true);
        $this->forge->createTable('project');
    }

    public function down()
    {
        $this->forge->dropTable('project');
    }
}
