@php
    $prefix = $prefix ?? 'destination';
    $title = $title ?? ($prefix === 'pickup' ? 'Alamat Pickup' : 'Alamat Tujuan Pengiriman');
    $initialLocation = [
        'provinceCode' => old("{$prefix}_province_code", optional($shipment)->{$prefix . '_province_code'} ?? ''),
        'cityCode' => old("{$prefix}_city_code", optional($shipment)->{$prefix . '_city_code'} ?? ''),
        'districtCode' => old("{$prefix}_district_code", optional($shipment)->{$prefix . '_district_code'} ?? ''),
        'villageCode' => old("{$prefix}_village_code", optional($shipment)->{$prefix . '_village_code'} ?? ''),
        'province' => old("{$prefix}_province", optional($shipment)->{$prefix . '_province'} ?? ''),
        'city' => old("{$prefix}_city", optional($shipment)->{$prefix . '_city'} ?? ''),
        'district' => old("{$prefix}_district", optional($shipment)->{$prefix . '_district'} ?? ''),
        'village' => old("{$prefix}_village", optional($shipment)->{$prefix . '_village'} ?? ''),
        'postalCode' => old("{$prefix}_postal_code", optional($shipment)->{$prefix . '_postal_code'} ?? ''),
        'address' => old("{$prefix}_address", optional($shipment)->{$prefix . '_address'} ?? ''),
    ];
@endphp

<div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
    <div class="mb-5 border-b border-slate-200 pb-4">
        <h2 class="text-base font-bold text-slate-950">{{ $title }}</h2>
        <p class="mt-1 text-sm text-slate-500">
            {{ $prefix === 'pickup' ? 'Lokasi pengambilan barang.' : 'Lokasi akhir pengiriman barang.' }}
        </p>
    </div>

    <div class="grid gap-5 lg:grid-cols-2">
        <div>
            <label for="{{ $prefix }}_province_code" class="mb-2 block text-sm font-semibold text-slate-700">Provinsi <span class="text-rose-500">*</span></label>
            <select id="{{ $prefix }}_province_code" name="{{ $prefix }}_province_code" required class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                <option value="">Pilih provinsi</option>
            </select>
            @error("{$prefix}_province_code")<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="{{ $prefix }}_city_code" class="mb-2 block text-sm font-semibold text-slate-700">Kabupaten / Kota <span class="text-rose-500">*</span></label>
            <select id="{{ $prefix }}_city_code" name="{{ $prefix }}_city_code" required class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" disabled>
                <option value="">Pilih kabupaten / kota</option>
            </select>
            @error("{$prefix}_city_code")<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="{{ $prefix }}_district_code" class="mb-2 block text-sm font-semibold text-slate-700">Kecamatan <span class="text-rose-500">*</span></label>
            <select id="{{ $prefix }}_district_code" name="{{ $prefix }}_district_code" required class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" disabled>
                <option value="">Pilih kecamatan</option>
            </select>
            @error("{$prefix}_district_code")<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="{{ $prefix }}_village_code" class="mb-2 block text-sm font-semibold text-slate-700">Desa / Kelurahan <span class="text-rose-500">*</span></label>
            <select id="{{ $prefix }}_village_code" name="{{ $prefix }}_village_code" required class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" disabled>
                <option value="">Pilih desa / kelurahan</option>
            </select>
            @error("{$prefix}_village_code")<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="mt-5 grid gap-5 lg:grid-cols-2">
        <div class="lg:col-span-2">
            <label for="{{ $prefix }}_address" class="mb-2 block text-sm font-semibold text-slate-700">Detail Alamat {{ $prefix === 'pickup' ? 'Pickup' : 'Tujuan' }} <span class="text-rose-500">*</span></label>
            <textarea id="{{ $prefix }}_address" name="{{ $prefix }}_address" rows="3" required class="w-full rounded-lg border border-slate-300 bg-white px-3 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="Nama gedung, jalan, nomor rumah, RT / RW">{{ $initialLocation['address'] }}</textarea>
            @error("{$prefix}_address")<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
        </div>
    </div>

    <input type="hidden" id="{{ $prefix }}_province" name="{{ $prefix }}_province" value="{{ $initialLocation['province'] }}" />
    <input type="hidden" id="{{ $prefix }}_city" name="{{ $prefix }}_city" value="{{ $initialLocation['city'] }}" />
    <input type="hidden" id="{{ $prefix }}_district" name="{{ $prefix }}_district" value="{{ $initialLocation['district'] }}" />
    <input type="hidden" id="{{ $prefix }}_village" name="{{ $prefix }}_village" value="{{ $initialLocation['village'] }}" />
    <input type="hidden" id="{{ $prefix }}_postal_code" name="{{ $prefix }}_postal_code" value="{{ $initialLocation['postalCode'] }}" />

    <script>
        (function () {
            const endpoint = '/api/indonesia-regions';
            const prefix = '{{ $prefix }}';
            const initial = @json($initialLocation);

            const provinceSelect = document.getElementById(`${prefix}_province_code`);
            const citySelect = document.getElementById(`${prefix}_city_code`);
            const districtSelect = document.getElementById(`${prefix}_district_code`);
            const villageSelect = document.getElementById(`${prefix}_village_code`);

            const hiddenProvince = document.getElementById(`${prefix}_province`);
            const hiddenCity = document.getElementById(`${prefix}_city`);
            const hiddenDistrict = document.getElementById(`${prefix}_district`);
            const hiddenVillage = document.getElementById(`${prefix}_village`);
            const hiddenPostalCode = document.getElementById(`${prefix}_postal_code`);

            function setSelectOptions(select, options, selectedValue) {
                select.innerHTML = '<option value="">Pilih opsi</option>';
                select.disabled = false;

                options.forEach(option => {
                    const item = document.createElement('option');
                    item.value = option.value;
                    item.textContent = option.label;
                    if (option.postal_code) {
                        item.dataset.postalCode = option.postal_code;
                    }
                    if (option.value === selectedValue) {
                        item.selected = true;
                    }
                    select.appendChild(item);
                });
            }

            async function fetchOptions(url) {
                const response = await fetch(url, { headers: { 'Accept': 'application/json' } });
                if (!response.ok) {
                    return [];
                }
                return response.json();
            }

            async function loadProvinces() {
                const provinces = await fetchOptions(`${endpoint}/select`);
                setSelectOptions(provinceSelect, provinces, initial.provinceCode);
            }

            async function loadCities(provinceCode) {
                if (!provinceCode) {
                    citySelect.innerHTML = '<option value="">Pilih kabupaten / kota</option>';
                    citySelect.disabled = true;
                    return;
                }
                const cities = await fetchOptions(`${endpoint}/select?parent_code=${provinceCode}`);
                setSelectOptions(citySelect, cities, initial.cityCode);
            }

            async function loadDistricts(cityCode) {
                if (!cityCode) {
                    districtSelect.innerHTML = '<option value="">Pilih kecamatan</option>';
                    districtSelect.disabled = true;
                    return;
                }
                const districts = await fetchOptions(`${endpoint}/select?parent_code=${cityCode}`);
                setSelectOptions(districtSelect, districts, initial.districtCode);
            }

            async function loadVillages(districtCode) {
                if (!districtCode) {
                    villageSelect.innerHTML = '<option value="">Pilih desa / kelurahan</option>';
                    villageSelect.disabled = true;
                    return;
                }
                const villages = await fetchOptions(`${endpoint}/select?parent_code=${districtCode}`);
                setSelectOptions(villageSelect, villages, initial.villageCode);
            }

            function syncHiddenFields(select, hiddenInput) {
                const option = select.selectedOptions[0];
                hiddenInput.value = option && select.value ? option.textContent : '';
            }

            function syncPostalCode() {
                const option = villageSelect.selectedOptions[0];
                hiddenPostalCode.value = option ? option.dataset.postalCode || '' : '';
            }

            function syncAllHiddenFields() {
                syncHiddenFields(provinceSelect, hiddenProvince);
                syncHiddenFields(citySelect, hiddenCity);
                syncHiddenFields(districtSelect, hiddenDistrict);
                syncHiddenFields(villageSelect, hiddenVillage);
                syncPostalCode();
            }

            async function reloadCascade(regionCode) {
                if (!regionCode) {
                    return;
                }

                const data = await fetchOptions(`${endpoint}/cascade?region_code=${regionCode}`);
                if (!data.selected) {
                    return;
                }

                setSelectOptions(provinceSelect, data.options.provinces ?? [], data.selected.province?.value ?? '');
                setSelectOptions(citySelect, data.options.cities ?? [], data.selected.city?.value ?? '');
                setSelectOptions(districtSelect, data.options.districts ?? [], data.selected.district?.value ?? '');
                setSelectOptions(villageSelect, data.options.villages ?? [], data.selected.village?.value ?? '');

                if (data.selected.province) {
                    hiddenProvince.value = data.selected.province.label;
                }
                if (data.selected.city) {
                    hiddenCity.value = data.selected.city.label;
                }
                if (data.selected.district) {
                    hiddenDistrict.value = data.selected.district.label;
                }
                if (data.selected.village) {
                    hiddenVillage.value = data.selected.village.label;
                    hiddenPostalCode.value = data.selected.village.postal_code ?? '';
                }
            }

            provinceSelect.addEventListener('change', async function () {
                const parentCode = this.value;
                syncHiddenFields(this, hiddenProvince);
                hiddenCity.value = '';
                hiddenDistrict.value = '';
                hiddenVillage.value = '';
                hiddenPostalCode.value = '';
                initial.cityCode = initial.districtCode = initial.villageCode = '';
                await loadCities(parentCode);
                districtSelect.innerHTML = '<option value="">Pilih kecamatan</option>';
                districtSelect.disabled = true;
                villageSelect.innerHTML = '<option value="">Pilih desa / kelurahan</option>';
                villageSelect.disabled = true;
            });

            citySelect.addEventListener('change', async function () {
                syncHiddenFields(this, hiddenCity);
                hiddenDistrict.value = '';
                hiddenVillage.value = '';
                hiddenPostalCode.value = '';
                initial.districtCode = initial.villageCode = '';
                await loadDistricts(this.value);
                villageSelect.innerHTML = '<option value="">Pilih desa / kelurahan</option>';
                villageSelect.disabled = true;
            });

            districtSelect.addEventListener('change', async function () {
                syncHiddenFields(this, hiddenDistrict);
                hiddenVillage.value = '';
                hiddenPostalCode.value = '';
                initial.villageCode = '';
                await loadVillages(this.value);
            });

            villageSelect.addEventListener('change', function () {
                syncHiddenFields(this, hiddenVillage);
                syncPostalCode();
            });

            const form = provinceSelect.closest('form');
            if (form) {
                form.addEventListener('submit', syncAllHiddenFields);
            }

            function onDocumentReady(callback) {
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', callback);
                } else {
                    callback();
                }
            }

            onDocumentReady(async function () {
                if (initial.villageCode) {
                    await reloadCascade(initial.villageCode);
                } else {
                    await loadProvinces();

                    if (initial.provinceCode) {
                        await loadCities(initial.provinceCode);
                    }

                    if (initial.cityCode) {
                        await loadDistricts(initial.cityCode);
                    }

                    if (initial.districtCode) {
                        await loadVillages(initial.districtCode);
                    }

                    if (initial.province) {
                        hiddenProvince.value = initial.province;
                    }
                    if (initial.city) {
                        hiddenCity.value = initial.city;
                    }
                    if (initial.district) {
                        hiddenDistrict.value = initial.district;
                    }
                    if (initial.village) {
                        hiddenVillage.value = initial.village;
                    }
                    if (initial.postalCode) {
                        hiddenPostalCode.value = initial.postalCode;
                    }
                }
            });
        })();
    </script>
</div>
