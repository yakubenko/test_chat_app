<?php


use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function up()
    {
        $users = $this->table("users");

        $users
            ->addColumn("login", "string", ['null' => false, 'limit' => 16])
            ->addColumn("password", "string", ['null' => false, 'limit' => 16])
            ->save();
    }

    public function down()
    {
        $this->table("users")->drop()->save();
    }
}
