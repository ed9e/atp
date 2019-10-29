export default class TimeTrial {
    constructor() {
        this.liTimeTrial = $('.time-trial').clone();
        setTimeout(() => {
            $('form > .row').css({'opacity': 1})
        }, 2500);
        this.eventListenerAddTimeTrial();
        this.eventListenerRemoveTimeTrial($('li .remove-trial'));
    }

    incId() {
        let ida = this.liTimeTrial[0].id.split('-');
        ida[ida.length - 1]++;
        this.liTimeTrial[0].id = ida.join('-');
        return this.liTimeTrial[0].id;
    }

    eventListenerAddTimeTrial() {
        document.querySelector('#add-trial').addEventListener('click', () => {
            let id = this.incId();
            let el = $('<li  class="time-trial" id="' + id + '">' + this.liTimeTrial.html() + '</li>');
            el.find('.remove-trial').attr('id', this.getIntId(id));
            $('#time-trials').append(el);
            this.eventListenerRemoveTimeTrial(el.find('.remove-trial'));
        });

    }

    getIntId(id) {
        let a = id.split('-');
        return a[a.length - 1];
    }

    eventListenerRemoveTimeTrial(x) {
        x.click(() => {
            this.removeTimeTrialClick(x)
        });

    }

    removeTimeTrialClick(x) {
        let id = 'li-time-trial-' + x[0].id;
        $('#' + id).hide()
    }
}