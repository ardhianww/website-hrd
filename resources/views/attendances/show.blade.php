<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Absensi') }}
            </h2>
            <div>
                <a href="{{ route('attendances.edit', $attendance) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                    {{ __('Edit') }}
                </a>
                <form action="{{ route('attendances.destroy', $attendance) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        {{ __('Hapus') }}
                    </button>
                </form>
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
                                <p class="mt-1">{{ $attendance->employee->employee_id }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Nama Karyawan') }}</p>
                                <p class="mt-1">{{ $attendance->employee->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Departemen') }}</p>
                                <p class="mt-1">{{ $attendance->employee->department }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Posisi') }}</p>
                                <p class="mt-1">{{ $attendance->employee->position }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Attendance Information -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Informasi Absensi') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Tanggal') }}</p>
                                <p class="mt-1">{{ $attendance->date->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Status') }}</p>
                                <p class="mt-1">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $attendance->status === 'present' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $attendance->status === 'absent' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ $attendance->status === 'late' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $attendance->status === 'leave' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $attendance->status === 'sick' ? 'bg-purple-100 text-purple-800' : '' }}">
                                        {{ ucfirst($attendance->status) }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Jam Masuk') }}</p>
                                <p class="mt-1">{{ $attendance->clock_in }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Jam Keluar') }}</p>
                                <p class="mt-1">{{ $attendance->clock_out ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Lokasi Masuk') }}</p>
                                <p class="mt-1">{{ $attendance->location_in ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Lokasi Keluar') }}</p>
                                <p class="mt-1">{{ $attendance->location_out ?? '-' }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm font-medium text-gray-500">{{ __('Catatan') }}</p>
                                <p class="mt-1">{{ $attendance->notes ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Informasi Tambahan') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('IP Address') }}</p>
                                <p class="mt-1">{{ $attendance->ip_address ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Device') }}</p>
                                <p class="mt-1">{{ $attendance->device ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Dibuat Pada') }}</p>
                                <p class="mt-1">{{ $attendance->created_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Diperbarui Pada') }}</p>
                                <p class="mt-1">{{ $attendance->updated_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="mt-6">
                        <a href="{{ route('attendances.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Kembali') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>