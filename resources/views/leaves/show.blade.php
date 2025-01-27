<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Pengajuan Cuti') }}
            </h2>
            <div>
                @if($leave->status === 'pending')
                <a href="{{ route('leaves.edit', $leave) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                    {{ __('Edit') }}
                </a>
                <form action="{{ route('leaves.destroy', $leave) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        {{ __('Hapus') }}
                    </button>
                </form>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Employee Information -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Informasi Karyawan') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('ID Karyawan') }}</p>
                                <p class="mt-1">{{ $leave->employee->employee_id }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Nama Karyawan') }}</p>
                                <p class="mt-1">{{ $leave->employee->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Departemen') }}</p>
                                <p class="mt-1">{{ $leave->employee->department }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Posisi') }}</p>
                                <p class="mt-1">{{ $leave->employee->position }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Leave Information -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Informasi Cuti') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Jenis Cuti') }}</p>
                                <p class="mt-1">{{ __($leave->type) }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Status') }}</p>
                                <p class="mt-1">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $leave->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $leave->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $leave->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($leave->status) }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Tanggal Mulai') }}</p>
                                <p class="mt-1">{{ $leave->start_date->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Tanggal Selesai') }}</p>
                                <p class="mt-1">{{ $leave->end_date->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Durasi') }}</p>
                                <p class="mt-1">{{ $leave->duration }} hari</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Disetujui Oleh') }}</p>
                                <p class="mt-1">{{ $leave->approved_by ? $leave->approver->name : '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Reason and Attachment -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Alasan dan Lampiran') }}</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-500">{{ __('Alasan Cuti') }}</p>
                                <p class="mt-1">{{ $leave->reason }}</p>
                            </div>
                            @if($leave->status === 'rejected')
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-500">{{ __('Alasan Penolakan') }}</p>
                                <p class="mt-1">{{ $leave->rejection_reason ?? '-' }}</p>
                            </div>
                            @endif
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Lampiran') }}</p>
                                @if($leave->attachment_path)
                                <p class="mt-1">
                                    <a href="{{ Storage::url($leave->attachment_path) }}" class="text-blue-600 hover:text-blue-900" target="_blank">
                                        {{ basename($leave->attachment_path) }}
                                    </a>
                                </p>
                                @else
                                <p class="mt-1">-</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Informasi Tambahan') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Dibuat Pada') }}</p>
                                <p class="mt-1">{{ $leave->created_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Diperbarui Pada') }}</p>
                                <p class="mt-1">{{ $leave->updated_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('leaves.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Kembali') }}
                        </a>
                        @if(auth()->user()->is_admin && $leave->status === 'pending')
                        <div>
                            <form action="{{ route('leaves.approve', $leave) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">
                                    {{ __('Setujui') }}
                                </button>
                            </form>
                            <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="showRejectModal()">
                                {{ __('Tolak') }}
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    @if(auth()->user()->is_admin && $leave->status === 'pending')
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Alasan Penolakan') }}</h3>
                <form action="{{ route('leaves.reject', $leave) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <textarea name="rejection_reason" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="hideRejectModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            {{ __('Batal') }}
                        </button>
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Tolak') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function showRejectModal() {
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function hideRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
    @endpush
    @endif
</x-app-layout>