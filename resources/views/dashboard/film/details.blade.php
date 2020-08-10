@extends('dashboard.layout')


@section('content')
<script>
    $('.nav-link').removeClass('active');
    $('#film_link').addClass('active');
</script>
<div style="width: 82%;height: auto;float: right;">
    <div class="container-admin">
        <div class="form-horizontal" id="myform4">
            <img src='/storage/app/public/<?= $result['img'] ?>' width="400" height="600" style="float: left">
            <div style="float: left;width: 1100px;margin-bottom:50px;">
                <div class="form-group">
                    <div class="header">Name English:</div>
                    <div class="col-sm-10">
                        <?= $result['nameEng'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="header">Name Russian:</div>
                    <div class="col-sm-10">
                        <?= $result['nameRus'] ?> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="header">Category:</div>
                    <div class="col-sm-10">
                        <?php
                     $countCategory = count($result->categories);
                     $i = 0;
                        foreach ($result->categories as $value){
                            $i++;
                           if($i === $countCategory) {
                            echo $value->category;
                          }else{
                               echo $value->category." , ";
                          }

                        }
                     ?> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="header">Country:</div>
                    <div class="col-sm-10">
                        <div class="col-sm-10">
                        <?php
                     $countryCount = count($result->countries);
                     $i = 0;
                        foreach ($result->countries as $value){
                            $i++;
                           if($i === $countryCount) {
                            echo $value->country;
                          }else{
                               echo $value->country." , ";
                          }

                        }
                     ?> 
                    </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="header">Year:</div>
                    <div class="col-sm-10">
                        <?= $result['year'] ?> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="header">Rating IMDB:</div>
                    <div class="col-sm-10 rate">
                        <?= $result['ratingImdb'] ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="header">Rating Kinopoisk:</div>
                    <div class="col-sm-10 rate">
                        <?= $result['ratingKinopoisk'] ?>
                    </div>
                </div>   

                <div class="form-group">
                    <div class="header">Duration:</div>
                    <div class="col-sm-10">
                        <?= $result['duration'] ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="header">Description:</div>
                    <div class="col-sm-10">
                        <?= $result['description'] ?>
                    </div>
                </div>

            <a class="btn btn-warning" href="/public/admin/film">BACK</a>
            <a class="editLinkDetails btn btn-info" href='/public/admin/film/<?=$result['id']?>/edit'>EDIT</a>
            </div>


        </div> 


        <div class="video">
            <iframe id="cdn-player" class="ifram" src="<?= $result['videourl'] ?>" frameborder="0" scrolling="no" allowfullscreen=""></iframe>
        </div>


        
    </div>

</div>
</div>

@endsection