<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detail Karyawan
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('employees.edit', $employee) }}"
                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Data Pribadi -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Data Pribadi</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">ID Karyawan</p>
                                <p class="mt-1">{{ $employee->employee_id }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama Lengkap</p>
                                <p class="mt-1">{{ $employee->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="mt-1">{{ $employee->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">No. Telepon</p>
                                <p class="mt-1">{{ $employee->phone }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-sm font-medium text-gray-500">Alamat</p>
                                <p class="mt-1">{{ $employee->address }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tanggal Lahir</p>
                                <p class="mt-1">{{ $employee->birth_date->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Jenis Kelamin</p>
                                <p class="mt-1">{{ $employee->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Data Kepegawaian -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Data Kepegawaian</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Jabatan</p>
                                <p class="mt-1">{{ $employee->position }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Departemen</p>
                                <p class="mt-1">{{ $employee->department }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tanggal Bergabung</p>
                                <p class="mt-1">{{ $employee->join_date->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Status</p>
                                <p class="mt-1">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $employee->status === 'active' ? 'bg-green-100 text-green-800' : 
                                           ($employee->status === 'inactive' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($employee->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Data Finansial -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Data Finansial</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Gaji Pokok</p>
                                <p class="mt-1">Rp {{ number_format($employee->base_salary, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Bank</p>
                                <p class="mt-1">{{ $employee->bank_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nomor Rekening</p>
                                <p class="mt-1">{{ $employee->bank_account }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">NPWP</p>
                                <p class="mt-1">{{ $employee->tax_id }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">BPJS Ketenagakerjaan</p>
                                <p class="mt-1">{{ $employee->bpjs_tk }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">BPJS Kesehatan</p>
                                <p class="mt-1">{{ $employee->bpjs_kes }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Riwayat -->
                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Riwayat</h3>

                        <!-- Tabs -->
                        <div x-data="{ activeTab: 'attendance' }" class="mb-4">
                            <div class="border-b border-gray-200">
                                <nav class="-mb-px flex space-x-8">
                                    <button @click="activeTab = 'attendance'"
                                        :class="{ 'border-blue-500 text-blue-600': activeTab === 'attendance' }"
                                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                        Absensi
                                    </button>
                                    <button @click="activeTab = 'payroll'"
                                        :class="{ 'border-blue-500 text-blue-600': activeTab === 'payroll' }"
                                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                        Penggajian
                                    </button>
                                    <button @click="activeTab = 'leave'"
                                        :class="{ 'border-blue-500 text-blue-600': activeTab === 'leave' }"
                                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                        Cuti
                                    </button>
                                </nav>
                            </div>

                            <!-- Tab Contents -->
                            <div class="mt-4">
                                <!-- Attendance Tab -->
                                <div x-show="activeTab === 'attendance'">
                                    @if($employee->attendances->count() > 0)
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Clock In</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Clock Out</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($employee->attendances->take(5) as $attendance)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $attendance->date->format('d/m/Y') }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $attendance->clock_in ? $attendance->clock_in->format('H:i') : '-' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $attendance->clock_out ? $attendance->clock_out->format('H:i') : '-' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($attendance->status) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <p class="text-gray-500 text-center py-4">Tidak ada data absensi</p>
                                    @endif
                                </div>

                                <!-- Payroll Tab -->
                                <div x-show="activeTab === 'payroll'">
                                    @if($employee->payrolls->count() > 0)
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Periode</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gaji Pokok</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($employee->payrolls->take(5) as $payroll)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $payroll->month }}/{{ $payroll->year }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($payroll->base_salary, 0, ',', '.') }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($payroll->net_salary, 0, ',', '.') }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($payroll->status) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <p class="text-gray-500 text-center py-4">Tidak ada data penggajian</p>
                                    @endif
                                </div>

                                <!-- Leave Tab -->
                                <div x-show="activeTab === 'leave'">
                                    @if($employee->leaves->count() > 0)
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipe</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durasi</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($employee->leaves->take(5) as $leave)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $leave->start_date->format('d/m/Y') }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($leave->type) }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $leave->duration }} hari</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $leave->status_badge }}">
                                                            {{ ucfirst($leave->status) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <p class="text-gray-500 text-center py-4">Tidak ada data cuti</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>