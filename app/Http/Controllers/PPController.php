<?php

namespace App\Http\Controllers;
use App\Models\PphPasal;
use App\Models\PphSendiri;
use App\Models\PphNon;
use App\Models\DokumenPphPasal;
use App\Models\DokumenPphNon;
use App\Models\Posting;
use Exception;
use Illuminate\Http\Request;

class PPController extends Controller
{
    public function proses_tambah_pphsendiri(Request $request){
        //  dd($request->all());
        try {
            $hitung_data_hari_ini = PphSendiri::select("id")
        ->where('tanggal_setor', date('Y-m-d',time()))
        ->get()->count(); 
        // return response()->json($hitung_data_hari_ini,200);
        $data = [
            'jenis_bukti_penyetoran' => $request->jenis_bukti_penyetoran,
            'ntpn' => $request->ntpn,
            'nomor_pemindahbukuan' => $request->nomor_pemindahbukuan,
            'nomor_bukti' => date('Ymd',time()).str_pad(((int)$hitung_data_hari_ini += 1), 6, '0', STR_PAD_LEFT),
            'tahun_pajak'=> $request->tahun_pajak,
            'masa_pajak' => $request->masa_pajak,
            'jenis_pajak' => $request->jenis_pajak,
            'jenis_setoran' => $request->jenis_setoran,
            'kode_objek_pajak' => $request->kode_objek_pajak,
            'jumlah_penghasilan_bruto' => $request->jumlah_penghasilan_bruto,
            'jumlah_setor' => $request->jumlah_setor,
            'tanggal_setor' => $request->tanggal_setor,
        ];
        $pphsendiri= new PphSendiri();
        $pphsendiri->create($data);
        return response()->json('sukses',200);
        } catch (Exception $e) {
        return response()->json($e->getMessage(),200);     
        }
    }

    public function hapus_pphsendiri($id){
        $pphsendiri= PphSendiri::find($id);
        $pphsendiri->delete();
        return response()->json('sukses');
    } 

    //pph pasal-----------------------------------------------------
    public function get_pphpasal(){
        $data = PphPasal::get();
        return response()->json($data,200);
    }

    public function proses_tambah_pphpasal(Request $request){
        //  dd($request->all());
        
        $hitung_data_hari_ini = PphPasal::select("pphpasal.id")
        ->join('dokumen_pphpasal', 'pphpasal.id', '=', 'dokumen_pphpasal.pphpasal_id')
        ->where('tgl_dokumen', date('d-m-Y',time()))
        ->get()->count(); 
        // $pphpasal= new Pphpasal();
        // $pphpasal->create($request->all());
        $data = [
            'tahun_pajak' => $request->tahun_pajak,
            'masa_pajak' => $request->masa_pajak,
            'nama' => $request->nama,
            'identitas'=> $request->identitas,
            'no_identitas'=> $request->no_identitas,
            'qq' => $request->qq,
            'kode_objek_pajak' => $request->kode_objek_pajak,
            'fasilitas_pajak_penghasilan' => $request->fasilitas_pajak_penghasilan,
            'no_fasilitas' => $this->getNoFasilitas($request),
            'jumlah_penghasilan_bruto' => $request->jumlah_penghasilan_bruto,
            'tarif' => $request->tarif,
            'jumlah_setor' => $request->jumlah_setor,
            'pengaturan_id' => $request->pengaturan_id,
            'no_bukti' => date('Ymd',time()).str_pad(((int)$hitung_data_hari_ini += 1), 6, '0', STR_PAD_LEFT),
            // 'no_bukti' => '2',
            'status' => 'belum posting'
        ];
        $pphpasal= new PphPasal();
        $pphpasal->create($data);
        $pphpasal = PphPasal::latest()->first();
        $dokumen = [
            'pphpasal_id' => $pphpasal->id,
            'nama_dokumen' => $request->nama_dokumen,
            'no_dokumen' => $request->no_dokumen,
            'tgl_dokumen' => $request->tgl_dokumen,
        ];
        // return response()->json([$pphpasal,$dokumen]);    

        $dokumen_pph= new DokumenPphPasal();
        $dokumen_pph->create($dokumen);
        return response()->json('sukses');    
    }

    public function getNoFasilitas(Request $request){
        $tmp = null;
        if($request->skb){
            $tmp = $request->skb;
        }
        if($request->dt){
            $tmp = $request->dt;
            
        }
        if($request->suket){
            $tmp = $request->suket;
            
        }
        if($request->lainnya){
            $tmp = $request->lainnya;
            
        }
        return $tmp;
    }
    public function hapus_dokumen($id){
        $dokumen_pph= DokumenPphPasal::find($id);
        $dokumen_pph->delete();
        return response()->json('sukses');
    }

    public function hapus_pphpasal($id){
        $pphpasal= PphPasal::find($id);
        $pphpasal->delete();
        return response()->json('sukses');
    } 

    //pph non--------------------------------------------------
    public function get_pphnon(){
        $data = PphNon::get();
        return response()->json($data,200);
    }

    public function proses_tambah_pphnon(Request $request){
        //  dd($request->all());
        
        $hitung_data_hari_ini = PphNon::select("pph_nonresiden.id")
        ->join('dokumen_pphnon', 'pph_nonresiden.id', '=', 'dokumen_pphnon.pphnon_id')
        ->where('dokumen_pphnon.tgl_dokumen', date('d-m-Y',time()))
        ->get()->count(); 

        // $pph_nonresiden= new PphNon();
        // $pph_nonresiden->create($request->all());
        $data = [
            'pengaturan_id' => $request->pengaturan_id,
            'tahun_pajak' => $request->tahun_pajak,
            'masa_pajak' => $request->masa_pajak,
            'tin' => $request->tin,
            'nama' => $request->nama,
            'alamat'=> $request->alamat,
            'negara'=> $request->negara,
            'tempat_lahir'=> $request->tempat_lahir,
            'tgl_lahir'=> $request->tgl_lahir,
            'no_paspor' => $request->no_paspor,
            'no_kitas' => $request->no_kitas,
            'kode_objek_pajak' => $request->kode_objek_pajak,
            'fasilitas_pajak_penghasilan' => $request->fasilitas_pajak_penghasilan,
            'no_fasilitas' => $request->no_fasilitas,
            'jumlah_penghasilan_bruto' => $request->jumlah_penghasilan_bruto,
            'netto' => $request->netto,
            'tarif' => $request->tarif,
            'jumlah_setor' => $request->jumlah_setor,
            'no_bukti' => date('Ymd',time()).str_pad(((int)$hitung_data_hari_ini += 1), 6, '0', STR_PAD_LEFT),
            // 'no_bukti' => '2',
            'status' => 'belum posting',
            'kelebihan_pemotongan' => $request->kelebihan_pemotongan,
            'pernyataan' => $request->pernyataan
        ];
        $pph_nonresiden= new PphNon();
        $pph_nonresiden->create($data);
        $pph_nonresiden = PphNon::latest()->first();
        $dokumen = [
            'pphnon_id' => $pph_nonresiden->id,
            'nama_dokumen' => $request->nama_dokumen,
            'no_dokumen' => $request->no_dokumen,
            'tgl_dokumen' => $request->tgl_dokumen,
        ];
        $dokumen_pphnon= new DokumenPphNon();
        $dokumen_pphnon->create($dokumen);
        return response()->json('sukses');    
    }

    public function getNoFasilitasNon(Request $request){
        $tmp = null;
        if($request->skdwpln){
            $tmp = $request->skdwpln;
        }
        if($request->dtp){
            $tmp = $request->dtp;
        }
        if($request->lainnya){
            $tmp = $request->lainnya;  
        }
        return $tmp;
    }

    public function hapus_dokumennon($id){
        $dokumen_pphnon= DokumenPphNon::find($id);
        $dokumen_pphnon->delete();
        return response()->json('sukses');
    }

    public function hapus_pphnon($id){
        $pph_nonresiden= PphNon::find($id);
        $pph_nonresiden->delete();
        return response()->json('sukses');
    } 
    
    //posting-------------------------------------------------------------
    public function get_posting(){
        $data = Posting::get();
        return response()->json($data,200);
    }
}