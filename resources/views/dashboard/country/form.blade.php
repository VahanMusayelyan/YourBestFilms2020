@extends('dashboard.layout')


@section('content')
<script>
    $('.nav-link').removeClass('active');
    $('#country_link').addClass('active');
</script>
<div style="width: 82%;height: auto;float: right">
    <h1>Countries</h1>
    <div class="container-admin">
        <!-- Clients -->

        <div class="form-horizontal" id="myform4">
            <fieldset>
                <legend>Countries</legend>
                <form action="{{ route('country.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="country">Country Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="partnerInput form-control" id="country" placeholder="Enter Name" name="country" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-warning but_partner_submit">Submit</button>
                    </div>
                </form>
            </fieldset>
            <a class="btn btn-warning partnerAdd" href="/admin/country">SHOW COUNTRIES</a>
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