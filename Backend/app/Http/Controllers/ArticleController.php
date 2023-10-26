<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Article::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|unique:articles',
        //     'price' => 'required|integer|min:0|max:9',
        //     'image_url' => 'required',
        // ]);

        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'price' => 'required|integer|min:0',
            'image_url' => 'required'
        ]);

        if ($validator->fails()) { 
            return response()->json(['errors' => $validator->errors()], 422);
         }

        //If it's valid, it will proceed
        //If it's not valid, throw a ValidationException

        $article = new Article;
        $article->name = $request->name;
        $article->price = $request->price;
        $article->image_url = $request->image_url;
        $article->save();

        return $article;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => 'Korisnik nije pronađen.'], 404);
        }
    
        $article->update($request->all());
    
        return response()->json(['message' => 'Korisnik uspješno ažuriran.']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $article = Article::find($id);
        $article->delete();

        return 'Uspješno obrisano!';
    }

}
