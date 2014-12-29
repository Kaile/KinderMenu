<?php
use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var string $name
* @var string $message
* @var Exception $exception
*/

$this->title = $name;
?>
<div class="site-error">

	<h1><?= Html::encode($this->title) ?></h1>

	<div class="alert alert-danger">
		<?= nl2br(Html::encode($message)) ?>
	</div>

	<p>
		Указанная выше ошибка произошла во время выполнения Вашего запроса
	</p>
	<p>
		Пожалуйста, свяжитесь с нами, если считаете, что это ошибка сервера. Спасибо.
	</p>

</div>
