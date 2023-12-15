<?php

namespace App\Http\Controllers;

use App\Http\Custom\Response;
use App\Http\Resources\PushResource;
use App\Models\Push;
use Illuminate\Http\Request;
/**
 * @group Push
 * @authenticated
 */
class PushController extends Controller
{
    private $response         = null;

    public function __construct()
    {
        $this->user = auth('sanctum')->user();
        $this->response = new Response();
    }
    /**
     *
     * Push List
     *
     */
    public function index(){
       $pushs = Push::all();
        return $this->response->withData(true,'Bildirimler listelendi', PushResource::collection($pushs));
    }
}
