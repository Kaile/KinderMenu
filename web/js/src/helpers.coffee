# Public: redeclare method for cool output in console
#
# Returns the string view as {string}.
Object::toString = ->
    str = '{'
    for own property, value of @
        str += "#{property}: #{value},"

    str += '}'

# Public: dump arrays and objects to console
#
# @created 26.01.2015 21:35:32
# @author Mihail Kornilov <fix-06 at yandex.ru>
# @since 1.1
class Dumper
    # Public: constructor
    #
    # debug  - The state of debugging as {boolean}.
    constructor: (@debug = yes) ->
    # Public: main method that dump variable to the console
    #
    # data - The dumped variable as {array|object}.
    #
    # Returns the void as {undefined}.
    log: (data, level = 0) ->
        return unless @debug
        if @isArray(data)
            console.log @_getShift(level) + '['

            for i in [0...data.length]
                @log data[i], level + 1

            console.log @_getShift(level) + ']'
        else
            console.log @_getShift(level) + data

    # Public: check variable if that is array
    #
    # data - The checked variable as {array|object}.
    #
    # Returns the array it or no as {boolean}.
    isArray: (data) ->
        return yes if typeof data.join is 'function'
        no

    # Private: service method that generates the shift of logged data for arrays
    #
    # level - The level of logged data as {integer}.
    #
    # Returns the shift in double spaces for every level as {string}.
    _getShift: (level) ->
        defaultOffset = '  ';
        resultOffset  = '';

        for i in [0...level]
            resultOffset += defaultOffset

        resultOffset

    showFailMessage: (data) ->
        message = data.responseJSON or data.responseText
        if typeof message.join is 'function'
            message = message.join "\n"
        if @debug
            new $.Informer message, 'error'
        else
            new $.Informer 'При загрузке данных произошла ошибка'
            console.log message

# Public: show notify and write to console error when it occur
# @created 25.01.2015 22:33:22
# @author Mihail Kornilov <fix-06 at yandex.ru>
# @since 1.0
class Informer
    # Public: class constructor
    #
    # msg   - The message that has been loged as {string}.
    # type  - The type of message, 'error', 'warn' or 'info' as {string}.
    # show  - The show at once as {boolean}.
    #
    # Returns the void as `undefined`.
    constructor: (@msg, @type = 'error', @showed = on) ->
        @show() if @showed is on

    # Public: show notification and log to console
    #
    # Returns the void as {undefined}.
    show: ->
        $.notify @msg, @type
        console.log @type + ': ' + @msg

    # Public: convert error message to string
    #
    # Returns the message as {string}.
    toString: ->
        @msg

    # Public: convert message to array
    #
    # Returns the array of message and it type as {array}.
    toArray: ->
        [@msg, @type]

    # Public: convert message to object
    #
    # Returns the object with msg - message and type - it type as {object}.
    toObject: ->
        msg: @msg
        type: @type

# Public: class that check data in context of Restful data.
class Checker
    # Public: class constructor
    #
    # throwError  - The option that show error for users when it occur as {boolean}.
    # debug       - The option that turn on/off debug output to console as {boolean}.
    constructor: (@throwError = yes, @debug = no) ->
        @errorStack = []
        @dumper = new Dumper()

    # Public: check data for errors and valid data
    #
    # data     - The data from server as {array|object}.
    # message  - The additional message for output as {string}.
    #
    # Returns the result of data checing as {boolean}.
    check: (data, message = '') ->
        if @debug
            console.log message if message
            @dumper.log data

        if typeof data is 'object'
            if data.status? in [403, 404]
                @errorStack.push new Informer('Error in request. Response return "' + data.name + '"', 'error', @throwError)
                return no
        else
            @errorStack.push new Informer('Bad response was returned. No json data.', 'error', @throwError)
            return no
        yes

    # Public: returns last error message
    #
    # Returns the error object as {Informer}.
    getLastError: ->
        if @errorStack
            @errorStack[@errorStack.lenght - 1]
        else
            no

    # Public: returns all errors that Checker found
    #
    # Returns the array of errors as {array}.
    getAllErrors: ->
        @errorStack

$.Informer = Informer
$.Checker  = Checker
$.Dumper   = Dumper
