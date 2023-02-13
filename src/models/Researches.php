<?php

namespace app\modules\research\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Researches.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $id
 * @property integer $uid
 * @property string $url
 * @property integer $start_time
 * @property integer $end_time
 * @property string $status
 */
class Researches extends NgRestModel
{
    /**
     * @inheritdoc
     */
    //public $i18n = ['url', 'status'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%research_table}}';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-research-researches';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uid' => Yii::t('app', 'Uid'),
            'url' => Yii::t('app', 'Url'),
            'start_time' => Yii::t('app', 'Start Time'),
            'end_time' => Yii::t('app', 'End Time'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'url', 'start_time', 'end_time', 'status'], 'required'],
            [['uid', 'start_time', 'end_time'], 'integer'],
            [['url'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 175],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'uid' => 'number',
            'url' => 'text',
            'start_time' => 'datetime',
            'end_time' => 'datetime',
            'status' => 'text',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['uid', 'url', 'start_time', 'end_time', 'status']],
            [['create', 'update'], ['uid', 'url', 'start_time', 'end_time', 'status']],
            ['delete', false],
        ];
    }
}
