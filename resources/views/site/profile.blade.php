@extends('site.layout')


@section('content')

@if ($errors->any())

<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>	
    <h4><strong>{{$errors->first()}}</strong></h4>
</div>
@endif

<div class="containerFilm">
    <div class="avatarUser" style="background-image: url('/storage/app/public/upload/users/{{$user['avatar']}}')">
    </div>
    <form id="profileUpdate" action="/public/profile/update" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="descUser">
            <div class="descProfile"><p>Имя:</p></div><div class="valueName"> {{$user['name']}} </div>
            <div class="descProfile"><p>Е маил:</p></div><div class="valueEmail">{{$user['email']}} </div>

            <div class="form-group">
                <input type="file" name="updateprofile" class="form-control-file" id="exampleFormControlFile1" disabled="disabled">
            </div>

        </div>
        <button type="button" class="btn btn-warning editProfile">Редактировать</button>
    </form>
   
<div class="clearProfile"></div>
    <table class="table table-bordered filmsLike">
        <tr>
            <th> Понравившиеся фильмы: </th>
        </tr>
        @foreach($like as $keyl => $valuel)
        <tr>
            <td><a href="/public/film/{{$valuel->id}}">{{$valuel->nameRus}}</a></td>
        </tr>
        @endforeach
    </table>

    <table class="table table-bordered filmsDislike">
        <tr>
            <th> Не понравившиеся фильмы:</th>
        </tr>
        @foreach($dislike as $keyd => $valued)
        <tr>
            <td><a href="/public/film/{{$valued->id}}">{{$valued->nameRus}}</a></td>
        </tr>
        @endforeach
    </table>

    <table class="table table-bordered filmsWatched">
        <tr>
            <th> Смотренные фильмы: </th>
        </tr>
        @foreach($watched as $keyw => $valuew)
        <tr>
            <td><a href="/public/film/{{$valuew->id}}">{{$valuew->nameRus}}</a></td>
        </tr>
        @endforeach
    </table>

    <table class="table table-bordered filmsLater">
        <tr>
            <th> Смотреть позже: </th>
        </tr>
        @foreach($later as $key => $value)
        <tr>
            <td><a href="/public/film/{{$value->id}}">{{$value->nameRus}}</a></td>
        </tr>
        @endforeach
    </table>





    @endsection