let waga = 1.4;
Array.prototype.ftp = function () {

    let A, k, l, divider, muppet;
    let O = Object(this);
    let len = O.length >>> 0;
    A = new Array(len);
    k = 0;

    while (k < len) {
        if (k in O) {

            muppet = O[k] / 1.5;
            l = 1;
            while (l <= k) {
                divider = (waga * l);
                if (k === 0) {
                    divider = waga;
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

            muppetY = O[k].y / 1.2;
            muppetX = O[k].x;
            l = 1;
            let m =1;
            while (l <= k) {
                divider = (waga * l + m);
                if (k === 0) {
                    divider = waga;
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

Array.prototype.ftpOReset = function () {
    let O = Object(this);
    let len = O.length >>> 0,
        A, k;
    A = new Array(len);
    k = 0;
    while (k < len) {
        if (k in O) {
            A[k] = {x: O[k].x, y: 0};
        }
        k++;
    }

    return A;
};

Array.prototype.kopia = function () {
    let O = Object(this);
    let len = O.length >>> 0,
        A, k;
    A = new Array(len);
    k = 0;
    while (k < len) {
        if (k in O) {
            A[k] = {x: O[k].x, y: O[k].y};
        }
        k++;
    }

    return A;
};

Array.prototype.formFSB = function () {

    let A, k, muppetX, muppetY = 0;
    let O = Object(this);
    let len = O.length >>> 0;

    A = new Array(len);
    k = 1;

    let sredniaPoprzednich,
        sumaPoprzednich = 0,
        biezacy, poprzedniY;

    while (k < len) {
        if (k in O) {
            if (O[k].y == 0) {
                O[k].y = 0;
            }
            if (O[k - 1].y == 0) {
                O[k - 1].y = 0;
            }


            biezacy = O[k].y;
            //muppetY = O[k].y;
            muppetX = O[k].x;
            sumaPoprzednich += parseInt(O[k - 1].y);

            sredniaPoprzednich = sumaPoprzednich / (k + 1);
            poprzedniY = muppetY;
            muppetY = (sredniaPoprzednich - biezacy) / sredniaPoprzednich;

            A[k] = {x: muppetX, y: muppetY + 1};
        }
        k++;
    }

    return A;
};