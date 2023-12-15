<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit()
    {
        $push = Settings::where('id',1)->first();
        return view('admin.settings.action',compact('push'));
    }

    public function save(Request $request)
    {
        if (isset($request['id'])) {
            $push = Settings::find($request['id']);
        } else {
            $push = new Settings();
        }

        if ($request->hasFile('logo'))
        {
            $imageName = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('logo'), $imageName);
        }else{
            $rand = Settings::all()->random(1)->first();
        }

        $push->version = $request['version'];
        $push->email = $request['email'];
        $push->title = $request['title'];
        $push->logo = $imageName ?? $push->logo ?? $rand->logo ;
        $push->save();

        return back()->with('success', 'Başarıyla gerçekleşti.');
    }
}
