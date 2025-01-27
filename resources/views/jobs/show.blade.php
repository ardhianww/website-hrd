<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Lowongan Kerja') }}
            </h2>
            <div>
                <a href="{{ route('jobs.edit', $job) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                    {{ __('Edit') }}
                </a>
                <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="inline">
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
                    <!-- Job Header -->
                    <div class="mb-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">{{ $job->title }}</h1>
                                <p class="mt-2 text-gray-600">{{ $job->department }} - {{ ucfirst(str_replace('_', ' ', $job->employment_type)) }}</p>
                            </div>
                            <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $job->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($job->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Job Overview -->
                    <div class="mb-8">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">{{ __('Ringkasan') }}</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-sm font-medium text-gray-500">{{ __('Gaji') }}</div>
                                <div class="mt-1 text-lg font-semibold">
                                    Rp {{ number_format($job->salary_min, 0, ',', '.') }} - {{ number_format($job->salary_max, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-sm font-medium text-gray-500">{{ __('Kuota') }}</div>
                                <div class="mt-1 text-lg font-semibold">{{ $job->quota }} orang</div>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-sm font-medium text-gray-500">{{ __('Deadline') }}</div>
                                <div class="mt-1 text-lg font-semibold">{{ $job->end_date->format('d/m/Y') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Job Description -->
                    <div class="mb-8">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">{{ __('Deskripsi Pekerjaan') }}</h2>
                        <div class="prose max-w-none">
                            {!! nl2br(e($job->description)) !!}
                        </div>
                    </div>

                    <!-- Job Requirements -->
                    <div class="mb-8">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">{{ __('Persyaratan') }}</h2>
                        <div class="prose max-w-none">
                            {!! nl2br(e($job->requirements)) !!}
                        </div>
                    </div>

                    <!-- Applications -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-medium text-gray-900">{{ __('Pelamar') }} ({{ $job->applications_count }})</h2>
                            <a href="{{ route('applications.index', ['job_id' => $job->id]) }}" class="text-blue-600 hover:text-blue-900">
                                {{ __('Lihat Semua') }} →
                            </a>
                        </div>
                        @if($job->applications->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Nama') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Email') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Tanggal Melamar') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Status') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Aksi') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($job->applications->take(5) as $application)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $application->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">{{ $application->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $application->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                        {{ $application->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                        {{ $application->status === 'shortlisted' ? 'bg-blue-100 text-blue-800' : '' }}
                                                        {{ $application->status === 'interviewed' ? 'bg-purple-100 text-purple-800' : '' }}
                                                        {{ $application->status === 'accepted' ? 'bg-green-100 text-green-800' : '' }}
                                                        {{ $application->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                                {{ ucfirst($application->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('applications.show', $application) }}" class="text-blue-600 hover:text-blue-900">
                                                {{ __('Detail') }}
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p class="text-gray-500 text-center py-4">{{ __('Belum ada pelamar') }}</p>
                        @endif
                    </div>

                    <!-- Additional Information -->
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">{{ __('Informasi Tambahan') }}</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Tanggal Mulai') }}</p>
                                <p class="mt-1">{{ $job->start_date->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Tanggal Berakhir') }}</p>
                                <p class="mt-1">{{ $job->end_date->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Dibuat Pada') }}</p>
                                <p class="mt-1">{{ $job->created_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Diperbarui Pada') }}</p>
                                <p class="mt-1">{{ $job->updated_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('jobs.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Kembali') }}
                        </a>
                        @if($job->status === 'active')
                        <a href="{{ route('applications.create', ['job_id' => $job->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Lamar Sekarang') }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>