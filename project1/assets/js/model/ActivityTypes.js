export default class ActivityTypes {
    constructor() {
        this.activityTypes = {
            running: {id: 1, txt: 'Running'},
            trail_running: {id: 6, txt: 'Trail running'},
            walking: {id: 3, txt: 'Hiking'},
            cycling: {id: 2, txt: 'Cycling'}
        };
    };

    getTypes() {
        return this.activityTypes;
    }

    getCheckedStatus(id) {
        return apiUrlConfig.urlParams.activityIds.default.indexOf(id) >= 0;
    };


    createBadges() {
        for (let key in this.activityTypes) {
            let checked = this.getCheckedStatus(this.getTypes()[key].id) ? 'checked' : '';
            let label = this.getTypes()[key].txt;
            $('ul#activity-badges').append('<li><input type="checkbox" ' + checked + ' id="' + key + '"/><label>' + label + '</label></li>');
        }
    }
}