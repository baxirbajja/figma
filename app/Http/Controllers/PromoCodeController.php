<?php

namespace App\Http\Controllers;

use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    public function index()
{
    $search = request('search');
    
    $promoCodes = PromoCode::when($search, function($query) use ($search) {
        $query->where('reference', 'like', "%{$search}%")
             ->orWhere('code', 'like', "%{$search}%");
    })
    ->latest()
    ->paginate(10);
    
    return view('promo-codes.index', compact('promoCodes'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reference' => 'required|unique:promo_codes',
            'code' => 'required|unique:promo_codes'
        ]);

        PromoCode::create($validated);
        return redirect()->route('promo-codes.index')
            ->with('success', 'Code promo créé avec succès');
    }

    public function update(Request $request, PromoCode $promoCode)
    {
        $validated = $request->validate([
            'reference' => 'required|unique:promo_codes,reference,' . $promoCode->id,
            'code' => 'required|unique:promo_codes,code,' . $promoCode->id
        ]);

        $promoCode->update($validated);
        return redirect()->route('promo-codes.index')
            ->with('success', 'Code promo modifié avec succès');
    }

    public function destroy(PromoCode $promoCode)
    {
        $promoCode->delete();
        return redirect()->route('promo-codes.index')
            ->with('success', 'Code promo supprimé avec succès');
    }
}