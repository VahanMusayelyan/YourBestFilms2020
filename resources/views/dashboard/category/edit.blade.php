@extends('dashboard.layout')


@section('content')
<script>
    $('.nav-link').removeClass('active');
    $('#cat_link').addClass('active');
</script>
<div style="width: 82%;height: auto;float: right">
    <h1>Clients</h1>
    <div class="container-admin">
        <!-- Client -->

        <div class="form-horizontal" id="myform4">
            <fieldset>
                <legend>Our Clients</legend>
                <form action="{{route('category.update',$result['id'])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="category">Category Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="partnerInput form-control" value="<?= $result['category'] ?>" id="categoryName" placeholder="Enter Name" name="category" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-warning but_partner_submit">Update</button>
                    </div>
                </form>
            </fieldset>
            <a class="btn btn-warning partnerAdd" href="/public/admin/category">SHOW CATEGORIES</a>
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