<?php


use Phinx\Migration\AbstractMigration;

class Sesion extends AbstractMigration
{

    public function up()
    {

        if (!$this->hasTable('session')) {
            $this->table('session')
                ->addColumn('user_id', 'integer')
                ->addColumn('session_id', 'string')
                ->save();
        }


        if ($this->hasTable('users')) {
            $this->table('session')
                ->addForeignKey('user_id', 'users', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
                ->save();
        }

    }

    public function down()
    {
	    $t = $this->table('session');
            if ($t->exists()) {
                $t->dropForeignKey('user_id');
               	$this->dropTable('session');
            }
    }
}
