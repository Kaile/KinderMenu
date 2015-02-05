<?php

namespace app\assets;

use yii\web\AssetBundle;
use Yii;

/**
* Asset bundle for the Twitter bootstrap css files.
*
* @since 2.0
*/
class ReactAsset extends AssetBundle
{
	public $sourcePath = '@bower/react';

	public function __construct()
	{
		if (YII_ENV_DEV) {
			$this->js[] = 'react.js';
		} else {
			$this->js[] = 'react.min.js';
		}
		parent::__construct();
	}
}
