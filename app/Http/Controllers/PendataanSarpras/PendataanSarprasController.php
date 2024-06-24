<?php

namespace App\Http\Controllers\PendataanSarpras;

use App\Models\Sarana;
use App\Models\Prasarana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\KodeInventaris;
use App\Models\PenanggungJawabSarpras;

class PendataanSarprasController extends Controller
{

    public function menu()
    {
        return view('page.pendataan-sarpras.menu');
    }

    public function pendataan($menu = null, $prasaranaID = null)
    {
        $userRole = $this->cekRole();

        if (in_array('PJS', $userRole)) {

            if ($menu == 'sarana') {
                $sarana = Sarana::join('prasarana_sarana', 'saranas.id', '=', 'prasarana_sarana.sarana_id')
                    ->where('prasarana_id', $prasaranaID)->select(
                        'saranas.id',
                        'saranas.kode_inventaris_id',
                        'saranas.nama_sarana',
                        'saranas.desc',
                        'saranas.jenis_sarana',
                        'saranas.kategori_id',
                        'saranas.tahun_pengadaan',
                        'saranas.jumlah',
                        'saranas.lokasi_sarana',
                        'saranas.status',
                    )->get();
                // dd($sarana);
                return  view('page.pendataan-sarpras.pendataan', [
                    'sarpras' => $sarana,
                    'menu' => $menu,
                    'kondisiPJL' => true,
                    'prasarana' => Prasarana::find($prasaranaID)
                ]);
            } elseif ($menu == 'prasarana') {
                $pjSarpras = PenanggungJawabSarpras::where('user_id', auth()->user()->id)
                    ->where('sarana_or_prasarana', 'prasarana')->get();
                return  view('page.pendataan-sarpras.pendataan', [
                    'sarpras' => $pjSarpras,
                    'menu' => $menu,
                    'kondisiPJL' => false
                ]);
            }
        } elseif (in_array('ADM', $userRole) || in_array('IVN', $userRole)) {
            if ($menu == 'sarana') {
                $sarana = Sarana::orderBy('created_at', 'asc')->get();
                return  view('page.pendataan-sarpras.pendataan', [
                    'sarpras' => $sarana,
                    'menu' => $menu,
                    'kondisiPJL' => false
                ]);
            } elseif ($menu == 'prasarana') {
                $prasarana = Prasarana::orderBy('created_at', 'asc')->get();
                return  view('page.pendataan-sarpras.pendataan', [
                    'sarpras' => $prasarana,
                    'menu' => $menu,
                    'kondisiPJL' => false
                ]);
            }
        }
    }

    // public function showInventaris($ruangan_id)
    // {
    //     $inventaris = Inventaris::where('ruangan_id', $ruangan_id)->get();
    //     return view('inventaris.inventaris', [
    //         'inventaris' => $inventaris,
    //         'ruanganID' => $ruangan_id
    //     ]);
    // }

    public function store(Request $request, $menu)
    {
        // dd($request->all(), $menu);
        $userRole = $this->cekRole();

        if ($menu == 'prasarana') {
            $this->validate($request, [
                // 'kode_inventaris' => 'required|unique:prasaranas',
                'nama_prasarana' => 'required',
                // 'desc' => 'required',
                'kategori_id' => 'required',
            ]);

            $kodeIventaris = KodeInventaris::create([
                'gol' => $request->gol,
                'bid' => $request->bid,
                'kel' => $request->kel,
                'sub_kel' => $request->sub_kel,
                'sub_sub' => $request->sub_sub,
                'no_urut' => $request->no_urut,
            ]);

            $createdPrasarana = new Prasarana();
            $createdPrasarana->kode_inventaris_id = $kodeIventaris->id;
            $createdPrasarana->nama_prasarana = $request->nama_prasarana;
            $createdPrasarana->desc = $request->desc;
            $createdPrasarana->kategori_id = $request->kategori_id;
            $createdPrasarana->tahun_pengadaan = $request->tahun_pengadaan;
            $createdPrasarana->harga = $request->harga;
            $createdPrasarana->lokasi_prasarana = $request->lokasi_prasarana;
            $createdPrasarana->save();
        } elseif ($menu == 'sarana') {

            if (in_array('PJS', $userRole)) {

                $sarana = Sarana::where('kode_inventaris_id', $request->kode_inventaris_id)->first();

                if ($sarana) {
                    $prasarana_sarana = DB::table('prasarana_sarana')->where('sarana_id', $sarana->id)
                        ->where('prasarana_id', $request->prasarana_id)->first();
                    if (!$prasarana_sarana) {

                        $prasarana_saranacheck = DB::table('prasarana_sarana')->where('sarana_id', $sarana->id)->first();

                        if ($prasarana_saranacheck) {
                            return redirect()->back()->with('info', 'Data sudah ada di tempat lain!');
                        }

                        $sarana->prasaranas()->attach($request->prasarana_id);
                    } else {
                        return redirect()->back()->with('info', 'Data sudah ada...');
                    }
                } else {
                    $this->validate($request, [
                        // 'kode_inventaris' => 'required|unique:saranas',
                        'nama_sarana' => 'required',
                        // 'desc' => 'required',
                        'jenis_sarana' => 'required',
                        'kategori_id' => 'required',
                        'tahun_pengadaan' => 'required',
                        'jumlah' => 'required',
                        'gol' => 'required',
                        'bid' => 'required',
                        'kel' => 'required',
                        'sub_kel' => 'required',
                        'sub_sub' => 'required',
                        'no_urut' => 'required',
                    ]);

                    $kodeIventaris = KodeInventaris::create([
                        'gol' => $request->gol,
                        'bid' => $request->bid,
                        'kel' => $request->kel,
                        'sub_kel' => $request->sub_kel,
                        'sub_sub' => $request->sub_sub,
                        'no_urut' => $request->no_urut,
                    ]);

                    $createdsarana = new Sarana;
                    $createdsarana->kode_inventaris_id = $kodeIventaris->id;
                    $createdsarana->nama_sarana = $request->nama_sarana;
                    $createdsarana->desc = $request->desc;
                    $createdsarana->jenis_sarana = $request->jenis_sarana;
                    $createdsarana->kategori_id = $request->kategori_id;
                    $createdsarana->tahun_pengadaan = $request->tahun_pengadaan;
                    $createdsarana->jumlah = $request->jumlah;
                    $createdsarana->harga = $request->harga;
                    $createdsarana->lokasi_sarana = $request->lokasi_sarana;
                    $createdsarana->save();

                    $createdsarana->prasaranas()->attach($request->prasarana_id);
                }
            } else {
                $this->validate($request, [
                    // 'kode_inventaris' => 'required|unique:saranas',
                    'nama_sarana' => 'required',
                    // 'desc' => 'required',
                    'jenis_sarana' => 'required',
                    'kategori_id' => 'required',
                    'tahun_pengadaan' => 'required',
                    'jumlah' => 'required',
                    'harga' => 'required',
                    'lokasi_sarana' => 'required',
                ]);

                $kodeIventaris = KodeInventaris::create([
                    'gol' => $request->gol,
                    'bid' => $request->bid,
                    'kel' => $request->kel,
                    'sub_kel' => $request->sub_kel,
                    'sub_sub' => $request->sub_sub,
                    'no_urut' => $request->no_urut,
                ]);

                $createdsarana = new Sarana;
                $createdsarana->kode_inventaris_id = $kodeIventaris->id;
                $createdsarana->nama_sarana = $request->nama_sarana;
                $createdsarana->desc = $request->desc;
                $createdsarana->jenis_sarana = $request->jenis_sarana;
                $createdsarana->kategori_id = $request->kategori_id;
                $createdsarana->tahun_pengadaan = $request->tahun_pengadaan;
                $createdsarana->jumlah = $request->jumlah;
                $createdsarana->harga = $request->harga;
                $createdsarana->lokasi_sarana = $request->lokasi_sarana;
                $createdsarana->save();
            }
        }

        return redirect()->back();
    }

    public function update(Request $request, $menu, $id)
    {

        // dd($request->all());

        if ($menu == 'prasarana') {

            $this->validate($request, [
                // 'kode_inventaris' => 'required|unique:prasaranas',
                'nama_prasarana' => 'required',
                // 'desc' => 'required',
                'kategori_id' => 'required',
            ]);

            $Prasarana = Prasarana::find($id);
            // $Prasarana->kode_inventaris_id = $kodeIventaris->id;
            $Prasarana->nama_prasarana = $request->nama_prasarana;
            $Prasarana->desc = $request->desc;
            $Prasarana->kategori_id = $request->kategori_id;
            $Prasarana->tahun_pengadaan = $request->tahun_pengadaan;
            $Prasarana->harga = $request->harga;
            $Prasarana->lokasi_prasarana = $request->lokasi_prasarana;
            $Prasarana->save();

            $kodeIventaris = KodeInventaris::find($Prasarana->kode_inventaris_id);
            $kodeIventaris->update([
                'gol' => $request->gol,
                'bid' => $request->bid,
                'kel' => $request->kel,
                'sub_kel' => $request->sub_kel,
                'sub_sub' => $request->sub_sub,
                'no_urut' => $request->no_urut,
            ]);
        } elseif ($menu == 'sarana') {

            $this->validate($request, [
                // 'kode_inventaris' => 'required|unique:saranas',
                'nama_sarana' => 'required',
                // 'desc' => 'required',
                'kategori_id' => 'required',
            ]);

            $sarana = Sarana::find($id);
            // $sarana->kode_inventaris_id = $kodeIventaris->id;
            $sarana->nama_sarana = $request->nama_sarana;
            $sarana->desc = $request->desc;
            $sarana->jenis_sarana = $request->Jenis_sarana;
            $sarana->kategori_id = $request->kategori_id;
            $sarana->tahun_pengadaan = $request->tahun_pengadaan;
            $sarana->jumlah = $request->jumlah;
            $sarana->harga = $request->harga;
            $sarana->lokasi_sarana = $request->lokasi_sarana;
            $sarana->save();

            $kodeIventaris = KodeInventaris::find($sarana->kode_inventaris_id);
            $kodeIventaris->update([
                'gol' => $request->gol,
                'bid' => $request->bid,
                'kel' => $request->kel,
                'sub_kel' => $request->sub_kel,
                'sub_sub' => $request->sub_sub,
                'no_urut' => $request->no_urut,
            ]);
        }

        return redirect()->back();
    }

    public function destroy($menu, $id)
    {
        if (request('kondisi') == 'move out') {
            $prasarana_sarana = DB::table('prasarana_sarana')->where('sarana_id', $id)->first();
            DB::table('prasarana_sarana')->where('id', $prasarana_sarana->id)->delete();
            // dd($id);
        } else {
            if ($menu == 'prasarana') {
                $prasarana = Prasarana::find($id);
                // $kodeIventaris = KodeInventaris::find($prasarana->kode_inventaris_id);
                $prasarana->delete();
                // $kodeIventaris->delete();
            } elseif ($menu == 'sarana') {
                $sarana = Sarana::find($id);
                $sarana->delete();

                // $kodeIventaris = KodeInventaris::find($sarana->kode_inventaris_id);
                // $kodeIventaris->delete();
            }
        }

        return redirect()->back();
    }

    public function cekRole($roleData = null)
    {
        if (is_null($roleData)) {
            $roles = auth()->user()->roles;
        } else {
            $roles = $roleData;
        }

        $listRole = [];
        foreach ($roles as $role) {
            array_push($listRole, $role->role_code);
        }

        return $listRole;
    }
}
