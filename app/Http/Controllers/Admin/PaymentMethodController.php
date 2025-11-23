<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::ordered()->get();
        return view('admin.payment-methods.index', compact('paymentMethods'));
    }

    public function create()
    {
        return view('admin.payment-methods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:bank_transfer,e_wallet,cod',
            'method_name' => 'required|string|max:255',
            'account_info' => 'nullable|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'qr_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'instructions' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        // Handle QR image upload
        $qrImagePath = null;
        if ($request->hasFile('qr_image')) {
            $qrImagePath = $request->file('qr_image')->store('payment_qr_codes');
        }

        // Get highest sort order and add 1
        $maxSort = PaymentMethod::max('sort_order') ?? 0;

        PaymentMethod::create([
            'type' => $request->type,
            'method_name' => $request->method_name,
            'account_info' => $request->account_info,
            'account_name' => $request->account_name,
            'qr_image' => $qrImagePath,
            'instructions' => $request->instructions,
            'is_active' => $request->has('is_active'),
            'sort_order' => $maxSort + 1,
        ]);

        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Metode pembayaran berhasil ditambahkan!');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.payment-methods.edit', compact('paymentMethod'));
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $request->validate([
            'type' => 'required|in:bank_transfer,e_wallet,cod',
            'method_name' => 'required|string|max:255',
            'account_info' => 'nullable|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'qr_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'instructions' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        // Handle QR image upload
        $qrImagePath = $paymentMethod->qr_image;
        if ($request->hasFile('qr_image')) {
            // Delete old image if exists
            if ($paymentMethod->qr_image) {
                \Storage::delete($paymentMethod->qr_image);
            }
            $qrImagePath = $request->file('qr_image')->store('payment_qr_codes');
        }

        $paymentMethod->update([
            'type' => $request->type,
            'method_name' => $request->method_name,
            'account_info' => $request->account_info,
            'account_name' => $request->account_name,
            'qr_image' => $qrImagePath,
            'instructions' => $request->instructions,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Metode pembayaran berhasil diperbarui!');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();
        
        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Metode pembayaran berhasil dihapus!');
    }

    public function toggleActive(PaymentMethod $paymentMethod)
    {
        $paymentMethod->update(['is_active' => !$paymentMethod->is_active]);
        
        return back()->with('success', 'Status berhasil diubah!');
    }
}
