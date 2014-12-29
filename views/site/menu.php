<?php $this->title = 'Конфигуратор меню'; ?>

<div id="menu">
	<div class="">
		<h2>
			<span>Меню на </span>
			<span id="menu-date" title="<?=date('Ymd')?>">сегодня</span>
		</h2>

		<table id="menu-body">
			<thead>
				<th>
					Прием пищи
				</th>
				<th>
					Наименование блюда
				</th>
			</thead>
			<tbody>
				<?php $ingestions = app\models\Ingestions::find()->orderBy('position')->all(); ?>
				<?php foreach ($ingestions as $ingestion): ?>
					<tr>
						<td>
							<?= $ingestion->name ?>
						</td>
						<td>
							<div class="add-dish">
								<span>Img-Add-Dish</span>
							</div>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
