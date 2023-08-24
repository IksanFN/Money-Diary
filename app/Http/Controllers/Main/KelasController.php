<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\KelasStore;
use App\Http\Requests\KelasUpdate;
use App\Models\Kelas;
use App\Tables\Kelases;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('main.kelas.index', ['kelases' => Kelases::class]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KelasStore $request)
    {
        Kelas::create($request->all());
        Toast::title('Kelas berhasil di buat')->center()->backdrop()->autoDismiss(1);
        return to_route('kelases.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        return view('main.kelas.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KelasUpdate $request, Kelas $kelas)
    {
        $kelas->update($request->all());
        Toast::title('Kelas berhasil di update')->center()->backdrop()->autoDismiss(1);
        return to_route('kelases.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        Toast::title('Kelas berhasil di hapus')->center()->backdrop()->autoDismiss(1);
        return back();
    }
}
