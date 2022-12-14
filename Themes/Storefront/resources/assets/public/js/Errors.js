import Vue from 'vue';

export default class {
    constructor() {
        this.errors = {};
    }

    record(errors) {
        this.errors = errors;
    }

    any() {
        return Object.keys(this.errors).length > 0;
    }

    has(key) {
        return this.errors.hasOwnProperty(key);
    }

    get(key) {
        if (this.errors[key]) {
            return this.errors[key][0];
        }
    }

    clear(key) {
        if (key === undefined) {
            return;
        }

        Vue.delete(this.errors, this.normalizeKey(key));
    }

    reset() {
        this.errors = {};
    }

    normalizeKey(key) {
        let keyParts = key.replace('[]', '').split('[');

        // No need to normalize the key.
        if (keyParts.length === 1) {
            return key;
        }

        return keyParts.join('.').slice(0, -1);
    }
}
