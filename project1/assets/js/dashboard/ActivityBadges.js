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
    $.ajax({
        url: urlWeekly,
        context: document.body
    }).done(function(data) {
        console.log(data.data.done);
        //console.log(createTimeArray(data.data.done));
        console.log(chartAtpInstance);
        chartAtpInstance.config.data.datasets.find('Done').data = data.data.done;
        chartAtpInstance.update();
    });

});

