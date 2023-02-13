<?php

namespace app\modules\research\admin\controllers;

/**
 * Researches Controller.
 * 
 * File has been created with `crud/create` command. 
 */
class ResearchesController extends \luya\admin\ngrest\base\Controller
{
    /**
     * @var string The path to the model which is the provider for the rules and fields.
     */
    public $modelClass = 'app\modules\research\models\Researches';
}