<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Masyarakat;

class MasyarakatController extends Controller
{
    public function create()
    {
        return view('admin.users.masyarakat.create');
    }

    public function store(Request $request)
    {
        $this->validator($request);

        Masyarakat::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'telp' => $request->telp
        ]);

        return redirect()->route('admin.masyarakat.indexMasyarakat')->with('status','User has been Registered!');
    }

    private function validator(Request $request)
    {
        $rules = [
            'nik'    => 'required|numeric',
            'nama'    => 'required|string',
            'telp'    => 'required|numeric',
            'username'    => 'required|string|unique:masyarakat|min:4|max:191',
            'password' => 'required|string|min:4|max:255|confirmed',
        ];

        $request->validate($rules);
    }

    public function edit($id)
    {
        $masyarakat = Masyarakat::find($id);
        return view('admin.users.masyarakat.edit', compact(['masyarakat']));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nik' => 'required|numeric',
            'nama' => 'required',
            'telp' => 'required|numeric'
        ]);

        $masyarakat = Masyarakat::find($id);
        $masyarakat->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'telp' => $request->telp
        ]);

        return redirect()->route('admin.users.indexMasyarakat')->with('status', 'User has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Masyarakat::destroy($id);
        return redirect()->route('admin.users.indexMasyarakat')->with('status', 'User has been deleted!');
    }
}
