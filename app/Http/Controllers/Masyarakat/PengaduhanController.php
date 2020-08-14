<?php

namespace App\Http\Controllers\Masyarakat;

use Auth;
use App\Pengaduan;
use App\Tanggapan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PengaduhanController extends Controller
{
    
    public function index()
    {
        $pengaduan = Pengaduan::with('masyarakat')->latest()->paginate(10);
        return view('masyarakat.pengaduan.index', compact(['pengaduan']));
    }

    public function create()
    {
        return view('masyarakat.pengaduan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'isi_laporan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg',
          ]);

        $pengaduan = Pengaduan::create([
            'tgl_pengaduan' => date('Y-m-d'),
            'masyarakat_id' => Auth::guard('masyarakat')->user()->id,
            'isi_laporan' => $request->isi_laporan,
            'foto' => $request->foto,
            'status' => 'proses'
        ]);

        $file = $request->foto;
        if ($file) {
            $dir = 'uploads';
            $fileName = time() . '-' . str_random(8) . '.' .$file->extension();
            $file->move($dir, $fileName);
            $filepath = $dir . '/' . $fileName;
            $pengaduan->foto = $filepath;
            $pengaduan->save();
        }

          return redirect()->route('masyarakat.pengaduan.index')->with('status', 'Data has been saved');
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::find($id);
        return view('admin.pengaduan.show', compact(['pengaduan']));
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::find($id);

        if($pengaduan){
            if($image_path = $pengaduan->foto) {
                unlink($image_path);
            }

            $pengaduan->tanggapan()->delete();
            $pengaduan->delete();
            return redirect()->back()->with('status', 'Data has been deleted.');
        }
    }
}
