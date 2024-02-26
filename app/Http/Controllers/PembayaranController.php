<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    /**
     * index
     *
     * @return void
     */
     public function index()
    {
        //get posts

        $pembayaran = Pembayaran::latest()->paginate(5);
       return view('pembayaran.index', compact ('pembayaran'));
    }

       /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $siswa = Siswa::all();
        return view('pembayaran.create', compact('siswa'));
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [

            'siswa_id'   => 'required',
            'tgl_bayar'   => 'required',
            'jumlah_bayar'   => 'required',
        ]);

        Pembayaran::create([
            'siswa_id'   => $request->input('siswa_id'),
            'tgl_bayar'   => $request->input('tgl_bayar'),
            'jumlah_bayar'   => $request->input('jumlah_bayar'),
        ]);

        //redirect to index
        return redirect()->route('pembayaran.index')->with(['success' => 'Pembayaran Berhasil Disimpan!']);
    }


    /**
     * edit
     *
     * @param  mixed $pembayaran
     * @return void
     */
    public function edit(Pembayaran $pembayaran)
    {
        $item = Siswa::all();
        $bayar = Pembayaran::all();
        return view('pembayaran.edit', compact('pembayaran', 'item', 'bayar'));
    }

     /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        //validate form
        $this->validate($request, [

            'siswa_id'     => 'required',
            'tgl_bayar'   => 'required',
            'jumlah_bayar'   => 'required',

        ]);
        $pembayaran->update([
            'siswa_id' => $request->input('siswa_id'),
            'tgl_bayar' => $request->input('tgl_bayar'),
            'jumlah_bayar' => $request->input('jumlah_bayar'),
        ]);

        //redirect to index
        return redirect()->route('pembayaran.index')->with(['success' => 'Berhasil melakukan update']);
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        //redirect to index
        return redirect()->route('pembayaran.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }


}
