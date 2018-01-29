<?php


use Phinx\Migration\AbstractMigration;

class Users extends AbstractMigration
{
    public function up()
    {

        if (!$this->hasTable('users_roles')) {
            $this->table('users_roles')
                ->addColumn('name', 'string')
                ->addColumn('liberties', 'string')
                ->save();

            $this->insert('users_roles', [
                ['id' => 1, 'name' => 'Пользователь', 'liberties' => 'Users'],
                ['id' => 2, 'name' => 'Администратор', 'liberties' => 'Admin']
            ]);
        }

	    if (!$this->hasTable('users')) {
            $this->table('users')
                ->addColumn('username', 'string')
                ->addColumn('email', 'string')
                ->addColumn('password', 'string')
                ->addColumn('active', 'string', ['limit' => 1, 'default' => 'Y'])
                ->addColumn('role_id', 'integer', ['default' => 1])              
		->addIndex(['username', 'email'], ['unique' => true])
                ->save();

            $this->insert('users', [
                ['id' => 1, 'username' => 'ksu', 'email' => 'ksa220410@gmail.com', 
		'password' => '$2y$08$Wk01L1FnUWFibThZN05TSein9afYlYTfVf6ZM3z5.lTKAmzfNq5gi', 'role_id' => 2]
            ]);
        }

        if ($this->hasTable('users_roles')) {
            $this->table('users')
                ->addForeignKey('role_id', 'users_roles', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
                ->save();
        }

    }

    public function down()
    {
	    $t = $this->table('users');
            if ($t->exists()) {
                $t->dropForeignKey('role_id');
                $this->dropTable('users_roles');
               	$this->dropTable('users');
            }
    }
}
