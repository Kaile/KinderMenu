<?php $this->title = 'Конфигуратор меню'; ?>
<?php $this->registerJsFile('/js/build/menu.js', ['depends' => ['app\assets\ReactAsset', 'app\assets\JqRestAsset']]) ?>
<div id="menu">
	<div class="">
		<h2>
			<span>Меню на </span>
			<span id="menu-date" title="<?=date('Ymd')?>">сегодня</span>
		</h2>

		<div id="menu-body" />
	</div>
</div>
