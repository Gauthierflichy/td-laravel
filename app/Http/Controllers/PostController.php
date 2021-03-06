<?php

namespace App\Http\Controllers;



use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('projets.index')->with(compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all()->lists('name', 'id');
        return view('projets.create')->with(compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\ValidatePostRequest $request)
    {

        $post = new Post;

        $post->title    = $request->title;
        $post->user_id  = $request->user()->id;
        $post->client  = $request->client;
        $post->client_metier  = $request->client_metier;
        $post->client_tel  = $request->client_tel;
        $post->client_email  = $request->client_email;
        $post->client_adresse  = $request->client_adresse;
        $post->client_suivi  = $request->client;
        $post->client_suivi_metier  = $request->client_metier;
        $post->client_suivi_tel  = $request->client_tel;
        $post->client_suivi_email  = $request->client_email;
        $post->client_suivi_adresse  = $request->client_adresse;
        $post->fiche_identite    = $request->fiche_identite;
        $post->type_projet  = $request->type_projet;
        $post->context  = $request->context;
        $post->demande  = $request->demande;
        $post->objectifs  = $request->objectifs;
        $post->contraintes  = $request->contraintes;

        $post->save();

        return redirect()
            ->route('projets.show', $post->id)
            ->with(compact('post'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        //dd($post);

        if (!$post){
            return redirect()->to('/projets');
        }

        return view('projets.show')->with(compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $users = User::all()->lists('name', 'id');

        if (!$post){
            return redirect()->to('/projets');
        }

        return view('projets.edit')->with(compact('post', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ValidatePostRequest $request, $id)
    {

        $post = Post::find($id);

        $post->title    = $request->title;
        $post->user_id  = $request->user_id;
        $post->client  = $request->client;
        $post->client_metier  = $request->client_metier;
        $post->client_tel  = $request->client_tel;
        $post->client_email  = $request->client_email;
        $post->client_adresse  = $request->client_adresse;
        $post->client_suivi  = $request->client;
        $post->client_suivi_metier  = $request->client_metier;
        $post->client_suivi_tel  = $request->client_tel;
        $post->client_suivi_email  = $request->client_email;
        $post->client_suivi_adresse  = $request->client_adresse;
        $post->fiche_identite    = $request->fiche_identite;
        $post->type_projet  = $request->type_projet;
        $post->context  = $request->context;
        $post->demande  = $request->demande;
        $post->objectifs  = $request->objectifs;
        $post->contraintes  = $request->contraintes;
        $post->save();

        return redirect()->route('projets.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();

        return redirect()->route('projets.index');

    }

}
