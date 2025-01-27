<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($attendance) ? __('Edit Absensi') : __('Tambah Absensi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ isset($attendance) ? route('attendances.update', $attendance) : route('attendances.store') }}">
                        @csrf
                        @if(isset($attendance))
                        @method('PUT')
                        @endif

                        <!-- Employee Selection -->
                        <div class="mb-4">
                            <label for="employee_id" class="block text-sm font-medium text-gray-700">{{ __('Karyawan') }}</label>
                            <select name="employee_id" id="employee_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="">{{ __('Pilih Karyawan') }}</option>
                                @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ (isset($attendance) && $attendance->employee_id == $employee->id) ? 'selected' : '' }}>
                                    {{ $employee->name }} ({{ $employee->employee_id }})
                                </option>
                                @endforeach
                            </select>
                            @error('employee_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700">{{ __('Tanggal') }}</label>
                            <input type="date" name="date" id="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ isset($attendance) ? $attendance->date->format('Y-m-d') : old('date') }}" required>
                            @error('date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Clock In -->
                        <div class="mb-4">
                            <label for="clock_in" class="block text-sm font-medium text-gray-700">{{ __('Jam Masuk') }}</label>
                            <input type="time" name="clock_in" id="clock_in" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ isset($attendance) ? $attendance->clock_in : old('clock_in') }}" required>
                            @error('clock_in')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Clock Out -->
                        <div class="mb-4">
                            <label for="clock_out" class="block text-sm font-medium text-gray-700">{{ __('Jam Keluar') }}</label>
                            <input type="time" name="clock_out" id="clock_out" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ isset($attendance) ? $attendance->clock_out : old('clock_out') }}">
                            @error('clock_out')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">{{ __('Status') }}</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="present" {{ (isset($attendance) && $attendance->status == 'present') ? 'selected' : '' }}>{{ __('Hadir') }}</option>
                                <option value="absent" {{ (isset($attendance) && $attendance->status == 'absent') ? 'selected' : '' }}>{{ __('Tidak Hadir') }}</option>
                                <option value="late" {{ (isset($attendance) && $attendance->status == 'late') ? 'selected' : '' }}>{{ __('Terlambat') }}</option>
                                <option value="leave" {{ (isset($attendance) && $attendance->status == 'leave') ? 'selected' : '' }}>{{ __('Cuti') }}</option>
                                <option value="sick" {{ (isset($attendance) && $attendance->status == 'sick') ? 'selected' : '' }}>{{ __('Sakit') }}</option>
                            </select>
                            @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div class="mb-4">
                            <label for="location_in" class="block text-sm font-medium text-gray-700">{{ __('Lokasi Masuk') }}</label>
                            <input type="text" name="location_in" id="location_in" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ isset($attendance) ? $attendance->location_in : old('location_in') }}">
                            @error('location_in')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div class="mb-4">
                            <label for="notes" class="block text-sm font-medium text-gray-700">{{ __('Catatan') }}</label>
                            <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ isset($attendance) ? $attendance->notes : old('notes') }}</textarea>
                            @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('attendances.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                {{ __('Batal') }}
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ isset($attendance) ? __('Update') : __('Simpan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>