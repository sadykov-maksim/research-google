<?php

namespace app\modules\research\frontend\models;

use Yii;
use yii\db\ActiveRecord;

class Researches extends ActiveRecord
{
    public static function tableName()
    {
        return 'research_table';
    }
    /** Получить все записи из таблицы «research_table» */
    public function getAllResearches(){
        return Researches::find()->asArray()->all();
    }
    /**
     * Уникальные значения
     */
    public function uniqueValues()
    {
        $list_pages = array();
        $researches = $this->getAllResearches();
        foreach ($researches as $page):
            array_push($list_pages, $page['url']);
        endforeach;
        return array_unique($list_pages);
    }
    public function createNewRecord(string $uid, string $url, string $start_time, string $end_time, string $status) {
        $record = new Researches();
        $record->uid = $uid;
        $record->url = $url;
        $record->start_time = $start_time;
        $record->end_time = $end_time;
        $record->status = $status;
        $record->save();
        return $status;
    }
    public function updateRecord(string $uid, string $url, string $create, string $update, string $status){
        $params = ['uid' => $uid, 'url' => $url, 'create' => $create, 'update' => $update, 'status' => $status,];
        Yii::$app->db->createCommand("UPDATE research_table SET url=:url, start_time=:create, end_time=:update, status=:status WHERE uid=:uid", $params)->execute();
        return $status;
    }
}