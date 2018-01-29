<?php


use Phinx\Migration\AbstractMigration;

class ArticlesSlug extends AbstractMigration
{

    public function up()
    {

         if ($this->hasTable('articles')) {
            $this->table('articles')
                ->addColumn('slug', 'string')
                ->save();
         }

    }

    public function down()
    {
        $t = $this->table('articles');
        if ($t->exists()) {
            $t->removeColumn('slug')
              ->save();
        }
    }

}
