debugMode = off

client = new $.RestClient '/v1/'

client.add 'dishes'
client.add 'consists'
client.add 'ingridients'

# First yes parameter is the allows thrown errors at once
# Second yes parameter is the debug option for Checker
checker = new $.Checker yes, debugMode

dumper = new $.Dumper(debugMode)

DishCreate = React.createClass
	getInitialState: ->
		dish:
			<div className="col-lg-6">
				<h3>Введите название блюда</h3>
				<div className="input-group">
					<input type="text" className="form-control" value={@dishName} onChange={@handleDishName} />
					<span className="input-group-btn">
						<input type="button" className="btn btn-default" value="Сохранить" onClick={@handleSaveName} />
					</span>
				</div>
			</div>
		dishId: 0
		ingridients: ''
		dishName: ''

	handleDishName: (e) ->
		e.preventDefault()
		@state.dishName = e.target.value

	handleSaveName: (e) ->
		e.preventDefault()

		@saveName()
			.done((data) =>
				@setState 
					dish:
						<a href="#" className="list-group-item">
							<h4 className="list-group-item-heading">{@state.dishName}</h4>
							<p className="list-group-item-text">
								<ConsistList dishId={@state.dishId} />
							</p>
						</a>
					ingridients:
						<Ingridients />
			)
			.fail ->
				new $.Informer 'Не удалось сохранить новое блюдо =(, попробуйте выполнить операцию позже', 'error'
		
	clearValues: ->
		@setState @getInitialState()

	saveName: ->
		dfd = new $.Deferred()

		client.dishes
			.create(name: @state.dishName)
			.done( (data) =>
				@state.dishId = data.id
				dfd.resolve()
			)
			.fail((data) ->
                checker.showFailMessage data
                dfd.reject()
            )

		dfd.promise()

	render: ->
		<div className="row">
			{@state.dish}
			<div className="col-lg-10">
				<br />
				<h4>Выбирите ингридиенты для блюда</h4>
				{@state.ingridients}
			</div>
		</div>

# Public: list of dish's consist.
ConsistList = React.createClass
    # Public: init state
    #
    # Returns the initial state of mutable properties as {object}.
    getInitialState: ->
    	$('document').on 'consist:update', ->
    		@componentDidMount()

        consistList: []

    # Public: call after render
    componentDidMount: ->

        consists = []

        client.consists.read(dish_id: @props.dishId)
            .done((data) =>
                for item in data
                    consists.push <Consist consist={item} />

                @setState consistList: consists
            )
            .fail((data) ->
                checker.showFailMessage data
            )

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

IngridientsObject =
	getInitialState: ->
		$(document).on('ingridients:update', @componentDidMount())

		ingridients: ''

	componentDidMount: ->
		tmpIngridients = []

		client.ingridients
				.read()
				.done((data) =>
					tmpIngridients = data.map (ingridient) ->
						<Ingridient value={ingridient} />

					@setState ingridients: tmpIngridients
				)
				.fail((data) ->
					checker.showFailMessage data
				)

	render: ->
		<div>
			{@state.ingridients}
		</div>

IngridientObject =
	render: ->
		btnStyle = 
			margin: "5px"
		<button style={btnStyle} className="btn btn-default">{@props.value.name}</button>

Ingridients = React.createClass IngridientsObject
Ingridient  = React.createClass IngridientObject

DishImport = React.createClass
	getInitialState: ->
		importText: ''

	handleImportText: (e) ->
		e.preventDefault()
		@state.importText = e.target.text()

	handleImport: ->
		

	render: ->
		areaStyle = 
			width: '100%'
			height: '300px'
			maxWidth: '100%'
			maxHeight: '300px'
			fontFamily: 'Courier New'
			fontSize: '14pt'
		<div >
			<textarea style={areaStyle} value={@state.importText} onChange={@handleImportText} />
			<br />
			<button onClick={@handleImport} className="btn btn-primary pull-right">Импортировать</button>
		</div>

React.render <DishImport />, $("#dish-import").get 0