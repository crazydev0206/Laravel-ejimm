<?php

namespace FleetCart\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Core\Http\Requests\Request;

class InstallRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'db.host' => 'required',
            'db.port' => 'required',
            'db.username' => 'required',
            'db.password' => 'nullable',
            'db.database' => 'required',
            'admin.first_name' => 'required',
            'admin.last_name' => 'required',
            'admin.email' => 'required|email',
            'admin.phone' => 'required',
            'admin.password' => 'required|confirmed|min:6',
            'store.store_name' => 'required',
            'store.store_email' => 'required|email',
            'store.store_phone' => 'required',
            'store.search_engine' => ['required', Rule::in(['mysql', 'algolia', 'meilisearch'])],
            'store.algolia_app_id' => 'required_if:store.search_engine,algolia',
            'store.algolia_secret' => 'required_if:store.search_engine,algolia',
            'store.meilisearch_host' => 'required_if:store.search_engine,meilisearch',
            'store.meilisearch_key' => 'required_if:store.search_engine,meilisearch',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'db.host' => 'host',
            'db.port' => 'port',
            'db.username' => 'username',
            'db.password' => 'password',
            'db.database' => 'datbase',
            'admin.first_name' => 'first name',
            'admin.last_name' => 'last name',
            'admin.email' => 'email',
            'admin.phone' => 'phone',
            'admin.password' => 'password',
            'store.store_name' => 'store name',
            'store.store_email' => 'store email',
            'store.store_phone' => 'store phone',
            'store.search_engine' => 'search engine',
            'store.algolia_app_id' => 'algolia application id',
            'store.algolia_secret' => 'algolia admin api key',
            'store.meilisearch_host' => 'meilisearch host',
            'store.meilisearch_key' => 'meilisearch key',
        ];
    }
}
