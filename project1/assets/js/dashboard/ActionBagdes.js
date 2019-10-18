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

class ActionBagdes {
    constructor() {
        this.types = {
            // zoom: {id: 'toggle-zoom', txt: 'Toggle zoom'},
            // pan: {id: 'toggle-pan', txt: 'Toggle pan'},
//            edit_atp: {id: 'edit-atp', txt: 'Edit ATP'},
            reset_zoom: {id: 'reset-zoom', txt: 'Reset zoom'},
            // undoChanges: {id: 'undoChanges', txt: 'Undo applied changes'},
            // cancelChanges: {id: 'cancelChanges', txt: 'Cancel changes'},
            // applyChanges: {id: 'applyChanges', txt: 'Apply changes'},
        };
    };

    getTypes() {
        return this.types;
    }

    createBadges() {
        for (let key in this.getTypes()) {
            let label = this.getTypes()[key].txt;
            let id = this.getTypes()[key].id;
            $('ul#action-badges').append('<li><input type="checkbox" id="' + id + '"/><label>' + label + '</label></li>');
        }
    }
}

let actionBadges = new ActionBagdes();
actionBadges.createBadges();


import {ResetZoom} from '../model/BadgesClasses';

// global.zoom = new ZoomToggler('toggle-zoom', chartAtpInstance, 'zoom');
// zoom.iCheckSetStartState().iCheckToggleSet();
// const pan = new OptionChecker('toggle-pan', chartAtpInstance, 'pan');
// pan.iCheckSetStartState().iCheckToggleSet();
// const editAtp = new EditAtp('edit-atp', chartAtpInstance);
// editAtp.iCheckToggleSet().iCheckSetStartState();
const resetZoom = new ResetZoom('reset-zoom', chartAtpInstance);
resetZoom.iCheckToggleSet().iCheckSetStartState();
