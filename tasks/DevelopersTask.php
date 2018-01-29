<?php

namespace Newfinder\Modules\Cli\Tasks;

use Newfinder\Helpers\StrHelper;
use Newfinder\Models\DevelopersModel;

class DevelopersTask extends BaseTask
{
    public function developersIconsAction()
    {
        $array_developers = $this->db->fetchAll("SELECT id, icon  FROM developers WHERE icon IS NOT NULL AND icon <> ''");
        if ($array_developers) {
            foreach ($array_developers as $developer) {
                if (!filter_var($developer['icon'], FILTER_VALIDATE_URL)) {
                    $path = BASE_PATH . '/public' . $developer['icon'];
                } else {
                    $path = $developer['icon'];
                }

                if (!@fopen($path, "r")) {
                    $this->log("File $path not found");
                    $result_query = $this->db->execute(sprintf("UPDATE developers SET icon='%s' WHERE id=%d", NULL, $developer['id']));
                    if ($result_query) {
                        $this->log("Record ID: " . $developer['id'] . " updated");
                    } else {
                        $this->log("Record ID: " . $developer['id'] . " not updated");
                    }
                }

            }

        }
    }

    public function setRelevanceAction()
    {
        $developer = new DevelopersModel();
        $data = $developer::find();
        foreach ($data as $r) {
            /**
             * @var $r DevelopersModel
             */
            $r->setRelevance($r->calcRelevance())->save();
        }
    }

    public function updateDevelopersSlugAction()
    {
        $strHelper = new StrHelper();
        $dic = $this->db->fetchAll("SELECT id, name FROM developers WHERE slug IS NULL");
        foreach ($dic as $row) {
            $this->db->execute(sprintf("UPDATE developers SET slug='%s' WHERE id=%d", $strHelper->makeUrl($row['name']), $row["id"]));
        }
    }
}
