@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-neutral-800">Review Management</h1>
        @if($pendingCount > 0)
            <span class="bg-orange-500 text-white px-4 py-2 rounded-full text-sm font-bold">
                {{ $pendingCount }} Pending Reviews
            </span>
        @endif
    </div>

    <!-- Filter Tabs -->
    <div class="bg-white rounded-lg shadow-sm mb-6">
        <div class="flex border-b">
            <a href="{{ route('admin.reviews.index') }}" 
               class="px-6 py-3 {{ !request('status') ? 'border-b-2 border-primary-500 text-primary-600 font-semibold' : 'text-neutral-600 hover:text-primary-600' }}">
                All Reviews
            </a>
            <a href="{{ route('admin.reviews.index', ['status' => 'pending']) }}" 
               class="px-6 py-3 {{ request('status') === 'pending' ? 'border-b-2 border-primary-500 text-primary-600 font-semibold' : 'text-neutral-600 hover:text-primary-600' }}">
                Pending ({{ $pendingCount }})
            </a>
            <a href="{{ route('admin.reviews.index', ['status' => 'approved']) }}" 
               class="px-6 py-3 {{ request('status') === 'approved' ? 'border-b-2 border-primary-500 text-primary-600 font-semibold' : 'text-neutral-600 hover:text-primary-600' }}">
                Approved
            </a>
        </div>
    </div>

    <!-- Reviews Table -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-neutral-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Rating</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Review</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200">
                @forelse($reviews as $review)
                <tr class="hover:bg-neutral-50">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($review->product->images->first())
                                <img src="{{ asset('storage/' . $review->product->images->first()->image_path) }}" 
                                     alt="{{ $review->product->name }}" 
                                     class="w-12 h-12 rounded object-cover mr-3">
                            @endif
                            <div>
                                <div class="text-sm font-medium text-neutral-900">{{ $review->product->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-neutral-900">{{ $review->user->name }}</div>
                        <div class="text-xs text-neutral-500">{{ $review->user->email }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-neutral-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                            <span class="ml-2 text-sm text-neutral-600">({{ $review->rating }}/5)</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-neutral-900 max-w-xs truncate">
                            {{ $review->comment ?? 'No comment' }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($review->is_approved)
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                Approved
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-neutral-500">
                        {{ $review->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            @if(!$review->is_approved)
                                <form action="{{ route('admin.reviews.approve', $review) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-900 text-sm font-medium">
                                        Approve
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this review?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-neutral-500">
                        No reviews found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $reviews->links() }}
    </div>
</div>
@endsection
