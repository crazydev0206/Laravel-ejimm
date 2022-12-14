<div class="payment-method" v-cloak>
    <h4 class="title">{{ trans('storefront::checkout.payment_method') }}</h4>

    <div class="payment-method-form">
        <div class="form-group">
            <div class="form-radio" v-for="(gateway, name) in gateways">
                <input
                    type="radio"
                    name="form.payment_method"
                    v-model="form.payment_method"
                    :value="name"
                    :id="name"
                >

                <label :for="name" v-text="gateway.label"></label>
                <img :src="'/assets/images/' + name + '.png'" :alt="name" title="name">
                <span class="helper-text" v-text="gateway.description"></span>
            </div>

            <span class="error-message" v-if="hasNoPaymentMethod">
                {{ trans('storefront::checkout.no_payment_method') }}
            </span>
        </div>
    </div>
</div>

<div id="stripe-card-element" v-show="form.payment_method === 'stripe'" v-cloak>
    {{-- A Stripe Element will be mounted here dynamically. --}}
</div>

<span class="error-message" v-if="stripeError" v-text="stripeError"></span>

<div class="payment-instructions" v-if="shouldShowPaymentInstructions" v-cloak>
    <h4 class="title">{{ trans('storefront::checkout.payment_instructions') }}</h4>

    <p v-html="paymentInstructions"></p>
</div>
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Klarna Payment</h5>
        </div>
        <div class="modal-body">
            <div id="klarnaDiv"></div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

