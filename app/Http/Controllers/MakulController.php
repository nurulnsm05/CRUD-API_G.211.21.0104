<?php

namespace App\Http\Controllers;

use App\Models\makul;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class MakulController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }

    public function index()
    {
        return makul::with('user')->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'namamakul' => 'required|max:225',
            'idmakul' => 'required|max:20',
            'semester' => 'required|max:2'
        ]);

        $makul = $request->user()->makul()->create($fields);
        
        return [ 'makul' => $makul, 'user' => $makul->user];
    }

    /**
     * Display the specified resource.
     */
    public function show(makul $makul)
    {
        return [ 'makul' => $makul, 'user' => $makul->user];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, makul $makul)
    {
        Gate::authorize('modify', $makul);

        $fields = $request->validate([
            'namamakul' => 'required|max:225',
            'idmakul' => 'required|max:20',
            'semester' => 'required|max:2'
        ]);

        $makul -> update($fields);
        
        return [ 'makul' => $makul, 'user' => $makul->user];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(makul $makul)
    {
        Gate::authorize('modify', $makul);

        $makul->delete();

        return ['Data Berhasil Dihapus'];
    }
}