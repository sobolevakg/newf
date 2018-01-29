<?php


use Phinx\Migration\AbstractMigration;

class Rubriks extends AbstractMigration
{
    public function up()
    {
        $this->table('rubriks')
            ->addColumn('old_id', 'integer')
            ->addColumn('name', 'string')
            ->addColumn('image', 'string')
            ->addColumn('icon', 'string')
            ->save();
        $this->insert('rubriks', [
            ['id' => 1, 'old_id' => 20, 'name' => 'Новости', 'image' => '/i/rubriks/news.png', 'icon' => '/i/rubriks/novosti_min.png'],
            ['id' => 2, 'old_id' => 40, 'name' => 'Истории', 'image' => '/i/rubriks/istorii.png', 'icon' => '/i/rubriks/istorii_min.png'],
            ['id' => 3, 'old_id' => 60, 'name' => 'Обзоры', 'image' => '/i/rubriks/overview.png', 'icon' => '/i/rubriks/obzory_min.png'],
            ['id' => 4, 'old_id' => 80, 'name' => 'Интервью', 'image' => '/i/rubriks/interview.png', 'icon' => '/i/rubriks/intervyu_min.png'],
            ['id' => 5, 'old_id' => 100, 'name' => 'Инвестиции в недвижимость', 'image' => '/i/rubriks/investment.png', 'icon' => '/i/rubriks/investicii-v-nedvizhimost_min.png'],
            ['id' => 6, 'old_id' => 120, 'name' => 'Битва новостроек', 'image' => '/i/rubriks/battle.png'],
            ['id' => 7, 'old_id' => 140, 'name' => 'Своими глазами', 'image' => '/i/rubriks/svoimi-glazami.png', 'icon' => '/i/rubriks/svoimi-glazami_min.png'],
            ['id' => 8, 'old_id' => 160, 'name' => 'Советы', 'image' => '/i/rubriks/advice.png', 'icon' => '/i/rubriks/sovety_min.png'],
            ['id' => 9, 'old_id' => 180, 'name' => 'Ипотека', 'image' => '/i/rubriks/mortgage.png', 'icon' => '/i/rubriks/ipoteka_min.png'],
            ['id' => 10, 'old_id' => 200, 'name' => 'Вопрос-ответ', 'image' => '/i/rubriks/question.png', 'icon' => '/i/rubriks/vopros-otvet_min.png'],
        ]);
    }

    public function down()
    {
        $t = $this->table('articles');
        if ($t->exists()) {
            $this->execute('ALTER TABLE articles DROP FOREIGN KEY rubriks_id;
			ALTER TABLE articles DROP INDEX rubriks_id');
        }
        $this->execute('DROP TABLE IF EXISTS `rubriks`;');
    }
}
