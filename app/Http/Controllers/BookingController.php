<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Enums\StatusIzin;
use App\Enums\StatusSelesai;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Court;
use App\Models\Order;
use App\Models\Join;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function index() 
    {
        $courtCollection = Court::all();
        $joinCollection = Join::where('status_id','!=', Status::BELUM_DIKONFIRMASI->status())
                        ->where('nama_pemain','=',request()->cookie('username'))
                        ->get();
        $orderCollection = Order::where('pemesan','=',request()->cookie('username'))
                                         ->where('status_selesai_id', '=', StatusSelesai::MASIH_BERMAIN->statusSelesai())
                                         ->get();
        $confirm = '';

        if($orderCollection->count() > 0) {
            $confirm = 'Ada';
            return view('booking.index', compact('courtCollection', 'joinCollection', 'confirm'));
        } elseif($orderCollection->count() < 1) {
            $confirm = 'Tidak';
            return view('booking.index', compact('courtCollection', 'joinCollection', 'confirm'));
        }
    }

    public function done() {
        $order = Order::where('pemesan','=',request()->cookie('username'))
                        ->where('status_selesai_id','=',StatusSelesai::MASIH_BERMAIN->statusSelesai())
                        ->update(['status_selesai_id' => StatusSelesai::SELESAI_BERMAIN->statusSelesai()]);

        return redirect()->back()->with('success', 'Terima Kasih Anda Sudah Bermain');
    }

    public function create() 
    {

        $courtCollection = Court::get();

        $orderCollection = Order::where('pemesan','=',request()->cookie('username'))
                                ->where('status_selesai_id', '=', StatusSelesai::MASIH_BERMAIN->statusSelesai())
                                ->get();

        if($orderCollection->count() > 0) {
            return redirect()->back()->with('error', 'Anda Masih Memiliki Pesanan yang Belum Selesai Dimainkan');
        } elseif($orderCollection->count() <= 0) {            
            return view('booking.create', compact('courtCollection'));
        }

    }

    public function store(StoreBookingRequest $request)
    {   
        $order = new Order;
        $order->pemesan = $request->input('pemesan');
        $order->email = $request->input('email');
        $order->tanggal = $request->input('tanggal');

        $time = $request->jam;
        $waktu_mulai = $time[0]; // jam pertama yang dipilih
        $waktu_selesai = date('H:i', strtotime(end($time) . '+1 hour')); // jam terakhir yang dipilih ditambah 1 jam
        
        $order->waktu_mulai = $waktu_mulai;
        $order->waktu_selesai = $waktu_selesai;
        $order->jumlah_pemain = $request->input('jumlah_pemain');
        $order->jumlah_pemain_max = $request->input('jumlah_pemain_max');
        $order->status = $request->input('deskripsi');

        $order->lapangan_id = $request->input('lapangan_id');

        // Menambahkan nilai "bermain" ke dalam atribut status_selesai
        $order->status_selesai_id = StatusSelesai::MASIH_BERMAIN->statusSelesai();

        $order->status_izin = $request->input('izin_join');
        $order->save();

        return redirect('/booking')->with('success', 'Pesanan Berhasil Dibuat');
    }

}
