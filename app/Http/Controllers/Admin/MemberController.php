<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
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
        $member = User::all();
        return view('admin.users.list_member',compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

            $user = new User();
            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->password = $input['password'];
            $user->profille_image = 'profille_image_user/user.png';
            $user->is_activated = 1;
            $user->save();

            return redirect()->back()->with('success',"Member baru berhasil ditambahkan");
        }
        return back()->with('Error',$validator->errors());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        // return $input;
        $validator = Validator::make($input, [
            'member_name_edit' => 'required|string|max:255',
            'member_email_edit' => 'required|string|email|max:255',
            'member_no_telp_edit' => 'required|numeric'
        ]);

        if($validator->passes()){
            $user = User::find($id);
            $user->name = $input['member_name_edit'];
            $user->email = $input['member_email_edit'];
            $user->no_telp = $input['member_no_telp_edit'];

            if ($request->hasFile('foto_profille')) {
                $filePic   = $request->file('foto_profille');
                $extension = $filePic->getClientOriginalExtension();
                $fileName  = 'profille_image_user_' . $id;
                $filePic->move('profille_image_user/', $fileName . '.' . $extension);

                $user->profille_image = 'profille_image_user/' . $fileName . '.' . $extension;
            }

            $user->is_activated = $request->status;
            $user->save();

            return redirect()->back()->with('success',"Member berhasil diperbaharui");
        }
        return back()->with('warning',$validator->errors());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = User::find($id);
        $delete->is_activated = 2;
        $delete->save();

        return redirect()->back()->with('success',"Member berhasil dihapus");
    }
}
