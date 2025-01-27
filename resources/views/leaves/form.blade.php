<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($leave) ? __('Edit Pengajuan Cuti') : __('Ajukan Cuti') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ isset($leave) ? route('leaves.update', $leave) : route('leaves.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($leave))
                        @method('PUT')
                        @endif

                        <!-- Employee Selection (for admin) -->
                        @if(auth()->user()->is_admin)
                        <div class="mb-4">
                            <label for="employee_id" class="block text-sm font-medium text-gray-700">{{ __('Karyawan') }}</label>
                            <select name="employee_id" id="employee_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="">{{ __('Pilih Karyawan') }}</option>
                                @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ (isset($leave) && $leave->employee_id == $employee->id) ? 'selected' : '' }}>
                                    {{ $employee->name }} ({{ $employee->employee_id }})
                                </option>
                                @endforeach
                            </select>
                            @error('employee_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif

                        <!-- Leave Type -->
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">{{ __('Jenis Cuti') }}</label>
                            <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="">{{ __('Pilih Jenis Cuti') }}</option>
                                <option value="annual" {{ (isset($leave) && $leave->type == 'annual') ? 'selected' : '' }}>{{ __('Tahunan') }}</option>
                                <option value="sick" {{ (isset($leave) && $leave->type == 'sick') ? 'selected' : '' }}>{{ __('Sakit') }}</option>
                                <option value="maternity" {{ (isset($leave) && $leave->type == 'maternity') ? 'selected' : '' }}>{{ __('Melahirkan') }}</option>
                                <option value="important_reason" {{ (isset($leave) && $leave->type == 'important_reason') ? 'selected' : '' }}>{{ __('Alasan Penting') }}</option>
                                <option value="unpaid" {{ (isset($leave) && $leave->type == 'unpaid') ? 'selected' : '' }}>{{ __('Tanpa Dibayar') }}</option>
                            </select>
                            @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date Range -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">{{ __('Tanggal Mulai') }}</label>
                                <input type="date" name="start_date" id="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ isset($leave) ? $leave->start_date->format('Y-m-d') : old('start_date') }}" required>
                                @error('start_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">{{ __('Tanggal Selesai') }}</label>
                                <input type="date" name="end_date" id="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ isset($leave) ? $leave->end_date->format('Y-m-d') : old('end_date') }}" required>
                                @error('end_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Reason -->
                        <div class="mb-4">
                            <label for="reason" class="block text-sm font-medium text-gray-700">{{ __('Alasan Cuti') }}</label>
                            <textarea name="reason" id="reason" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ isset($leave) ? $leave->reason : old('reason') }}</textarea>
                            @error('reason')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Attachment -->
                        <div class="mb-4">
                            <label for="attachment" class="block text-sm font-medium text-gray-700">{{ __('Lampiran') }}</label>
                            <input type="file" name="attachment" id="attachment" class="mt-1 block w-full" accept=".pdf,.jpg,.jpeg,.png">
                            @if(isset($leave) && $leave->attachment_path)
                            <p class="mt-2 text-sm text-gray-500">
                                {{ __('File saat ini:') }} <a href="{{ Storage::url($leave->attachment_path) }}" class="text-blue-600 hover:text-blue-900" target="_blank">{{ basename($leave->attachment_path) }}</a>
                            </p>
                            @endif
                            @error('attachment')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status (for admin) -->
                        @if(auth()->user()->is_admin && isset($leave))
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">{{ __('Status') }}</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="pending" {{ $leave->status == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                <option value="approved" {{ $leave->status == 'approved' ? 'selected' : '' }}>{{ __('Disetujui') }}</option>
                                <option value="rejected" {{ $leave->status == 'rejected' ? 'selected' : '' }}>{{ __('Ditolak') }}</option>
                            </select>
                            @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Rejection Reason -->
                        <div class="mb-4" id="rejection_reason_container" style="display: none;">
                            <label for="rejection_reason" class="block text-sm font-medium text-gray-700">{{ __('Alasan Penolakan') }}</label>
                            <textarea name="rejection_reason" id="rejection_reason" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ $leave->rejection_reason ?? old('rejection_reason') }}</textarea>
                            @error('rejection_reason')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('leaves.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                {{ __('Batal') }}
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ isset($leave) ? __('Update') : __('Simpan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('status');
            const rejectionReasonContainer = document.getElementById('rejection_reason_container');

            if (statusSelect && rejectionReasonContainer) {
                statusSelect.addEventListener('change', function() {
                    rejectionReasonContainer.style.display = this.value === 'rejected' ? 'block' : 'none';
                });

                // Set initial state
                rejectionReasonContainer.style.display = statusSelect.value === 'rejected' ? 'block' : 'none';
            }
        });
    </script>
    @endpush
</x-app-layout>