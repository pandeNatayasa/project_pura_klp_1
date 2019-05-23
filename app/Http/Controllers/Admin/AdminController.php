<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.master_data');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = Admin::all();
        return view('admin.users.list_admin',compact('admin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->passes()){

            $user = new aAdmin();
            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->password = $input['password'];
            $user->profille_image = 'profille_image_admin/admin.png';
            $user->save();

            return redirect()->back()->with('success',"Admin baru berhasil ditambahkan");
        }
        return back()->with('warning',$validator->errors());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        // return $input;
        $validator = Validator::make($input, [
            'admin_name_edit' => 'required|string|max:255',
            'admin_email_edit' => 'required|string|email|max:255',
            'admin_no_telp_edit' => 'required|numeric'
        ]);

        if($validator->passes()){
            $user = Admin::find($id);
            $user->name = $input['admin_name_edit'];
            $user->email = $input['admin_email_edit'];
            $user->no_telp = $input['admin_no_telp_edit'];

            if ($request->hasFile('foto_profille')) {
                $filePic   = $request->file('foto_profille');
                $extension = $filePic->getClientOriginalExtension();
                $fileName  = 'profille_image_user_' . $id;
                $filePic->move('profille_image_user/', $fileName . '.' . $extension);

                $user->profille_image = 'profille_image_user/' . $fileName . '.' . $extension;
            }

            $user->save();

            return redirect()->back()->with('success',"admin berhasil diperbaharui");
        }
        return back()->with('warning',$validator->errors());
    }

    public function update_foto_profille(Request $request)
    {
        // Check when upload profile image
        if (null !== $request->get('profille_image')){
            if($request->get('profille_image')){ // start success
                $image_str = $request->get('profille_image');
                $array = explode(',', $image_str);
                $extension = explode('/', explode(':', substr($image_str, 0, strpos($image_str, ';')))[1])[1];
                $filePic = Image::make($array[1])->encode($extension); 
                
                $fileName = 'profille_image_admin_'.Auth::id();
                $path = 'profille_image_admin/';
                $filePic->save($path . $fileName.'.'.$extension);

                $update_profile = Admin::find(Auth::id());
                $update_profile->profille_image = $path . $fileName.'.'.$extension;
                $update_profile->save();

                return $update_profile->profille_image;
            }
        }
        return "aa";        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Admin::find($id);
        $delete->delete();

        return redirect()->back()->with('success',"Admin berhasil dihapus");
    }
}
