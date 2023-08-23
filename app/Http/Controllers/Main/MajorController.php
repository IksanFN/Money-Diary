<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\MajorStore;
use App\Http\Requests\MajorUpdate;
use App\Models\Major;
use App\Tables\Majors;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

class MajorController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:major-list|major-create|major-edit|major-delete', ['only' => ['index','store']]);
        $this->middleware('permission:major-create', ['only' => ['create','store']]);
        $this->middleware('permission:major-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:major-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('main.majors.index', ['majors' => Majors::class]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main.majors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MajorStore $request)
    {
        Major::create($request->all());
        Toast::title('Major berhasil di buat')->center()->backdrop()->autoDismiss(1);
        return to_route('majors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Major $major)
    {
        return view('main.majors.edit', compact('major'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MajorUpdate $request, Major $major)
    {
        $major->update($request->all());
        Toast::title('Major berhasil di update!')->center()->backdrop()->autoDismiss(1);
        return to_route('majors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Major $major)
    {
        $major->delete();
        Toast::title('Major berhasil di hapus!')->center()->backdrop()->autoDismiss(1);
        return back();
    }
}
