//http://icheck.fronteed.com/
$(document).ready(function () {
    $('.polaris input').not('#curtain__checkbox').iCheck({
        checkboxClass: 'icheckbox_polaris',
        radioClass: 'iradio_polaris',
        increaseArea: '-10%' // optional
    });
});
$(document).ready(function () {
    $('.flat_skin input').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
});
$(document).ready(function () {
    $('.line input').each(function () {
        var self = $(this),
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
$(document).ready(function () {
    $('.square input').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
        increaseArea: '20%' // optional
    });
});


$(".ion input").ionCheckRadio();


$('input').on('ifToggled', function (event) {
    console.log(this.name + ' ' + this.checked + ' ' + this.value);

});
$('input#name1').on('ifToggled', function (event) {
    $('input#curtain__checkbox').prop('checked', this.checked);
    console.log($('input#curtain__checkbox'))
});
$('#name1').iCheck('check');