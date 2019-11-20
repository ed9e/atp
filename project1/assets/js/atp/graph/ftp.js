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

    let A, k, Y = 0;
    let O = Object(this);
    let len = O.length >>> 0;

    A = new Array(len);
    k = 1;

    let sredniaPoprzednich,
        sumaPoprzednich = 0,
        sumaWag = 0,
        biezacy;

    while (k < len) {
        if (k in O) {

            biezacy = parseFloat(O[k].y);
            sumaPoprzednich += k * biezacy;
            sumaWag += k;
            sredniaPoprzednich = sumaPoprzednich / sumaWag;

            Y = (-sredniaPoprzednich - biezacy) / sredniaPoprzednich;

            Y += 2.2;//przesuniecie osi x w y=0

            A[k] = {x: O[k].x, y: Y};
        }
        k++;
    }

    return A;
};