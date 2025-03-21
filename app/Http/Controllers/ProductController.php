<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categorie;

class ProductController extends Controller
{
   // Afficher tous les produits
   public function index()
   {
       $products = Product::with('categorie')->get();
       return response()->json($products);
   }

   // Créer un nouveau produit
   public function store(Request $request)
   {
       $request->validate([
           'name' => 'required|string|max:255',
           'price' => 'required|numeric',
           'categorie_id' => 'required|exists:categories,id',
       ]);

       $product = Product::create($request->all());

       return response()->json($product, 201);
   }

   // Afficher un produit spécifique
   public function show($id)
   {
       $product = Product::with('categorie')->findOrFail($id);
       return response()->json($product);
   }

   // Mettre à jour un produit
   public function update(Request $request, $id)
   {
       $product = Product::findOrFail($id);

       $request->validate([
           'name' => 'required|string|max:255',
           'price' => 'required|numeric',
           'description' => 'nullable|string',
           'categorie_id' => 'required|exists:categories,id',
       ]);

       $product->update($request->all());

       return response()->json($product);
   }

   // Supprimer un produit
   public function destroy($id)
   {
       $product = Product::findOrFail($id);
       $product->delete();

       return response()->json(['message' => 'Produit supprimé avec succès']);
   }
}
