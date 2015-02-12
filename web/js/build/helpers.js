// Generated by CoffeeScript 1.8.0
var Checker, Dumper, Informer,
  __hasProp = {}.hasOwnProperty;

Object.prototype.toString = function() {
  var property, str, value;
  str = '{';
  for (property in this) {
    if (!__hasProp.call(this, property)) continue;
    value = this[property];
    str += "" + property + ": " + value + ",";
  }
  return str += '}';
};

Dumper = (function() {
  function Dumper(debug) {
    this.debug = debug != null ? debug : true;
  }

  Dumper.prototype.log = function(data, level) {
    var i, _i, _ref;
    if (level == null) {
      level = 0;
    }
    if (!this.debug) {
      return;
    }
    if (this.isArray(data)) {
      console.log(this._getShift(level) + '[');
      for (i = _i = 0, _ref = data.length; 0 <= _ref ? _i < _ref : _i > _ref; i = 0 <= _ref ? ++_i : --_i) {
        this.log(data[i], level + 1);
      }
      return console.log(this._getShift(level) + ']');
    } else {
      return console.log(this._getShift(level) + data);
    }
  };

  Dumper.prototype.isArray = function(data) {
    if (typeof data.join === 'function') {
      return true;
    }
    return false;
  };

  Dumper.prototype._getShift = function(level) {
    var defaultOffset, i, resultOffset, _i;
    defaultOffset = '  ';
    resultOffset = '';
    for (i = _i = 0; 0 <= level ? _i < level : _i > level; i = 0 <= level ? ++_i : --_i) {
      resultOffset += defaultOffset;
    }
    return resultOffset;
  };

  return Dumper;

})();

Informer = (function() {
  function Informer(msg, type, showed) {
    this.msg = msg;
    this.type = type != null ? type : 'error';
    this.showed = showed != null ? showed : true;
    if (this.showed === true) {
      this.show();
    }
  }

  Informer.prototype.show = function() {
    $.notify(this.msg, this.type);
    return console.log(this.type + ': ' + this.msg);
  };

  Informer.prototype.toString = function() {
    return this.msg;
  };

  Informer.prototype.toArray = function() {
    return [this.msg, this.type];
  };

  Informer.prototype.toObject = function() {
    return {
      msg: this.msg,
      type: this.type
    };
  };

  return Informer;

})();

Checker = (function() {
  function Checker(throwError, debug) {
    this.throwError = throwError != null ? throwError : true;
    this.debug = debug != null ? debug : false;
    this.errorStack = [];
    this.dumper = new Dumper();
  }

  Checker.prototype.check = function(data, message) {
    var _ref;
    if (message == null) {
      message = '';
    }
    if (this.debug) {
      if (message) {
        console.log(message);
      }
      this.dumper.log(data);
    }
    if (typeof data === 'object') {
      if ((_ref = data.status != null) === 403 || _ref === 404) {
        this.errorStack.push(new Informer('Error in request. Response return "' + data.name + '"', 'error', this.throwError));
        return false;
      }
    } else {
      this.errorStack.push(new Informer('Bad response was returned. No json data.', 'error', this.throwError));
      return false;
    }
    return true;
  };

  Checker.prototype.getLastError = function() {
    if (this.errorStack) {
      return this.errorStack[this.errorStack.lenght - 1];
    } else {
      return false;
    }
  };

  Checker.prototype.getAllErrors = function() {
    return this.errorStack;
  };

  return Checker;

})();

$.Informer = Informer;

$.Checker = Checker;

$.Dumper = Dumper;
