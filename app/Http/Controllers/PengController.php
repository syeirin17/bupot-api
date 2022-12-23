<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaturan;
class PengController extends Controller
{
    //
    public function get_pengaturan($id){
        $data = Pengaturan::with(['user'])->where('user_id', $id)->first();
        return response()->json($data,200);
    }
    public function ganti_status_peng($id){
        $pengaturan= Pengaturan::find($id);
        $pengaturan->status = $pengaturan->status ? 0 : 1;
        $pengaturan->save(); 
        return response()->json('sukses'); 
    }
        
    public function proses_tambah_pengaturan(Request $request, $id){
        $data = [
            'bertindak_sebagai' => $request->bertindak_sebagai,
            'identitas' => $request->identitas,
            'status' => $request->status ?? 0,
            'user_id' => $id            
        ];
        //dd($request->all());
        $pengaturan= new Pengaturan();
        $pengaturan->create($data);
        return response()->json('sukses');    
    } 
    
}
