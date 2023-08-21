<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Year;
use App\Tables\Years;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use ProtoneMedia\Splade\Facades\Toast;

class YearController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:year-list|year-create|year-edit|year-delete', ['only' => ['index','show']]);
        $this->middleware('permission:year-create', ['only' => ['create','store']]);
        $this->middleware('permission:year-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:year-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('main.years.index', ['years' => Years::class]);
    }

    public function create()
    {
        return view('main.years.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable',
        ]);

        Year::create($request->all());

        Toast::title('Year berhasil di buat')->center()->backdrop()->autoDismiss(1);
        return back();
    }

    public function show(Year $year)
    {
        return view('main.years.show', compact('year'));
    }

    public function edit(Year $year)
    {
        return view('main.years.edit', compact('year'));
    }

    public function update(Request $request, Year $year)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $year->update($request->all());

        Toast::title('Year berhasil di update')->center()->backdrop()->autoDismiss(1);
        return to_route('years.index');
    }

    public function destroy(Year $year)
    {
        $year->delete();
        Toast::title('Year berhasil di hapsu!')->center()->backdrop()->autoDismiss(1);
        return back();
    }
}
