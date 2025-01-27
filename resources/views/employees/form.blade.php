<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($employee) ? 'Edit Karyawan' : 'Tambah Karyawan Baru' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ isset($employee) ? route('employees.update', $employee) : route('employees.store') }}"
                        method="POST" class="space-y-6">
                        @csrf
                        @if(isset($employee))
                        @method('PUT')
                        @endif

                        <!-- Data Pribadi -->
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Data Pribadi</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="employee_id" class="block text-sm font-medium text-gray-700">ID Karyawan</label>
                                    <input type="text" name="employee_id" id="employee_id"
                                        value="{{ old('employee_id', $employee->employee_id ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300">
                                    @error('employee_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $employee->name ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300">
                                    @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" id="email"
                                        value="{{ old('email', $employee->email ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300">
                                    @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                                    <input type="text" name="phone" id="phone"
                                        value="{{ old('phone', $employee->phone ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300">
                                    @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                                    <textarea name="address" id="address" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300">{{ old('address', $employee->address ?? '') }}</textarea>
                                    @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="birth_date" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                    <input type="date" name="birth_date" id="birth_date"
                                        value="{{ old('birth_date', $employee->birth_date ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300">
                                    @error('birth_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                    <select name="gender" id="gender" class="mt-1 block w-full rounded-md border-gray-300">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="male" {{ old('gender', $employee->gender ?? '') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="female" {{ old('gender', $employee->gender ?? '') == 'female' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('gender')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Data Kepegawaian -->
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Data Kepegawaian</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="position" class="block text-sm font-medium text-gray-700">Jabatan</label>
                                    <input type="text" name="position" id="position"
                                        value="{{ old('position', $employee->position ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300">
                                    @error('position')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="department" class="block text-sm font-medium text-gray-700">Departemen</label>
                                    <select name="department" id="department" class="mt-1 block w-full rounded-md border-gray-300">
                                        <option value="">Pilih Departemen</option>
                                        <option value="IT" {{ old('department', $employee->department ?? '') == 'IT' ? 'selected' : '' }}>IT</option>
                                        <option value="HR" {{ old('department', $employee->department ?? '') == 'HR' ? 'selected' : '' }}>HR</option>
                                        <option value="Finance" {{ old('department', $employee->department ?? '') == 'Finance' ? 'selected' : '' }}>Finance</option>
                                    </select>
                                    @error('department')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="join_date" class="block text-sm font-medium text-gray-700">Tanggal Bergabung</label>
                                    <input type="date" name="join_date" id="join_date"
                                        value="{{ old('join_date', $employee->join_date ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300">
                                    @error('join_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300">
                                        <option value="">Pilih Status</option>
                                        <option value="active" {{ old('status', $employee->status ?? '') == 'active' ? 'selected' : '' }}>Aktif</option>
                                        <option value="inactive" {{ old('status', $employee->status ?? '') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                        <option value="on_leave" {{ old('status', $employee->status ?? '') == 'on_leave' ? 'selected' : '' }}>Cuti</option>
                                    </select>
                                    @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Data Finansial -->
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Data Finansial</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="base_salary" class="block text-sm font-medium text-gray-700">Gaji Pokok</label>
                                    <input type="number" name="base_salary" id="base_salary"
                                        value="{{ old('base_salary', $employee->base_salary ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300">
                                    @error('base_salary')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="bank_name" class="block text-sm font-medium text-gray-700">Nama Bank</label>
                                    <input type="text" name="bank_name" id="bank_name"
                                        value="{{ old('bank_name', $employee->bank_name ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300">
                                    @error('bank_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="bank_account" class="block text-sm font-medium text-gray-700">Nomor Rekening</label>
                                    <input type="text" name="bank_account" id="bank_account"
                                        value="{{ old('bank_account', $employee->bank_account ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300">
                                    @error('bank_account')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="tax_id" class="block text-sm font-medium text-gray-700">NPWP</label>
                                    <input type="text" name="tax_id" id="tax_id"
                                        value="{{ old('tax_id', $employee->tax_id ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300">
                                    @error('tax_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="bpjs_tk" class="block text-sm font-medium text-gray-700">BPJS Ketenagakerjaan</label>
                                    <input type="text" name="bpjs_tk" id="bpjs_tk"
                                        value="{{ old('bpjs_tk', $employee->bpjs_tk ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300">
                                    @error('bpjs_tk')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="bpjs_kes" class="block text-sm font-medium text-gray-700">BPJS Kesehatan</label>
                                    <input type="text" name="bpjs_kes" id="bpjs_kes"
                                        value="{{ old('bpjs_kes', $employee->bpjs_kes ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300">
                                    @error('bpjs_kes')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('employees.index') }}"
                                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                {{ isset($employee) ? 'Update' : 'Simpan' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>