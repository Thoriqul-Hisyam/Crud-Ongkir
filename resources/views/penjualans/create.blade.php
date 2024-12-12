<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Tambah Penjualan</h1>
        <form action="{{ route('penjualans.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="nama_sales" class="block text-sm font-medium text-gray-700">Nama Sales</label>
                <input type="text" name="nama_sales" id="nama_sales" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="nilai_omset" class="block text-sm font-medium text-gray-700">Nilai Omset</label>
                <input type="number" name="nilai_omset" id="nilai_omset" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="nama_customer" class="block text-sm font-medium text-gray-700">Nama Customer</label>
                <input type="text" name="nama_customer" id="nama_customer" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="produk" class="block text-sm font-medium text-gray-700">Produk</label>
                <input type="text" name="produk" id="produk" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="province_id" class="block text-sm font-medium text-gray-700">Provinsi</label>
                <select name="province_id" id="province_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>Pilih Provinsi</option>
                    @foreach ($provinsis as $provinsi)
                        <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="city_id" class="block text-sm font-medium text-gray-700">Kota</label>
                <select name="city_id" id="city_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>Pilih Kota</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="berat" class="block text-sm font-medium text-gray-700">Berat</label>
                <input type="number" name="berat" id="berat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="courier" class="block text-sm font-medium text-gray-700">Courier</label>
                <select name="courier" id="courier" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>Pilih Kurir</option>
                    <option value="JNE">JNE</option>
                    <option value="POS">POS</option>
                    <option value="TIKI">TIKI</option>
                </select>
            </div>

            <div>
                <label for="ongkir" class="block text-sm font-medium text-gray-700">Ongkir</label>
                <input type="number" name="ongkir" id="ongkir"  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>


            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Simpan</button>
        </form>
    </div>
</x-app-layout>

<script>
//     document.addEventListener('DOMContentLoaded', () => {
//     const destinationSelect = document.querySelector('#city_id');
//     const courierSelect = document.querySelector('#courier');
//     const weightInput = document.querySelector('#berat');
//     const ongkirInput = document.querySelector('#ongkir');
//     const courierServicesContainer = document.querySelector('#courier-services'); 
    
//     async function calculateOngkir() {
//         const destination = destinationSelect.value;
//         const weight = weightInput.value;
//         const courier = courierSelect.value;
        
//         if (!destination || !courier || !weight) {
//             ongkirInput.value = ''; 
//             courierServicesContainer.innerHTML = ''; 
//             return;
//         }
        
//         try {
//             const response = await fetch('{{ route('calculate.ongkir') }}', {
//                 method: 'GET',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': '{{ csrf_token() }}', 
//                 },
//                 body: JSON.stringify({ 
//                     city_origin: "133",  
//                     city_id: destination,
//                     berat: weight,
//                     courier: courier
//                 }),
//             });

//             const data = await response.json();

//             if (response.ok && data.length > 0) {
//                 let servicesHTML = ''; // To hold the formatted services HTML
                
//                 for (let courierData of data) {
//                     if (courierData.code === courier) {
//                         for (let service of courierData.costs) {
//                             const serviceName = service.service;
//                             const serviceCost = service.value;
//                             const serviceDescription = service.description || 'No description available';
                            
//                             servicesHTML += `
//                                 <div class="service-option">
//                                     <p><strong>${courierData.name} : ${serviceName}</strong> - Rp ${serviceCost} (${serviceDescription})</p>
//                                 </div>
//                             `;
//                         }
//                         break; // Exit the loop after handling the selected courier
//                     }
//                 }

//                 courierServicesContainer.innerHTML = servicesHTML;

//                 if (servicesHTML) {
//                     const firstServiceCost = data[0]?.costs[0]?.value || 0;
//                     ongkirInput.value = firstServiceCost;
//                 }

//             } else {
//                 ongkirInput.value = 0; // Default jika tidak ada data
//                 courierServicesContainer.innerHTML = '<p>No shipping options available.</p>';
//             }
//         } catch (error) {
//             console.error(error);
//             alert('Terjadi kesalahan saat menghitung ongkir.');
//         }
//     }

//     destinationSelect.addEventListener('change', calculateOngkir);
//     courierSelect.addEventListener('change', calculateOngkir);
//     weightInput.addEventListener('input', calculateOngkir);
// });

document.addEventListener('DOMContentLoaded', () => {
    const provinceSelect = document.querySelector('#province_id');
    const citySelect = document.querySelector('#city_id');

    provinceSelect.addEventListener('change', async () => {
        const provinceId = provinceSelect.value;

        citySelect.innerHTML = '<option value="" disabled selected>Loading...</option>';

        try {
            const response = await fetch(`/get-cities/${provinceId}`);
            const cities = await response.json();

            citySelect.innerHTML = '<option value="" disabled selected>Pilih Kota</option>';
            cities.forEach(city => {
                const option = document.createElement('option');
                option.value = city.id;
                option.textContent = city.name;
                citySelect.appendChild(option);
            });
        } catch (error) {
            console.error(error);
            citySelect.innerHTML = '<option value="" disabled selected>Error loading cities</option>';
        }
    });
});

</script>