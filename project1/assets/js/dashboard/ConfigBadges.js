//http://icheck.fronteed.com/

$(document).ready(function () {
    $('.controls.badges #config-badges input').each(function () {
        let self = $(this),
            label = self.next(),
            label_text = label.text();

        label.remove();
        self.iCheck({
            checkboxClass: 'icheckbox_line',
            radioClass: 'iradio_line',
            insert: '<div class="icheck_line-icon"></div>' + label_text
        });
    });
});

let configBadgesRadio = {
    sum: {
        distance: {label: 'Sum by distance', checked: true},
        time: {label: 'Sum by time', checked: false}
    }
};

for (let key in configBadgesRadio) {
    for (let radioName in configBadgesRadio[key]) {
        let checked = configBadgesRadio[key][radioName].checked ? 'checked' : '';
        $('ul#config-badges').append('<li><input type="radio" ' + checked + ' name="' + key + '" id="' + radioName + '"/><label>' + configBadgesRadio[key][radioName].label + '</label></li>');
    }
}

$('ul#config-badges li input').on('ifChecked', function (event) {
    $('#' + event.target.id).attr('checked', 'checked');
    $('#edit-atp').iCheck('uncheck');

    $.ajax({
        url: apiUrlConfig.hrefWeekly(),
        context: document.body
    }).done(function (data) {
        chartDataAction.onDataLoad(data);
    });
});