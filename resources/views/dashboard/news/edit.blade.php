@extends('dashboard.layout')


@section('content')
<script>
    $('.nav-link').removeClass('active');
    $('#country_link').addClass('active');
</script>
<div style="width: 82%;height: auto;float: right">
    <h1>Clients</h1>
    <div class="container-admin">
        <!-- Client -->

        <div class="form-horizontal" id="myform4">
            <fieldset>
                <legend>Our Clients</legend>
                <form action="{{route('country.update',$result['id'])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="country">Country Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?= $result['country'] ?>" id="clientName" placeholder="Enter Name" name="country" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-warning but_country_submit">Update</button>
                    </div>
                </form>
            </fieldset>
            <a class="btn btn-warning partnerAdd" href="/public/admin/country">SHOW COUNTRIES</a>
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