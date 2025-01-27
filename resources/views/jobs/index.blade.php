<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Lowongan Kerja') }}
            </h2>
            <a href="{{ route('jobs.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Tambah Lowongan') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Search and Filter -->
                    <div class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="department" class="block text-sm font-medium text-gray-700">Departemen</label>
                            <select name="department" id="department" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Semua Departemen</option>
                                <option value="IT">IT</option>
                                <option value="HR">HR</option>
                                <option value="Finance">Finance</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Operations">Operations</option>
                            </select>
                        </div>
                        <div>
                            <label for="employment_type" class="block text-sm font-medium text-gray-700">Tipe Pekerjaan</label>
                            <select name="employment_type" id="employment_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Semua Tipe</option>
                                <option value="full_time">Full Time</option>
                                <option value="part_time">Part Time</option>
                                <option value="contract">Contract</option>
                                <option value="internship">Internship</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Filter') }}
                            </button>
                        </div>
                    </div>

                    <!-- Job Vacancies Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse ($vacancies as $job)
                        <div class="bg-white border rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                            <div class="p-5">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $job->title }}</h3>
                                        <p class="text-sm text-gray-600">{{ $job->department }} - {{ ucfirst(str_replace('_', ' ', $job->employment_type)) }}</p>
                                    </div>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $job->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($job->status) }}
                                    </span>
                                </div>
                                <div class="mt-4">
                                    <p class="text-sm text-gray-600 line-clamp-2">{{ $job->description }}</p>
                                </div>
                                <div class="mt-4">
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Gaji:</span>
                                        Rp {{ number_format($job->salary_min, 0, ',', '.') }} - {{ number_format($job->salary_max, 0, ',', '.') }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Kuota:</span>
                                        {{ $job->quota }} orang
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Deadline:</span>
                                        {{ $job->end_date->format('d/m/Y') }}
                                    </p>
                                </div>
                                <div class="mt-4 flex justify-between items-center">
                                    <div class="text-sm text-gray-600">
                                        <span class="font-medium">{{ $job->applications_count }}</span> Pelamar
                                    </div>
                                    <div>
                                        <a href="{{ route('jobs.show', $job) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                            {{ __('Detail') }} →
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3 border-t">
                                <div class="flex justify-end space-x-3">
                                    <a href="{{ route('jobs.edit', $job) }}" class="text-yellow-600 hover:text-yellow-900">
                                        {{ __('Edit') }}
                                    </a>
                                    <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            {{ __('Hapus') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full">
                            <p class="text-center text-gray-500">{{ __('Tidak ada lowongan kerja yang tersedia') }}</p>
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $vacancies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>