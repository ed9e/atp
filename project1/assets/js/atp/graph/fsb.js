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

            A[k] = {x: muppetX, y: muppetY + 0.5};
        }
        k++;
    }

    return A;
};