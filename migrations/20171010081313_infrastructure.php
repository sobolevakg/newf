<?php


use Phinx\Migration\AbstractMigration;

class Infrastructure extends AbstractMigration
{
    public function up()
    {
        if (!$this->hasTable('env_objects')) {
            $this->table('env_objects')
                ->addColumn('env_type_id', 'integer')
                ->addColumn('name', 'string')
                ->addColumn('latitude', 'decimal', ['precision' => 15, 'scale' => 10])
                ->addColumn('longitude', 'decimal', ['precision' => 15, 'scale' => 10])
                ->addColumn('description', 'text', ['null' => true])
                ->save();
        }

        if (!$this->hasTable('env_object_types')) {
            $this->table('env_object_types')
                ->addColumn('name', 'string')
                ->addColumn('icon', 'string')
                ->save();
            $this->insert('env_object_types', [
                ["id" => 1, "name" => "Школы", 'icon' => '/i/infrastructure/shkola.png'],
                ["id" => 2, "name" => "Детские сады", 'icon' => '/i/infrastructure/sad.png'],
                ["id" => 3, "name" => "Поликлиники", 'icon' => '/i/infrastructure/bolnica.png'],
                ["id" => 4, "name" => "Продуктовые магазины", 'icon' => '/i/infrastructure/magazin.png'],
                ["id" => 5, "name" => "Кафе", 'icon' => '/i/infrastructure/cafe.png']
            ]);
        }

        if (!$this->hasTable('env_objects_housing_complex')) {
            $this->table('env_objects_housing_complex')
                ->addColumn('env_objects_id', 'integer')
                ->addColumn('housing_complex_id', 'integer', ['signed' => false])
                ->save();
        }

        if ($this->hasTable('env_objects')) {
            $this->table('env_objects_housing_complex')
                ->addForeignKey('env_objects_id', 'env_objects', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
                ->save();
        }

        if ($this->hasTable('env_object_types')) {
            $this->table('env_objects')
                ->addForeignKey('env_type_id', 'env_object_types', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
                ->save();
        }

        if ($this->hasTable('housing_complex')) {
            $this->table('env_objects_housing_complex')
                ->addForeignKey('housing_complex_id', 'housing_complex', 'id', ['delete' => 'RESTRICT', 'update' => 'CASCADE'])
                ->save();
        }
    }

    public function down()
    {
        $this->dropTable('env_object_types');
        $this->dropTable('env_objects');
        $this->dropTable('env_objects_housing_complex');
    }
}
