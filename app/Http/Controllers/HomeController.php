<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function dashboard(){
        $data = Auth::user();

        return view ('dashboard', compact('data'));
    }

    public function dashboard_admin(){
        return view ('dashboard_admin');
    }

    public function index() {

        $data = User::get();

        return view('index', compact('data'));
    }

    public function create(){
        return view('create');
    }

    public function profile(){
        $data = Auth::user();

        return view('auth.profile', compact('data'));
    }
    public function edit_profile(){
        $data = Auth::user();

        return view('auth.edit_profile',compact('data'));
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(),[
            'photo'    => 'required|mimes:png,jpg,jpeg|max:2048',
            'email'    => 'required|email',
            'nama'     => 'required',
          
            'email' => 'required|email',
            'nama'  => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $photo      = $request->file('photo');
        $filename   = date('Y-m-d').$photo->getClientOriginalName();
        $path       = 'photo-user/'.$filename;

        Storage::disk('public')->put($path,file_get_contents($photo));

        $data['email']     = $request->email;
        $data['name']      = $request->nama;
        $data['password']  = Hash::make($request->password);
        $data['image']     = $filename;

        User::create($data);

        return redirect()->route('admin.index');
    }

    public function edit(Request $request,$id){
        $data = User::find($id);

        return view('edit',compact('data'));
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'photo'     => 'required|mimes:png,jpg,jpeg|max:2048',
            'email'      => 'required|email',
            'nama'       => 'required',
            'password'   => 'nullable',
        ]);
        $photo                  = $request->file('photo');
        $filename               = date('Y-m-d').$photo->getClientOriginalName();
        $path                   = 'photo-user/'.$filename;

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['email']     = $request->email;
        $data['name']      = $request->nama;
        $data['image']     = $filename;


        if($request->password){
            $data['password']  = Hash::make($request->password);

        }
        User::whereId($id)->update($data);
        return redirect()->route('admin.index');
    }

    public function delete(Request $request,$id){
        $data = User::find($id);

        if($data){
            $data->delete();
        }

        return redirect()->route('admin.index');
    }

    public function jumlah_sekolah(){
        return view ('jumlah_sekolah');
    }
    public function jumlah_anak_magang(){
        return view ('jumlah_anak_magang');
    }
    public function jumlah_admin(){
        return view ('jumlah_admin');
    }
    
    public function update_user(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'email'      => 'required|email',
            'nama'       => 'required',
            'password'   => 'nullable',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['email']     = $request->email;
        $data['name']      = $request->nama;

        if($request->password){
            $data['password']  = Hash::make($request->password);

        }

        User::whereId($id)->update($data);

        return redirect()->route('admin.dashboard_user');
    }

    public function delete_user(Request $request,$id){
        $data = User::find($id);

        if($data){
            $data->delete();
        }

        return redirect()->route('admin.dashboard_user');
    }
}
