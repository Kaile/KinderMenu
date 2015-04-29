<?php /* @var $this \yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<?php $this->title = 'Импорт блюд'; ?>

<?php if ($errorMessage): ?>
    <div class="alert alert-danger"><?= $errorMessage; ?></div>
<?php endif; ?>

<?php if ($importedDishes) { ?>
    <ol>
    <?php foreach ($importedDishes as $dish => $consist): ?>
        <li>
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading"><?= $dish ?></h4>
                <p class="list-group-item-text">
                    <span>
                        Состав блюда:
                        <?php foreach ($consist as $ingridient => $portion): ?>
                            <span>
                                <span class="label label-info">
                                    <?= $ingridient ?> : <?= $portion ?>
                                </span>  <span></span>
                            </span>
                        <?php endforeach ?>
                    </span>
                </p>
            </a>
    <?php endforeach ?>
    </ol>
    <a href="<?= \yii\helpers\Url::to('dish-import') ?>">Вернуться на страницу импорта блюд</a>
<?php } else { ?>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<!--        <label for="file">Выберите файл для импорта блюд</label> <br />-->
        <?= $form->field($model, 'file')->fileInput() ?>
        <?= Html::submitButton('Импортировать') ?>
    <?php ActiveForm::end() ?>
<?php } ?>