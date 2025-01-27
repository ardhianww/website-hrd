@extends('layouts.app')

@section('header')
Detail Pengajuan Cuti
@endsection

@section('content')
<div class="bg-white shadow sm:rounded-lg">
    <div class="px-4 py-5 sm:p-6">
        <!-- Header with Actions -->
        <div class="md:flex md:items-center md:justify-between md:space-x-4 xl:border-b xl:pb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $leave->employee->name }}</h2>
                <p class="mt-2 text-sm text-gray-500">{{ $leave->employee->department }} - {{ $leave->employee->position }}</p>
            </div>
            <div class="mt-4 flex space-x-3 md:mt-0">
                @if(auth()->user()->is_admin || auth()->id() == $leave->employee_id)
                <a href="{{ route('leaves.edit', $leave) }}" class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    Edit
                </a>
                <form action="{{ route('leaves.destroy', $leave) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="inline-flex justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Hapus
                    </button>
                </form>
                @endif
            </div>
        </div>

        <!-- Leave Status -->
        <div class="mt-6 border-b border-gray-200 pb-6">
            <h3 class="text-lg font-medium text-gray-900">Status Pengajuan</h3>
            <div class="mt-4">
                @php
                $statusClasses = [
                'pending' => 'bg-yellow-100 text-yellow-800',
                'approved' => 'bg-green-100 text-green-800',
                'rejected' => 'bg-red-100 text-red-800'
                ];
                $statusLabels = [
                'pending' => 'Pending',
                'approved' => 'Disetujui',
                'rejected' => 'Ditolak'
                ];
                @endphp
                <span class="inline-flex items-center rounded-full px-3 py-0.5 text-sm font-medium {{ $statusClasses[$leave->status] }}">
                    {{ $statusLabels[$leave->status] }}
                </span>
            </div>
        </div>

        <!-- Leave Details -->
        <div class="mt-6 border-b border-gray-200 pb-6">
            <h3 class="text-lg font-medium text-gray-900">Detail Cuti</h3>
            <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Tipe Cuti</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        @php
                        $typeLabels = [
                        'annual' => 'Tahunan',
                        'sick' => 'Sakit',
                        'maternity' => 'Melahirkan',
                        'marriage' => 'Menikah',
                        'other' => 'Lainnya'
                        ];
                        @endphp
                        {{ $typeLabels[$leave->type] }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Durasi</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $leave->duration }} hari</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Tanggal Mulai</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $leave->start_date->format('d F Y') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Tanggal Selesai</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $leave->end_date->format('d F Y') }}</dd>
                </div>
            </dl>
        </div>

        <!-- Reason and Attachment -->
        <div class="mt-6 border-b border-gray-200 pb-6">
            <h3 class="text-lg font-medium text-gray-900">Alasan dan Dokumen</h3>
            <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Alasan Cuti</dt>
                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $leave->reason }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Lampiran</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        @if($leave->attachment_path)
                        <a href="{{ asset('storage/' . $leave->attachment_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">
                            {{ basename($leave->attachment_path) }}
                        </a>
                        @else
                        <span class="text-gray-500">Tidak ada lampiran</span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>

        <!-- Approval Information -->
        @if($leave->status !== 'pending')
        <div class="mt-6 border-b border-gray-200 pb-6">
            <h3 class="text-lg font-medium text-gray-900">Informasi Persetujuan</h3>
            <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Disetujui/Ditolak Oleh</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $leave->approved_by ? $leave->approver->name : '-' }}</dd>
                </div>
                @if($leave->status === 'rejected')
                <div>
                    <dt class="text-sm font-medium text-gray-500">Alasan Penolakan</dt>
                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $leave->rejection_reason ?: 'Tidak ada alasan' }}</dd>
                </div>
                @endif
            </dl>
        </div>
        @endif
    </div>

    <!-- Footer -->
    <div class="bg-gray-50 px-4 py-4 sm:px-6">
        <div class="flex justify-between">
            <a href="{{ route('leaves.index') }}" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
            <div class="text-sm text-gray-500">
                <p>Dibuat pada: {{ $leave->created_at->format('d F Y H:i') }}</p>
                @if($leave->updated_at->ne($leave->created_at))
                <p>Diperbarui pada: {{ $leave->updated_at->format('d F Y H:i') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection