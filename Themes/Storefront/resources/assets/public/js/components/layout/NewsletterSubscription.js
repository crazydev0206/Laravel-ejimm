export default {
    data() {
        return {
            email: '',
            subscribed: false,
            subscribing: false,
        };
    },

    methods: {
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
                    this.$notify(response.responseJSON.errors.email[0]);
                } else {
                    this.$notify(response.responseJSON.message);
                }
            }).always(() => {
                this.subscribing = false;
            });
        },
    },
};
