<?php


use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class NewIsCustomEdit extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('housing_complex')) {
            $this->table('housing_complex')
                ->addColumn('is_custom_edit', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'default' => 0])
                ->save();
        }
    }

    public function down()
    {
        $t = $this->table('housing_complex');
        if ($t->exists()) {
            $t->removeColumn('is_custom_edit')
                ->save();
        }
    }
}
