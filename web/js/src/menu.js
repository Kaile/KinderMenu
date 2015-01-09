var client = new $.RestClient('/');

client.add('ingestions');
client.add('dishes');

var Menu = React.createClass({
	getInitialState: function() {
		return {
			ingestions: [],
			dishes: []
		};
	},

	componentDidMount: function() {
		client.ingestions.read().done(function(data) {
			this.setState({ingestions: data});
		}.bind(this));

		client.dishes.read().done(function(data) {
			this.setState({dishes: data});
		}.bind(this));
	},

	render: function() {
		return (
			<table>
				<thead>
					<th>Прием пищи</th>
					<th>Название блюда и состав</th>
				</thead>
				<MenuList class="menuList" ingestions={this.state.ingestions} dishes={this.state.dishes}/>
			</table>
		);
	}
});

var MenuList = React.createClass({
	render: function() {
		var ingestions = [];

		for (var i = 0; i < this.props.ingestions.length; ++i) {
			ingestions.push(
				<tr>
					<td>
						{this.props.ingestions[i].name}
					</td>

				</tr>
			);
		}

		return (
			<tbody>
				{ingestions}
			</tbody>
		);
	}
});

React.render(<Menu />, document.getElementById('menu-body'));
