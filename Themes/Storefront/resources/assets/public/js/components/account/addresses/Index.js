import Errors from '../../../Errors';

export default {
    props: ['initialAddresses', 'initialDefaultAddress', 'countries'],

    data() {
        return {
            addresses: this.initialAddresses,
            defaultAddress: this.initialDefaultAddress,
            form: { state: '' },
            states: {},
            errors: new Errors(),
            formOpen: false,
            editing: false,
            loading: false,
        };
    },

    computed: {
        firstCountry() {
            return Object.keys(this.countries)[0];
        },

        hasAddress() {
            return Object.keys(this.addresses).length !== 0;
        },

        hasNoStates() {
            return Object.keys(this.states).length === 0;
        },
    },

    created() {
        this.changeCountry(this.firstCountry);
    },

    methods: {
        changeDefaultAddress(address) {
            this.$set(this.defaultAddress, 'address_id', address.id);

            $.ajax({
                method: 'POST',
                url: route('account.change_default_address'),
                data: { address_id: address.id },
            }).then((message) => {
                this.$notify(message);
            }).catch((xhr) => {
                this.$notify(xhr.responseJSON.message);
            });
        },

        changeCountry(country) {
            this.form.country = country;
            this.form.state = '';

            this.fetchStates(country);
        },

        fetchStates(country) {
            $.ajax({
                method: 'GET',
                url: route('countries.states.index', { code: country }),
            }).then((states) => {
                this.$set(this, 'states', states);
            });
        },

        edit(address) {
            this.formOpen = true;
            this.editing = true;
            this.form = address;

            this.fetchStates(address.country);
        },

        remove(address) {
            if (! confirm(this.$trans('storefront::account.addresses.confirm'))) {
                return;
            }

            $.ajax({
                method: 'DELETE',
                url: route('account.addresses.destroy', address.id),
            }).then((response) => {
                this.$delete(this.addresses, address.id);
                this.$notify(response.message);
            }).catch((xhr) => {
                this.$notify(xhr.responseJSON.message);
            });
        },

        cancel() {
            this.editing = false;
            this.formOpen = false;

            this.errors.reset();
            this.resetForm();
        },

        save() {
            this.loading = true;

            if (this.editing) {
                this.update();
            } else {
                this.create();
            }
        },

        update() {
            $.ajax({
                method: 'PUT',
                url: route('account.addresses.update', { id: this.form.id }),
                data: this.form,
            }).then((response) => {
                this.formOpen = false;
                this.editing = false;

                this.addresses[this.form.id] = response.address;

                this.resetForm();
                this.$notify(response.message);
            }).catch((xhr) => {
                if (xhr.status === 422) {
                    this.errors.record(xhr.responseJSON.errors);
                }

                this.$notify(xhr.responseJSON.message);
            }).always(() => {
                this.loading = false;
            });
        },

        create() {
            $.ajax({
                method: 'POST',
                url: route('account.addresses.store'),
                data: this.form,
            }).then((response) => {
                this.formOpen = false;

                let address = { [response.address.id]: response.address };

                this.$set(this, 'addresses', { ...this.addresses, ...address });

                this.resetForm();
                this.$notify(response.message);
            }).catch((xhr) => {
                if (xhr.status === 422) {
                    this.errors.record(xhr.responseJSON.errors);
                }

                this.$notify(xhr.responseJSON.message);
            }).always(() => {
                this.loading = false;
            });
        },

        resetForm() {
            this.form = { state: '' };
        },
    },
};
