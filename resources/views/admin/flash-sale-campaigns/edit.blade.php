@extends('admin.layouts.app')

@section('title', 'Edit Campaign')
@section('page-title', 'Edit Campaign')
@section('page-description', 'Edit informasi campaign flash sale')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.flash-sale-campaigns.update', $campaign) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6">
            <h3 class="text-lg font-bold text-neutral-900 mb-6">Edit Campaign</h3>
            
            <!-- Name -->
            <div class="mb-5">
                <label class="block text-sm font-semibold text-neutral-700 mb-2">Nama Campaign *</label>
                <input type="text" name="name" value="{{ old('name', $campaign->name) }}" required
                       class="w-full px-4 py-2.5 border border-neutral-300 rounded-lg focus:border-orange-600 focus:ring-2 focus:ring-orange-100 transition">
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-5">
                <label class="block text-sm font-semibold text-neutral-700 mb-2">Deskripsi (Opsional)</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-2.5 border border-neutral-300 rounded-lg focus:border-orange-600 focus:ring-2 focus:ring-orange-100 transition">{{ old('description', $campaign->description) }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Start Time -->
            <div class="mb-5">
                <label class="block text-sm font-semibold text-neutral-700 mb-2">Waktu Mulai *</label>
                <input type="datetime-local" name="start_time" value="{{ old('start_time', $campaign->start_time->format('Y-m-d\TH:i')) }}" required
                       class="w-full px-4 py-2.5 border border-neutral-300 rounded-lg focus:border-orange-600 focus:ring-2 focus:ring-orange-100 transition">
                @error('start_time')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- End Time -->
            <div class="mb-5">
                <label class="block text-sm font-semibold text-neutral-700 mb-2">Waktu Berakhir *</label>
                <input type="datetime-local" name="end_time" value="{{ old('end_time', $campaign->end_time->format('Y-m-d\TH:i')) }}" required
                       class="w-full px-4 py-2.5 border border-neutral-300 rounded-lg focus:border-orange-600 focus:ring-2 focus:ring-orange-100 transition">
                @error('end_time')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Show Teaser -->
            <div class="mb-5">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="show_teaser" value="1" {{ old('show_teaser', $campaign->show_teaser) ? 'checked' : '' }}
                           class="w-5 h-5 text-orange-600 border-neutral-300 rounded focus:ring-2 focus:ring-orange-100">
                    <div>
                        <span class="text-sm font-semibold text-neutral-700">Tampilkan Teaser</span>
                        <p class="text-xs text-neutral-500">Campaign akan ditampilkan sebagai "Coming Soon" di halaman publik sebelum dimulai</p>
                    </div>
                </label>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-4 border-t border-neutral-200">
                <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2.5 rounded-lg font-medium shadow-sm hover:shadow transition">
                    Update Campaign
                </button>
                <a href="{{ route('admin.flash-sale-campaigns.index') }}" class="bg-neutral-100 hover:bg-neutral-200 text-neutral-700 px-6 py-2.5 rounded-lg font-medium transition">
                    Batal
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
