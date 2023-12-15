<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use App\Models\Push;
use Illuminate\Http\Request;

class PushController extends Controller
{
    public function index()
    {
        $push = Push::all();
        return view('admin.push.index',compact('push'));
    }

    public function create()
    {
        return view('admin.push.action');
    }

    public function edit($id)
    {
        $push = Push::where('id',$id)->first();
        return view('admin.push.action',compact('push'));
    }

    public function save(Request $request)
    {
        if (isset($request['id'])) {
            $push = Push::find($request['id']);
        } else {
            $push = new Push();
        }

        $push->title = $request['title'];
        $push->description = $request['description'];
        $push->save();

        return back()->with('success', 'Başarıyla gerçekleşti.');
    }

    public function destroy($id)
    {
        $push = Push::where('id',$id)->first();

        $push = $push->delete();
        if ($push)
        {
            return back()->with('success', 'Başarıyla silindi.');
        }

        return back()->with('error', 'Silinirken bir hata oluştu.');
    }
}
