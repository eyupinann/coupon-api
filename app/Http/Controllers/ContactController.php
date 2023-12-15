<?php

namespace App\Http\Controllers;

use App\Http\Custom\Response;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

/**
 * @group Contact
 * @unauthenticated
 */
class ContactController extends Controller
{
    private $response = null;

    public function __construct()
    {
        $this->response = new Response();
    }

    /**
     * Contact
     * @bodyParam email    string The email of the user.
     * @bodyParam email string Password for the user.
     * @bodyParam text string Text for the user.
     *
     * @param ContactRequest $request
     * @return void
     */

    public function index(ContactRequest $request){
        $request->validated();

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'text' => $request->text
        ]);

        return $this->response->withData(
            true,
            "Başarılı bir şekilde gönderildi.",
            []
        );

    }
}
