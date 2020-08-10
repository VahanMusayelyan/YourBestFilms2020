@extends('dashboard.layout')


@section('content')
<script>
    $('.nav-link').removeClass('active');
    $('#cat_link').addClass('active');
</script>
<div style="width: 82%;height: auto;float: right">
    <h1>Countries</h1>
    <div class="container-admin">
        <!-- Clients -->

        <div class="form-horizontal" id="myform4">
            <fieldset>
                <legend>Countries</legend>
                <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="category">Country Category</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="category" placeholder="Enter Name" name="category" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-warning but_category_submit">Submit</button>
                    </div>
                </form>
            </fieldset>
            <a class="btn btn-warning partnerAdd" href="/public/admin/category">SHOW CATEGORIES</a>
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