<?php


use Phinx\Migration\AbstractMigration;

class TreePaths extends AbstractMigration
{

    public function up()
    {
	  if (!$this->hasTable('TreePaths')) {
            $this->table('TreePaths')
                ->addColumn('ancestor', 'integer')
                ->addColumn('descendant', 'integer')
                ->save();
        }

        if ($this->hasTable('review')) {
            $this->table('TreePaths')
                ->addForeignKey('ancestor', 'review', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
                ->save();
        }

        if ($this->hasTable('review')) {
            $this->table('TreePaths')
                ->addForeignKey('descendant', 'review', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
                ->save();
        }

    }

    public function down()
    {
	    $t = $this->table('TreePaths');
            if ($t->exists()) {
               	$t->dropForeignKey('ancestor');
		        $t->dropForeignKey('descendant');
                	$this->dropTable('TreePaths');
            }
    }
}
