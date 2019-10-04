$(document).ready(function () {
    $('.controls.badges #activity-badges input').each(function () {
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
    // let checked = $('ul#activity-badges li input:checked');
    // checked.iCheck('uncheck')
    // setTimeout(function() {
    //     checked.iCheck('check');
    // }, 2500);
});

import ActivityTypes from '../model/ActivityTypes';

global.activityTypes = new ActivityTypes();
activityTypes.createBadges();

$('ul#activity-badges li input').on('ifToggled', function (event) {

    $('#edit-atp').iCheck('uncheck');

    $.ajax({
        url: apiUrlConfig.hrefWeekly(),
        context: document.body
    }).done(function (data) {
        chartDataAction.onDataLoad(data);
    });
});
