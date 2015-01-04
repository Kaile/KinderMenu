<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
* Asset bundle for the Twitter bootstrap css files.
*
* @since 2.0
*/
class ReactAsset extends AssetBundle
{
	public $sourcePath = '@bower/react';
	public $js = [
		'react.min.js',
	];
}
