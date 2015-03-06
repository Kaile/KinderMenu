debugMode = on

client = new $.RestClient '/v1/'

client.add 'ingestions'
client.add 'menus'
client.add 'menu-dishes'
client.add 'dishes'
client.add 'portions'
client.add 'ingridients'
client.add 'units'
client.add 'consists'
client.add 'menu-consists'

# First yes parameter is the allows thrown errors at once
# Second yes parameter is the debug option for Checker
checker = new $.Checker yes, debugMode

dumper = new $.Dumper(debugMode)

# Public: it calls save method from all pushed objects for save or update it.
# @created 05.02.2015 23:35:12
# @author Mihail Kornilov <fix-06 at yandex.ru>
# @since 1.0
class Saver
    # Public: array of objects for saving as {array}.
    objectList: []

    # Public: add object to saving
    #
    # savedObject - The object that adds to save as {object}. Must to have save method
    #
    # Returns the true if save or undefined as {bool|undefined}.
    add: (savedObject) ->
        @objectList.push savedObject if typeof savedObject.save is 'function'

    # Public: peform saving of all objects in list
    #
    # Returns the empty array as {array}.
    save: ->
        obj.save() for obj in @objectList
        @objectList = []

# Public: mixin that handled change event.
InputChangeMixin =
    handleChange: (e) ->
        @setState value: e.target.value

MenuOrder = React.createClass
    mixins: [InputChangeMixin]

    getInitialState: ->
        menuList: []
        value: ''

    componentDidMount: ->
        @updateState()

    updateState: ->
        client.menus.read().done (data) =>
            if data.length and checker.check data, 'Reads all menus'
                menuList = []

                for item in data
                    menuList.push <MenuItem menu={item} />

                res =
                    <div className="col-lg-6">
                        <ul className="list-group">
                            {menuList}
                        </ul>
                    </div>
                @setState menuList: res

    addMenu: ->
        unless @state.value
            new $.Informer('Укажите название создаваемого меню', 'info')
            return
        client.menus.create({name: @state.value, date: (new Date()).toLocaleDateString()}).done (data) =>
            @updateState()

    render: ->
        <div className="row">
            <h3>Выберите меню для загрузки или создайте новое</h3>
            {@state.menuList}
            <div className="col-lg-6">
                <div className="input-group">
                    <span className="input-group-addon">Меню</span>
                    <input className="form-control" onChange={@handleChange} value={@state.value} type="text" placeholder="Введите название меню" />
                    <span className="input-group-btn">
                        <button className="btn btn-default" type="button" onClick={@addMenu}>Добавить меню</button>
                    </span>
                </div>
            </div>
        </div>

MenuItem = React.createClass
    loadMenu: (e) ->
        e.preventDefault()
        React.unmountComponentAtNode $('#menu').get 0
        React.render <Menu menu={@props.menu} />, $('#menu').get 0

    render: ->
        <li onClick={@loadMenu} className="list-group-item">{@props.menu.name} {@props.menu.date}</li>

# Public: create menu
Menu = React.createClass
    # Public: init state
    #
    # Returns the initial state of mutable properties as {object}.
    getInitialState: ->
        ingestions: []
        menu: null

    # Public: call after render
    # componentWillMount: ->
    #     @updateState()

    # updateState: ->
    #     @setState menu: @props.menu
    #
    componentDidMount: ->
        client.ingestions.read().done (data) =>
            @setState ingestions: data if checker.check data, 'Load ingestion list for menu'
    #
    # componentWillReceiveProps: () ->
    #     @updateState()

    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        <div className="panel panel-default">
            <div className="panel-heading" title={@props.menu.date}>
                <h3>
                    <p className="text-center">
                        <strong>
                            Меню на {@props.menu.date}
                        </strong>
                    </p>
                </h3>
            </div>

            <table className="table">
                <thead>
                    <th>
                        <h4>
                            <p className="text-center">
                                <strong>
                                    Прием пищи
                                </strong>
                            </p>
                        </h4>
                    </th>
                    <th>
                        <h4>
                            <p className="text-center">
                                <strong>
                                    Название блюда и состав
                                </strong>
                            </p>
                        </h4>
                    </th>
                </thead>
                <MenuList ingestions={@state.ingestions} menuId={@props.menu.id}/>
            </table>
            <div className="panel-footer">Итоговый состав:</div>
        </div>

# Public: list of menu elements.
MenuList = React.createClass
    #Public: {object} received props type validation.
    propTypes:
        ingestions: React.PropTypes.arrayOf(React.PropTypes.object)
        menuId: React.PropTypes.number

    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        ingestions = []

        for item in @props.ingestions
            ingestions.push(
                <tr>
                    <td>
                        <div className="col-lg-6">
                            <h4>
                                <p className="text-center">
                                    {item.name}
                                </p>
                            </h4>
                        </div>
                    </td>
                    <td>
                        <MenuDishList menuId={@props.menuId} ingestionId={item.id} />
                    </td>
                </tr>
            )

        <tbody>
            {ingestions}
        </tbody>

# Public: list of dishes thats be presents in menu by ingestion.
MenuDishList = React.createClass
    #Public: {object} received props type validation.
    propTypes:
        menuId: React.PropTypes.number
        ingestionId: React.PropTypes.number

    # Public: init state
    #
    # Returns the initial state of mutable properties as {object}.
    getInitialState: ->
        dishes: []

    # Public: call after render
    componentDidMount: ->
        @handleUpdateDishList()

    openDishAddDialog: ->
        React.render <DishesLight changeDishList={@handleUpdateDishList} menuId={@props.menuId} ingestionId={@props.ingestionId} />, $('#dish-list').get 0
        $('#dish-add-dialog').modal().show()

    handleUpdateDishList: ->
        loadedDishes = []

        if @props.menuId > 0
            client['menu-dishes'].read(
                menu_id: @props.menuId
                ingestion_id: @props.ingestionId
            ).done (data) =>
                return if not checker.check data, 'Read dishes by menu id and ingestion id'

                if data.length is 0
                    loadedDishes.push(
                        <div className="row">
                            <div className="col-lg-6">
                                <div className="well">
                                    Блюда отсутствуют
                                </div>
                            </div>
                        </div>
                    )

                for item in data
                    loadedDishes.push <Dish onDishChange={[@handleUpdateDishList]} dish={item} menuId={@props.menuId} ingestionId={@props.ingestionId} />

                @setState dishes: loadedDishes

    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        <div className="list-group">
            {@state.dishes}
            <br/>
            <button className="btn btn-default" type="button" onClick={@openDishAddDialog} title="Добавить блюдо">
                Добавить блюдо
            </button>
        </div>

DishesLight = React.createClass
    propTypes: ->
        changeDishList: React.propTypes.func
        menuId: React.propTypes.number
        ingestionId: React.propTypes.number

    getInitialState: ->
        dishList: []

    componentDidMount: ->
        client.dishes.read().done (data) =>
            return unless checker.check data, 'Load all dishes for select to menu'

            @setState dishList: data.map (dish) =>
                #TODO: Сделать загрузку списка блюд только тех которые отсутсвуют в текущем меню текущего времени приема пищи
                <DishLight dish={dish} {...@props} />

    render: ->
        <div>
            {@state.dishList}
        </div>

DishLight = React.createClass
    propTypes: ->
        changeDishList: React.propTypes.func
        menuId: React.PropTypes.number
        ingestionId: React.PropTypes.number
        dish: React.PropTypes.object

    toggleDishInMenu: (e) ->
        button = $(e.target)
        if button.hasClass 'btn-default'
            newDishInMenu = 
                menu_id: @props.menuId
                ingestion_id: @props.ingestionId
                dish_id: @props.dish.id

            client['menu-consists']
                .create(newDishInMenu)
                .done( (data) =>
                    button.removeClass 'btn-default'
                    button.addClass 'btn-success'
                    return unless checker.check data, 'Add new dish in menu'
                    @props.changeDishList()
                    new $.Informer 'Блюдо "' + button.text() + '" добавлено в меню', 'info'
                )
                .fail( (data) => 
                    #TODO: в будущем переделать
                    messages = data.responseJSON
                    messages.map (item) ->
                        new $.Informer item.message, 'error'
                )

    render: ->
        style = margin: "15px"
        <button onClick={@toggleDishInMenu} className="btn btn-default" style={style} >{@props.dish.name}</button>

# Public: create view for single dish.
Dish = React.createClass
    #Public: {object} received props type validation.
    propTypes:
        dish: React.PropTypes.object
        menuId: React.PropTypes.number
        ingestionId: React.PropTypes.number
        onDishChange: React.PropTypes.array

    removeDish: (e) ->
        e.preventDefault()

        client['menu-consists']
            .read({dish_id: @props.dish.id, ingestion_id: @props.ingestionId, menu_id: @props.menuId})
            .done((data) =>
                return unless checker.check data, 'Search for menu consists for dish deleting'
                if data.length
                    client['menu-consists'].destroy(data[0].id).done (data) =>
                        new $.Informer "Блюдо '#{@props.dish.name}' было удалено из меню"
                        for item in @props.onDishChange
                            item.call()
            )



    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        <a href="#" className="list-group-item">
            <button onClick={@removeDish} type="button" className="close pull-right">x</button>
            <h4 onMouseDown={@setActive} className="list-group-item-heading">{@props.dish.name}</h4>
            <p className="list-group-item-text">
                <ConsistList dishId={@props.dish.id}/>
            </p>
        </a>

# Public: list of dish's consist.
ConsistList = React.createClass
    # Public: init state
    #
    # Returns the initial state of mutable properties as {object}.
    getInitialState: ->
        consistList: []

    # Public: call after render
    componentDidMount: ->

        consists = []

        client.consists.read(dish_id: @props.dishId).done (data) =>
            return if not checker.check data, 'Read consists by dish id'

            for i in [0...data.length]
                consists.push <Consist consist={data[i]} />

            @setState consistList: consists

    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        <span>
            Состав блюда: {@state.consistList}
        </span>

# Public: create view for single dish consist list.
Consist = React.createClass
    #Public: {object} received props type validation.
    propTypes: React.PropTypes.object

    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        <span>
            <span className="label label-info">
                {@props.consist.name}: {@props.consist.size} {@props.consist.shortName}.
            </span>  <span></span>
        </span>

# Public: parent of added dish list.
DishAdd = React.createClass
    # Public: init state
    #
    # Returns the initial state of mutable properties as {object}.
    getInitialState: ->
        elemCount: 0

    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        <DishAddList onCountUpdate={@handleCountUpdate} />

    # Public: handle for updating counter of dish list
    #
    # count - The value of elements for updating as {number}.
    #
    # Returns the void as {void}.
    handleCountUpdate: (count) ->
        @setState elemCount: count

# Public: list of dishes that can be added to the menu.
DishAddList = React.createClass
    #Public: {object} received props type validation.
    propTypes:
        onCountUpdate: React.PropTypes.func

    # Public: init state
    #
    # Returns the initial state of mutable properties as {object}.
    getInitialState: ->
        dishAddList : []

    # Public: call after render
    componentDidMount: ->

        dishList = []

        client.dishes.read().done (data) =>
            return if not checker.check data, 'Read all dishes for add dialog'

            for i in [0...data.length]
                dishList.push <Dish dish={data[i]} />
            @props.onCountUpdate(dishList.length)
            @setState dishAddList: dishList

    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        <div className="list-group">
            {@state.dishAddList}
        </div>

# Public: tab for creating new dish.
DishCreate = React.createClass
    # Public: mixin methods.
    mixins: [InputChangeMixin]

    # Private: ingridients as {array or object}.
    _ingridients: []

    # Private: portions as {array of number}.
    _portions: []

    Private: []

    # Private: units as {array of object}.
    _units: []

    # Private: dish identificator as {number}.
    _dishId: 0

    getInitialState: ->
        value: '' #dish name
        doClear: off

    # Public: update ingridients for saving
    #
    # ingridients - The array of ingridients as {array of object}.
    setIngridients: (ingridients) ->
        @_ingridients = ingridients

    # Public: update portions for saving
    #
    # portions - The array of portions as {array of object}.
    setPortions: (portions) ->
        @_portions = portions

    # Public: update units for saving
    #
    # units - The array of units as {array of object}.
    setUnits: (units) ->
        @_units = units

    saved: new $.Deferred()

    # Public: saves new dish
    save: (e) ->
        e.preventDefault()
        return new $.Informer 'Данные не прошли валидацию' unless @validate()
        try
            @saveDish().done (data) =>
                return unless checker.check data, 'Save new dish'
                @_dishId = data.id
                @saveIngridients()
            @saved.done =>
                new $.Informer 'Новое блюдо сохранено, Вы можете добавить его в меню', 'info'
                @clearDishCreateForm()
        catch e
            new $.Informer e.message

    # Public: validate saving data before save
    #
    # Returns the result of validation as {boolean}.
    validate: ->
        unless @state.value
            new $.Informer 'Не введено название блюда'
            return no
        unless @_ingridients.length is @_portions.length and @_portions.length is @_units.length
            new $.Informer 'Проверьте правильность заполнения ингридиентов блюда'
            return no
        yes

    # Public: saves the dish
    #
    # Returns object trigger that indicates when savign is over as {$.Differed}.
    saveDish: ->
        client.dishes.create name: @state.value

    # Public: saves ingridient of dish
    # TODO: Сделать точное определение сохранения всех данных блюда и обработку ошибок - в противном случае
    saveIngridients: ->
        loopCallback = (i) =>
            deferred = $.Deferred()
            if @_ingridients[i].name.length
                # if ingridient is not exist
                if @_ingridients[i].id is 0
                    client.ingridients.read({name: @_ingridients[i].name}).done (ingr) =>
                        if ingr.length and checker.check ingr[0], 'Search for existing ingridient by it name'
                            @savePortion(ingr[0].id, i)
                            deferred.resolve()
                        else
                            client.ingridients.create({name: @_ingridients[i].name, unit_id: @_units[i].id}).done (data) =>
                                @savePortion(data.id, i) if checker.check data, 'Saving new ingridient: ' + @_ingridients[i].name
                                deferred.resolve()
                else
                    @savePortion @_ingridients[i].id, i
                    deferred.resolve()
            deferred.promise()

        loopRecursion = (start, stop) ->
            return if start > stop
            loopCallback(start).done ->
                loopRecursion start + 1, stop

        loopRecursion 0, @_units.length - 1

    # Public: saves the portions consist of dish
    #
    # ingridientId - The ingridient identifier as {number}.
    # i            - The index of curr ingridient as {number}.
    savePortion: (ingridientId, i) ->
        client.portions.read({ingridient_id: ingridientId, size: @_portions[i]}).done (data) =>
            # if portion exists
            if data.length and checker.check data, 'Getting portion exist or not'
                existPortionId = data[0].id
                @saveConsist existPortionId, i
            else
                client.portions.create({ingridient_id: ingridientId, size: @_portions[i]}).done (data) =>
                    @saveConsist data.id, i if checker.check data, 'Saving new portion: ' + data.id

    # Public: saves the consists of dish
    #
    # portionId - The portion identifier as {number}.
    # i         - The index of curr portion as {number}.
    saveConsist: (portionId, i) ->
        client.consists.read({portion_id: portionId, dish_id: @_dishId}).done (data) =>
            #check consist existing
            if data.length and checker.check data, "Checks existing consist for dish: #{@_dishId} and portion #{portionId}"
            else
                client.consists.create({portion_id: portionId, dish_id: @_dishId}).done (data) =>
                    if checker.check data, 'Saving new consist'
                        @saved.resolve()

    # Public: clears dish creating form
    #
    # Returns the [Description] as `undefined`.
    clearDishCreateForm: ->
        @setState
            doClear: on
            value: ''
        @setState doClear: off

    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        <div className="form-group">
            <br/>
            <label htmlFor="dish-name" className="sr-only">Название блюда</label>
            <input type="text" className="form-control" placeholder="Введите название блюда" value={@state.value} onChange={@handleChange}/>
            <br/>
            <p>Состав блюда:</p>
            <DishConsist doClear={@state.doClear} returnIngridients={@setIngridients} returnPortions={@setPortions} returnUnits={@setUnits} />
            <br/>
            <button className="btn btn-sm btn-primary" onClick={@save}>Создать блюдо</button>
        </div>

# Public: show form for fill consist for new dish.
DishConsist = React.createClass
    # Private: row number for content elements.
    _rowNo: 0

    # Private: array of ingridients of dish.
    _ingridients: []

    # Private: array of portions of ingridients of dish.
    _portions: []

    # Private: array of units for portions.
    _units: []

    handleIngridient: (ingridient, rowNo) ->
        @_ingridients[rowNo] = ingridient
        @props.returnIngridients(@_ingridients)

    handlePortion: (portion, rowNo) ->
        @_portions[rowNo] = portion
        @props.returnPortions(@_portions)

    handleUnit: (unit, rowNo) ->
        @_units[rowNo] = unit
        @props.returnUnits(@_units)

    getInitialState: ->
        content: []

    componentDidMount: ->
        @addConsist()

    getItem: ->
        res =   <div className="row">
                    <div className="col-lg-7">
                        <IngridientInput rowNo={@_rowNo} updateIngridient={@handleIngridient} />
                    </div>
                    <div className="col-lg-5">
                        <Portion rowNo={@_rowNo} updatePortion={@handlePortion} updateUnit={@handleUnit} />
                    </div>
                </div>
        ++@_rowNo
        res

    # Public: add new form for input dish ingridient description
    addConsist: (e) ->
        e.preventDefault()
        @state.content.push @getItem()
        @setState content: @state.content

    clearConsist: ->
        @_rowNo = 0
        @setState content: []
        @setState content: @getItem()

    componentWillReceiveProps: ->
        if @props.doClear is on
            @clearConsist()

    render: ->
        <div>
            {@state.content}
            <br/>
            <button onClick={@addConsist} className="btn btn-xs btn-default">
                Добавить ингридиент
            </button>
        </div>

# Public: list of ingridients of dish that can be added to the consist of dish.
IngridientInput = React.createClass
    propTypes:
        rowNo: React.PropTypes.number
        updateIngridient: React.PropTypes.func

    handleChange: (e) ->
        tmp =
            id: 0
            name: e.target.value

        @props.updateIngridient tmp, @props.rowNo
        @setState selectedIngridient: tmp

    # Public: init state
    #
    # Returns the initial state of mutable properties as {object}.
    getInitialState: ->
        ingridientList: []
        selectedIngridient:
            id: 0
            name: ''

    # Public: update state on children element changing
    #
    # ingridient - The ingridient data as {object}.
    handleUpdate: (ingridient) ->
        @setState selectedIngridient: ingridient
        @props.updateIngridient ingridient, @props.rowNo

    # Public: call after render
    componentDidMount: ->
        ingridients = []

        client.ingridients.read().done (data) =>
            return if not checker.check data, 'Read all ingridients for selector in add dish dialog'

            for i in [0...data.length]
                 ingridients.push <Ingridient ingridient={data[i]} updateSelected={@handleUpdate} />

            @setState ingridientList: ingridients

    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        <div className="input-group">
            <div className="input-group-btn">
                <button type="button" className="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    Выберите или <span className="caret"></span>
                </button>
                <ul id="menu-ingridient-list" className="dropdown-menu">
                    {@state.ingridientList}
                </ul>
            </div>
            <input id="ingridient-new" type="text" className="form-control" onChange={@handleChange} value={@state.selectedIngridient.name} placeholder="введите ингридиент"/>
        </div>

# Public: creates view for single ingridient item.
Ingridient = React.createClass
    #Public: {object} received props type validation.
    propTypes:
        ingridient: React.PropTypes.object
        updateSelected: React.PropTypes.func

    handleClick: (e) ->
        e.preventDefault()
        @props.updateSelected(@props.ingridient)

    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        <li onClick={@handleClick}><a href="#">{@props.ingridient.name}</a></li>

# Public: list of units measures for size portions of ingridients.
Portion = React.createClass
    propTypes:
        rowNo: React.PropTypes.number
        updatePortion: React.PropTypes.func
        updateUnit: React.PropTypes.func

    handleChange: (e) ->
        portionSize = Number(e.target.value) or 0
        @props.updatePortion portionSize, @props.rowNo
        @setState value: portionSize

    # Public: current showen unit identifier as {number}.
    currUnitId: 0

    # Public: init state
    #
    # Returns the initial state of mutable properties as {object}.
    getInitialState: ->
        value: ''
        units: []
        currUnit:
            id: 0
            name: '????'

    # Public: call after render
    componentDidMount: ->
        client.units.read().done (data) =>
            return if not checker.check data, 'Read all units in add dish dialog'

            @setState
                units: data
                currUnit:
                    id: data[@currUnitId].id
                    name: data[@currUnitId].name
            @props.updateUnit data[@currUnitId], @props.rowNo

    # Public: change unit handled to click on button of unit type
    #
    # Returns the void as {void}.
    changeUnits: (e) ->
        e.preventDefault()
        maxId = @state.units.length - 1
        if ++@currUnitId > maxId
            @currUnitId = 0
        unit = @state.units[@currUnitId]

        @props.updateUnit unit, @props.rowNo

        @setState
            currUnit:
                name: unit.name
                id: unit.id

    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        <div className="input-group">
            <input type="number" className="form-control" onChange={@handleChange} value={@state.value} placeholder="Количество"/>
            <span onClick={@changeUnits} unitId={@state.currUnit.id} title="Кликните для смены единиц измерения" className="input-group-addon">{@state.currUnit.name}</span>
        </div>


React.render <MenuOrder />, $('#menu-order').get 0
# React.render <Menu />, $('#menu').get 0
#React.render <DishAdd />, $('#menu-dish-add').get 0
#React.render <DishCreate />, $('#menu-dish-create').get 0
