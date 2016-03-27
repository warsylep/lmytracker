var rules = [
{ value: 'weight',  good: -1},
{ value: 'bodyfat', good: -1},
{ value: 'tbw',     good: 1 },
{ value: 'muscle',  good: 1 },
{ value: 'bone',    good: 1 }
];

for (i = 0; i < rules.length; i++) {
    var prev = null;
    $("." + rules[i].value).each(function(index) {
        var value = $(this).html();
        if (prev != null) {
            var difference = (value - prev);
            var delta = difference * rules[i].good;

            if (delta > 0) {
                $(this).addClass('success');
            } else if (delta < 0) {
                $(this).addClass('danger');
            } else {
                $(this).addClass('info');
            }

            var sign = ""
            if (difference > 0) {
                sign = "+";
            }
            $(this).html($(this).html() + " <sup>" + sign +
                difference.toFixed(1) + "</sup>");

        }

        prev = value;
    });
}

var prev = null;
$(".date").each(function(index) {
    var value = new Date($(this).data("date"));
    if (prev != null) {
        var timeDiff = Math.abs(value.getTime() - prev.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

        $(this).html($(this).html() + " <sup>+" + diffDays +
            " days</sup>");
    }

    prev = value;
});