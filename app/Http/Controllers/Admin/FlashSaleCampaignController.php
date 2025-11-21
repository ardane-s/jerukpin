<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlashSaleCampaign;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\FlashSale;
use App\Services\FlashSaleCampaignService;
use Illuminate\Http\Request;

class FlashSaleCampaignController extends Controller
{
    /**
     * Display a listing of campaigns
     */
    public function index()
    {
        $activeCampaign = FlashSaleCampaign::active()->first();
        $upcomingCampaigns = FlashSaleCampaign::upcoming()->get();
        $endedCampaigns = FlashSaleCampaign::ended()->paginate(10);

        return view('admin.flash-sale-campaigns.index', compact(
            'activeCampaign',
            'upcomingCampaigns',
            'endedCampaigns'
        ));
    }

    /**
     * Show the form for creating a new campaign
     */
    public function create()
    {
        return view('admin.flash-sale-campaigns.create');
    }

    /**
     * Store a newly created campaign
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'show_teaser' => 'boolean',
        ]);

        $validated['status'] = 'scheduled';
        $validated['is_active'] = false;
        $validated['show_teaser'] = $request->has('show_teaser');

        $campaign = FlashSaleCampaign::create($validated);

        return redirect()
            ->route('admin.flash-sale-campaigns.products', $campaign)
            ->with('success', 'Campaign berhasil dibuat! Sekarang tambahkan produk.');
    }

    /**
     * Show campaign products management
     */
    public function products(FlashSaleCampaign $campaign)
    {
        $campaign->load(['flashSales.productVariant.product']);
        $products = Product::with(['variants', 'category', 'images'])
            ->where('is_active', true)
            ->get();

        return view('admin.flash-sale-campaigns.products', compact('campaign', 'products'));
    }

    /**
     * Add product to campaign
     */
    public function addProduct(Request $request, FlashSaleCampaign $campaign)
    {
        $validated = $request->validate([
            'product_variant_id' => 'required|exists:product_variants,id',
            'flash_price' => 'required|numeric|min:0',
            'flash_stock' => 'required|integer|min:1',
        ]);

        $variant = ProductVariant::findOrFail($validated['product_variant_id']);
        
        // Check if already exists in campaign
        $exists = FlashSale::where('campaign_id', $campaign->id)
            ->where('product_variant_id', $variant->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Produk sudah ada dalam campaign ini!');
        }

        FlashSale::create([
            'campaign_id' => $campaign->id,
            'product_variant_id' => $variant->id,
            'original_price' => $variant->price,
            'flash_price' => $validated['flash_price'],
            'flash_stock' => $validated['flash_stock'],
            'flash_sold' => 0,
            'start_time' => $campaign->start_time,
            'end_time' => $campaign->end_time,
            'is_active' => false,
        ]);

        return back()->with('success', 'Produk berhasil ditambahkan ke campaign!');
    }

    /**
     * Remove product from campaign
     */
    public function removeProduct(FlashSaleCampaign $campaign, FlashSale $flashSale)
    {
        if ($flashSale->campaign_id !== $campaign->id) {
            return back()->with('error', 'Produk tidak ditemukan dalam campaign ini!');
        }

        if ($flashSale->flash_sold > 0) {
            return back()->with('error', 'Tidak dapat menghapus produk yang sudah terjual!');
        }

        $flashSale->delete();

        return back()->with('success', 'Produk berhasil dihapus dari campaign!');
    }

    /**
     * Show the form for editing campaign
     */
    public function edit(FlashSaleCampaign $campaign)
    {
        if (!FlashSaleCampaignService::canEdit($campaign)) {
            return redirect()
                ->route('admin.flash-sale-campaigns.index')
                ->with('error', 'Campaign yang sudah dimulai tidak dapat diedit!');
        }

        return view('admin.flash-sale-campaigns.edit', compact('campaign'));
    }

    /**
     * Update the specified campaign
     */
    public function update(Request $request, FlashSaleCampaign $campaign)
    {
        if (!FlashSaleCampaignService::canEdit($campaign)) {
            return back()->with('error', 'Campaign yang sudah dimulai tidak dapat diedit!');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'show_teaser' => 'boolean',
        ]);

        $validated['show_teaser'] = $request->has('show_teaser');

        $campaign->update($validated);

        // Update flash sale times
        $campaign->flashSales()->update([
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
        ]);

        return redirect()
            ->route('admin.flash-sale-campaigns.index')
            ->with('success', 'Campaign berhasil diupdate!');
    }

    /**
     * Remove the specified campaign
     */
    public function destroy(FlashSaleCampaign $campaign)
    {
        if (!FlashSaleCampaignService::canDelete($campaign)) {
            return back()->with('error', 'Campaign yang sedang aktif tidak dapat dihapus!');
        }

        $campaign->delete();

        return redirect()
            ->route('admin.flash-sale-campaigns.index')
            ->with('success', 'Campaign berhasil dihapus!');
    }
}
