<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfilRequest;
use App\Models\Profil;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $profils = Profil::where('status', 'active')->get();

        // Inclure l'URL de l'image pour chaque profil
        $profils->each(function ($profil) {
            $profil->image_url = $profil->image_url;
        });

        return response()->json($profils);
    }

    public function store(ProfilRequest $request)
    {
        $profilData = $request->validated();
    
        if ($request->hasFile('image')) {
            $profilData['image'] = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images/profils', $profilData['image']);
        }
    
        $profil = Profil::create($profilData);
    
        return response()->json($profil, 201);
    }
    

    public function show(Profil $profil)
    {
        $profil->image_url = $profil->image_url;
        return response()->json($profil);
    }

    public function update(ProfilRequest $request, Profil $profil)
    {
        Log::info('Request data:', $request->all());
        Log::info('Request files:', $request->file());        
        
        $profilData = $request->validated();
    
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($profil->image) {
                Storage::disk('public')->delete($profil->image);
            }
            // Stocker la nouvelle image
            $profilData['image'] = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images/profils', $profilData['image']);            
        }

        $profil->update($profilData);
    
        return response()->json($profil);
    }

    public function destroy(Profil $profil)
    {
        if ($profil->image) {
            Storage::disk('public')->delete($profil->image);
        }

        $profil->delete();
        return response()->json(['message' => 'Profil deleted successfully']);
    }
}
