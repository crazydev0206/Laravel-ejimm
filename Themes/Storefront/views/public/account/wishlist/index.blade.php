@extends('public.account.layout')

@section('title', trans('storefront::account.pages.my_wishlist'))

@section('account_breadcrumb')
    <li class="active">{{ trans('storefront::account.pages.my_wishlist') }}</li>
@endsection

@section('panel')
    <my-wishlist inline-template>
        <div class="panel">
            <div class="panel-header">
                <h4>{{ trans('storefront::account.pages.my_wishlist') }}</h4>
            </div>

            <div class="panel-body" :class="{ loading: fetchingWishlist }" v-cloak>
                <div class="empty-message" v-if="wishlistIsEmpty">
                    <h3 v-if="! fetchingWishlist">
                        {{ trans('storefront::account.wishlist.empty_wishlist') }}
                    </h3>
                </div>

                <div class="table-responsive" v-else>
                    <table class="table table-borderless my-wishlist-table">
                        <thead>
                            <tr>
                                <th>{{ trans('storefront::account.image') }}</th>
                                <th>{{ trans('storefront::account.product_name') }}</th>
                                <th>{{ trans('storefront::account.wishlist.price') }}</th>
                                <th>{{ trans('storefront::account.wishlist.availability') }}</th>
                                <th>{{ trans('storefront::account.action') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="product in products.data" :key="product.id">
                                <td>
                                    <div class="product-image">
                                        <img :src="baseImage(product)" :class="{ 'image-placeholder': ! hasBaseImage(product) }" alt="product-image">
                                    </div>
                                </td>

                                <td>
                                    <a :href="productUrl(product)" class="product-name">
                                        @{{ product.name }}
                                    </a>
                                </td>

                                <td>
                                    <span class="product-price" v-html="product.formatted_price"></span>
                                </td>

                                <td>
                                    <span class="badge badge-success" v-if="product.is_in_stock">
                                        {{ trans('storefront::account.wishlist.in_stock') }}
                                    </span>

                                    <span class="badge badge-danger" v-else>
                                        {{ trans('storefront::account.wishlist.out_of_stock') }}
                                    </span>
                                </td>

                                <td>
                                    <button class="btn btn-delete" @click="remove(product)">
                                        <i class="las la-trash"></i>
                                        {{ trans('storefront::account.wishlist.delete') }}
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel-footer">
                <v-pagination
                    :total-page="totalPage"
                    :current-page="currentPage"
                    @page-changed="fetchProducts"
                    v-if="products.total > 20"
                >
                </v-pagination>
            </div>
        </div>
    </my-wishlist>
@endsection
