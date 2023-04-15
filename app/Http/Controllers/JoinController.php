<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Enums\StatusIzin;
use App\Enums\StatusSelesai;
use App\Http\Requests\StoreJoinRequest;
use App\Models\Join;
use App\Models\Order;
use Illuminate\Http\Request;

class JoinController extends Controller
{

    public function index() 
    {
        $orderCollection = Order::with('court')
            ->where('status_izin', '=', StatusIzin::YA->statusizin())
            ->where('pemesan', '!=', request()->cookie('username'))
            ->where('status_selesai_id', '=', StatusSelesai::MASIH_BERMAIN->statusSelesai())
            ->get();
            
        return view('join.index', compact('orderCollection'));
    }

    public function create(Order $order) 
    {
        return view('join.create', compact('order'));
    }

    public function store(StoreJoinRequest $request) 
    {
        $join = new Join();
        $join->nama_pemain = $request->input('nama_pemain');
        $join->pemesan = $request->input('pemesan');
        $join->posisi = $request->input('posisi');
        $join->pesan = $request->input('pesan');
        $join->status_id = Status::BELUM_DIKONFIRMASI->status();
        $join->save();

        return redirect()->back()->with('success', 'Anda berhasil membuat permintaan bergabung');
    }

}
