let BB = chartTune.getBoundingClientRect(),
    offsetX = BB.left,
    offsetY = BB.top;


let $menu = $('#contextMenu');
global.menuOpened = false;
chartTune.addEventListener('contextmenu', handleContextMenu, false);
//document.getElementById('contextMenu').addEventListener('mousedown', handleMouseDown, false);
let menuChartElement = null;

function handleContextMenu(e) {
    e.preventDefault();
    e.stopPropagation();
    if (global.menuOpened) {
        $menu.hide();
        global.menuOpened = false;
        return false;
    }
    let paddingX = 5;
    let paddingY = 180;

    let x = parseInt(e.clientX - offsetX + paddingX);
    let y = parseInt(e.clientY - offsetY + paddingY);
    $menu.css({left: x, top: y});
    $menu.show();
    global.menuOpened = true;

    chartAtpInstance.selectedElement = chartAtpInstance.getElementAtEvent(e)[0];
    return false;
}

function handleMouseDown(e) {
    console.log(e)
    $menu.hide();
    global.menuOpened = false;
}

