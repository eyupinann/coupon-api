<?php

namespace App\Http\Controllers;

use App\Http\Custom\Response;
use App\Http\Resources\SettingsResource;
use App\Models\Settings;
use Illuminate\Http\Request;
/**
 * @group Settings
 * @authenticated
 */
class SettingsController extends Controller
{
    private $response         = null;

    public function __construct()
    {
        $this->user = auth('sanctum')->user();
        $this->response = new Response();
    }
    /**
     *
     * Settings
     *
     */
    public function index(){
        $settings = Settings::where('id',1)->first();
        return $this->response->withData(true,'Ayarlar listelendi', SettingsResource::make($settings));
    }
}
