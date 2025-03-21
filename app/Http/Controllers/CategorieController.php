<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

class CategorieController extends Controller
{
    // Afficher toutes les catégories
    public function index()
    {
        $categories = Categorie::all();
        return response()->json($categories);
    }

    // Créer une nouvelle catégorie
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $categorie = Categorie::create($request->all());

        return response()->json($categorie, 201);
    }

    // Afficher une catégorie spécifique
    public function show($id)
    {
        $categorie = Categorie::findOrFail($id);
        return response()->json($categorie);
    }

    // Mettre à jour une catégorie
    public function update(Request $request, $id)
    {
        $categorie = Categorie::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categorie->update($request->all());

        return response()->json($categorie);
    }

    // Supprimer une catégorie
    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();

        return response()->json(['message' => 'Catégorie supprimée avec succès']);
    }
}
