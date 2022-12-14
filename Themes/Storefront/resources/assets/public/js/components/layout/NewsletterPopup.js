export default {
    data() {
        return {
            email: '',
            subscribed: false,
            subscribing: false,
            error: '',
            disable_popup: false,
        };
    },

    watch: {
        email() {
            this.error = '';
        },

        disable_popup(bool) {
            if (bool) {
                this.disableNewsletterPopup();
            } else {
                this.enableNewsletterPopup();
            }
        },
    },

    mounted() {
        setTimeout(() => {
            $('.newsletter-wrap').modal('show');
        }, 1000);
    },

    methods: {
        enableNewsletterPopup() {
            $.ajax({
                method: 'POST',
                url: route('storefront.newsletter_popup.store'),
            });
        },

        disableNewsletterPopup() {
            $.ajax({
                method: 'DELETE',
                url: route('storefront.newsletter_popup.destroy'),
            });
        },

        subscribe() {
            if (! this.email || this.subscribed) {
                return;
            }

            this.subscribing = true;

            $.ajax({
                method: 'POST',
                url: route('subscribers.store'),
                data: { email: this.email },
            }).then(() => {
                this.email = '';
                this.subscribed = true;
            }).catch((response) => {
                if (response.status === 422) {
                    this.error = response.responseJSON.errors.email[0];
                } else {
                    this.error = response.responseJSON.message;
                }
            }).always(() => {
                this.subscribing = false;
            });
        },
    },
};
