<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Penggajian') }}
            </h2>
            <div>
                <a href="{{ route('payrolls.edit', $payroll) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                    {{ __('Edit') }}
                </a>
                <form action="{{ route('payrolls.destroy', $payroll) }}" method="POST" class="inline">
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
                                <p class="mt-1">{{ $payroll->employee->employee_id }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Nama Karyawan') }}</p>
                                <p class="mt-1">{{ $payroll->employee->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Departemen') }}</p>
                                <p class="mt-1">{{ $payroll->employee->department }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Posisi') }}</p>
                                <p class="mt-1">{{ $payroll->employee->position }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payroll Information -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Informasi Penggajian') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Periode') }}</p>
                                <p class="mt-1">{{ date('F Y', mktime(0, 0, 0, $payroll->month, 1, $payroll->year)) }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Status') }}</p>
                                <p class="mt-1">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $payroll->status === 'paid' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $payroll->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $payroll->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($payroll->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Salary Components -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Komponen Gaji') }}</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">{{ __('Gaji Pokok') }}</span>
                                    <span class="text-sm font-medium">Rp {{ number_format($payroll->base_salary, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">{{ __('Tunjangan') }}</span>
                                    <span class="text-sm font-medium">Rp {{ number_format($payroll->allowances, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">{{ __('Potongan') }}</span>
                                    <span class="text-sm font-medium text-red-600">- Rp {{ number_format($payroll->deductions, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">{{ __('Pajak') }}</span>
                                    <span class="text-sm font-medium text-red-600">- Rp {{ number_format($payroll->tax, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-500">{{ __('BPJS') }}</span>
                                    <span class="text-sm font-medium text-red-600">- Rp {{ number_format($payroll->bpjs, 0, ',', '.') }}</span>
                                </div>
                                <div class="pt-3 border-t border-gray-200">
                                    <div class="flex justify-between">
                                        <span class="text-base font-medium text-gray-900">{{ __('Total Gaji Bersih') }}</span>
                                        <span class="text-base font-bold text-blue-600">Rp {{ number_format($payroll->net_salary, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Informasi Tambahan') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Tanggal Pembayaran') }}</p>
                                <p class="mt-1">{{ $payroll->payment_date ? $payroll->payment_date->format('d/m/Y') : '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Catatan') }}</p>
                                <p class="mt-1">{{ $payroll->notes ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Dibuat Pada') }}</p>
                                <p class="mt-1">{{ $payroll->created_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Diperbarui Pada') }}</p>
                                <p class="mt-1">{{ $payroll->updated_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('payrolls.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Kembali') }}
                        </a>
                        <a href="#" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Cetak Slip Gaji') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>