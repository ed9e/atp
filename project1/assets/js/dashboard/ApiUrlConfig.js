export class ApiUrlConfig {
    constructor(weeklyPath) {
        this.weeklyPath = weeklyPath;
        this.importPath = 'activities-import';
        this.atpSavePath = 'atp_save';
        let locUrl = new URL(location.href);
        let port = locUrl.port ? ':' + locUrl.port : '';
        let path = locUrl.protocol + '//' + locUrl.host ;
        this.url = new URL(path + '/api/');
        this.urlParams = {
            activityIds: {default: [1, 6]},
            profileId: {default: 'lbrzozowski', value: null},
            weeklyType: {default: 'time'},
            weekDate: {default: '', store: null},
            atp: {default: '', value: null},
        };
    }

    hrefWeekly() {
        let url = new URL(this.url);
        url.pathname += this.weeklyPath;
        let searchParams = this.getSearchParams();
        Object.keys(searchParams).forEach(function (x) {
            url.searchParams.append(x, searchParams[x])
        });

        return url.href;
    }

    hrefImport() {
        let url = new URL(this.url);
        url.pathname += this.importPath;
        url.searchParams.append('profileId', this.getProfileId());
        return url.href;
    }

    hrefAtpSave($atp) {
        let url = new URL(this.url);
        url.pathname += this.atpSavePath;
        //url.searchParams.append('atp', $atp);
        return url.href;
    }

    storeWeekDate(date) {
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
        searchParams.atp = this.getAtpId();
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
        return this.urlParams.profileId.value ? this.urlParams.profileId.value : this.urlParams.profileId.default;
    }

    getAtpId() {
        return this.urlParams.atp.value ? this.urlParams.atp.value : this.urlParams.atp.default;
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

    setProfileId(name) {
        this.urlParams.profileId.value = name;
    }

    setAtpId(name) {
        this.urlParams.atp.value = name;
    }
}