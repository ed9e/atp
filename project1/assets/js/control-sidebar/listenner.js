window.addEventListener('hashchange', function () {
    let dataTable = $('#data-table');
    dataTable.DataTable().ajax.url(apiUrlConfig.hrefDataTable()).load();
    $.ajax({
        url: apiUrlConfig.hrefWeekly(),
        context: document.body
    }).done(function (data) {
        chartDataAction.onDataLoad(data);
    });
});