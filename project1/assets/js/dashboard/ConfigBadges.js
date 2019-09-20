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
        distance: {label: 'Sum by distance', checked: false},
        time: {label: 'Sum by time', checked: false}
    }
};

for (let key in configBadgesRadio) {
    for(let radioName in configBadgesRadio[key]) {
        let checked = configBadgesRadio[key][radioName].checked ? 'checked' : '';
        $('ul#config-badges').append('<li><input type="radio" ' + checked + ' name="'+ key+'" id="' + radioName + '-'+key+'"/><label>' + configBadgesRadio[key][radioName].label + '</label></li>');
    }
}
// $('ul#activity-badges li input').on('ifToggled', function (event) {
//     let urlActivityIds = '';
//     $('ul#activity-badges li input:checked').each(function () {
//         urlActivityIds += activityTypes[this.id].id + ',';
//     });
//     let dataTable = $('#data-table');
//     let url = new URL(dataTable.DataTable().ajax.url());
//     url.searchParams.set('activityId', urlActivityIds);
//
//     dataTable.DataTable().ajax.url(url.href).load();
//
//     let sUrlWeekly = 'http://127.0.0.1:8000/api/weekly';
//     let urlWeekly = new URL(sUrlWeekly);
//     urlWeekly.searchParams.set('activityId', urlActivityIds);
//     $.ajax({
//         url: urlWeekly,
//         context: document.body
//     }).done(function (data) {
//         let vals = createTimeArray(data.data.done);
//         chartAtpInstance.config.data.datasets.find('Done').data = vals;
//         chartAtpInstance.config.data.datasets.find('FTPDone').data = vals.ftpO();
//         chartAtpInstance.update();
//     });
//
// });