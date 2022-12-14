<div class="table-responsive">
    <table class="table table-borderless shopping-cart-table">
        <thead>
            <tr>
                <th>{{ trans('storefront::cart.table.image') }}</th>
                <th>{{ trans('storefront::cart.table.product_name') }}</th>
                <th>{{ trans('storefront::cart.table.unit_price') }}</th>
                <th>{{ trans('storefront::cart.table.quantity') }}</th>
                <th>{{ trans('storefront::cart.table.line_total') }}</th>
                <th>
                    <button class="btn-remove" @click="clearCart">
                        <i class="las la-times"></i>
                    </button>
                </th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="cartItem in cart.items" :key="cartItem.id">
                <td>
                    <div class="product-image">
                        <img
                            :src="baseImage(cartItem.product)"
                            :class="{ 'image-placeholder': ! hasBaseImage(cartItem.product) }"
                            alt="product image"
                        >
                    </div>
                </td>

                <td>
                    <a
                        :href="productUrl(cartItem.product)"
                        class="product-name"
                        v-text="cartItem.product.name"
                    >
                    </a>

                    <ul class="list-inline product-options" v-cloak>
                        <li v-for="option in cartItem.options">
                            <label>@{{ option.name }}:</label> @{{ optionValues(option) }}
                        </li>
                    </ul>
                </td>

                <td>
                    <label>{{ trans('storefront::cart.table.unit_price:') }}</label>

                    <span class="product-price" v-html="cartItem.unitPrice.inCurrentCurrency.formatted"></span>
                </td>

                <td>
                    <label>{{ trans('storefront::cart.table.quantity:') }}</label>

                    <div class="number-picker">
                        <div class="input-group-quantity">
                            <button type="button" class="btn btn-number btn-minus" data-type="minus" :disabled="cartItem.qty == 1">
                                <i class="las la-angle-left"></i>
                            </button>

                            <input
                                type="text"
                                :value="cartItem.qty"
                                min="1"
                                :max="cartItem.product.manage_stock ? cartItem.product.qty : ''"
                                class="form-control input-number input-quantity"
                                @input="updateQuantity(cartItem, $event.target.value)"
                                @keydown.up="updateQuantity(cartItem, cartItem.qty + 1)"
                                @keydown.down="updateQuantity(cartItem, cartItem.qty - 1)"
                            >

                            <button type="button" class="btn btn-number btn-plus" data-type="plus">
                                <i class="las la-angle-right"></i>
                            </button>
                        </div>
                    </div>
                </td>

                <td>
                    <label>{{ trans('storefront::cart.table.line_total:') }}</label>

                    <span class="product-price" v-html="cartItem.total.inCurrentCurrency.formatted"></span>
                </td>

                <td>
                    <button class="btn-remove" @click="remove(cartItem)">
                        <i class="las la-times"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
