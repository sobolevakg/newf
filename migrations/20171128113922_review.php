<?php


use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class Review extends AbstractMigration
{
    public function up()
    {
        if (!$this->hasTable('review')) {
            $this->table('review')
                ->addColumn('publish', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'default' => 0])
                ->addColumn('publication_datetime', 'datetime')
                ->addColumn('name_user', 'string')
                ->addColumn('user_id', 'integer', ['null' => true])
                ->addColumn('housing_complex_id', 'integer', ['null' => true])
                ->addColumn('developers_id', 'integer', ['null' => true])
                ->addColumn('text', 'text')
                ->save();
        }

    }

    public function down()
    {
        $this->dropTable('review');
    }
}
