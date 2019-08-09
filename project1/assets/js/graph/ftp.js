Array.prototype.ftp = function () {

    let A, k, l, divider, muppet;
    let O = Object(this);
    let len = O.length >>> 0;
    A = new Array(len);
    k = 0;

    while (k < len) {
        if (k in O) {
            muppet = O[k];
            l = 1;
            while (l <= k) {
                divider = (1.9 * l);
                if (k === 0) {
                    divider = 1.9;
                }
                muppet += O[k - l] / divider;
                l++;
            }
            A[k] = Math.floor(muppet);
        }
        k++;
    }

    return A;
};

Array.prototype.ftpO = function () {

    let A, k, l, divider, muppetX, muppetY;
    let O = Object(this);
    let len = O.length >>> 0;

    A = new Array(len);
    k = 0;

    while (k < len) {
        if (k in O) {

            muppetY = O[k].y;
            muppetX = O[k].x;
            l = 1;
            while (l <= k) {
                divider = (1.9 * l);
                if (k === 0) {
                    divider = 1.9;
                }
                muppetY += O[k - l].y / divider;
                l++;
            }
            A[k] = {x: muppetX, y: Math.floor(muppetY)};

        }
        k++;
    }

    return A;
};