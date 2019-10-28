require('@webcomponents/webcomponentsjs/webcomponents-bundle');
import 'paper-collapse-item/paper-collapse-item';
import '@polymer/iron-flex-layout/iron-flex-layout-classes';
import '@polymer/iron-icons/';
import '@polymer/iron-ajax';
import {html, PolymerElement} from '@polymer/polymer/polymer-element.js';
import '@fooloomanzoo/datetime-picker/overlay-date-picker';
import '@vaadin/vaadin-date-picker';
//import '@material-ui/pickers/DatePicker/index'
import 'air-datepicker/dist/js/datepicker.min'
import 'air-datepicker/dist/css/datepicker.min.css'
import 'air-datepicker/dist/js/i18n/datepicker.pl'
import 'air-datepicker/dist/js/i18n/datepicker.en'

class PlanFormCollapse extends PolymerElement {
    static get is() {
        return 'plan-form-collapse';
    }

    static get template() {
        return html`
        <style is="custom-style" include="iron-flex iron-flex-alignment"></style>
        <paper-collapse-item icon="icons:assignment" opened>
            <div slot="header">
            Planning
            </div>
            
            <div class="horizontal layout">
                <div class="">
                    <paper-input always-float-label label="Plan Label"></paper-input>
                </div>
                <div>
                    <date-picker id="date-picker"></date-picker>
                </div>
            </div>
            
        </paper-collapse-item>
        
    `;
    }
}

class DatePicker extends PolymerElement {
    static get is() {
        return 'my-date-picker';
    }

    static get template() {
        return html`
       <vaadin-date-picker label="My label" theme="my-theme"></vaadin-date-picker>
        `;
    }
}
customElements.define(DatePicker.is, DatePicker);
customElements.define(PlanFormCollapse.is, PlanFormCollapse);
// customElements.whenDefined('vaadin-date-picker').then(function() {
//     console.log('a')
//     let datepicker = document.querySelector('vaadin-date-picker');
//     datepicker.set('i18n.firstDayOfWeek', 2);
// });
$('.datepicker-here').data('datepicker');