<?php

namespace app\modules\research\frontend\controllers;

use app\modules\research\frontend\Connection;
use app\modules\research\frontend\models\Researches;

/**
 * Researches Controller.
 *
 * File has been created with `crud/create` command.
 */
class ResearcheController
{
    /** Описание метода */
    public function dirtyArray(array $pages) {
        $remove_ids = array();
        foreach ($pages as $page):
            if (str_contains($page['alias'], 'deleted')) {
                array_push($remove_ids, $page);
            }
        endforeach;
        return $remove_ids;
    }
    /** Очищаем массив от удалленые страниц */
    public function clearingArray(array $objects, array $pages){
        $deleted_obj = array();
        foreach ($objects as $object):
            array_push($deleted_obj, $object);
            unset($pages[$object['id']-1]);
        endforeach;
        $this->deletedValues($deleted_obj);
        return $pages;
    }
    /** Удаление значений */
    public function deletedValues(array $deleted) {
        /* Создаем массив */
        $deleted_objs = array();
        /* Перебираем массив */
        foreach ($deleted as $item) {
            $new_object = $item['alias'];
            $da = mb_substr($new_object, 25);
            array_push($deleted_objs, $da);
        }
        return $deleted_objs;
    }
    public function actionPage(array $page) {
        $record = new Researches();
        $google = new Connection();
        $researches_list = $record->getAllResearches();
        $new_array = array();
        $status = array(
            1 => "In processing",
            2 => "Created",
            3 => "Deleted",
            4 => "Updated"
        );
        foreach ($researches_list as $research) {
            if (array_search($research['url'], $page)) {
                $record->updateRecord($page['nav_id'], $page['alias'], $page['timestamp_create'], $page['timestamp_update'], $status[1]);
                array_push($new_array, $page);
                $google->postRequest($page['alias'], 1);
                return $status[1];
            }
            else if (str_contains($page['alias'], 'deleted')) {
                $alias = mb_substr($page['alias'], 25);
                $record->updateRecord($page['nav_id'], $alias, $page['timestamp_create'], $page['timestamp_update'], $status[3]);
                array_push($new_array, $page);
                $google->postRequest($page['alias'], 2);
                return $status[3];
            }
        }
        if (!in_array($page, $new_array)) {
            if ($page['timestamp_update']) {
                $record->updateRecord($page['nav_id'], $page['alias'], $page['timestamp_create'], $page['timestamp_update'], $status[4]);
                array_push($new_array, $page);
                $google->postRequest($page['alias'], 2);
                return $status[4];
            }
            $record->createNewRecord($page['nav_id'], $page['alias'], $page['timestamp_create'], $page['timestamp_update'], $status[2]);
            $google->postRequest($page['alias'], 1);
            return $status[2];
        }
        return true;
    }
}