@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
<div class="min-h-screen bg-slate-50 px-4 py-5 sm:px-6 lg:px-8">

    <div class="mx-auto w-full max-w-screen-2xl">

        <!-- Header -->
        <div class="mb-5 flex flex-col gap-4 border-b border-slate-200 pb-5 lg:flex-row lg:items-end lg:justify-between">

            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">USERS</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950 sm:text-3xl">Manajemen Pengguna</h1>
            </div>

            <a href="{{ route('users.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>

                Tambah User
            </a>

        </div>

        <!-- Success / Error -->
        @if(session('success'))
        <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-800 shadow-sm">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-medium text-rose-800 shadow-sm">
            {{ session('error') }}
        </div>
        @endif

        <!-- Table -->
        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">
                <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Data User</h2>
                        <p class="mt-1 text-sm text-slate-500">Tabel user dengan role dan status.</p>
                    </div>

                    <div class="rounded-2xl bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">
                        Total User: {{ $users->total() }}
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[1100px] border-collapse">
                    <thead class="border-b border-slate-200 bg-slate-50 text-slate-600">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Telepon</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Role</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Terakhir Login</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse($users as $user)
                        <tr class="transition hover:bg-slate-50">
                            <td class="px-6 py-5 text-sm font-semibold text-slate-900">{{ $user->name }}</td>
                            <td class="px-6 py-5 text-sm text-slate-700">{{ $user->email }}</td>
                            <td class="px-6 py-5 text-sm text-slate-700">{{ $user->phone ?? '-' }}</td>
                            <td class="px-6 py-5 text-sm text-slate-700">{{ $user->role_label }}</td>

                            <td class="px-6 py-5">
                                @php
                                    $isActive = $user->status === 'active';
                                    $statusLabel = $isActive ? 'Aktif' : 'Tidak Aktif';
                                    $badgeClass = $isActive
                                        ? 'bg-emerald-100 text-emerald-700'
                                        : 'bg-slate-100 text-slate-600';
                                @endphp
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $badgeClass }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-700">{{ $user->last_login?->format('d M Y H:i') ?? '-' }}</td>

                            <td class="px-6 py-5 text-center">
                                <div class="flex items-center justify-center gap-2">

                                    <!-- Edit -->
                                    <a href="{{ route('users.edit', $user) }}"
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-700 transition hover:bg-amber-200"
                                        title="Edit User">

                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    <!-- Delete -->
                                    <button type="button"
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-red-100 text-red-700 transition hover:bg-red-200"
                                        title="Hapus User"
                                        data-open-delete-modal
                                        data-delete-url="{{ route('users.destroy', $user) }}"
                                        data-name="{{ $user->name }}">

                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100">
                                        <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V5l12-2v12" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-slate-900">Belum Ada User</h3>
                                    <p class="mt-2 text-sm text-slate-500">Mulai dengan menambahkan user baru terlebih dahulu.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between px-6 pb-5">
                <p class="text-sm text-slate-600">
                    Menampilkan
                    <strong>{{ $users->firstItem() ?? 0 }}</strong>
                    sampai
                    <strong>{{ $users->lastItem() ?? 0 }}</strong>
                    dari
                    <strong>{{ $users->total() }}</strong>
                    hasil
                </p>

                <div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>

        {{-- Delete Popover --}}
        <div class="absolute left-0 top-0 z-50 hidden min-w-[300px] transform rounded-2xl border border-slate-200 bg-white p-4 shadow-xl" id="delete-popover" style="display:none;">
            <div class="mb-3 flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-50 text-rose-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M6 19h12M8 7V6a2 2 0 012-2h4a2 2 0 012 2v1" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-950">Hapus user ini?</h3>
                    <p class="mt-1 text-xs text-slate-600">Aksi ini akan menghapus akun secara permanen.</p>
                </div>
            </div>

            <div class="text-sm text-slate-700" id="delete-popover-user-name"></div>

            <form method="POST" id="delete-user-form" class="mt-4">
                @csrf
                @method('DELETE')

                <div class="flex flex-wrap gap-2">
                    <button type="button" class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-50" data-close-delete-modal>
                        Batal
                    </button>

                    <button type="submit" class="inline-flex h-10 items-center justify-center rounded-lg bg-rose-600 px-4 text-sm font-semibold text-white transition hover:bg-rose-700">
                        Hapus
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('delete-popover')?.parentElement || document.body;
        const popover = document.getElementById('delete-popover');
        const deleteForm = document.getElementById('delete-user-form');
        const deleteUserName = document.getElementById('delete-popover-user-name');
        const openButtons = document.querySelectorAll('[data-open-delete-modal]');
        const closeButtons = document.querySelectorAll('[data-close-delete-modal]');

        const hidePopover = () => {
            popover.style.display = 'none';
            popover.classList.add('hidden');
        };

        openButtons.forEach(button => {
            button.addEventListener('click', function () {
                const rect = this.getBoundingClientRect();
                const parentRect = container.getBoundingClientRect();
                const top = rect.bottom - parentRect.top + (container.scrollTop || 0) + 8;
                const left = Math.min(rect.left - parentRect.left, parentRect.width - popover.offsetWidth - 16);

                deleteForm.action = this.dataset.deleteUrl;
                deleteUserName.textContent = `User: ${this.dataset.name}`;

                popover.style.top = `${top}px`;
                popover.style.left = `${Math.max(left, 8)}px`;
                popover.style.display = 'block';
                popover.classList.remove('hidden');
            });
        });

        closeButtons.forEach(button => {
            button.addEventListener('click', function () {
                hidePopover();
            });
        });

        document.addEventListener('click', function (event) {
            if (!popover.contains(event.target) && !event.target.closest('[data-open-delete-modal]')) {
                hidePopover();
            }
        });
    });
</script>
@endpush
@endsection

