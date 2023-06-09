import IMask from "imask";
window.addEventListener('livewire:load', function (event) {
    initMask();
});
document.addEventListener("DOMContentLoaded", () => {
    Livewire.hook('message.processed', (el, component) => {
        initMask();
    })
});
(function () {
    initMask();
})();
function initMask() {

    var maskElementList = [].slice.call(document.querySelectorAll('[data-mask]'));

    maskElementList.map(function (maskEl) {
        return new IMask(maskEl, {
            mask: maskEl.dataset.mask,
            lazy: typeof (maskEl.dataset['maskVisible']) == 'undefined' || maskEl.dataset['maskVisible'] == 'false'
        })
    });

    document.querySelectorAll(".mascara-celular").forEach(function (maskedNode) {
        IMask(maskedNode, {
            mask: [
                {
                    mask: "(00) 0000-0000",
                },
                {
                    mask: "(00) [0] 0000-0000",
                }
            ],
        });
    });
}
