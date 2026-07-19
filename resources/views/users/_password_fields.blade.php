@php
    $mode = $mode ?? 'create';
@endphp

<div class="contents">
    <div>
        <label for="password" class="block text-sm font-medium text-slate-700">
            {{ $mode === 'edit' ? 'Password Baru' : 'Password' }}
        </label>
        <input
            id="password"
            name="password"
            type="password"
            {{ $mode === 'create' ? 'required' : '' }}
            class="mt-2 w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100"
        />
        {{-- Pesan bantuan ditempatkan di bawah Konfirmasi Password (biar lebih jelas) --}}
    </div>

    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-slate-700">
            Konfirmasi Password
        </label>
        <input
            id="password_confirmation"
            name="password_confirmation"
            type="password"
            {{ $mode === 'create' ? 'required' : '' }}
            class="mt-2 w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100"
        />
        @if($mode === 'edit')
            <p class="mt-2 text-xs text-slate-500">Kosongkan jika tidak ingin mengganti password.</p>
        @endif
    </div>
</div>

