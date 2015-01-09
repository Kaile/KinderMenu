var client = new $.RestClient('/');

client.add('ingestions');
client.add('dishes');

var Menu = React.createClass({displayName: "Menu",
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
			React.createElement("table", null, 
				React.createElement("thead", null, 
					React.createElement("th", null, "Прием пищи"), 
					React.createElement("th", null, "Название блюда и состав")
				), 
				React.createElement(MenuList, {class: "menuList", ingestions: this.state.ingestions, dishes: this.state.dishes})
			)
		);
	}
});

var MenuList = React.createClass({displayName: "MenuList",
	render: function() {
		var ingestions = [];

		for (var i = 0; i < this.props.ingestions.length; ++i) {
			ingestions.push(
				React.createElement("tr", null, 
					React.createElement("td", null, 
						this.props.ingestions[i].name
					)

				)
			);
		}

		return (
			React.createElement("tbody", null, 
				ingestions
			)
		);
	}
});

React.render(React.createElement(Menu, null), document.getElementById('menu-body'));
