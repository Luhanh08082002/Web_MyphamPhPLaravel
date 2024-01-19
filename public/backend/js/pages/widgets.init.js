function hexToRGB(o, e) {
    var i = parseInt(o.slice(1, 3), 16),
        t = parseInt(o.slice(3, 5), 16),
        l = parseInt(o.slice(5, 7), 16);
    return e ? "rgba(" + i + ", " + t + ", " + l + ", " + e + ")" : "rgb(" + i + ", " + t + ", " + l + ")"
}
$(document).ready(function () {
    function e() {
        var o, e = ["#00acc1", "#f1556c"];
        (o = $("#lifetime-sales").data("colors")) && (e = o.split(",")), $("#lifetime-sales").sparkline([0, 23, 43, 35, 44, 45, 56, 37, 40], {
            type: "line",
            width: "100%",
            height: "220",
            chartRangeMax: 50,
            lineColor: e[0],
            fillColor: hexToRGB(e[0], .3),
            highlightLineColor: "rgba(0,0,0,.1)",
            highlightSpotColor: "rgba(0,0,0,.2)",
            maxSpotColor: !1,
            minSpotColor: !1,
            spotColor: !1,
            lineWidth: 1
        }), $("#lifetime-sales").sparkline([25, 23, 26, 24, 25, 32, 30, 24, 19], {
            type: "line",
            width: "100%",
            height: "220",
            chartRangeMax: 40,
            lineColor: e[1],
            fillColor: hexToRGB(e[1], .3),
            composite: !0,
            highlightLineColor: "rgba(0,0,0,.1)",
            highlightSpotColor: "rgba(0,0,0,.2)",
            maxSpotColor: !1,
            minSpotColor: !1,
            spotColor: !1,
            lineWidth: 1
        }), e = ["#00acc1"], (o = $("#income-amounts").data("colors")) && (e = o.split(",")), $("#income-amounts").sparkline([3, 6, 7, 8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12], {
            type: "bar",
            height: "220",
            barWidth: "10",
            barSpacing: "3",
            barColor: e
        }), e = ["#00acc1", "#4b88e4", "#e3eaef", "#fd7e14"], (o = $("#total-users").data("colors")) && (e = o.split(",")), $("#total-users").sparkline([20, 40, 30, 10], {
            type: "pie",
            width: "220",
            height: "220",
            sliceColors: e
        })
    }
    var i;
    e(), $(window).resize(function (o) {
        clearTimeout(i), i = setTimeout(function () {
            e()
        }, 300)
    })
});
