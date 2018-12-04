<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\UserData;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = UserData::all();
        return view('form.formTampil')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form.daftar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request,array(
            'bidang_minat' => 'required|max:255',
            'nim' => 'required|max:255',
            'alamat' => 'required'
        ));
        
        //return response()->json($request);
        
        $data = new UserData();
        
        $data->bidang_minat = $request->bidang_minat;
        $data->nim = $request->nim;
        $data->alamat = $request->alamat;
        
          //  $id = DB::table('user_datas')->insertGetId(
            //    ['bidang_minat' => $request->bidang_minat, 'nim' => $request->nim,'alamat'=>$request->alamat]
           //);
        
        $data->save();
        Session::flash('Success','Data berhasil di Simpan');
        return redirect()->route('daftar.store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showForm(){
        return view('form.formTampil');
    }

    public function show($id)
    {
        $post = UserData::find($id);

        return view('form.tampil')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = UserData::find($id);

        return view('form.tampil')->withPost($post);
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
        //
        $this->validate($request,array(
            'bidang_minat' => 'required|max:255'
        ));

        $post =  UserData::find($id);
        $post->bidang_minat = $request->bidang_minat;
        $post->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = UserData::find($id);
        $post->delete();
    }
}
