<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index()
    {
        $publications = Publication::with('user', 'likes', 'comments')->latest()->get();
        return view('publication.feed', compact('publications'));
    }

    public function create()
    {
        return view('publication.create-publication');
    }

    public function store(Request $request)
    {
        // Validation des données d'entrée
        $validatedData = $request->validate([
            'caption' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Traitement de l'upload d'image
        if ($request->hasFile('image')) {
            try {
                // Stocke le fichier et récupère le chemin
                $path = $request->file('image')->store('publications', 'public');
                if (!$path) {
                    return redirect()->back()->withErrors(['image' => 'Image upload failed.']);
                }

                // Création de la publication
                $publication = Publication::create([
                    'caption' => $validatedData['caption'],
                    'image_url' => $path,
                    'user_id' => auth()->id(),
                ]);

                if (!$publication) {
                    return redirect()->back()->withErrors(['publication' => 'Publication creation failed.']);
                }

                return redirect()->route('feed')->with('success', 'Publication created successfully.');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
            }
        }

        return redirect()->back()->withErrors(['image' => 'No image file provided.']);
    }


    public function show($id)
    {
        $publication = Publication::with('user', 'comments', 'likes')->findOrFail($id);
        return view('publication-detail', compact('publication'));
    }

    public function destroy($id)
    {
        $publication = Publication::findOrFail($id);

        if ($publication->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $publication->delete();

        return redirect()->route('feed')->with('success', 'Publication deleted successfully.');
    }
}
