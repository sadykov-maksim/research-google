<?php

namespace app\modules\research\admin;

/**
 * Research Admin Module.
 *
 * File has been created with `module/create` command. 
 * 
 * @author
 * @since 1.0.0
 */
class Module extends \luya\admin\base\Module
{
	public $apis = [
		'api-research-researches' => 'app\modules\research\admin\apis\ResearchesController',
	];

	public function getMenu()
	{
		return (new \luya\admin\components\AdminMenuBuilder($this))
			->node('Researches', 'extension')
				->group('Group')
					->itemApi('Researches', 'researchadmin/researches/index', 'label', 'api-research-researches');
	}
}