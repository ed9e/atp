window.addEventListener('keydown', (e) => {
    global.chartAtpInstance.config.options.zoom.speed = e.ctrlKey === true ? 0.2 : 0;
    global.chartAtpInstance.config.options.pan.enabled = e.ctrlKey === true;
    global.chartAtpInstance.update(0);
});
window.addEventListener('keyup', (e) => {
    global.chartAtpInstance.config.options.zoom.speed = e.ctrlKey === true ? 0.2 : 0;
    global.chartAtpInstance.config.options.pan.enabled = e.ctrlKey === true;
    global.chartAtpInstance.update(0);
});