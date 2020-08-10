@extends('site.layout')


@section('content')

@if ($errors->any())

<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>	
    <h4><strong>{{$errors->first()}}</strong></h4>
</div>
@endif

<div class="contentFilms">



    <div class="attribute"><span class="headerCont">Каталог фильмов</span>
        <button class="btn list" data-toggle="dropdown" href="#"><i class="fa fa-th activeicon"></i></button>
        

        <div class="filmsCount"><span style="font-weight: 600;margin-left:15px;color: green">Фильмов: <?= $result->total() ?> --</span>

            <?php

            if (!empty($category)) {

                echo "<span class='filtername'>Категории - </span>";
                for ($i = 0; $i < count($category); $i++) {
                    $count = count($category) - 1;
                    if ($i == $count) {
                        echo "<span class='filtervalue'>" . $category[$i]->category . ":</span>";
                    } else {
                        echo "<span class='filtervalue'>" . $category[$i]->category . " , </span>";
                    }
                }
            }

            if (!empty($year)) {
                sort($year);
                echo "<span class='filtername'>Годы - </span>";
                for ($i = 0; $i < count($year); $i++) {
                    $count = count($category) - 1;
                    if ($i == $count) {
                        echo "<span class='filtervalue'>" . $year[$i] . ":</span>";
                    } else {
                        echo "<span class='filtervalue'>" . $year[$i] . " , </span>";
                    }
                }
            }
            ?>

        </div>

    </div>
    <div class="clear"></div>

    <div class="smallFilms">
        

        <?php
        if ($list == 1){
            foreach ($result as $key => $value) {

                echo '<div class = "filmDiv">'
                . '<p style = "text-align:center"> '
                . '<a href = "http://localhost1/public/film/' . $value['id'] . '" class = "filmsName">'
                . '<img class = "film" src = "/storage/app/public/' . $value['img'] . '">'
                . $value['nameRus'] . ' (' . $value['year'] . ') '
               . ' <br><span class="likespan"> ' . $value['like'] . ' </span> / <span class="dislikespan">' . $value['dislike'] . '</span></p></a>'
                . '</div>';
            }
        }else{
        ?>


        <?php
        $array = json_decode(json_encode($result->items()), true);


        foreach ($array as $key => $value) {
            ?>
            <div class = "filmDivList">
                <div>
                    <a href = "/public/film/{{$value['id']}}" class = "filmsName filmListName">
                        <img class = "film" src = "/storage/app/public/{{$value['img'] }}" />

                    </a>
                    <div style="float: left;width: 75%; margin-left: 15px;">
                        <ul class="list-group">
                            <li class="list-group-item"><a href = "http://localhost1/public/film/{{$value['id']}}" class = "filmsName filmListName">
                                    <?= str_replace($category, "<span style='color:red'>" . $category . "</span>", $value['nameRus']) ?>

                                </a>
                                <div class="like_dislike"><span class="likespan"> {{ $value['like'] }} </span> / 
                                    <span class="dislikespan">{{ $value['dislike'] }}</span></div>
                            </li>
                            <li class="list-group-item"><b>Год:</b> <span class="value"> {{ $value['year'] }} </span></li>
                            <li class="list-group-item">
                                <b>Жанр:</b>
                                <span class="value">
                                    <?php
                                    $k = 0;

                                    foreach ($value['categories'] as $key => $cat) {
                                      $last = count($value['categories']) - 1;

                                        if ($k == $last) {
                                            echo $cat['category'];
                                        } else {
                                            echo $cat['category'] . ", ";
                                        }
                                        $k++;
                                    }
                                    ?>

                            </li>
                            <li class="list-group-item">
                                <b>Страны:</b>
                                <span class="value">
                                    <?php
                                    $k = 0;

                                    foreach ($value['countries'] as $key => $country) {
                                      $last = count($value['countries']) - 1;

                                        if ($k == $last) {
                                            echo $country['country'];
                                        } else {
                                            echo $country['country'] . ", ";
                                        }
                                        $k++;
                                    }
                                    ?>

                            </li>


                            <li class="list-group-item"><b>Описание:</b> <span class="textdesc">: 
                                    {{$value['description']}}
                                </span></li>
                        </ul>

                    </div>
                    <a class="watchOnline" href = "/public/film/{{$value['id']}}" class = "filmsName filmListName">Смотреть онлайн »</a>
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
                                <a style="padding:5px 15.5px 7px 15.5px;" class="page-link" href="http://localhost1/public/?page=' . ($page - 1) . '" rel="previous"> &#8249; </a>
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
                            <a style="padding:5px 15.5px 7px 15.5px;" class="page-link" href="http://localhost1/public/?page=' . ($page + 1) . '" rel="next"> &#8250; </a>
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
                                     <a class="page-link" style="padding:5px 15.5px 7px 15.5px;" href="http://localhost1/public/?page=' . ($page - 1) . '" rel="previous"> &#8249; </a>
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
                            <a style="padding:5px 15.5px 7px 15.5px;" class="page-link" href="http://localhost1/public/?page=' . ($page + 1) . '" rel="next"> &#8250; </a>
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
                                     <a class="page-link" style="padding:5px 15.5px 7px 15.5px;" href="http://localhost1/public/?page=' . ($page - 1) . '" rel="previous"> &#8249; </a>
                                    </li>';
        }
        if (array_search($range[$i], $range) > 9) {
            echo '<li data-value="' . $i . '" class="page-item index"><a style="padding:7px 8px;"  class="page-link" href="' . $range[$i] . '">' . $i . '</a></li>';
        } else {
            echo '<li data-value="' . $i . '" class="page-item index"><a style="padding:7px 12.5px 7px 12.5px;"  class="page-link" href="' . $range[$i] . '">' . $i . '</a></li>';
        }

        if ($i == ($page + 5)) {
            echo '<li class="page-item next round">
                            <a class="page-link" style="padding:5px 15.5px 7px 15.5px;" href="http://localhost1/public/?page=' . ($page + 1) . '" rel="next"> &#8250; </a>
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