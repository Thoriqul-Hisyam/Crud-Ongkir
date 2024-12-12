<?php

namespace App\Http\Controllers;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use App\Models\Penjualan;
use App\Models\Province;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PenjualanController extends Controller
{

    public function getCities($province_id)
{
    $cities = City::where('province_id', $province_id)->get(['id', 'name']);

    return response()->json($cities);
}

    
public function calculateOngkir(Request $request)
{
    $validated = $request->validate([
        'city_id' => 'required|integer', 
        'berat' => 'required|integer', 
        'courier' => 'required|string' 
    ]);
    
    $origin = 133;
    
    $costs = Rajaongkir::ongkosKirim([
        'origin' => $origin,
        'city_id' => $validated['city_id'],
        'berat' => $validated['berat'],
        'courier' => $validated['courier']
    ])->get();

    $results = $costs['results'] ?? [];

    if (empty($results)) {
        return response()->json(['error' => 'Tidak ada data ongkir yang ditemukan.'], 404);
    }

    $cheapestCost = null;
    foreach ($results as $result) {
        foreach ($result['costs'] as $cost) {
            if (!$cheapestCost || $cost['cost'][0]['value'] < $cheapestCost) {
                $cheapestCost = $cost['cost'][0]['value'];
            }
        }
    }

    return response()->json(['cheapest_cost' => $cheapestCost]);
}


    public function index()
    {
        $penjualans = Penjualan::with(['province', 'city'])->get();
        // dd($penjualans->toArray());
        return view('penjualans.index', compact('penjualans'));
    }

    public function create()
    {
        $provinsis = Province::all();
        $cities = City::all();
        // @dd($cities);
    return view('penjualans.create', compact('provinsis', 'cities'));
    }

    public function store(Request $request)
{
    $filteredData = $request->except('_token');
    // $data = $request->validate([
    //     'nama_sales' => 'required|string|max:255',
    //     'nilai_omset' => 'required|integer',
    //     'nama_customer' => 'required|string|max:255',
    //     'produk' => 'required|string|max:255',
    //     'province_id' => 'required|integer',
    //     'city_id' => 'required|integer',
    //     'berat' => 'required|integer',
    //     'courier' => 'required|string|max:255',
    //     'ongkir' => 'required|integer',
    // ]);

    // @dd($filteredData);
    Penjualan::create($filteredData);

    return redirect()->route('penjualans.index')->with('success', 'Data penjualan berhasil ditambahkan!');
}


    public function show(Penjualan $penjualan)
    {
        return view('penjualans.show', compact('penjualan'));
    }

    public function edit(Penjualan $penjualan)
    {
        $provinsis = Province::all();
    $cities = City::all();
    return view('penjualans.edit', compact('penjualan', 'provinsis', 'cities'));

    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'nama_sales' => 'required|string|max:255',
            'nilai_omset' => 'required|integer',
            'nama_customer' => 'required|string|max:255',
            'produk' => 'required|string|max:255',
            'provinsi_id' => 'required|integer',
            'city_id' => 'required|integer',
            'courier' => 'required|string|max:255',
            'ongkir' => 'required|numeric',
        ]);

        $penjualan->update($request->all());
        return redirect()->route('penjualans.index')->with('success', 'Data penjualan berhasil diperbarui!');
    }

    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();
        return redirect()->route('penjualans.index')->with('success', 'Data penjualan berhasil dihapus!');
    }
}
