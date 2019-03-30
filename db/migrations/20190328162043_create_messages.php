<?php


use Phinx\Migration\AbstractMigration;

class CreateMessages extends AbstractMigration
{
    public function up()
    {
        $messages = $this->table('messages');

        $messages
            ->addColumn('user_id', 'integer', ['null' => false, 'limit' => 3])
            ->addColumn('created_at', 'datetime', ['null' => false, 'timezone' => true])
            ->addColumn('message', 'text', ['null' => false])
            ->addIndex('user_id')
            ->addIndex('created_at')
            ->save();
    }

    public function down()
    {
        $this->table('messages')->drop()->save();
    }
}
