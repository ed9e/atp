require('@webcomponents/webcomponentsjs/webcomponents-bundle');
import '@polymer/paper-dropdown-menu/paper-dropdown-menu';
import '@polymer/paper-item/paper-item';
import '@polymer/paper-listbox/paper-listbox';
import '@polymer/iron-ajax';
import {html, PolymerElement} from '@polymer/polymer/polymer-element.js';


class PersonsElement extends PolymerElement {
    static get is() {
        return 'persons-element';
    }

    static get template() {
        return html`
        <iron-ajax
                auto
                 url="/layout/personsapi"
                 params="{}"
                 last-response="{{users}}"
                 on-response="handleResponse"
                 handle-as="json"
                 debounce-duration="300"
                 ></iron-ajax>
      <paper-dropdown-menu label="Person" on-iron-select="changed">
        <paper-listbox slot="dropdown-content" selected="0">
          <template is="dom-repeat" items="[[users]]">
            <paper-item id="[[item.username]]">[[item.name]]</paper-item>
          </template>
        </paper-listbox>
      </paper-dropdown-menu>
    `;
    }

    handleResponse(d) {
        //console.log(d)
    }

    changed(e) {
//TODO: activities-import
        apiUrlConfig.setProfileId(e.detail.item.id);
        let dataTable = $('#data-table');
        if (dataTable.length > 0) {
            dataTable.DataTable().ajax.url(apiUrlConfig.hrefDataTable()).load();
        }
        chartLoad();
        activitiesImport();
    }
}

function chartLoad() {
    $.ajax({
        url: apiUrlConfig.hrefWeekly(),
        context: document.body
    }).done(function (data) {
        chartDataAction.onDataLoad(data);
    });
}

function activitiesImport() {
    $.ajax({
        url: apiUrlConfig.hrefImport(),
        context: document.body
    }).done(function (data) {
        console.log(data);
        if (data.new) {
            chartLoad();
        }
    });
}

customElements.define(PersonsElement.is, PersonsElement);