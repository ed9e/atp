//http://icheck.fronteed.com/

$(document).ready(function () {
    $('.controls.badges #action-badges input').each(function () {
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


import {OptionChecker, EditAtp, ResetZoom} from './BadgesClasses';
const zoom = new OptionChecker('toggle-zoom', chartAtpInstance, 'zoom');
zoom.iCheckSetStartState().iCheckToggleSet();
const pan = new OptionChecker('toggle-pan', chartAtpInstance, 'pan');
pan.iCheckSetStartState().iCheckToggleSet();
const editAtp = new EditAtp('edit-atp', chartAtpInstance);
editAtp.iCheckToggleSet().iCheckSetStartState();
const resetZoom = new ResetZoom('reset-zoom', chartAtpInstance);
resetZoom.iCheckToggleSet().iCheckSetStartState();
