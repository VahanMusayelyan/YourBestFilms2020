@extends('dashboard.layout')


@section('content')
<script>
    $('.nav-link').removeClass('active');
    $('#film_link').addClass('active');
</script>
<div style="width: 87.5%;height: auto;float: right">
    <div class="container-admin">
        <div class="form-horizontal" id="myform4">
            <fieldset>
                <legend>Films</legend>
                <form action="{{route('film.update',$result['id'])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nameEng">Name English:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?= $result['nameEng'] ?>" id="nameEng" placeholder="Enter english name" name="nameEng" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nameRus">Name Russian:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?= $result['nameRus'] ?>" id="nameRus" placeholder="Enter russian name" name="nameRus" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="year">Year:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?= $result['year'] ?>" id="year" placeholder="Enter year" name="year" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group category">
                        <label class="control-label col-sm-2 labelCategory" for="category">Choose Categories:</label>
                        <div class="col-sm-10">
                            <select class="js-example-basic-multiple" name="category[]" multiple="multiple">   
                                <?php
                                foreach ($catArray as $key => $value) {
                                    $keys = $value->id;
                                    $value = $value->category;
                                     foreach ($filmcategory as $filmkey => $filmvalue) {
                                        $filmKey = $filmvalue->id;
                                         if($filmKey == $keys){
                                              echo "<option value=".$keys." selected>".$value."</option>";
                                         }else{
                                              echo "<option value=".$keys.">".$value."</option>";
                                         }
                                       
                                     }
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-group category">
                        <label class="control-label col-sm-2 labelCategory" for="country">Choose Countries:</label>
                        <div class="col-sm-10">
                            <select class="js-example-basic-multiple" name="country[]" multiple="multiple">
                                <?php
                                foreach ($countArray as $key => $value) {
                                    $keys = $value->id;
                                    $value = $value->country;
                                    foreach ($filmcountry as $filmkey => $filmvalue) {
                                        $filmKey = $filmvalue->id;
                                        if ($filmKey == $keys) {
                                            echo "<option value=" . $keys . " selected>" . $value . "</option>";
                                        } else {
                                            echo "<option value=" . $keys . ">" . $value . "</option>";
                                        }
                                    }
                                }
                                ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="ratingImb">Rating IMDB:</label>
                        <div class="col-sm-10 rate">
                            <input type="text" class="form-control" id="ratingImdb" value="<?= $result['ratingImdb'] ?>"  placeholder="Enter rating Imdb" name="ratingImdb" autocomplete="off" min="1" max="10">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2 labelKinopoisk" for="ratingKinopoisk">Rating Kinopoisk:</label>
                        <div class="col-sm-10 rate">
                            <input type="text" class="form-control" id="ratingKinopoisk" value="<?= $result['ratingKinopoisk'] ?>"  placeholder="Enter rating Kinopoisk" name="ratingKinopoisk" autocomplete="off" min="1" max="10">
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="videourl" style="clear: both;">Video Url:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="videourl"  value="<?= $result['videourl'] ?>"  placeholder="Enter video url" name="videourl" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="duration">Duration:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="duration" value="<?= $result['duration'] ?>" placeholder="Enter duration by minutes" name="duration" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="description">Description:</label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" id="description" placeholder="Enter description" name="description" autocomplete="off"><?= $result['description'] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group fileDiv">
                        <div class="custom-file">
                            <label class="custom-file-label" for="customFile">Choose poster file</label>
                            <input type="file" class=" btn btn-default custom-file-input file" id="file" name="file">
                        </div> 
                        <img src="/storage/app/public/{{$result['img']}}" width="130" height="200">
                    </div>  

                    <div class="form-group butbut">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default submitFilm but_upload">Submit</button>
                        </div>
                    </div>

                </form>
            </fieldset>
            <a class="btn btn-warning partnerAdd" href="/public/admin/film">SHOW FILMS</a>
        </div> 
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
</div>

@endsection