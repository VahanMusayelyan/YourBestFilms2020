@extends('site.layout')


@section('content')

@if ($errors->any())

<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>	
    <h4><strong>{{$errors->first()}}</strong></h4>
</div>
@endif

<div class="contentFilms">



    <?php if ($list == 1) { ?>

<!--        <div class="attribute"><span class="headerCont">Каталог фильмов</span>
            <button class="btn list" data-toggle="dropdown" href="#"><i class="fa fa-th activeicon"></i> <i class="fa fa-caret-down"></i></button>
            <div class="dropdown-menu filter-list-bar">
                <form action="{{'/public/list'}}" method="POST">@csrf<button class="btn btn-default list-type" value="bars"> <i class="fas fa-list"></i></button></form>
                <form action="{{'/public'}}" method="POST">@csrf<button class="btn btn-default list-type" value="square"> <i class="fa fa-th"></i></li></button></form>
            </div>

            <div class="filmsCount"><span style="font-weight: 600;margin-left:15px;color: green">Фильмов: <?= $count ?></span></div>
        </div>-->



        <?php
//        foreach ($result as $key => $value) {
//
//            echo '<div class = "filmDiv">'
//            . '<p style = "text-align:center"> '
//            . '<a href = "http://films/public/film/' . $value->id . '" class = "filmsName">'
//            . '<img class = "film" src = "/storage/app/public/' . $value->img . '">'
//            . $value->nameRus . ' (' . $value->year . ') '
//            . ' <br><span class="likespan"> ' . $value->like . ' </span> / <span class="dislikespan">' . $value->dislike . '</span></p></a>'
//            . '</div>';
//        }
    } else {
        ?>

        <div class="attribute"><span class="headerCont">Каталог фильмов</span>
            <button class="btn list" data-toggle="dropdown" href="#"><i class="fas fa-list activeicon"></i> <i class="fa fa-caret-down"></i></button>
            <div class="dropdown-menu filter-list-bar">
                <form action="{{'/public/list'}}" method="POST">@csrf<button class="btn btn-default list-type" value="bars"> <i class="fas fa-list"></i></button></form>
                <form action="{{'/public'}}" method="POST">@csrf<button class="btn btn-default list-type" value="square"> <i class="fa fa-th"></i></li></button></form>
            </div>

            <div class="filmsCount"><span style="font-weight: 600;margin-left:15px;color: green">Фильмов: <?= $count ?></span></div>
        </div>


        <?php foreach ($result as $key => $value) {
            ?>
            <div class = "filmDivList">
                <div>
                    <a href = "/public/film/{{$value->id}}" class = "filmsName filmListName">
                        <img class = "film" src = "/storage/app/public/{{$value->img }}" />

                    </a>
                    <div style="float: left;width: 74%; margin-left: 15px;">
                        <ul class="list-group">
                            <li class="list-group-item"><a href = "http://films/public/film/{{$value->id}}" class = "filmsName filmListName">
                                    <?= str_replace($search, "<span style='color:red'>" . $search . "</span>", $value->nameRus) ?>

                                </a>
                                <div class="like_dislike"><span class="likespan"> {{ $value->like }} </span> / 
                                    <span class="dislikespan">{{ $value->dislike }}</span></div>
                            </li>
                            <li class="list-group-item"><b>Год:</b> <span class="value"> {{ $value->year }}</span></li>
                            <li class="list-group-item">
                                <b>Жанр:</b>
                                <span class="value">
                                    @foreach($value['categories'] as $key => $categories)
                                    @if($key == count($value['categories'])-1)
                                    {{$categories->category}}
                                    @else
                                    {{$categories->category}} ,
                                    @endif
                                    @endforeach
                                </span>
                            </li>
                            <li class="list-group-item"><b>Страна:</b>
                                <span class="value">
                                    @foreach($value['countries'] as $key => $countries)
                                    @if($key == count($value['countries'])-1)
                                    {{$countries->country}}
                                    @else
                                    {{$countries->country}} ,
                                    @endif
                                    @endforeach
                                </span>
                            </li>
                            <li class="list-group-item"><b>Описание:</b> <span class="textdesc">: 
                                    <?= str_replace($search, "<span style='color:red'>" . $search . "</span>", $value->description) ?></span></li>
                        </ul>

                    </div>
                    <a class="watchOnline" href = "/public/film/{{$value->id}}" class = "filmsName filmListName">Смотреть онлайн »</a>
                </div>

            </div>
            <hr>
            <?php
        }
    }
    ?>








</div>




@if($result->lastPage()>1)

<?php
$result->appends(['search' => $search])->links();
$page = 1;
$page = $result->currentPage();
$last = $result->lastPage();

if ($page + 6 > $last) {
    if ($last > 6) {
        $range = $result->getUrlRange($last - 6, $last);
    } else {
        $range = $result->getUrlRange(1, $last);
    }
} else if ($page - 6 < 1) {
    $range = $result->getUrlRange(1, 6);
} else {
    $range = $result->getUrlRange($page, $page + 6);
}
?>

<div class="page">
    <div class="containerpage">


        <nav>
            <ul class="pagination">
                <?php
                if ($page + 6 > $last) {

                    $position = ($page - 1) * 46.5;
                    if ($page == 1) {
                        echo '<li class="page-item previous round">
                                <a style="opacity:0.5;padding:5px 15.5px 7px 15.5px;" class="page-link" rel="previous"> &#8249; </a>
                              </li>';
                    } else {
                        echo '<li class="page-item previous round">
                                <a style="padding:5px 15.5px 7px 15.5px;" class="page-link" href="http://films/public/?page=' . ($page - 1) . '" rel="previous"> &#8249; </a>
                              </li>';
                    }


                    if ($last > 6) {

                        for ($j = $last - 5; $j < $last + 1; $j++) {
                            if (array_search($range[$j], $range) > 9) {
                                echo '<li data-value="' . $j . '" class="page-item index"><a style="padding:7px 8px;"  class="page-link"  href="' . $range[$j] . '">' . $j . '</a></li>';
                            } else {
                                echo '<li data-value="' . $j . '" class="page-item index"><a style="padding:6px 12px;" class="page-link"  href="' . $range[$j] . '"> ' . $j . ' </a></li>';
                            }
                        }
                    } else {
                        for ($d = 1; $d < $last + 1; $d++) {
                            $numb = array_search($range[$d], $range);

                            if ($numb > 9) {
                                echo '<li data-value="' . $d . '" class="page-item index"><a style="padding:7px 8px;"  class="page-link"  href="' . $range[$d] . '">' . $d . '</a></li>';
                            } else {
                                echo '<li data-value="' . $d . '" class="page-item index"><a style="padding:6px 12px;" class="page-link"  href="' . $range[$d] . '"> ' . $d . ' </a></li>';
                            }
                        }
                    }


                    if ($page == $last) {
                        echo '<li class="page-item next round">
                            <a class="page-link " rel="next" style="opacity:0.5;padding:5px 15.5px 7px 15.5px;"> &#8250; </a>
                        </li>';
                    } else {
                        echo '<li class="page-item next round">
                            <a style="padding:5px 15.5px 7px 15.5px;" class="page-link" href="http://films/public/?page=' . ($page + 1) . '" rel="next"> &#8250; </a>
                        </li>';
                    }


                    echo '<script>'
                    . '$(".pagination li").removeClass("active");'
                    . '$(".pagination li[data-value=' . $page . ']").addClass("active");
                            </script>';
                } else if ($page - 6 < 1) {
                    $position = 46.5;

                    if ($page !== 1) {
                        echo '<li class="page-item previous round">
                                     <a class="page-link" style="padding:5px 15.5px 7px 15.5px;" href="http://films/public/?page=' . ($page - 1) . '" rel="previous"> &#8249; </a>
                                    </li>';
                    } else {
                        echo '<li class="page-item previous round">
                                     <a class="page-link"  rel="previous" style="opacity:0.5;padding:5px 15.5px 7px 15.5px;"> &#8249; </a>
                                    </li>';
                    }

                    for ($k = 1; $k < 7; $k++) {
                        if (array_search($range[$k], $range) > 9) {
                            echo '<li data-value="' . $k . '" class="page-item index"><a style="padding:7px 8px;"  class="page-link" href="' . $range[$k] . '">' . $k . '</a></li>';
                        } else {
                            echo '<li data-value="' . $k . '" class="page-item index"><a style="padding:6px 12px;"  class="page-link" href="' . $range[$k] . '">' . $k . '</a></li>';
                        }
                    }

                    if ($k !== 5) {
                        echo '<li class="page-item next round">
                            <a style="padding:5px 15.5px 7px 15.5px;" class="page-link" href="http://films/public/?page=' . ($page + 1) . '" rel="next"> &#8250; </a>
                        </li>';
                    } else {
                        echo '<li class="page-item next round">
                                    <a class="page-link"  rel="next" style="opacity:0.5;padding:5px 15.5px 7px 15.5px"> &#8250; </a>
                                </li>';
                    }


                    echo '<script>'
                    . '$(".pagination li").removeClass("active");'
                    . '$(".pagination li[data-value=' . $page . ']").addClass("active");'
                    . 'x = $(".pagination li[data-value=' . $page . ']").position();
                      </script>';
                } else {
                    $position = 46.5;

                    for ($i = $page; $i < ($page + 6); $i++) {

                        if ($i == $page) {
                            echo '<li class="page-item previous round">
                                     <a class="page-link" style="padding:5px 15.5px 7px 15.5px;" href="http://films/public/?page=' . ($page - 1) . '" rel="previous"> &#8249; </a>
                                    </li>';
                        }
                        if (array_search($range[$i], $range) > 9) {
                            echo '<li data-value="' . $i . '" class="page-item index"><a style="padding:7px 8px;"  class="page-link" href="' . $range[$i] . '">' . $i . '</a></li>';
                        } else {
                            echo '<li data-value="' . $i . '" class="page-item index"><a style="padding:7px 12.5px 7px 12.5px;"  class="page-link" href="' . $range[$i] . '">' . $i . '</a></li>';
                        }

                        if ($i == ($page + 5)) {
                            echo '<li class="page-item next round">
                            <a class="page-link" style="padding:5px 15.5px 7px 15.5px;" href="http://films/public/?page=' . ($page + 1) . '" rel="next"> &#8250; </a>
                        </li>';
                        }
                    }

                    echo '<script>'
                    . '$(".pagination li").removeClass("active");'
                    . '$(".pagination li[data-value=' . $page . ']").addClass("active");
                            </script>';
                }
                ?>

            </ul>

        </nav>
        <div class="pagesinput">

            <div class="input-group mb-3 pageInp">
                <span class="rangePages"> {{$page}} / {{$result->lastPage()}}</span>
                <input type="text" class="form-control pageinput" placeholder="Стр." name="page">
                <div class="input-group-append">
                    <a class="btn btn-outline-secondary submitlinks">Ок</a>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="{{ url('/admins/js/indexsearch.js') }}"></script>

@endif



@endsection