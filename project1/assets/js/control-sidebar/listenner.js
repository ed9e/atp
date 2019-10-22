window.addEventListener('hashchange', function () {

    $.ajax({
        url: apiUrlConfig.hrefWeekly(),
        context: document.body
    }).done(function (data) {
        chartDataAction.onDataLoad(data);
    });
});