client = new $.RestClient '/v1/'

client.add 'ingestions'
client.add 'menus'
client.add 'dishes'
client.add 'portions'
client.add 'ingridients'

# Second yes parameter is the debug option for Checker
checker = new $.Checker yes, yes

Menu = React.createClass(
    getInitialState: ->
        ingestions: []
        menus: []
        date: new Date

    componentDidMount: ->
        client.menus.read(date: @state.date).done (data) =>
            @setState ingestions: data if checker.check data, 'Read menu by it date'

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
                <MenuList ingestions={@state.ingestions} menus={@state.menus}/>
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
                        <DishList />
                        <DishAddButton />
                    </td>
                </tr>
            )

        <tbody>
            {ingestions}
        </tbody>
)

DishList = React.createClass(
    getInitialState: ->
        dishes: []

    componentDidMount: ->
        loadedDishes = []

        #TODO: Переделать на загрузку блюд из этого меню
        client.dishes.read().done (data) =>
            return if not checker.check data, 'Read dishes by menu id'

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

        #TODO: проверить правильно ли работает чтение значений
        client.dishes.read(@props.dishId).consists().done (data) =>
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
            {@props.consist.name}:{@props.consist.portion}
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
        if @state.elemCount > 0
            <DishAddList onCountUpdate={@handleCountUpdate} />
        else
            <div>
                <br/>
                Блюд еще нет, создайте свое первое блюдо на
                вкладке "Создание блюда"
            </div>

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
    render: ->
        <div></div>
)

Unit = React.createClass(
    render: ->
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">метр</a></li>
)

React.render <Menu />, $('#menu').get 0
React.render <DishAdd />, $('#menu-dish-add').get 0
React.render <IngridientList />, $('#menu-ingridient-list').get 0
# React.render <UnitList />, $('#menu-unit-list').get 0
