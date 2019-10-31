require('@webcomponents/webcomponentsjs/webcomponents-bundle');
import '@polymer/paper-dropdown-menu/paper-dropdown-menu';
import '@polymer/paper-item/paper-item';
import '@polymer/paper-listbox/paper-listbox';
import '@polymer/iron-ajax';
import {html, PolymerElement} from '@polymer/polymer/polymer-element.js';


class PlansElement extends PolymerElement {
    static get is() {
        return 'plans-element';
    }

    static get template() {
        return html`
        <iron-ajax
                auto
                 url="/atplayout/plansapi"
                 params="{}"
                 last-response="{{plans}}"
                 on-response="handleResponse"
                 handle-as="json"
                 debounce-duration="300"
                 ></iron-ajax>
      <paper-dropdown-menu label="Plans" on-iron-select="changed">
        <paper-listbox slot="dropdown-content" selected="0">
          <template is="dom-repeat" items="[[plans]]">
            <paper-item id="[[item.id]]">[[item.name]]</paper-item>
          </template>
        </paper-listbox>
      </paper-dropdown-menu>
    `;
    }

    handleResponse(d) {
        //console.log(d)
    }

    changed(e) {

        apiUrlConfig.setAtpId(e.detail.item.id);

        $.ajax({
            url: apiUrlConfig.hrefWeekly(),
            context: document.body
        }).done(function (data) {
            chartDataAction.onDataLoad(data);
        });
    }
}

customElements.define(PlansElement.is, PlansElement);