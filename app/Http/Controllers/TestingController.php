<?php

namespace App\Http\Controllers;

use App\Models\Testing;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TestingController extends Controller
{

    // menampilkan isi session
	public function tampilkanSession(Request $request) {
        dd($request->session());
		if($request->session()->has('nama')){
			echo $request->session()->get('nama');
		}else{
			echo 'Tidak ada data dalam session.';
		}
	}

	// membuat session
	public function buatSession(Request $request) {
		$request->session()->put('nama','saya');
		echo "Data telah ditambahkan ke session.";
	}

	// menghapus session
	public function hapusSession(Request $request) {
		$request->session()->forget('nama');
		echo "Data telah dihapus dari session.";
	}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {

        // $isi = [];
        // $isi['judul'] = 'sistem pakar';
        // $isi['pembimbing_1'] = 'si C';
        // $isi['pembimbing_2'] = 'si D';
        // $isi['Status'] = 'Belum di ACC';
        // $isi = json_encode($isi);

        // $testing = new Testing;
        // $testing->testing = $isi;
        // // dd($testing);
        // $testing->save();

        // $testing = Testing::where('testing', 'like', '%' . '"Status":"Belum di ACC"'. '%')->get();
        // $data = $testing;
        // dd($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Testing $testing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testing $testing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testing $testing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testing $testing)
    {
        //
    }
}
