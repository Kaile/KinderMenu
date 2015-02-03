client = new $.RestClient '/v1/'

client.add 'ingestions'
client.add 'menus'
client.add 'menu-dishes'
client.add 'dishes'
client.add 'portions'
client.add 'ingridients'
client.add 'units'

# First yes parameter is the allows thrown errors at once
# Second yes parameter is the debug option for Checker
checker = new $.Checker yes, yes

Menu = React.createClass(
    getInitialState: ->
        ingestions: []
        menu: []
        date: new Date

    componentDidMount: ->
        client.menus.read(date: @state.date).done (data) =>
            if data.length
                @setState menu: data if checker.check data, 'Read menu by it date'

        client.ingestions.read().done (data) =>
            @setState ingestions: data if checker.check data, 'Load ingestion list for menu'

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

MenuList = React.createClass(
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

MenuDishList = React.createClass(
    getInitialState: ->
        dishes: []

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

    render: ->
        <div className="list-group">
            {@state.dishes}
        </div>
)

Dish = React.createClass(
    render: ->
        <a href="#" className="list-group-item">
            <h4 className="list-group-item-heading">{@props.dish.name}</h4>
            <p className="list-group-item-text">
                <ConsistList dishId={@props.dish.id} />
            </p>
        </a>
)

ConsistList = React.createClass(
    getInitialState: ->
        consistList: []

    componentDidMount: ->

        consists = []

        client.consists.read(dish_id: @props.dishId).done (data) =>
            return if not checker.check data, 'Read consists by dish id'

            for i in [0...data.length]
                consists.push <Consist consist={data[i]} />

            @setState consistList: consists

    render: ->
        <span>
            Состав блюда: {@state.consistList}
        </span>
)

Consist = React.createClass(
    render: ->
        <span className="label label-info">
            {@props.consist.name}: {@props.consist.size}
        </span>
)

DishAddButton = React.createClass(
    render: ->
        <button onClick={@openDialog} className="btn btn-default" >
            Добавить блюдо
        </button>

    openDialog: ->
        $('#dish-add-dialog').modal()
)

DishAdd = React.createClass(
    getInitialState: ->
        elemCount: 0

    render: ->
        <DishAddList onCountUpdate={@handleCountUpdate} />

    handleCountUpdate: (count) ->
        @setState(elemCount: count)

)

DishAddList = React.createClass(
    getInitialState: ->
        dishAddList : []

    componentDidMount: ->

        dishList = []

        client.dishes.read().done (data) =>
            return if not checker.check data, 'Read all dishes for add dialog'

            for i in [0...data.length]
                dishList.push <Dish dish={data[i]} />
            @props.onCountUpdate(dishList.length)
            @setState dishAddList: dishList

    render: ->
        <div className="list-group">
            {@state.dishAddList}
        </div>
)

IngridientList = React.createClass(
    getInitialState: ->
        ingridientList: []

    componentDidMount: ->

        ingridients = [];

        client.ingridients.read().done (data) =>
            return if not checker.check data, 'Read all ingridients for selector in add dish dialog'

            for i in [0...data.length]
                 ingridients.push <Ingridient name={data[i].name} />

            @setState(ingridientList: ingridients)

    render: ->
        <ul className="dropdown-menu">
            {@state.ingridientList}
        </ul>
)

Ingridient = React.createClass(
    render: ->
        <li><a href="#">{@props.name}</a></li>
)

#TODO: сделать отображение и выбор единиц измерения
UnitList = React.createClass(
    currUnitId: 0

    getInitialState: ->
        units: []
        currUnit:
            id: 0
            name: '????'

    componentDidMount: ->
        client.units.read().done (data) =>
            return if not checker.check data, 'Read all units in add dish dialog'

            @setState
                units: data
                currUnit:
                    id: data[@currUnitId].id
                    name: data[@currUnitId].name

    render: ->
        <div className="input-group">
            <input id="portion-new" type="text" className="form-control" placeholder="Количество"/>
            <span onClick={@changeUnits} unitId={@state.currUnit.id} title="Кликните для смены единиц измерения" className="input-group-addon">{@state.currUnit.name}</span>
        </div>

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
