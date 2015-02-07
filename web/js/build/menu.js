// Generated by CoffeeScript 1.8.0
var Consist, ConsistList, Dish, DishAdd, DishAddButton, DishAddList, Ingridient, IngridientList, Menu, MenuDishList, MenuList, Saver, UnitList, checker, client;

client = new $.RestClient('/v1/');

client.add('ingestions');

client.add('menus');

client.add('menu-dishes');

client.add('dishes');

client.add('portions');

client.add('ingridients');

client.add('units');

Saver = (function() {
  function Saver() {}

  Saver.prototype.objectList = [];

  Saver.prototype.add = function(savedObject) {
    if (typeof savedObject.save === 'function') {
      return this.objectList.push(savedObject);
    }
  };

  Saver.prototype.save = function() {
    var obj, _i, _len, _ref;
    _ref = this.objectList;
    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
      obj = _ref[_i];
      obj.save();
    }
    return this.objectList = [];
  };

  return Saver;

})();

checker = new $.Checker(true, false);

Menu = React.createClass({
  getInitialState: function() {
    return {
      ingestions: [],
      menu: [],
      date: new Date
    };
  },
  componentDidMount: function() {
    client.menus.read({
      date: this.state.date
    }).done((function(_this) {
      return function(data) {
        if (data.length) {
          if (checker.check(data, 'Read menu by it date')) {
            return _this.setState({
              menu: data
            });
          }
        }
      };
    })(this));
    return client.ingestions.read().done((function(_this) {
      return function(data) {
        if (checker.check(data, 'Load ingestion list for menu')) {
          return _this.setState({
            ingestions: data
          });
        }
      };
    })(this));
  },
  render: function() {
    return React.createElement("div", {
      "className": "panel panel-default"
    }, React.createElement("div", {
      "className": "panel-heading",
      "title": this.state.date.toString()
    }, React.createElement("h3", null, React.createElement("p", {
      "className": "text-center"
    }, React.createElement("strong", null, "\u041c\u0435\u043d\u044e \u043d\u0430 ", this.state.date.toLocaleDateString())))), React.createElement("table", {
      "className": "table"
    }, React.createElement("thead", null, React.createElement("th", null, React.createElement("h4", null, React.createElement("p", {
      "className": "text-center"
    }, React.createElement("strong", null, "\u041f\u0440\u0438\u0435\u043c \u043f\u0438\u0449\u0438")))), React.createElement("th", null, React.createElement("h4", null, React.createElement("p", {
      "className": "text-center"
    }, React.createElement("strong", null, "\u041d\u0430\u0437\u0432\u0430\u043d\u0438\u0435 \u0431\u043b\u044e\u0434\u0430 \u0438 \u0441\u043e\u0441\u0442\u0430\u0432"))))), React.createElement(MenuList, {
      "ingestions": this.state.ingestions,
      "menuId": this.state.menu.id
    })), React.createElement("div", {
      "className": "panel-footer"
    }, "\u0418\u0442\u043e\u0433\u043e\u0432\u044b\u0439 \u0441\u043e\u0441\u0442\u0430\u0432:"));
  }
});

MenuList = React.createClass({
  propTypes: {
    ingestions: React.PropTypes.arrayOf(React.PropTypes.object),
    menuId: React.PropTypes.number
  },
  render: function() {
    var i, ingestions, _i, _ref;
    ingestions = [];
    for (i = _i = 0, _ref = this.props.ingestions.length; 0 <= _ref ? _i < _ref : _i > _ref; i = 0 <= _ref ? ++_i : --_i) {
      ingestions.push(React.createElement("tr", null, React.createElement("td", null, React.createElement("h4", null, React.createElement("p", {
        "className": "text-center"
      }, this.props.ingestions[i].name))), React.createElement("td", null, React.createElement(MenuDishList, {
        "menuId": this.props.menuId,
        "ingestionId": this.props.ingestions[i].id
      }), React.createElement(DishAddButton, null))));
    }
    return React.createElement("tbody", null, ingestions);
  }
});

MenuDishList = React.createClass({
  propTypes: {
    menuId: React.PropTypes.number,
    ingestionId: React.PropTypes.number
  },
  getInitialState: function() {
    return {
      dishes: []
    };
  },
  componentDidMount: function() {
    var loadedDishes;
    loadedDishes = [];
    return client['menu-dishes'].read({
      menu_id: this.props.menuId,
      ingestion_id: this.props.ingestionId
    }).done((function(_this) {
      return function(data) {
        var i, _i, _ref;
        if (!checker.check(data, 'Read dishes by menu id and ingestion id')) {
          return;
        }
        for (i = _i = 0, _ref = data.length; 0 <= _ref ? _i < _ref : _i > _ref; i = 0 <= _ref ? ++_i : --_i) {
          loadedDishes.push(React.createElement(Dish, {
            "dish": data[i]
          }));
        }
        return _this.setState({
          dishes: loadedDishes
        });
      };
    })(this));
  },
  render: function() {
    return React.createElement("div", {
      "className": "list-group"
    }, this.state.dishes);
  }
});

Dish = React.createClass({
  propTypes: {
    dish: React.PropTypes.object
  },
  render: function() {
    return React.createElement("a", {
      "href": "#",
      "className": "list-group-item"
    }, React.createElement("h4", {
      "className": "list-group-item-heading"
    }, this.props.dish.name), React.createElement("p", {
      "className": "list-group-item-text"
    }, React.createElement(ConsistList, {
      "dishId": this.props.dish.id
    })));
  }
});

ConsistList = React.createClass({
  getInitialState: function() {
    return {
      consistList: []
    };
  },
  componentDidMount: function() {
    var consists;
    consists = [];
    return client.consists.read({
      dish_id: this.props.dishId
    }).done((function(_this) {
      return function(data) {
        var i, _i, _ref;
        if (!checker.check(data, 'Read consists by dish id')) {
          return;
        }
        for (i = _i = 0, _ref = data.length; 0 <= _ref ? _i < _ref : _i > _ref; i = 0 <= _ref ? ++_i : --_i) {
          consists.push(React.createElement(Consist, {
            "consist": data[i]
          }));
        }
        return _this.setState({
          consistList: consists
        });
      };
    })(this));
  },
  render: function() {
    return React.createElement("span", null, "\u0421\u043e\u0441\u0442\u0430\u0432 \u0431\u043b\u044e\u0434\u0430: ", this.state.consistList);
  }
});

Consist = React.createClass({
  propTypes: React.PropTypes.object,
  render: function() {
    return React.createElement("span", {
      "className": "label label-info"
    }, this.props.consist.name, ": ", this.props.consist.size);
  }
});

DishAddButton = React.createClass({
  render: function() {
    return React.createElement("button", {
      "onClick": this.openDialog,
      "className": "btn btn-default"
    }, "\u0414\u043e\u0431\u0430\u0432\u0438\u0442\u044c \u0431\u043b\u044e\u0434\u043e");
  },
  openDialog: function() {
    return $('#dish-add-dialog').modal();
  }
});

DishAdd = React.createClass({
  getInitialState: function() {
    return {
      elemCount: 0
    };
  },
  render: function() {
    return React.createElement(DishAddList, {
      "onCountUpdate": this.handleCountUpdate
    });
  },
  handleCountUpdate: function(count) {
    return this.setState({
      elemCount: count
    });
  }
});

DishAddList = React.createClass({
  propTypes: {
    onCountUpdate: React.PropTypes.func
  },
  getInitialState: function() {
    return {
      dishAddList: []
    };
  },
  componentDidMount: function() {
    var dishList;
    dishList = [];
    return client.dishes.read().done((function(_this) {
      return function(data) {
        var i, _i, _ref;
        if (!checker.check(data, 'Read all dishes for add dialog')) {
          return;
        }
        for (i = _i = 0, _ref = data.length; 0 <= _ref ? _i < _ref : _i > _ref; i = 0 <= _ref ? ++_i : --_i) {
          dishList.push(React.createElement(Dish, {
            "dish": data[i]
          }));
        }
        _this.props.onCountUpdate(dishList.length);
        return _this.setState({
          dishAddList: dishList
        });
      };
    })(this));
  },
  render: function() {
    return React.createElement("div", {
      "className": "list-group"
    }, this.state.dishAddList);
  }
});

IngridientList = React.createClass({
  getInitialState: function() {
    return {
      ingridientList: []
    };
  },
  componentDidMount: function() {
    var ingridients;
    ingridients = [];
    return client.ingridients.read().done((function(_this) {
      return function(data) {
        var i, _i, _ref;
        if (!checker.check(data, 'Read all ingridients for selector in add dish dialog')) {
          return;
        }
        for (i = _i = 0, _ref = data.length; 0 <= _ref ? _i < _ref : _i > _ref; i = 0 <= _ref ? ++_i : --_i) {
          ingridients.push(React.createElement(Ingridient, {
            "name": data[i].name
          }));
        }
        return _this.setState({
          ingridientList: ingridients
        });
      };
    })(this));
  },
  render: function() {
    return React.createElement("ul", {
      "className": "dropdown-menu"
    }, this.state.ingridientList);
  }
});

Ingridient = React.createClass({
  propTypes: {
    name: React.PropTypes.string
  },
  render: function() {
    return React.createElement("li", null, React.createElement("a", {
      "href": "#"
    }, this.props.name));
  }
});

UnitList = React.createClass({
  currUnitId: 0,
  getInitialState: function() {
    return {
      units: [],
      currUnit: {
        id: 0,
        name: '????'
      }
    };
  },
  componentDidMount: function() {
    return client.units.read().done((function(_this) {
      return function(data) {
        if (!checker.check(data, 'Read all units in add dish dialog')) {
          return;
        }
        return _this.setState({
          units: data,
          currUnit: {
            id: data[_this.currUnitId].id,
            name: data[_this.currUnitId].name
          }
        });
      };
    })(this));
  },
  render: function() {
    return React.createElement("div", {
      "className": "input-group"
    }, React.createElement("input", {
      "id": "portion-new",
      "type": "text",
      "className": "form-control",
      "placeholder": "Количество"
    }), React.createElement("span", {
      "onClick": this.changeUnits,
      "unitId": this.state.currUnit.id,
      "title": "Кликните для смены единиц измерения",
      "className": "input-group-addon"
    }, this.state.currUnit.name));
  },
  changeUnits: function() {
    var maxId, unit;
    maxId = this.state.units.length - 1;
    if (++this.currUnitId > maxId) {
      this.currUnitId = 0;
    }
    unit = this.state.units[this.currUnitId];
    return this.setState({
      currUnit: {
        name: unit.name,
        id: unit.id
      }
    });
  }
});

React.render(React.createElement(Menu, null), $('#menu').get(0));

React.render(React.createElement(DishAdd, null), $('#menu-dish-add').get(0));

React.render(React.createElement(IngridientList, null), $('#menu-ingridient-list').get(0));

React.render(React.createElement(UnitList, null), $('.menu-unit-list').get(0));
