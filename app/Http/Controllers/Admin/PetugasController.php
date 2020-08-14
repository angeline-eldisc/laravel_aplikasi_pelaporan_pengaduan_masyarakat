<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Petugas;

class PetugasController extends Controller
{
    public function create()
    {
        return view('admin.users.petugas.createAdmin');
    }

    public function store(Request $request)
    {
        $this->validator($request);

        Petugas::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'telp' => $request->telp,
            'level' => 'Admin',
            'status' => '1'
        ]);

        return redirect()->route('admin.users.index')->with('status','User has been Registered!');
    }

    private function validator(Request $request)
    {
        $rules = [
            'nama'    => 'required|string',
            'telp'    => 'required|numeric',
            'username'    => 'required|string|unique:masyarakat|min:5|max:191',
            'password' => 'required|string|min:4|max:255|confirmed',
        ];

        $request->validate($rules);
    }

    public function edit($id)
    {
        if(Auth::guard('petugas')->user()->id == $id){
            return redirect()->route('admin.users.index')->with('error', 'You are not allowed to edit yourself.');
        }

        $admin = Petugas::find($id);
        return view('admin.users.petugas.edit', compact(['admin']));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nama' => 'required',
            'telp' => 'required|numeric',
            'level' => 'required'
        ]);

        $admin = Petugas::find($id);
        $admin->update([
            'nama' => $request->nama,
            'telp' => $request->telp,
            'level' => $request->level
        ]);

        if($admin->level == 'Admin'){
            return redirect()->route('admin.users.index')->with('status', 'User has been updated!');
        }

        return redirect()->route('admin.users.indexPetugas')->with('status', 'User has been updated!');
    }

    public function destroy($id)
    {
        if(Auth::guard('petugas')->user()->id == $id){
            return redirect()->route('admin.users.index')->with('error', 'You are not allowed to delete yourself.');
        }

        $user = Petugas::find($id);
        
        if($user->level == 'Admin'){
            Petugas::destroy($id);
            return redirect()->route('admin.users.index')->with('status', 'User has been updated!');
        }

        Petugas::destroy($id);
        return redirect()->route('admin.users.indexPetugas')->with('status', 'User has been deleted!');
    }

    public function updateStatus($id){
        if(Auth::guard('petugas')->user()->id == $id){
            return redirect()->route('admin.users.index')->with('error', 'You are not allowed to actived/deactive yourself.');
        }

        $user = Petugas::find($id);

        if($user->status == 1){
            $user->status = '0';
            $user->save();
            if($user->level == 'Admin'){
                return redirect()->route('admin.users.index')->with('status', 'User has been updated!');
            }
            return redirect()->route('admin.users.indexPetugas')->with('warning', 'This account has been deactive!');
        }

        if($user->status == 0){
            $user->status = '1';
            $user->save();

            if($user->level == 'Admin'){
                return redirect()->route('admin.users.index')->with('status', 'User has been updated!');
            }

            return redirect()->route('admin.users.indexPetugas')->with('status', 'This account has been actived!');
        }
    }
    
    public function createPetugas()
    {
        return view('admin.users.petugas.createPetugas');
    }

    public function storePetugas(Request $request)
    {
        $this->validator($request);

        Petugas::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'telp' => $request->telp,
            'level' => 'Petugas',
            'status' => '1'
        ]);

        return redirect()->route('admin.users.indexPetugas')->with('status','User has been Registered!');
    }
}