<?php

namespace FleetCart;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;
use GuzzleHttp\Exception\ClientException;
use FleetCart\Exceptions\InvalidLicenseException;

class License
{
    private $license;
    private $licenseFilePath;
    private $endpoint = 'https://license.envaysoft.com';

    public function __construct()
    {
        $this->licenseFilePath = storage_path('app/license');
    }

    public function valid()
    {
        return $this->getLicenseFromFile()->valid;
    }

    public function shouldRecheck()
    {
        if ($this->getLicenseFromFile()->valid) {
            return $this->getLicenseFromFile()->next_check->isPast();
        }

        return false;
    }

    public function recheck()
    {
        $this->activate(
            $this->getLicenseFromFile()->purchase_code
        );
    }

    private function getLicenseFromFile()
    {
        if (! is_null($this->license)) {
            return $this->license;
        }

        if (! file_exists($this->licenseFilePath)) {
            return (object) ['valid' => false];
        }

        return $this->license = decrypt(file_get_contents($this->licenseFilePath));
    }

    public function deleteLicenseFile()
    {
        File::delete($this->licenseFilePath);
    }

    public function activate($purchaseCode)
    {
        $client = new Client(['base_uri' => $this->endpoint]);

        try {
            $response = $client->post('/api/v1/licenses', [
                'form_params' => $this->getFormParameters($purchaseCode),
            ]);
        } catch (ClientException $e) {
            $response = json_decode($e->getResponse()->getBody());

            if ($response->status === 'success' && ! $response->valid) {
                throw new InvalidLicenseException('The purchase code is invalid.');
            }

            if ($response->status === 'error') {
                throw new InvalidLicenseException($response->message);
            }
        }

        $license = json_decode($response->getBody());
        $license->purchase_code = $purchaseCode;
        $license->next_check = now()->addDays(1);

        $this->store($license);
    }

    private function getFormParameters($purchaseCode)
    {
        return [
            'item_id' => FleetCart::ITEM_ID,
            'domain' => request()->root(),
            'purchase_code' => $purchaseCode,
        ];
    }

    public function store($license)
    {
        file_put_contents($this->licenseFilePath, encrypt($license));
    }

    public function shouldCreateLicense()
    {
        if ($this->valid()) {
            return false;
        }

        if ($this->runningInLocal()) {
            return false;
        }

        if ($this->inFrontend()) {
            return false;
        }

        return true;
    }

    private function runningInLocal()
    {
        return app()->isLocal() || in_array(request()->ip(), ['127.0.0.1', '::1']);
    }

    private function inFrontend()
    {
        if (request()->is('license')) {
            return false;
        }

        return ! request()->is('*admin*');
    }
}
