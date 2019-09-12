export const convert = (function () {
    var conversions = {
        speed: {
            ms: 1, // use m/s as our base unit
            kmh: 3.6,
            mph: 2.23693629,
            knots: 1.94384449,
            minkm: 16.67
        },

        distance: {
            m: 1, // use meters as our base
            inches: 39.3700787402, // can't use "in" as that's a keyword. Darn.
            ft: 3.280839895,
            mi: 0.000621371192,
            nm: 0.000539956803 // nautical miles, not nanometers
        },

        mass: {
            g: 1, // use grams as our base
            lb: 0.002204622622,
            oz: 0.0352739619
        }
    };

    function Unit(type, unit, base) {
        this.value = base * conversions[type][unit];
        this.to = {};
        for (var otherUnit in conversions[type]) {
            (function (target) {
                this.to[target] = function () {
                    return new Unit(type, target, base);
                }
            }).call(this, otherUnit);
        }
    }

    Unit.prototype = {
        yield: function () {
            return this.valueOf();
        },

        toString: function () {
            return String(this.value);
        },

        valueOf: function () {
            return this.value;
        }
    };

    // my god, it's full of scopes!
    var types = {};
    for (var type in conversions) {
        (function (type) {
            types[type] = function (value) {
                var units = {};
                for (var unit in conversions[type]) {
                    (function (unit) {
                        units[unit] = function () {
                            return new Unit(type, unit, value / conversions[type][unit]);
                        }
                    }(unit));
                }
                return units;
            };
        }(type));
    }

    return types;
}());