<x-app-layout>
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Data Penjualan</h1>
    <a href="{{ route('penjualans.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Tambah Penjualan</a>
    
    <table class="table-auto w-full mt-6 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">No</th>
                <th class="border border-gray-300 px-4 py-2">Nama Sales</th>
                <th class="border border-gray-300 px-4 py-2">Nilai Omset</th>
                <th class="border border-gray-300 px-4 py-2">Nama Customer</th>
                <th class="border border-gray-300 px-4 py-2">Produk</th>
                <th class="border border-gray-300 px-4 py-2">Provinsi</th>
                <th class="border border-gray-300 px-4 py-2">Kota</th>
                <th class="border border-gray-300 px-4 py-2">Berat (gr)  </th>
                <th class="border border-gray-300 px-4 py-2">Kurir  </th>
                <th class="border border-gray-300 px-4 py-2">Ongkir</th>
                <th class="border border-gray-300 px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualans as $penjualan)
                <tr class="odd:bg-white even:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $penjualan->nama_sales }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $penjualan->nilai_omset }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $penjualan->nama_customer }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $penjualan->produk }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $penjualan->province->name ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $penjualan->city->name ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $penjualan->berat }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $penjualan->courier }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $penjualan->ongkir }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center space-x-2">
                        <a href="{{ route('penjualans.edit', $penjualan) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">Edit</a>
                        <form action="{{ route('penjualans.destroy', $penjualan) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>
