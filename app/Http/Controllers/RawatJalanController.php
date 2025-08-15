<?php

namespace App\Http\Controllers;

use App\Models\RawatJalan;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RawatJalanController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', RawatJalan::class);
        if(Auth::user()->role == 'pasien'){
            $rawatJalan = RawatJalan::where('pasien_id', Auth::user()->id)->get();
            return view('rawat-jalan.index', compact('rawatJalan'));
        }
        $rawatJalan = RawatJalan::all();
        return view('rawat-jalan.index', compact('rawatJalan'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RawatJalan $rawatJalan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RawatJalan $rawatJalan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RawatJalan $rawatJalan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RawatJalan $rawatJalan)
    {
        //
    }
}
