<?php
	require("header.php");

    $products = $product->getList();
    $cat = $cat->getList();
    $integr = $integration->getList();
    $platform = $platform->getList();
    $combination = $combination->getList();
    $solution = $solution->getList();
    $service = $service->getList();

?>
  
  
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
		  
            <h1 class="m-0 text-dark">Starter Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <table class="table table-bordered">

        <tr>
          <th> ID </th>
          <th> NAME </th>
          <th> TYPE SOLUTION </th>
          <th> NAME SERVICE </th>
          <th> PRICE </th>
          <th> DESCRIPTION </th>
          <th> SALE </th>
          <th> TYPE PRODUCT </th>
          <th>Edit / Delet </th>
        </tr>
      <?php

          if(!empty($products)){
            foreach ($products as $key => $value){

              echo "<tr><td>".$value['id']."</td>
                        <td>".$value['name']."</td>
                        <td>".$value['typesolution']."</td>
                        <td>".$value['nameservice']."</td>
                        <td>".$value['price']."</td>
                        <td>".$value['description']."</td>
                        <td>".$value['sale']."</td>
                        <td>".$value['typeprod']."</td>
                        <td><button type='button' class='btn btn-info editProduct' data-id=".$value['id'] ." style='margin-right:5px;'>Edit</button>
                        <button type='button' class='btn btn-primary deleteProduct' data-name='".$value['name']."'  data-id='".$value['id'] ."'>Delete</button>
                        </td></tr>";
            }

          };

      ?>
      </table>
      </div><!-- /.container-fluid -->
      <div class="form-horizontal" id="myform1">
        <form name="addProduct" enctype="multipart/form-data">
        <div class="form-group">
          <label class="control-label col-sm-2" for="product">Product</label>
          <div class="col-sm-10 radioSelect">
            <input type="radio" class="radioInp productInput form-control" id="Product" data-name="product" name="type" value="Product">

          </div>
          <label class="control-label col-sm-2" for="service">Service</label>
          <div class="col-sm-10 radioSelect">
            <input type="radio" class="radioInp productInput form-control" id="Service" data-name="service" name="type" value="Service">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="nameProduct">Product Name</label>
          <div class="col-sm-10">
            <input type="text" class="productInput form-control" id="nameProduct" data-id="" data-product="" data-image="" placeholder="Enter Name" name="nameProduct" autocomplete="off">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="priceProduct">Product Price</label>
          <div class="col-sm-10">
            <input type="text" class="productInput form-control" id="priceProduct" data-id="" placeholder="Enter Price" name="priceProduct" autocomplete="off">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="saleProduct">Product Sale</label>
          <div class="col-sm-10">
            <input type="text" class="productInput saleInput form-control" id="saleProduct" data-id="" placeholder="Enter Sale" name="saleProduct" autocomplete="off">
          </div>
        </div>
        <div class="form-group category">
          <label class="control-label col-sm-2 labelCategory">Choose Categories:</label>
          <select class="js-example-basic-multiple" id="categorySelect" name="category[]" multiple="multiple">

            <?php if(!empty($products)){
            foreach ($cat as $key => $value){
              echo '<option class="optionCategory" value="' . $value['id'] . '" name="category">'.$value['nameCategory'] .'</option>';
            }
            }
            ?>

          </select>
        </div>
        <div class="form-group integration">
          <label class="control-label col-sm-2 labelIntegration">Choose Integrations:</label>
          <select class="js-example-basic-multiple" id="integrationSelect" name="integration[]" multiple="multiple">
            <?php if(!empty($integr)){
              foreach ($integr as $key => $value){
                echo '<option class="optionIntegr" value="' . $value['id'] . '" name="integration">'.$value['integration'] .'</option>';
              }
            }
            ?>
          </select>
        </div>
        <div class="form-group platform">
          <label class="control-label col-sm-2 labelPlatform">Choose Platforms:</label>
          <select class="js-example-basic-multiple" id="platformSelect" name="platform[]" multiple="multiple">
            <?php if(!empty($platform)){
              foreach ($platform as $key => $value){
                echo '<option class="optionPlat" value="' . $value['id'] . '" name="platform">'.$value['platformname'] .'</option>';
              }
            }
            ?>
          </select>
        </div>
        <div class="form-group combination">
          <label class="control-label col-sm-2 labelCombination">Choose Combinations:</label>
          <select class="js-example-basic-multiple" id="combinationSelect" name="combination[]" multiple="multiple">
            <?php if(!empty($combination)){
              foreach ($combination as $key => $value){
                echo '<option class="optionComb" value="' . $value['id'] . '" name="combination">'.$value['combination'] .'</option>';
              }
            }
            ?>
          </select>
        </div>
        <div class="selectDiv">
          <label class="control-label col-sm-2 selectlabel" for="solutionProduct">Solution Type</label>
          <select class="solutionSelect btn btn-default" name="solutionProduct">
            <?php if(!empty($solution)){
              foreach ($solution as $key => $value){
                echo '<option class="optionSol" value="' . $value['id'] . '" name="solution">'.$value['typeSolution'] .'</option>';
              }
            }
            ?>
          </select>
        </div>
        <div class="selectDiv">
          <label class="control-label col-sm-2 selectlabel" for="seviceProduct">Product Service</label>
          <select class="serviceSelect btn btn-default" name="seviceProduct">
            <?php if(!empty($service)){
              foreach ($service as $key => $value){
                echo '<option class="optionService" value="' . $value['id'] . '" name="service">'.$value['nameService'] .'</option>';
              }
            }
            ?>
          </select>
        </div>
        <div class="form-group textaera">
          <label class="control-label col-sm-2" for="descriptionProduct">Description:</label>
          <div class="col-sm-10">
            <textarea type="text" class="productInput form-control" id="descriptionProduct" placeholder="Enter Description" name="descriptionProduct" autocomplete="off"></textarea>
          </div>
        </div>
        <div class="custom-file">
          <label class="custom-file-label" for="customFile"></label>
          <input type="file" class="btn btn-default custom-file-input file" id="file" name="file[]" multiple>
        </div>
        <div class="additionalDiv">
          <span class="addInp">+</span>
        </div>

        <div class="col-sm-offset-2 col-sm-10 div_product_submit">
          <button type="button" class="btn btn-warning but_product_submit">Submit</button>
        </div>

          <div class="col-sm-offset-2 col-sm-10 div_product_submit">
            <button type="submit" class="btn btn-default" name="select-product">Select</button>
          </div>
        </form>

      </div>
    </div>
    <!-- /.content -->
  
  
  
  <?php
	require("footer.php");
?>
