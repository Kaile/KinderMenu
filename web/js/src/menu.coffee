client = new $.RestClient '/v1/'

client.add 'ingestions'
client.add 'menus'
client.add 'menu-dishes'
client.add 'dishes'
client.add 'portions'
client.add 'ingridients'
client.add 'units'

# Public: it calls save method from all pushed objects for save or update it.
# @created 05.02.2015 23:35:12
# @author Mihail Kornilov <fix-06 at yandex.ru>
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

# First yes parameter is the allows thrown errors at once
# Second yes parameter is the debug option for Checker
checker = new $.Checker yes, no

# Public: create menu
Menu = React.createClass(
    # Public: init state
    #
    # Returns the initial state of mutable properties as {object}.
    getInitialState: ->
        ingestions: []
        menu: []
        date: new Date

    # Public: call after render
    componentDidMount: ->
        client.menus.read(date: @state.date).done (data) =>
            if data.length
                @setState menu: data if checker.check data, 'Read menu by it date'

        client.ingestions.read().done (data) =>
            @setState ingestions: data if checker.check data, 'Load ingestion list for menu'

    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        <div className="panel panel-default">
            <div className="panel-heading" title={@state.date.toString()}>
                <h3>
                    <p className="text-center">
                        <strong>
                            Меню на {@state.date.toLocaleDateString()}
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
                <MenuList ingestions={@state.ingestions} menuId={@state.menu.id}/>
            </table>
            <div className="panel-footer">Итоговый состав:</div>
        </div>
)

# Public: list of menu elements.
MenuList = React.createClass(
    #Public: {object} received props type validation.
    propTypes:
        ingestions: React.PropTypes.arrayOf(React.PropTypes.object)
        menuId: React.PropTypes.number

    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        ingestions = []

        for i in [0...@props.ingestions.length]
            ingestions.push(
                <tr>
                    <td>
                        <h4>
                            <p className="text-center">
                                {@props.ingestions[i].name}
                            </p>
                        </h4>
                    </td>
                    <td>
                        <MenuDishList menuId={@props.menuId} ingestionId={@props.ingestions[i].id} />
                        <DishAddButton />
                    </td>
                </tr>
            )

        <tbody>
            {ingestions}
        </tbody>
)

# Public: list of dishes thats be presents in menu by ingestion.
MenuDishList = React.createClass(
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
        loadedDishes = []

        #TODO: Переделать на загрузку блюд из этого меню
        client['menu-dishes'].read(
            menu_id: @props.menuId
            ingestion_id: @props.ingestionId
        ).done (data) =>
            return if not checker.check data, 'Read dishes by menu id and ingestion id'

            for i in [0...data.length]
                loadedDishes.push <Dish dish={data[i]} />

            @setState dishes: loadedDishes

    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        <div className="list-group">
            {@state.dishes}
        </div>
)

# Public: create view for single dish.
Dish = React.createClass(
    #Public: {object} received props type validation.
    propTypes:
        dish: React.PropTypes.object

    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        <a href="#" className="list-group-item">
            <h4 className="list-group-item-heading">{@props.dish.name}</h4>
            <p className="list-group-item-text">
                <ConsistList dishId={@props.dish.id} />
            </p>
        </a>
)

# Public: list of dish's consist.
ConsistList = React.createClass(
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
)

# Public: create view for single dish consist list.
Consist = React.createClass(
    #Public: {object} received props type validation.
    propTypes: React.PropTypes.object

    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        <span className="label label-info">
            {@props.consist.name}: {@props.consist.size}
        </span>
)

# Public: handle to button of creating or adding dish in the menu.
DishAddButton = React.createClass(
    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        <button onClick={@openDialog} className="btn btn-default" >
            Добавить блюдо
        </button>

    # Public: handle of click on the add or create dish button
    #
    # Returns the void as {void}.
    openDialog: ->
        $('#dish-add-dialog').modal()
)

# Public: parent of added dish list.
DishAdd = React.createClass(
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
        @setState(elemCount: count)

)

# Public: list of dishes that can be added to the menu.
DishAddList = React.createClass(
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
)

# Public: list of ingridients of dish that can be added to the consist of dish.
IngridientList = React.createClass(
    # Public: init state
    #
    # Returns the initial state of mutable properties as {object}.
    getInitialState: ->
        ingridientList: []

    # Public: call after render
    componentDidMount: ->

        ingridients = [];

        client.ingridients.read().done (data) =>
            return if not checker.check data, 'Read all ingridients for selector in add dish dialog'

            for i in [0...data.length]
                 ingridients.push <Ingridient name={data[i].name} />

            @setState(ingridientList: ingridients)

    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        <ul className="dropdown-menu">
            {@state.ingridientList}
        </ul>
)

# Public: creates view for single ingridient item.
Ingridient = React.createClass(
    #Public: {object} received props type validation.
    propTypes:
        name: React.PropTypes.string

    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        <li><a href="#">{@props.name}</a></li>
)

#TODO: сделать отображение и выбор единиц измерения
# Public: list of units measures for size portions of ingridients.
UnitList = React.createClass(
    # Public: current showen unit identifier as {number}.
    currUnitId: 0

    # Public: init state
    #
    # Returns the initial state of mutable properties as {object}.
    getInitialState: ->
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

    # Public: render components to DOM
    #
    # Returns the dom nodes as {NodeElement}.
    render: ->
        <div className="input-group">
            <input id="portion-new" type="text" className="form-control" placeholder="Количество"/>
            <span onClick={@changeUnits} unitId={@state.currUnit.id} title="Кликните для смены единиц измерения" className="input-group-addon">{@state.currUnit.name}</span>
        </div>

    # Public: change unit handled to click on button of unit type
    #
    # Returns the void as {void}.
    changeUnits: ->
        maxId = @state.units.length - 1
        if ++@currUnitId > maxId
            @currUnitId = 0
        unit = @state.units[@currUnitId]

        @setState
            currUnit:
                name: unit.name
                id: unit.id
)

React.render <Menu />, $('#menu').get 0
React.render <DishAdd />, $('#menu-dish-add').get 0
React.render <IngridientList />, $('#menu-ingridient-list').get 0
React.render <UnitList />, $('.menu-unit-list').get 0
