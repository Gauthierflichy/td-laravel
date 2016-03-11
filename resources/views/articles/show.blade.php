
@extends('layouts.app')

@section('content')
    <h2>Article n°{{$article->id}}</h2>
    <h3>Auteur : {{$article->user->name}}</h3>
    <p>{{$article->description}}</p>
    <a href="{{route('articles.edit', $article->id)}}">
        <button>
            Modifier l'article
        </button>
    </a>
    <form action="{{route('articles.destroy', $article->id)}}" method="POST">
        {{csrf_field()}}
    <input type="hidden" name="_method" value="DELETE">
    <input value="supprimer" type="submit" class="form-control">

    </form>
    <h2>Commentaires</h2>
    @foreach($comments as $comment)
        @if($comment->article_id==$article->id)
            <p>{{$comment->user->name}} : {{$comment->com}}</p>
        @endif

    @endforeach




@endsection