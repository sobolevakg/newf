<?php


use Phinx\Migration\AbstractMigration;

class Seller extends AbstractMigration
{

    public function up()
    {
         if (!$this->hasTable('seller')) {
            $this->table('seller')
                ->addColumn('developer_id', 'integer', ['signed' => false])
                ->addColumn('housing_complex_id', 'integer', ['signed' => false])
                ->save();
        }


        if ($this->hasTable('developers')) {
            $this->table('seller')
                ->addForeignKey('developer_id', 'developers', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
                ->save();
        }

	
        if ($this->hasTable('housing_complex')) {
            $this->table('seller')
                ->addForeignKey('housing_complex_id', 'housing_complex', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
                ->save();
        }

    }
    public function down()
    {
	$t = $this->table('seller');
        if ($t->exists()) {
           	$t->dropForeignKey('housing_complex_id');
		$t->dropForeignKey('developer_id');
            	$this->dropTable('seller');
        }
    }
}
