<?php

namespace FleetCart\Install;

use Modules\Setting\Entities\Setting;

class Store
{
    public function setup($data)
    {
        Setting::setMany([
            'translatable' => [
                'store_name' => $data['store_name'],
            ],
            'store_email' => $data['store_email'],
            'store_phone' => $data['store_phone'],
            'search_engine' => $data['search_engine'],
            'algolia_app_id' => $data['algolia_app_id'],
            'algolia_secret' => $data['algolia_secret'],
        ]);
    }
}
