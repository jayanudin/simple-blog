<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\TagArticle;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::get();
        return view('backend.article.article', compact('articles'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $tags = Tag::get();
        return view('backend.article.create', compact('categories', 'tags'))->with('i');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $file = $request->file('thumbnail');
        $destinationPath = public_path('images');
        $fileName = time().'.'.$request->thumbnail->extension();
        $file->move($destinationPath, $fileName);
        $articles = $request->all();
        $slug_replace_space = str_replace(' ', '-', $articles['slug']);
        $articles['slug'] = strtolower($slug_replace_space);
        $articles['thumbnail'] = $fileName;
        Article::create($articles);

        $articleId = Article::latest()->first()->id;
        foreach ($request->tag_id as $key => $val) {
            $tagArticle = new TagArticle;
            if (in_array($val, $request->tag_id)) {
                $tagArticle->article_id = $articleId;
                $tagArticle->tag_id = $val;
                $tagArticle->save();
            }
        }
       
        return redirect('admin/article')->with('success','article has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $categories = Category::get();
        return view('backend.article.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:50|min:5',
            'slug' => 'required|min:5|max:50',
            'content' => 'required|min:5',
            'status' => 'required',
            'category_id' => 'required',
        ]);
  
        $input = $request->all();
        
        if ($image = $request->file('thumbnail')) {
            $destinationPath = public_path('images');
            $thumbnail = time().'.'.$image->extension();
            $image->move($destinationPath, $thumbnail);
            $input['thumbnail'] = $thumbnail;
        }else{
            unset($input['thumbnail']);
        }
        $slug_replace_space = str_replace(' ', '-', $input['slug']);
        $input['slug'] = strtolower($slug_replace_space);
        $article = Article::find($request->id);
        $article->update($input);
    
        return redirect('admin/article')->with('success','comment has been updated successfully.');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::where('id', $id)->delete();
        return redirect('admin/article')->with('success','Remove data has been successfully.');
    }
}
