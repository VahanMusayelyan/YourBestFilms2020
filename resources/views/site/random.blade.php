@extends('site.layout')


@section('content')

@foreach($result as $key=> $value)
<div class="containerFilm">
    <div class="imgFilm">
        <img src="/storage/app/public/<?= $value->img ?>">
    </div>
    <div class="descFilm">
        <div class="desc"><p>Name English:</p></div><div class="value">  <?= $value->nameEng ?></div>
        <div class="desc"><p>Name Russian:</p></div><div class="value">  <?= $value->nameRus ?></div>
        <div class="desc"><p>Category:</p></div>
        <div class="value" style="margin-left: -5px">
            <?php
            $countcat = count($category);
            foreach ($category as $keycat => $valuecat) {
                if ($keycat == $countcat - 1) {
                    echo $valuecat->category;
                } else {
                    echo $valuecat->category . ", ";
                }
            }
            ?></div>

        <div class="desc"><p>Country:</p></div> 
        <div class="value" style="margin-left: -5px">
            <?php
            $countcount = count($countries);


            foreach ($countries as $keycount => $valuecount) {

                if ($keycount == $countcount - 1) {
                    echo $valuecount->country;
                } else {
                    echo $valuecount->country . ", ";
                }
            }
            ?>
        </div>

        <div class="desc"><p>Year:</p></div><div class="value"> <?= $value->year ?></div>
        <div class="desc half"><p>Rating Imdb:</p></div><div class="value"> <?= $value->ratingImdb ?></div>
        <div class="desc half"><p>Rating Kinopoisk:</p></div><div class="value"> <?= $value->ratingKinopoisk ?></div>
        <div class="desc"><p>Duration:</p></div><div class="value"> <?= $value->duration ?> minute</div>
        <div><div class="description" style="float: left;width: 170px;font-weight: bold">Description:</div><span class="textdesc"> <?= $value->description ?></span></div>



        <div class="btn-group likDislike">

            <button class="btn btn-info likedislike" data-toggle="modal" data-value="1" data-id="{{$value->id}}">

                <?php
                if (count($status_film) > 0) {
                    if ($status_film[0]->status == 1) {
                        echo '<i class="fa fa-thumbs-up" style="color: #9e0505"></i> Нравится';
                    } else {
                        echo '<i class="fa fa-thumbs-up"></i> Нравится';
                    }
                } else {
                    echo '<i class="fa fa-thumbs-up"></i> Нравится';
                }
                ?>
            </button>

            <button class="btn btn-info likedislike" data-toggle="modal" data-value="0" data-id="{{$value->id}}">
                <?php
                if (count($status_film) > 0) {
                    if ($status_film[0]->status == 0) {
                        echo '<i class="fa fa-thumbs-down" style="color: #9e0505"></i>';
                    } else {
                        echo '<i class="fa fa-thumbs-down"></i>';
                    }
                } else {
                    echo '<i class="fa fa-thumbs-down"></i>';
                }
                ?>
            </button>
            <button class="btn btn-info btn-watch-want-big" data-id="{{$value->id}}">
                <?php
                if (count($later_film) > 0) {

                    echo '<i class="fa fa-clock-o color"></i>';
                } else {
                    echo '<i class="fa fa-clock-o"></i>';
                }
                ?>
                Смотреть позже        

            </button>


            <button class="btn btn-info btn-watch-watched-big" data-id="{{$value->id}}">
                <?php
                if (count($watched_film) > 0) {

                    echo '<i class="fa fa-eye color"></i>';
                } else {
                    echo '<i class="fa fa-eye"></i>';
                }
                ?>



                Смотрел/a</button>

        </div>
    </div>


    <div class="video">
        <iframe id="cdn-player" class="ifram" src="<?= $value->videourl ?>" frameborder="0" scrolling="no" allowfullscreen=""></iframe>
    </div>

    <div class="comment">
        <h2>Comments</h2>
        <form action="{{url('/film/'.$value->id.'/comment')}}" method="POST" enctype="multipart/form-data">@csrf
            <textarea class="writecomment" name="comment" placeholder="Поделитесь с нами своим мнением" <?php if (!session()->has('role')) echo 'disabled="disabled" style="opacity:0.4"'; ?>></textarea>
            <button class="btn btn-info submit" data-toggle="modal" data-id="{{$value->id}}" <?php if (!session()->has('role')) echo 'disabled="disabled" style="opacity:0.4"'; ?>>Отправить</button>
        </form>
        <hr>

        <div class="right">USER:
            <p>COMMENT</p>
        </div>
        <div class="left">USER:
            <p>COMMENT</p>
        </div>
        <div class="right">USER:
            <p>COMMENT</p>
        </div>
        <div class="left">USER:
            <p>COMMENT</p>
        </div>
        <div class="right">USER:
            <p>COMMENT</p>
        </div>
        <div class="left">USER:
            <p>COMMENT</p>
        </div>

    </div>



</div>

@endforeach


@endsection