Array.prototype.formFSB = function () {

    let A, k, Y = 0;
    let O = Object(this);
    let len = O.length >>> 0;
    A = new Array(len);
    k = 1;
    let sredniaPoprzednich,
        sumaPoprzednich = 0,
        sumaWag = 0,
        waga = 1,
        biezacy;

    while (k < len) {
        if (k in O) {
            waga = k;
            biezacy = parseFloat(O[k].y);
            sumaPoprzednich += waga * biezacy;
            sumaWag += waga;
            sredniaPoprzednich = sumaPoprzednich / sumaWag;

            if (sredniaPoprzednich < 1) {
                Y = 0
            } else {
                Y = (-sredniaPoprzednich - biezacy) / sredniaPoprzednich;
            }

            Y += 2.2;//przesuniecie osi x w y=0

            A[k] = {x: O[k].x, y: Y};
        }
        k++;
    }
    return A;
};