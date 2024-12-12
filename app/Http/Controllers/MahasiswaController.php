<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class MahasiswaController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }

    public function index()
    {
        return Mahasiswa::with('user')->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'nama' => 'required|max:225',
            'nim' => 'required|max:10',
            'ipk' => 'required|max:4'
        ]);

        $mahasiswa = $request->user()->mahasiswa()->create($fields);
        
        return ['mahasiswa' => $mahasiswa, 'user' => $mahasiswa->user];
        //return $mahasiswa;
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        return ['mahasiswa' => $mahasiswa, 'user' => $mahasiswa->user];

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        Gate::authorize('modify', $mahasiswa);
        $fields = $request->validate([
            'nama' => 'required|max:225',
            'nim' => 'required|max:10',
            'ipk' => 'required|max:4'
        ]);

        $mahasiswa -> update($fields);
        
        return ['mahasiswa' => $mahasiswa, 'user' => $mahasiswa->user];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        Gate::authorize('modify', $mahasiswa);

        $mahasiswa->delete();

        return ['Data Berhasil Dihapus'];
    }
}