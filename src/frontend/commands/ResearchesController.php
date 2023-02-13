<?php

namespace app\modules\research\frontend\commands;

use app\modules\research\frontend\controllers\ResearcheController;
use app\modules\research\frontend\Google;
use app\modules\research\frontend;
use luya\cms\models\NavItem;

class ResearchesController extends \luya\console\Command
{
    /**
     * Описание метода №1
     */
    public function actionIndex()
    {
        $controller = new ResearcheController();
        $pages = NavItem::find()->asArray()->all();
        $pages_array = array();
        $dirty = $controller->dirtyArray($pages);
        $data = $controller->clearingArray($dirty, $pages);
        foreach ($data as $object) {
            $status = $controller->actionPage($object);
            $array = array(
                "id" => $object['id'],
                "uid" => $object['nav_id'],
                "create" => $object['timestamp_create'],
                "update" => $object['timestamp_update'],
                "url" => $object['alias'],
                "status" => $status,
            );
            array_push($pages_array, $array);
        }
        foreach ($pages as $page) {
            $controller->actionPage($page);
        }
        return $this->output($pages_array);
    }

}