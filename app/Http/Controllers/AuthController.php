<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Custom\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
/**
 * @group Auth
 * @unauthenticated
 */
class AuthController extends Controller
{
    private $user     = null;
    private $response = null;

    public function __construct()
    {
        $this->user     = auth('sanctum')->user();
        $this->response = new Response();
    }

    /**
     * Login
     *
     * Login the user with given data if valid.
     *
     * @bodyParam email    string The email of the user.
     * @bodyParam password string Password for the user.
     *
     * @param LoginRequest $request
     * @return void
     */
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if (!Auth::attempt($request->only('email', 'password'))) {
            return Response::withoutData(false, "Hesap bilgilerinizi yanlış girdiniz.");
        }

        $this->user = auth()->user();
        if (isset(auth()->user()->email_verification_code)){
            return Response::withoutData(false, "Lütfen hesabınızı onaylayınız.");
        }

        return $this->response->withData(
            true,
            "Başarılı bir şekilde giriş yaptınız.",
            [
                'token' => auth()->user()->createToken('API Token')->plainTextToken,
                'user'  => UserResource::make($this->user)
            ]
        );
    }

    /**
     * Profile Update
     *
     * Profile Update the user with given data if valid.
     *
     * @bodyParam name string Name for the user.
     * @bodyParam surname string Surname for the user.
     * @bodyParam phone string Phone for the user.
     * @bodyParam email    string The email of the user.
     * @bodyParam password string Password for the user.
     *
     * @param Request $request
     * @return void
     * @authenticated
     */
    public function edit(ProfileRequest $request)
    {
        $data = $request->validated();

        $user = User::where('id', $this->user->id)->first();

        if (!empty($request->name))
        {
            $user->update(['name' => $request->name]);
        }

        if (!empty($request->email))
        {
            $user->update(['email' => $request->email]);
        }

        if (!empty($request->password))
        {
            $user->update(['password' => bcrypt($request->password)]);
        }


        return $this->response->withData(
            true,
            "Kullanıcı bilgilerini bir şekilde güncellediniz.",
            [
                'user' => UserResource::make($user)
            ]
        );
    }

    /**
     * Register
     *
     * Register the user with given data if valid.
     *
     * @bodyParam email    string The email of the user.
     * @bodyParam password string Password for the user.
     *
     * @param RegisterRequest $request
     * @return void
     */
    public function create(RegisterRequest $request)
    {
        $request->validated();

        $this->user = User::create([
            'name' => $request->name,
            'email'    => $request->email,
            'role'    => 'free',
            'password' => bcrypt($request->password),
            'type' => 0,
        ]);


        return $this->response->withData(
            true,
            "Başarılı bir şekilde kayıt oldunuz.",
            [
                'token' => $this->user->createToken('API Token')->plainTextToken,
                'user'  => UserResource::make($this->user)
            ]
        );
    }

    /**
     * Profile
     *
     * Profile Detail
     *
     * @unauthenticated
     *
     * @return void
     *
     */
    public function detail()
    {
        return $this->response->withData(
            true,
            "Kullanıcı detayı başarılı bir şekilde listelendi.",
            UserResource::make($this->user)
        );
    }

    /**
     * Destroy User
     *
     * Destroy User with given parameters
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function destroy()
    {
        $user = User::find($this->user->id);

        if ($user) {
            $user->delete();
        }

        return $this->response->withData(
            true,
            "Kullanıcı başarılı bir şekilde silindi.",
            []
        );
    }

    /**
     * User Logout
     *
     *  User Logout with given parameters
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function logout(){
        $this->user->tokens()->delete();

        return $this->response->withData(
            true,
            "Başarılı bir şekilde çıkış yapıldı.",
            []
        );
    }

    /**
     * User Pay
     * @authenticated
     */

    public function pay(Request $request){

        $this->user->update(['role' => 'premium', 'type' => $request->type, 'pay_date' => Carbon::now()]);

        return $this->response->withData(
            true,
            "Başarılı bir şekilde üyeliği yükseltildi.",
            []
        );
    }

    /**
     * User Type List
     * @authenticated
     */
    public function user_type(){
        $data = [
            1  => '1 Hafta',
            2 => '1 Ay',
            3 => '3 Ay'
        ];

        return $this->response->withData(
            true,
            "Başarılı bir şekilde üyelik türleri listelendi.",
            $data
        );
    }
}
