<?php


use Phinx\Migration\AbstractMigration;

class Articles extends AbstractMigration
{
    public function up()
    {
        if (!$this->hasTable('articles')) {
            $this->table('articles')
                ->addColumn('publish', 'boolean')
                ->addColumn('publication_datetime', 'datetime')
                ->addColumn('title', 'string')
                ->addColumn('short_text', 'string')
                ->addColumn('text', 'text')
                ->addColumn('rubric_id', 'integer')
                ->addColumn('cover', 'string')
                ->addColumn('author_id', 'integer')
                ->addColumn('tags', 'string')
                ->save();
        }

        if (!$this->hasTable('author')) {
            $this->table('author')
                ->addColumn('name', 'string')
                ->save();
            $this->insert('author', [
                ["id" => 1, "name" => "ab"],
                ["id" => 2, "name" => "eg"],
                ["id" => 3, "name" => "ek"],
                ["id" => 4, "name" => "rom"]
            ]);
        }

        if ($this->hasTable('rubriks')) {
            $this->table('articles')
                ->addForeignKey('rubric_id', 'rubriks', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
                ->save();
        }

        if ($this->hasTable('author')) {
            $this->table('articles')
                ->addForeignKey('author_id', 'author', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
                ->save();
        }
    }

    public function down()
    {
        $this->dropTable('author');
        $this->dropTable('articles');
    }
}
