<form action="{{'/public/filter'}}" method="POST" enctype="multipart/form-data">
    @csrf
<ul class="categorylist">
    <p style="margin:5px 0 15px 5px;font-weight: 600">Фильтры для выбора:</p>
    <h5>Категории</h5>
    <div class="categories">
        <?php
        foreach ($arraycategory as $key => $value) {
            echo '<li>'
            . '<input class="catInp" value =' . $value['id'] . ' type="checkbox" class="custom btn btn-default filter" id="category' . $value['id'] . '" name="category[]">'
            . '<label for="category' . $value['id'] . '">'
            . $value['category'] . '</label>'
            . '</li>';
        }
        ?>
        <li class="unselect">Oтменить категории</li>
    </div>
    <hr>
    <h5> Годы </h5>
    <div class="years">
        <?php
        foreach ($arrayyear as $keyy => $valuey) {
            if ($keyy < 10) {
                echo '<li>'
                . '<input class="yearsInp" type="checkbox" value="' . $valuey->year . '" class="custom btn btn-default filter" id="year' . $valuey->year . '" name="year[]">'
                . '<label for="year' . $valuey->year . '">'
                . $valuey->year . '</label>'
                . '</li>';
            }
        }
        ?>
    </div>

    <li id="openDiv"><span data-toggle="dropdown" href="#">Показать все годы</span>

        <ul class="dropdown-menu filter-list-year">
            <?php
            foreach ($arrayyear as $keyy => $valuey) {
                echo '<li>'
                . '<input class="yearsInp yearsdetails" value="' . $valuey->year . '" type="checkbox" class="custom btn btn-default filter" id="year_' . $valuey->year . '" name="year_all[]">'
                . '<label for="year_' . $valuey->year . '">'
                . $valuey->year . '</label>'
                . '</li>';
            }
            ?>



        </ul>
        
    </li>
    <li class="unselectYear">Oтменить годы</li>



    <li><button class="btn btn-primary andbtn">ПОИСК</button></li>
    

</ul>
</form>