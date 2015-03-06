<?php $this->title = 'Конфигуратор меню'; ?>
<?php $this->registerJsFile('/js/build/menu.js', ['depends' => [
                                                                'app\assets\ReactAsset',
                                                                'app\assets\JqRestAsset',
                                                                'app\assets\HelpersAsset'],
]) ?>
<div class="modal fade" id="dish-add-dialog">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title">Кликните по блюду, чтобы добавить в меню</h4>
            </div>

            <div class="modal-body">
                <div id="dish-list">
                </div>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<div id="menu"></div>
<div id="menu-order"></div>
