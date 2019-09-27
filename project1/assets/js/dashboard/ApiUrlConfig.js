export class ApiUrlConfig {
    constructor() {
        this.url = new URL('http://127.0.0.1:8000/api/');
        this.urlParams = {
            activityIds: {default: [1, 6]},
            profileId: {default: 'lbrzozowski'},
            weeklyType: {default: 'time'},
            weekDate: {default:'', store:null}
        };
    }

    hrefWeekly() {
        let url = new URL(this.url);
        url.pathname += 'weekly';
        let searchParams = this.getSearchParams();
        Object.keys(searchParams).forEach(function (x) {
            url.searchParams.append(x, searchParams[x])
        });

        return url.href;
    }

    storeWeekDate(date)
    {
        this.urlParams.weekDate.store = date;
        return this;
    }

    hrefDataTable() {

        let url = new URL(this.url);
        url.searchParams.append('data', this.urlParams.weekDate.store);
        let searchParams = this.getSearchParams();
        Object.keys(searchParams).forEach(function (x) {
            url.searchParams.append(x, searchParams[x])
        });
        return url.href;
    }

    getSearchParams() {
        let searchParams = {};
        searchParams.activityId = this.getActivityIds().join(',');
        searchParams.profileId = this.getProfileId();
        searchParams.weeklyType = this.getWeeklyType();
        return searchParams;
    }

    getActivityIds() {
        let activityIds = [];
        $('ul#activity-badges li input:checked').each(function () {
            activityIds.push(activityTypes.getTypes()[this.id].id);
        });
        return activityIds;
    }

    getProfileId() {
        return this.urlParams.profileId.default;
    }

    getWeeklyType() {
        let checked = $('ul#config-badges li input:checked');

        return checked.length > 0 ? checked.get(0).id : this.urlParams.weeklyType.default;
    }

    inSearchParams(name) {
        return this.url.searchParams.has(name);
    }

    getSearchParam(name) {
        return this.url.searchParams.get(name);
    }
}