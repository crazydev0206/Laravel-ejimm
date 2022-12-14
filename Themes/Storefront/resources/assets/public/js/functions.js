import Vue from 'vue';

export function notify(message, options = {}) {
    Vue.$toast.open({
        message,
        type: 'default',
        duration: 3000,
        position: (screen.width < 992) ? 'bottom' : 'bottom-right',
        ...options,
    });
}

export function trans(langKey, replace = {}) {
    let line = window.FleetCart.langs[langKey];

    for (let key in replace) {
        line = line.replace(`:${key}`, replace[key]);
    }

    return line;
}

export function isEmpty(value) {
    return $.isEmptyObject(value);
}

export function chunk(array, size) {
    let chunkedArray = [];
    let index = 0;

    while (index < array.length) {
        chunkedArray.push(array.slice(index, size + index));
        index += size;
    }

    return chunkedArray;
}

export function slickPrevArrow() {
    if (window.FleetCart.rtl) {
        return `<div class="arrow-prev">
                    <i class="las la-angle-right"></i> ${trans('storefront::layout.prev')}
                </div>`;
    }

    return `<div class="arrow-prev">
                <i class="las la-angle-left"></i> ${trans('storefront::layout.prev')}
            </div>`;
}

export function slickNextArrow() {
    if (window.FleetCart.rtl) {
        return `<div class="arrow-next">
                    ${trans('storefront::layout.next')} <i class="las la-angle-left"></i>
                </div>`;
    }

    return `<div class="arrow-next">
                ${trans('storefront::layout.next')} <i class="las la-angle-right"></i>
            </div>`;
}
