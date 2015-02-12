<?php

namespace app\modules\v1\controllers;

class ConsistController extends \app\modules\common\controllers\RestController
{
	public $modelClass = 'app\modules\v1\models\Consists';

	/**
	* Add new actions to standart, declared in ActiveController
	* @return array actions
	*/
	public function actions()
	{
		$actions = parent::actions();

		$actions['index'] = [
			'class' =>'app\modules\v1\controllers\actions\ConsistIndexAction',
			'modelClass' => $this->modelClass,
			'checkAccess' => [$this, 'checkAccess'],
		];

		return $actions;
	}
}
