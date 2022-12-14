export default {
    name: 'DynamicTab',

    props: ['label', 'initialLogo', 'url'],

    data() {
        return {
            isActive: false,
        };
    },

    computed: {
        hasLogo() {
            return ! Array.isArray(this.initialLogo);
        },

        logo() {
            if (this.hasLogo) {
                return this.initialLogo.path;
            }

            return `${window.FleetCart.baseUrl}/themes/storefront/public/images/image-placeholder.png`;
        },
    },

    template: '<div></div>',
};
