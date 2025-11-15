<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mosque;
use App\Models\Regions;
use Illuminate\Http\Request;

class MosqueController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $query = Mosque::query();
        if ($q) $query->where('name', 'like', "%{$q}%");
        $mosques = $query->orderBy('name')->paginate(20);
        return view('admin.master.mosques.index', compact('mosques', 'q'));
    }

    public function create()
    {
        // provide lists for hierarchical region selection
        $regionals = Regions::where('level', 'REGIONAL')->orderBy('name')->get();
        $witels = Regions::where('level', 'WITEL')->orderBy('name')->get();
        $stos = Regions::where('level', 'STO')->orderBy('name')->get();
        $mosque = new Mosque();
        return view('admin.master.mosques.create', compact('mosque', 'regionals', 'witels', 'stos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'type' => 'nullable|string|in:MASJID,MUSHOLLA',
            'address' => 'nullable|string',
            'tahun_didirikan' => 'nullable|integer|min:1800|max:2100',
            'jml_bkm' => 'nullable|integer|min:0',
            'luas_tanah' => 'nullable|numeric|min:0',
            'daya_tampung' => 'nullable|integer|min:0',
            'regional_id' => 'nullable|exists:regions,id',
            'witel_id' => 'nullable|exists:regions,id',
            'sto_id' => 'nullable|exists:regions,id',
        ]);
        Mosque::create($data);
        return redirect()->route('admin.mosques.index')->with('success', 'Mosque created');
    }

    public function edit(Mosque $mosque)
    {
        $regionals = Regions::where('level', 'REGIONAL')->orderBy('name')->get();
        $witels = Regions::where('level', 'WITEL')->orderBy('name')->get();
        $stos = Regions::where('level', 'STO')->orderBy('name')->get();
        return view('admin.master.mosques.edit', compact('mosque', 'regionals', 'witels', 'stos'));
    }

    public function update(Request $request, Mosque $mosque)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'type' => 'nullable|string|in:MASJID,MUSHOLLA',
            'address' => 'nullable|string',
            'tahun_didirikan' => 'nullable|integer|min:1800|max:2100',
            'jml_bkm' => 'nullable|integer|min:0',
            'luas_tanah' => 'nullable|numeric|min:0',
            'daya_tampung' => 'nullable|integer|min:0',
            'regional_id' => 'nullable|exists:regions,id',
            'witel_id' => 'nullable|exists:regions,id',
            'sto_id' => 'nullable|exists:regions,id',
        ]);
        $mosque->update($data);
        return redirect()->route('admin.mosques.index')->with('success', 'Mosque updated');
    }

    public function destroy(Mosque $mosque)
    {
        $mosque->delete();
        return redirect()->route('admin.mosques.index')->with('success', 'Mosque deleted');
    }
}
