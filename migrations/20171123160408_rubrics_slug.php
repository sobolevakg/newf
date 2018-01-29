<?php


use Phinx\Migration\AbstractMigration;

class RubricsSlug extends AbstractMigration
{

    public function up()
    {

         if ($this->hasTable('rubriks')) {
            $this->table('rubriks')
                ->addColumn('slug', 'string')
                ->save();
         }

    }

    public function down()
    {
        $t = $this->table('rubriks');
        if ($t->exists()) {
            $t->removeColumn('slug')
              ->save();
        }
    }
}
