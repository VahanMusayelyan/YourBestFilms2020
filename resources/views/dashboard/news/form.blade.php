@extends('dashboard.layout')


@section('content')
<script>
    $('.nav-link').removeClass('active');
    $('#news_link').addClass('active');
</script>
<div style="width: 82%;height: auto;float: right">
    <h1>News</h1>
    <div class="container-admin">
        <!-- Clients -->

        <div class="form-horizontal" id="myform4">
            <fieldset>
                <legend>News</legend>
                <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="header">Header:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="header" placeholder="Enter header" name="header" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="text">Text</label>
                        <textarea class="form-control" id="text" name="text" rows="3"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="custom-file">
                            <label class="custom-file-label" for="customFile">Choose news file</label>
                            <input type="file" class=" btn btn-default custom-file-input file" id="file_news" name="file">
                        </div> 
                    </div> 
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-warning but_partner_submit">Submit</button>
                    </div>
                </form>
            </fieldset>
            <a class="btn btn-warning news" href="/public/admin/news">SHOW NEWS</a>
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