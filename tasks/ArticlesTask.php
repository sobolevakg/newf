<?php

namespace Newfinder\Modules\Cli\Tasks;

use Newfinder\Helpers\StrHelper;

class ArticlesTask extends BaseTask
{
    public function insertArticlesAction()
    {
        $connection_old =
            [
                "host" => "stable-db0.*.ru",
                "username" => "*",
                "password" => "*",
                "dbname" => "*"
            ];

        $old_db = clone $this;
        $old_db->db = clone $this->db;

        try {
            $old_db->db->connect($connection_old);
            $this->success("Connected successfully");
            $sql = 'SELECT f_id, f_on, f_date, f_name,f_short,f_type, f_big, f_body, f_tag, f_author FROM t_nfj_art';
            $param = $old_db->db->fetchAll($sql);
            $old_db->db->close();
            unset($old_db);
            $helper = new StrHelper();
            foreach ($param as &$row) {
                $text_art = $this->convertAbTagsToHTML($row['f_body']);
                $rubrics_id = $this->db->fetchOne("SELECT id FROM rubriks WHERE old_id = '" . $row['f_type'] . "'");
                $author_id = $this->db->fetchOne("SELECT id FROM author WHERE name = '" . $row['f_author'] . "'");
                $slug = $helper->makeUrl(base64_decode($row['f_name']).' '.$row['f_id']);
                if ($rubrics_id['id'] && $author_id['id']){
                    $artToInsert = [
                        'publish' => $row['f_on'],
                        'publication_datetime' => $row['f_date'],
                        'title' => base64_decode($row['f_name']),
                        'short_text' => base64_decode($row['f_short']),
                        'rubric_id' => $rubrics_id['id'],
                        'text' => $text_art,
                        'cover' => base64_decode($row['f_big']),
                        'tags' => base64_decode($row['f_tag']),
                        'author_id' => $author_id['id'],
                        'slug' => $slug
                    ];

                    $names = implode(',', array_keys($artToInsert));
                    $qs = implode(',', array_pad([], count($artToInsert), '?'));
                    $articles_id = $this->db->fetchColumn(sprintf("SELECT id FROM articles WHERE slug = '%s'", $slug));
                    if (empty($articles_id)){
                        $result_query = $this->db->execute(sprintf("INSERT INTO articles (%s) VALUES (%s)", $names, $qs), array_values($artToInsert));
                        if ($result_query) {
                            $this->success("Entry added ID:" . $row['f_id']);
                        } else {
                            $this->error("Entry not added ID:" . $row['f_id']);
                        }
                    }else{
                        $this->warn('Record exists');
                    }
                }else{
                    $this->error("Entry not added ID:" . $row['f_id']);
                }
            }

        } catch (PDOException $e) {
            $this->error("Connection failed: " . $e->getMessage());
        }
    }

    public function convertAbTagsToHTML($str)
    {
        $body = base64_decode($str);
        $body = str_replace("[img=", "<img src='https://www.newfinder.ru/data/nfj/art/", $body);
        $body = str_replace(",nfj-open-image]", "' class='nfj-open-image'>", $body);
        $body = preg_replace('/\[c\]/', '<center>', $body);
        $body = preg_replace('/\[\/c\]/', '</center>', $body);
        $body = preg_replace('/\[u\]/', '<u>', $body);
        $body = preg_replace('/\[\/u\]/', '</u>', $body);
        $body = preg_replace('/\[b\]/', '<b>', $body);
        $body = preg_replace('/\[\/b\]/', '</b>', $body);
        $body = preg_replace('/\[i\]/', '<i>', $body);
        $body = preg_replace('/\[\/i\]/', '</i>', $body);
        $body = preg_replace('/\[num=(.[^\]]*)\]/', '<div class="nfj-num">$1</div>', $body);
        $body = preg_replace('/\[head\]/', '<div class="nfj-head">', $body);
        $body = preg_replace('/\[\/head\]/', '</div>', $body);
        $body = preg_replace('/\[color=(.[^\]]*)\]/', '<span style="color:$1">', $body);
        $body = preg_replace('/\[\/span\]/', '</span>', $body);
        $body = preg_replace('/\[link=(.[^\]]*)\]/', '<a href="$1" target="_blank">', $body);
        $body = preg_replace('/\[\/link\]/', '</a>', $body);
        $body = preg_replace('/\[div=(.[^\]]*)\]/', '<div class="$1">', $body);
        $body = preg_replace('/\[\/div\]/', '</div>', $body);
        $body = preg_replace('/\[art=(.[^\]]*)\]/', '<span class="nfj-art-link">', $body);
        $body = preg_replace('/\[\/art\]/', '</span>', $body);
        $body = str_replace(",nfj-open-image]", "' class='nfj-open-image'>", $body);
        $body = str_replace(",nfj-interview-photo]", "' class='nfj-interview-photo'>", $body);
        $body = str_replace(",nfj-vo-image]", "' class='nfj-vo-image'>", $body);
        $body = str_replace(",nfj-textphoto]", "' class='nfj-textphoto'>", $body);
        $body = preg_replace('/\[div=(.[^\]]*)\]/', '<div class="$1">', $body);
        $body = preg_replace('/\[\/div\]/', '</div>', $body);
        $body = preg_replace('/\[slider]/', '<div id="sm_slider"><ul>', $body);
        $body = preg_replace('/\[slide=/', '<li><img src="https://newfinder.ru/data/nfj/art/', $body);
        $body = preg_replace('/\/slide]/', '"/></li>', $body);
        $body = preg_replace('/\[\/slider]/', '</ul></div>', $body);
        $body = preg_replace('/\[iframe/', '<iframe', $body);
        $body = preg_replace('/\[\/iframe\]/', '</iframe>', $body);

        return $body;
    }

}
