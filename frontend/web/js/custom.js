!function(t) {
    "use strict";
    var e=function() {}
    ;
    e.prototype.init=function() {

            c3.generate( {
                    bindto:"#pie-chart", data: {
                        columns: [["iPhone", 46], ["MI", 24], ["Samsung", 30]], type: "pie"
                    }
                    , color: {
                        pattern: ["#525e6b", "#4a81d4", "#1abc9c"]
                    }
                    , pie: {
                        label: {
                            show: !1
                        }
                    }
                }
            )
    }
        ,
        t.ChartC3=new e,
        t.ChartC3.Constructor=e
}

(window.jQuery),
    function(t) {
        "use strict";
        window.jQuery.ChartC3.init()
    }();