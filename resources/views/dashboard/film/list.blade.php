@extends('dashboard.layout')


@section('content')
<script>
    $('.nav-link').removeClass('active');
    $('#film_link').addClass('active');
</script>
<div style="width: 87.5%;height: auto;float: right">
    <h1>Films</h1>
    <?php
    $type = 'asc'
    ?>
    <table class="table table-bordered partnerTable">
        <tr>
            <th> ID </th>
            <th> NAME ENGLISH 
                <div style="position: relative">
                    <a class="nameEngAsc fas fa-sort-up" href="<?= '/public/admin/film/filter/nameEng/asc' ?>"></a>
                    <a class="nameEngDesc fas fa-sort-down" href="<?= '/public/admin/film/filter/nameEng/desc' ?>"></a>
                </div>
            </th>
            <th> NAME RUSSIAN 
                <div style="position: relative">
                    <a class="nameRusAsc fas fa-sort-up" href="<?= '/public/admin/film/filter/nameRus/asc' ?>"></a>
                    <a class="nameRusDesc fas fa-sort-down" href="<?= '/public/admin/film/filter/nameRus/desc' ?>"></a>
                </div>
            </th>
            <th> YEAR 
                <div style="position: relative">
                    <a class="yearAsc fas fa-sort-up" href="<?= '/public/admin/film/filter/year/asc' ?>"></a>
                    <a class="yearDesc fas fa-sort-down" href="<?= '/public/admin/film/filter/year/desc' ?>"></a>
                </div>
            </th>
            <th> IMDB 
                <div style="position: relative">
                    <a class="ratingImdbAsc fas fa-sort-up" href="<?= '/public/admin/film/filter/ratingImdb/asc' ?>"></a>
                    <a class="ratingImdbDesc fas fa-sort-down" href="<?= '/public/admin/film/filter/ratingImdb/desc' ?>"></a>
                </div>
            </th>
            <th> KPSK 
                <div style="position: relative">
                    <a class="ratingKinopoiskAsc fas fa-sort-up" href="<?= '/public/admin/film/filter/ratingKinopoisk/asc' ?>"></a>
                    <a class="ratingKinopoiskDesc fas fa-sort-down" href="<?= '/public/admin/film/filter/ratingKinopoisk/desc' ?>"></a>
                </div>
            </th>
            <th> CAT </th>
            <th> COUNTRY </th>
            <th> IMG </th>
            <th>E/D </th>
        </tr>

        <?php
        foreach ($result as $key => $value) {

            echo "<tr>"
            . "<td>" . $value['id'] . "</td>"
            . "<td><a href='/public/admin/film/" . $value['id'] . "'>" . $value['nameEng'] . "</td>"
            . "<td>" . $value['nameRus'] . "</td>"
            . "<td>" . $value['year'] . "</td>"
            . "<td>" . $value['ratingImdb'] . "</td>"
            . "<td>" . $value['ratingKinopoisk'] . "</td>"
            . "<td>";
            foreach ($value->categories as $categories) {
                echo $categories->category . " <br>";
            }
            echo "</td>"
            . "<td>";
            foreach ($value->countries as $countries) {
                echo $countries->country . " <br>";
            }
            echo "</td>"
            . "<td><img class='imageClient' src='/storage/app/public/" . $value['img'] . "' ></td>"
            . "<td class='editAndDelete'><a class='editlink btn btn-info' href='" . url('/admin/film/' . $value['id']) . "/edit'>Edit</a>";
            ?>
            <form action="{{route('film.destroy',$value['id'])}}" method='POST' enctype='multipart/form-data'>
                @csrf
                @method('DELETE')
                <?php
                echo "<button type='submit' class='btn btn-primary'>Delete</button></form></td></tr>";
            }
            ?>




    </table>
    {{ $result->links() }}

    <a class="btn btn-warning partnerAdd" href="/public/admin/film/create">ADD FILM</a>

</div>

@endsection