<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($job) ? __('Edit Lowongan Kerja') : __('Tambah Lowongan Kerja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ isset($job) ? route('jobs.update', $job) : route('jobs.store') }}">
                        @csrf
                        @if(isset($job))
                        @method('PUT')
                        @endif

                        <!-- Basic Information -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Informasi Dasar') }}</h3>

                            <!-- Title -->
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700">{{ __('Judul Pekerjaan') }}</label>
                                <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ isset($job) ? $job->title : old('title') }}" required>
                                @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Department & Position -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="department" class="block text-sm font-medium text-gray-700">{{ __('Departemen') }}</label>
                                    <select name="department" id="department" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                        <option value="">{{ __('Pilih Departemen') }}</option>
                                        <option value="IT" {{ (isset($job) && $job->department == 'IT') ? 'selected' : '' }}>IT</option>
                                        <option value="HR" {{ (isset($job) && $job->department == 'HR') ? 'selected' : '' }}>HR</option>
                                        <option value="Finance" {{ (isset($job) && $job->department == 'Finance') ? 'selected' : '' }}>Finance</option>
                                        <option value="Marketing" {{ (isset($job) && $job->department == 'Marketing') ? 'selected' : '' }}>Marketing</option>
                                        <option value="Operations" {{ (isset($job) && $job->department == 'Operations') ? 'selected' : '' }}>Operations</option>
                                    </select>
                                    @error('department')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="position" class="block text-sm font-medium text-gray-700">{{ __('Posisi') }}</label>
                                    <input type="text" name="position" id="position" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ isset($job) ? $job->position : old('position') }}" required>
                                    @error('position')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Employment Type & Quota -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="employment_type" class="block text-sm font-medium text-gray-700">{{ __('Tipe Pekerjaan') }}</label>
                                    <select name="employment_type" id="employment_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                        <option value="">{{ __('Pilih Tipe') }}</option>
                                        <option value="full_time" {{ (isset($job) && $job->employment_type == 'full_time') ? 'selected' : '' }}>Full Time</option>
                                        <option value="part_time" {{ (isset($job) && $job->employment_type == 'part_time') ? 'selected' : '' }}>Part Time</option>
                                        <option value="contract" {{ (isset($job) && $job->employment_type == 'contract') ? 'selected' : '' }}>Contract</option>
                                        <option value="internship" {{ (isset($job) && $job->employment_type == 'internship') ? 'selected' : '' }}>Internship</option>
                                    </select>
                                    @error('employment_type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="quota" class="block text-sm font-medium text-gray-700">{{ __('Kuota') }}</label>
                                    <input type="number" name="quota" id="quota" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ isset($job) ? $job->quota : old('quota') }}" required min="1">
                                    @error('quota')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Description & Requirements -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Deskripsi dan Persyaratan') }}</h3>

                            <!-- Description -->
                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700">{{ __('Deskripsi Pekerjaan') }}</label>
                                <textarea name="description" id="description" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ isset($job) ? $job->description : old('description') }}</textarea>
                                @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Requirements -->
                            <div class="mb-4">
                                <label for="requirements" class="block text-sm font-medium text-gray-700">{{ __('Persyaratan') }}</label>
                                <textarea name="requirements" id="requirements" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ isset($job) ? $job->requirements : old('requirements') }}</textarea>
                                @error('requirements')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Salary & Benefits -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Gaji dan Benefit') }}</h3>

                            <!-- Salary Range -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="salary_min" class="block text-sm font-medium text-gray-700">{{ __('Gaji Minimum') }}</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">Rp</span>
                                        </div>
                                        <input type="number" name="salary_min" id="salary_min" class="pl-12 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ isset($job) ? $job->salary_min : old('salary_min') }}" required>
                                    </div>
                                    @error('salary_min')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="salary_max" class="block text-sm font-medium text-gray-700">{{ __('Gaji Maximum') }}</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">Rp</span>
                                        </div>
                                        <input type="number" name="salary_max" id="salary_max" class="pl-12 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ isset($job) ? $job->salary_max : old('salary_max') }}" required>
                                    </div>
                                    @error('salary_max')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Schedule -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Jadwal') }}</h3>

                            <!-- Date Range -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="start_date" class="block text-sm font-medium text-gray-700">{{ __('Tanggal Mulai') }}</label>
                                    <input type="date" name="start_date" id="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ isset($job) ? $job->start_date->format('Y-m-d') : old('start_date') }}" required>
                                    @error('start_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="end_date" class="block text-sm font-medium text-gray-700">{{ __('Tanggal Berakhir') }}</label>
                                    <input type="date" name="end_date" id="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ isset($job) ? $job->end_date->format('Y-m-d') : old('end_date') }}" required>
                                    @error('end_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-6">
                            <label for="status" class="block text-sm font-medium text-gray-700">{{ __('Status') }}</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="active" {{ (isset($job) && $job->status == 'active') ? 'selected' : '' }}>{{ __('Active') }}</option>
                                <option value="inactive" {{ (isset($job) && $job->status == 'inactive') ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                            </select>
                            @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('jobs.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                {{ __('Batal') }}
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ isset($job) ? __('Update') : __('Simpan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>