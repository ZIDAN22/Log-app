@extends('layouts.app')

@section('title', 'User Management')

@section('content')
<div class="min-h-screen bg-slate-100 py-6 px-3 sm:px-5 lg:px-6">
    <div class="mx-auto max-w-[1100px] relative" id="users-index-wrapper">
        <div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">User Management</h1>
                <p class="mt-2 text-slate-600">Kelola akses akun internal untuk seluruh tim perusahaan Anda.</p>
            </div>
            <a href="{{ route('users.create') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                Tambah User
            </a>
        </div>

        @if(session('success'))
        <div class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700 shadow-sm">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-4 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-medium text-rose-700 shadow-sm">
            {{ session('error') }}
        </div>
        @endif

        <div class="overflow-hidden rounded-[28px] border border-slate-200 bg-white shadow-sm">
            <table class="min-w-full text-left text-sm text-slate-700">
                <thead class="bg-slate-50 text-slate-900">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Nama</th>
                        <th class="px-6 py-4 font-semibold">Email</th>
                        <th class="px-6 py-4 font-semibold">Telepon</th>
                        <th class="px-6 py-4 font-semibold">Role</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 font-semibold">Terakhir Login</th>
                        <th class="px-6 py-4 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">{{ $user->phone }}</td>
                        <td class="px-6 py-4">{{ $user->role_label }}</td>
                        <td class="px-6 py-4">{{ ucfirst($user->status) }}</td>
                        <td class="px-6 py-4">{{ $user->last_login?->format('d M Y H:i') ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('users.edit', $user) }}" class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-700 transition hover:bg-amber-100 focus:outline-none focus:ring-2 focus:ring-amber-100" title="Edit User">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <button type="button" class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-rose-50 text-rose-700 transition hover:bg-rose-100 focus:outline-none focus:ring-2 focus:ring-rose-100" title="Hapus User" data-open-delete-modal data-delete-url="{{ route('users.destroy', $user) }}" data-name="{{ $user->name }}">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-sm text-slate-500">Belum ada user yang dibuat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</div>

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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('users-index-wrapper');
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
                const rect = button.getBoundingClientRect();
                const parentRect = container.getBoundingClientRect();
                const top = rect.bottom - parentRect.top + container.scrollTop + 8;
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
