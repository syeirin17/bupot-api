<?php

namespace App\Http\Controllers;
use App\Models\RekamSPT;

class SPTController extends Controller
{
    public function get_tambah(){
        $data = RekamSPT::get();
        return response()->json($data,200);
    }

    public function proses_tambah_buktisetor(Request $request){
        try {
            $hitung_data_hari_ini = RekamSPT::select("id")
        ->where('tanggal_setor', date('d-m-Y',time()))
        ->get()->count(); 
        // return response()->json($hitung_data_hari_ini,200);
        $data = [
            'jenis_bukti_penyetoran' => $request->jenis_bukti_penyetoran,
            'npwp' => $request->npwp,
            'ntpn' => $request->ntpn,
            'nomor_pemindahbukuan' => $request->nomor_pemindahbukuan,
            'nomor_bukti' => date('Ymd',time()).str_pad(((int)$hitung_data_hari_ini += 1), 6, '0', STR_PAD_LEFT),
            'tahun_pajak'=> $request->tahun_pajak,
            'masa_pajak' => $request->masa_pajak,
            'jenis_pajak' => $request->jenis_pajak,
            'jenis_setoran' => $request->jenis_setoran,
            'jumlah_setor' => $request->jumlah_setor,
            'tanggal_setor' => $request->tanggal_setor,
        ];
        $rekam_spt= new RekamSPT();
        $rekam_spt->create($data);
        return response()->json('sukses',200);
        } catch (Exception $e) {
        return response()->json($e->getMessage(),200);     
        }
    }
}