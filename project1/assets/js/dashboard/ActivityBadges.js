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

class ActivityTypes {
    constructor() {
        this.activityTypes = {
            running: {id: 1, txt: 'Running'},
            trail_running: {id: 6, txt: 'Trail running'},
            walking: {id: 3, txt: 'Hiking'},
            cycling: {id: 2, txt: 'Cycling'}
        };
    };

    getTypes() {
        return this.activityTypes;
    }

    getCheckedStatus(id) {
        return apiUrlConfig.urlParams.activityIds.default.indexOf(id) >= 0;
    };


    createBadges() {
        for (let key in this.activityTypes) {
            let checked = this.getCheckedStatus(this.getTypes()[key].id) ? 'checked' : '';
            let label = this.getTypes()[key].txt;
            $('ul#activity-badges').append('<li><input type="checkbox" ' + checked + ' id="' + key + '"/><label>' + label + '</label></li>');
        }
    }
}

global.activityTypes = new ActivityTypes();
activityTypes.createBadges();

$('ul#activity-badges li input').on('ifToggled', function (event) {

    $('#edit-atp').iCheck('uncheck');

    let dataTable = $('#data-table');
    dataTable.DataTable().ajax.url(apiUrlConfig.hrefDataTable()).load();
    zingGrid.dataLoad();

    $.ajax({
        url: apiUrlConfig.hrefWeekly(),
        context: document.body
    }).done(function (data) {
        chartDataAction.onDataLoad(data);
    });
});
