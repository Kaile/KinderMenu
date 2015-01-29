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
                        <div id="menu-dish-create">
                            <div class="form-group">
                                <br/>
                                <label for="dish-name" class="sr-only">Название блюда</label>
                                <input type="text" class="form-control" id="dish-name" placeholder="Введите название блюда"/>
                                <br/>
                                <p>Состав блюда:</p>

                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                    Выберите или <span class="caret"></span>
                                                </button>
                                                <ul id="menu-ingridient-list" class="dropdown-menu">
                                                </ul>
                                            </div>
                                            <input id="ingridient-new" type="text" class="form-control" placeholder="введите ингридиент"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <div class="input-group">
                                                <input id="portion-new" type="text" class="form-control" placeholder="Укажите объем"/>
                                                <span class="input-group-addon">грамм</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="input-group">
                                            <div class="input-group-btn" id="menu-ingridient-list">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                    Выберите или <span class="caret"></span>
                                                </button>
                                            </div>
                                            <input id="ingridient-new" type="text" class="form-control" placeholder="введите ингридиент"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <div class="input-group">
                                                <input id="portion-new" type="text" class="form-control" placeholder="Укажите объем"/>
                                                <span class="input-group-addon">грамм</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <button class="btn btn-sm btn-primary">Создать блюдо</button>
                            </div>
                        </div>
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
<div id="menu"></div>
