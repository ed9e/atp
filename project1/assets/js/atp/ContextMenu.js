let BB = chartTune.getBoundingClientRect(),
    offsetX = BB.left,
    offsetY = BB.top;


let $menu = $('#contextMenu');
chartTune.addEventListener('contextmenu', handleContextMenu, false);
chartTune.addEventListener('mousedown', handleMouseDown, false);

function handleContextMenu(e) {
    let paddingX = 5;
    let paddingY = 180;
    e.preventDefault();
    e.stopPropagation();

    let x = parseInt(e.clientX - offsetX + paddingX);
    let y = parseInt(e.clientY - offsetY + paddingY);
    $menu.css({left: x, top: y});
    $menu.show();
    return (false);
}

function handleMouseDown(e) {
    $menu.hide();
}

function menu(n) {
    console.log("select menu " + n);
    $menu.hide();
}