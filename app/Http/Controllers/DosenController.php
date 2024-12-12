<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class DosenController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }

    public function index()
    {
        return Dosen::with('user')->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'namadosen' => 'required|max:225',
            'nidn' => 'required|max:20',
            'matakuliah' => 'required|max:255'
        ]);

        $dosen = $request->user()->dosen()->create($fields);
        
        return [ 'dosen' => $dosen, 'user' => $dosen->user];
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        return [ 'dosen' => $dosen, 'user' => $dosen->user];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        Gate::authorize('modify', $dosen);
        $fields = $request->validate([
            'namadosen' => 'required|max:225',
            'nidn' => 'required|max:20',
            'matakuliah' => 'required|max:255'
        ]);

        $dosen -> update($fields);
        
        return [ 'dosen' => $dosen, 'user' => $dosen->user];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        Gate::authorize('modify', $dosen);

        $dosen->delete();

        return ['Data Berhasil Dihapus'];
    }
}