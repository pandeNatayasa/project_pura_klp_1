<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Auth;

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
        return view('admin.users.list_admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, Admin $admin)
    {
        //
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
    public function destroy(Admin $admin)
    {
        //
    }
}
