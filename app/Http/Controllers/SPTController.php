<?php

namespace App\Http\Controllers;
use App\Models\RekamSPT;

use Exception;
use Illuminate\Http\Request;

class SPTController extends Controller
{
   

    public function proses_tambah_buktisetor(Request $request){
        
        $data = [
            'jenis_bukti_penyetoran' => $request->jenis_bukti_penyetoran,
            'npwp' => $request->npwp,
            'ntpn' => $request->ntpn,
            'nomor_pemindahbukuan' => $request->nomor_pemindahbukuan,
            'tahun_pajak'=> $request->tahun_pajak,
            'masa_pajak' => $request->masa_pajak,
            'jenis_pajak' => $request->jenis_pajak,
            'jenis_setoran' => $request->jenis_setoran,
            'jumlah_setor' => $request->jumlah_setor,
            'tanggal_setor' => $request->tanggal_setor,
        ];
        $rekam_spt= new RekamSPT();
        $rekam_spt->create($data);
        return response()->json('sukses'); 
             
    }

    public function hapus_buktisetor($id){
        $rekam_spt= RekamSPT::find($id);
        $rekam_spt->delete();
        return response()->json('sukses');
    } 
}
