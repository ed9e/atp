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

    //chart.config.data.datasets.find('Done').data =
});

