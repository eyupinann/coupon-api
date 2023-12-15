<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('admin.user.index',compact('user'));
    }

    public function user_premium_list()
    {
        $user = User::where('type', '!=',0)->get();
        return view('admin.user.premium',compact('user'));
    }

    public function create()
    {
        return view('admin.user.action');
    }

    public function edit($id)
    {
        $user = User::where('id',$id)->first();
        return view('admin.user.action',compact('user'));
    }

    public function save(Request $request)
    {
        if (isset($request['id'])) {
            $user = User::find($request['id']);
        } else {
            $user = new User();
        }

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->role = $request['role'] ?? 'free';
        $user->type = $request['type'] ?? 0;
        $user->pay_date = Carbon::now();
        $user->save();

        return back()->with('success', 'Başarıyla gerçekleşti.');
    }

    public function destroy($id)
    {
        $user = User::where('id',$id)->delete();

        if ($user)
        {
            return back()->with('success', 'Başarıyla silindi.');
        }

        return back()->with('error', 'Silinirken bir hata oluştu.');
    }
}
