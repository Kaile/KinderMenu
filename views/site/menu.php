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
                <h4 class="modal-title">Управление блюдами</h4>
            </div>

            <div class="modal-body">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#dish-select" data-toggle="tab">Выбор блюд</a></li>
                    <li ><a href="#dish-create" data-toggle="tab">Создание блюда</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="dish-select">
                        <div id="menu-dish-add"></div>
                    </div>
                    <div class="tab-pane fade" id="dish-create">
                        <div id="menu-dish-create"></div>
                    </div>
                </div>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" >Сохранить</button>
            </div>
        </div>
    </div>
</div>
<div id="menu-order"></div>
<div id="menu"></div>
