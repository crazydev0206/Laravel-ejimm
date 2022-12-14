export default {
    data() {
        return {
            show: false,
        };
    },

    mounted() {
        setTimeout(() => {
            this.show = true;
        });
    },

    methods: {
        accept() {
            this.show = false;

            $.ajax({
                method: 'DELETE',
                url: route('storefront.cookie_bar.destroy'),
            });
        },
    },
};
