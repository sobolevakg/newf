<?php

namespace Newfinder\Modules\Frontend\Controllers;

use Phalcon\Mvc\View;

use Newfinder\Models\Review;
use Newfinder\Models\TreePaths;
use Newfinder\Library\UrlManager;
use Phalcon\Db\Column;
use function array_filter;

class ReviewController extends BaseController
{
    public function onConstruct() {
        parent::onConstruct();
        $js = $this->assets->collection('js');
        $js->addJs('js/lib/fotorama.js');
        $this->view->showHeaderTitle = false;
    }

    public function saveAction()
    {
        $this->view->disable();
        $review = new Review();
        if ($this->request->isPost()) {
            if($this->request->getPost('type') == "developers"){
                $review->setDevelopersId($this->request->getPost('id'));                
            }else if($this->request->getPost('type') == "housing_complex"){
                $review->setHousingComplexId($this->request->getPost('id'));    
            }
            $review->setPublicationDatetime();
            $review->setNameUser($this->request->getPost('user_name'));
            $review->setText($this->request->getPost('text'));
            if (!$review->create()) {
                $result["error"] = 1;
                $result["message"] = "К сожалению, не удалось отправить отзыв";
            }else{
		if(!empty($this->request->getPost('answer'))){
			$id_answer = $review->id;
			$id_review = $this->request->getPost('answer');
			$answer = new TreePaths();
			$answer->setDescendant($id_answer);
			$answer->setAncestor($id_review);
			if (!$answer->create()) {
				$result["error"] = 1;
				$result["message"] = "К сожалению, не удалось отправить отзыв";
			}else{
				$result["error"] = 0;
		        	$result["message"] = "Ваш отзыв успешно оставлен";
			}
			
		}else{
		        $result["error"] = 0;
		        $result["message"] = "Ваш отзыв успешно оставлен";
		}
	    }
            
                echo json_encode($result);
        }
    }


}
