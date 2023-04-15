<?php

namespace App\Http\Controllers;

use App\Enums\StatusSelesai;
use App\Http\Requests\EditCourtsRequest;
use App\Http\Requests\StoreCourtsRequest;
use App\Models\Court;
use App\Models\Order;
use Illuminate\Http\Request;

class BasketBallCourtsController extends Controller
{

    public function index()
    {
        $courtCollection = Court::get();

        return view('basketball-courts.index', compact('courtCollection'));
    }

    public function create() 
    {
        return view('basketball-courts.create');
    }

  
    
    public function store(StoreCourtsRequest $request)
    {
        $court = new Court();
        $court->nama_lapangan = $request->input('nama_lapangan');
        $court->alamat = $request->input('alamat');
        $court->save();
      
        return redirect()->back()->with('success', 'Lapangan baru berhasil ditambahkan');
    }

    public function edit(Court $court) 
    {
        return view('basketball-courts.edit', compact('court'));
    }

    public function update(EditCourtsRequest $request, Court $court) 
    {    
        $court->update($request->all());
    
        return redirect()->back()->with('success', 'Data lapangan berhasil diperbarui!');
    }
    

    public function destroy(Court $court) 
    {
        $order = Order::where('status_selesai_id', '=', StatusSelesai::MASIH_BERMAIN->statusSelesai())
            ->where('lapangan_id', '=', $court->id)
            ->get();

        // Jika tidak ditemukan maka akan menendang kembali user ke basketball-courts dan memberikan pesan gagal
        if($order->count() > 0) {
            return redirect('/basketball-courts')->with('error', 'Lapangan Sedang Dimainkan');
        } elseif($order->count() <= 0) {
            $court->delete();
            return redirect('/basketball-courts')->with('success', 'Lapangan berhasil dihapus');        
        }
    }
  
}
