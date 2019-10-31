
//zoom & pan on ctrl down
window.addEventListener('keydown', (e) => {
    global.chartAtpInstance.config.options.zoom.speed = e.ctrlKey === true ? 0.2 : 0;
    global.chartAtpInstance.config.options.pan.enabled = e.ctrlKey === true;
    global.chartAtpInstance.update(0);
});
//zoom & pan on ctrl up
window.addEventListener('keyup', (e) => {
    global.chartAtpInstance.config.options.zoom.speed = e.ctrlKey === true ? 0.2 : 0;
    global.chartAtpInstance.config.options.pan.enabled = e.ctrlKey === true;
    global.chartAtpInstance.update(0);
});

let flagSubmits = document.querySelectorAll('.flag-submit');

for (let i = 0; i < flagSubmits.length; i++) {
    let flag = flagSubmits[i];
    flag.addEventListener('click', (e) => {
        let sliced = e.target.id.slice('-');
        let id = sliced[sliced.length - 1];
        let inputs = $('#li-time-trial-' + id).find('input');
        flags[inputs[1].value] = inputs[0].value;
        global.chartAtpInstance.update(0);
    });

}