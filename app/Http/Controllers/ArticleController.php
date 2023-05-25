<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    //
    public function articleCreate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:6',
            'category_id' => 'required',
            'text' => 'required|min:30',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput($request->all());
        }


        $image = null;

        if ($request->file('image')) {
            $image = $request->file('image')->store('public/assets/articleImage');
        }

        Article::query()->create(['image' => $image] + $validator->validated());

        return redirect()->route('main');
    }

    public function show($id)
    {

        $article = Article::query()->where('id', $id)->first();

        if ($article === null) {
            return redirect()->route('articles');
        }
        $article->views_count += 1;
        $article->save();

        return view('singleArticle', ['article' => $article]);
    }

    public function destroy($id)
    {
        Article::destroy($id);
        return redirect()->route('articles');

    }


    public function editArticle(Request $request,Article $article){
        $validator  = Validator::make($request->all(),[
            'title' => 'required|min:6',
            'category_id' => 'required',
            'text' => 'required|min:30',

        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        $validated = $validator->validated();

        if($request->file('image')){
            $request->validate(['image' => 'mimes:jpg,jpeg,png']);

            $image = $request->file('image')->store('public/assets/articleImage');
            $validated['image'] = $image;
        }

        $article->update($validated);

        return redirect()->route('singleArticle',$article->id);
    }
}
