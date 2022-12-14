<?php

namespace FleetCart\Install;

use Modules\User\Entities\Role;
use Modules\Setting\Entities\Setting;
use Illuminate\Support\Facades\Artisan;
use Modules\Currency\Entities\CurrencyRate;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class App
{
    public function setup()
    {
        $this->generateAppKey();
        $this->setEnvVariables();
        $this->createCustomerRole();
        $this->setAppSettings();
        $this->createDefaultCurrencyRate();
        $this->createStorageFolder();
    }

    private function generateAppKey()
    {
        Artisan::call('key:generate', ['--force' => true]);
    }

    private function setEnvVariables()
    {
        $env = DotenvEditor::load();

        $env->setKey('APP_ENV', 'production');
        $env->setKey('APP_DEBUG', 'false');
        $env->setKey('APP_CACHE', 'true');
        $env->setKey('APP_URL', url('/'));

        $env->save();
    }

    private function createCustomerRole()
    {
        Role::create(['name' => 'Customer']);
    }

    private function setAppSettings()
    {
        Setting::setMany([
            'active_theme' => 'Storefront',
            'supported_countries' => ['BD'],
            'default_country' => 'BD',
            'supported_locales' => ['en'],
            'default_locale' => 'en',
            'default_timezone' => 'Asia/Dhaka',
            'customer_role' => 2,
            'reviews_enabled' => true,
            'auto_approve_reviews' => true,
            'cookie_bar_enabled' => true,
            'supported_currencies' => ['USD'],
            'default_currency' => 'USD',
            'send_order_invoice_email' => false,
            'store_email' => 'admin@fleetcart.test',
            'newsletter_enabled' => false,
            'search_engine' => 'mysql',
            'local_pickup_cost' => 0,
            'flat_rate_cost' => 0,
            'translatable' => [
                'store_name' => 'FleetCart',
                'free_shipping_label' => 'Free Shipping',
                'local_pickup_label' => 'Local Pickup',
                'flat_rate_label' => 'Flat Rate',
                'paypal_label' => 'PayPal',
                'paypal_description' => 'Pay via your PayPal account.',
                'stripe_label' => 'Stripe',
                'stripe_description' => 'Pay via credit or debit card.',
                'paytm_label' => 'Paytm',
                'paytm_description' => 'The best payment gateway provider in India for e-payment through credit card, debit card & net banking.',
                'razorpay_label' => 'Razorpay',
                'razorpay_description' => 'Pay securely by Credit or Debit card or Internet Banking through Razorpay.',
                'instamojo_label' => 'Instamojo',
                'instamojo_description' => 'CC/DB/NB/Wallets',
                'cod_label' => 'Cash On Delivery',
                'cod_description' => 'Pay with cash upon delivery.',
                'bank_transfer_label' => 'Bank Transfer',
                'bank_transfer_description' => 'Make your payment directly into our bank account. Please use your Order ID as the payment reference.',
                'check_payment_label' => 'Check / Money Order',
                'check_payment_description' => 'Please send a check to our store.',
            ],
            'storefront_copyright_text' => 'Copyright © <a href="{{ store_url }}">{{ store_name }}</a> {{ year }}. All rights reserved.',
        ]);
    }

    private function createDefaultCurrencyRate()
    {
        CurrencyRate::create(['currency' => 'USD', 'rate' => 1]);
    }

    private function createStorageFolder()
    {
        if (! is_dir(public_path('storage'))) {
            mkdir(public_path('storage'));
        }
    }
}
