<?php $this->title = 'Управление блюдами'; ?>
<?php $this->registerJsFile('/js/build/dishes.js', ['depends' => [
                                                                'app\assets\ReactAsset',
                                                                'app\assets\JqRestAsset',
                                                                'app\assets\HelpersAsset'],
]) ?>
<div>
	<h3>Создайте свое новое блюдо</h3>
	<div id="dish-create">
		
	</div>
</div>
<div>
	<h3>Быстрый импорт блюд</h3>
	<div>
		<h4>Введите блюда в формате:
		[Название блюда]: [название ингридиента] [объем] [единица измерения в именительном падеже], ...,;</h4>
		<span id="dish-import"></span>
	</div>
</div>