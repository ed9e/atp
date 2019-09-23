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
    setTimeout(function() {
        $('#running').iCheck('check');
    }, 2000);
});

global.activityTypes = {
    running: {id: 1, txt: 'Running', checked: false},
    trail_running: {id: 6, txt: 'Trail running', checked: false},
    walking: {id: 3, txt: 'Hiking', checked: false},
    cycling: {id: 2, txt: 'Cycling', checked: false},
};

for (let key in activityTypes) {
    let checked = activityTypes[key].checked ? 'checked' : '';
    $('ul#activity-badges').append('<li><input type="checkbox" ' + checked + ' id="' + key + '"/><label>' + activityTypes[key].txt + '</label></li>');
}
$('ul#activity-badges li input').on('ifToggled', function (event) {
    let urlActivityIds = '';
    $('ul#activity-badges li input:checked').each(function(){
        urlActivityIds += activityTypes[this.id].id+',';
    });
    let dataTable = $('#data-table');
    let url = new URL(dataTable.DataTable().ajax.url());
    url.searchParams.set('activityId', urlActivityIds);

    dataTable.DataTable().ajax.url(url.href).load();

    let sUrlWeekly = 'http://127.0.0.1:8000/api/weekly';
    let urlWeekly = new URL(sUrlWeekly);
    urlWeekly.searchParams.set('activityId', urlActivityIds);
    $('#edit-atp').iCheck('uncheck');
    $.ajax({
        url: urlWeekly,
        context: document.body
    }).done(function(data) {
        chartDataAction.onDataLoad(data);

    });

});
