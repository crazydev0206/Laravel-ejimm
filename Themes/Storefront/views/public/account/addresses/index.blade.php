@extends('public.account.layout')

@section('title', trans('storefront::account.pages.my_addresses'))

@push('globals')
    <script>
        FleetCart.langs['storefront::account.addresses.confirm'] = '{{ trans("storefront::account.addresses.confirm") }}';
    </script>
@endpush

@section('panel')
    <my-addresses
        :initial-addresses="{{ $addresses }}"
        :initial-default-address="{{ $defaultAddress }}"
        :countries="{{ json_encode($countries) }}"
        inline-template
    >
        <div class="account-right">
            <div class="panel-wrap">
                <div class="panel">
                    <div class="panel-header">
                        <h4>{{ trans('storefront::account.pages.my_addresses') }}</h4>
                    </div>

                    <div class="panel-body" v-cloak>
                        <div class="my-addresses">
                            <div class="address-card-wrap" v-if="hasAddress && ! formOpen">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-9 d-flex" v-for="address in addresses" :key="address.id">
                                        <address
                                            class="address-card"
                                            :class="{ active: defaultAddress.address_id === address.id }"
                                            @click="changeDefaultAddress(address)"
                                        >
                                            <div class="address-card-data">
                                                <span v-text="address.full_name"></span>
                                                <span v-text="address.address_1"></span>
                                                <span v-if="address.address_2" v-text="address.address_2"></span>
                                                <span>@{{ address.city }}, @{{ address.state_name }} @{{ address.zip }}</span>
                                                <span v-text="address.country_name"></span>
                                            </div>

                                            <div class="address-card-actions">
                                                <button
                                                    type="button"
                                                    class="btn btn-edit-address"
                                                    @click.stop="edit(address)"
                                                >
                                                {{ trans('storefront::account.addresses.edit') }}
                                                </button>

                                                <button
                                                    type="button"
                                                    class="btn btn-delete-address"
                                                    @click.stop="remove(address)"
                                                >
                                                    {{ trans('storefront::account.addresses.delete') }}
                                                </button>
                                            </div>

                                        </address>
                                    </div>

                                    <div class="col-md-18">
                                        <button
                                            type="button"
                                            class="btn btn-lg btn-default btn-add-new-address"
                                            @click="formOpen = true"
                                        >
                                            {{ trans('storefront::account.addresses.add_new_address') }}
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <form @submit.prevent="save" @input="errors.clear($event.target.name)" v-else>
                                <div class="add-new-address-form">
                                    <h4 class="section-title">
                                        {{ trans('storefront::account.addresses.new_address') }}
                                    </h4>

                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="first-name">
                                                    {{ trans('storefront::account.addresses.first_name') }}<span>*</span>
                                                </label>

                                                <input
                                                    v-model="form.first_name"
                                                    name="first_name"
                                                    type="text"
                                                    id="first-name"
                                                    class="form-control"
                                                >

                                                <span
                                                    class="error-message"
                                                    v-if="errors.has('first_name')"
                                                    v-text="errors.get('first_name')"
                                                >
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="last-name">
                                                    {{ trans('storefront::account.addresses.last_name') }}<span>*</span>
                                                </label>

                                                <input
                                                    v-model="form.last_name"
                                                    name="last_name"
                                                    type="text"
                                                    id="last-name"
                                                    class="form-control"
                                                >

                                                <span
                                                    class="error-message"
                                                    v-if="errors.has('last_name')"
                                                    v-text="errors.get('last_name')"
                                                >
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-18">
                                            <div class="form-group">
                                                <label for="address-1">
                                                    {{ trans('storefront::account.addresses.street_address') }}<span>*</span>
                                                </label>

                                                <input
                                                    v-model="form.address_1"
                                                    name="address_1"
                                                    type="text"
                                                    id="address-1"
                                                    placeholder="{{ trans('storefront::account.addresses.address_line_1') }}"
                                                    class="form-control"
                                                >

                                                <span
                                                    class="error-message"
                                                    v-if="errors.has('address_1')"
                                                    v-text="errors.get('address_1')"
                                                >
                                                </span>
                                            </div>

                                            <div class="form-group">
                                                <input
                                                    v-model="form.address_2"
                                                    name="address_2"
                                                    type="text"
                                                    id="address-2"
                                                    placeholder="{{ trans('storefront::account.addresses.address_line_2') }}"
                                                    class="form-control"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="city">
                                                    {{ trans('storefront::account.addresses.city') }}<span>*</span>
                                                </label>

                                                <input
                                                    v-model="form.city"
                                                    name="city"
                                                    type="text"
                                                    id="city"
                                                    class="form-control"
                                                >

                                                <span
                                                    class="error-message"
                                                    v-if="errors.has('city')"
                                                    v-text="errors.get('city')"
                                                >
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="zip">
                                                    {{ trans('storefront::account.addresses.zip') }}<span>*</span>
                                                </label>

                                                <input
                                                    v-model="form.zip"
                                                    name="zip"
                                                    type="text"
                                                    id="zip"
                                                    class="form-control"
                                                >

                                                <span
                                                    class="error-message"
                                                    v-if="errors.has('zip')"
                                                    v-text="errors.get('zip')"
                                                >
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="country">
                                                    {{ trans('storefront::account.addresses.country') }}<span>*</span>
                                                </label>

                                                <select
                                                    :value="form.country"
                                                    name="country"
                                                    id="country"
                                                    class="form-control arrow-black"
                                                    @change="changeCountry($event.target.value)"
                                                >
                                                    <option
                                                        v-for="(name, code) in countries"
                                                        :value="code"
                                                        v-text="name"
                                                    >
                                                    </option>
                                                </select>

                                                <span
                                                    class="error-message"
                                                    v-if="errors.has('country')"
                                                    v-text="errors.get('country')"
                                                >
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="state">
                                                    {{ trans('storefront::account.addresses.state') }}<span>*</span>
                                                </label>

                                                <input
                                                    v-model="form.state"
                                                    name="state"
                                                    type="text"
                                                    id="state"
                                                    class="form-control"
                                                    v-if="hasNoStates"
                                                >

                                                <select
                                                    v-model="form.state"
                                                    name="state"
                                                    id="state"
                                                    class="form-control arrow-black"
                                                    v-else
                                                >
                                                    <option value="">
                                                        {{ trans('storefront::account.addresses.please_select') }}
                                                    </option>

                                                    <option
                                                        v-for="(name, code) in states"
                                                        :value="code"
                                                        v-text="name"
                                                    >
                                                    </option>
                                                </select>

                                                <span
                                                    class="error-message"
                                                    v-if="errors.has('state')"
                                                    v-text="errors.get('state')"
                                                >
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-18">
                                            <button
                                                type="button"
                                                class="btn btn-lg btn-default btn-cancel"
                                                v-if="hasAddress"
                                                @click="cancel"
                                            >
                                                {{ trans('storefront::account.addresses.cancel') }}
                                            </button>

                                            <button
                                                type="submit"
                                                class="btn btn-lg btn-primary btn-save-address"
                                                :class="{ 'btn-loading': loading }"
                                            >
                                                {{ trans('storefront::account.addresses.save_address') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </my-addresses>
@endsection
