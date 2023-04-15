<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Join;
use App\Models\Order;
use Illuminate\Http\Request;

class JoinReqController extends Controller
{

    public function index() 
    {
        $joinCollection = Join::where('nama_pemain','!=',request()->cookie("username"))
                           ->where('pemesan', '=', request()->cookie("username"))
                           ->where('status_id', '=', Status::BELUM_DIKONFIRMASI->status())
                           ->get();


        return view('join.request', compact('joinCollection'));
    }

    public function accept(Request $request, $id) 
    {
        $join = Join::findOrFail($id);

        $order = Order::findOrFail($id);

        $order->jumlah_pemain += 1;
        $order->save();

        $join->status_id = Status::DITERIMA->status();
        $join->save();

        return redirect()->back()->with("success", "konfirmasi anda akan dikirimkan kepada player");
    }

    public function reject(Request $request, $id) 
    {
        $join = Join::findOrFail($id);

        $join->status_id = Status::DITOLAK->status();
        $join->save();

        return redirect()->back()->with("success", "konfirmasi anda akan dikirimkan kepada player");
    }

}
