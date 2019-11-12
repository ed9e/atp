const imagesContext = require.context('../images', true, /\.(png|jpg|jpeg|gif|ico|svg|webp)$/);
imagesContext.keys().forEach(imagesContext);
require('./control-sidebar/listenner');

if (document.getElementById('curtainId'))
document.getElementById('curtainId').addEventListener('click', () => {
    document.getElementById('curtain__checkbox').checked = true;
});
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        document.getElementById('curtain__checkbox').checked = !document.getElementById('curtain__checkbox').checked;
    }
});