@extends('dashboard.layout')


@section('content')


<div style="width: 82%;height: auto;float: right">
    <h1 style="color:#a696c5">STATISTICS</h1>
    <div class="container-admin">
        <!-- Clients -->

        <div class="form-horizontal" id="myform4">
            
<h3 style="text-align: center">Films by Year </h3>
<div id="chartContainer1" style="width: 80%;height: 350px;margin: 20px 0px"></div>
<div style="width: 100%;margin: 0 auto;border: 3px solid #0ba73f;position: absolute;left: 0;margin: 20px 0"></div>
<h3 style="text-align: center;margin-top: 60px;">Films by Category </h3>
<div id="chartContainer2" style="width: 80%;height: 350px;margin: 50px 0px">
 
    
</div>
<script>
var chart1 = new CanvasJS.Chart("chartContainer1",{
    
    data: [{
	type: "line",
        dataPoints : [
            @foreach($valsYear as $key => $value)
	    { label: {{$key}},  y: {{$value}}  },
            @endforeach
	]
    }]
});
var chart2 = new CanvasJS.Chart("chartContainer2",{
    data: [{
	type: "column",
	dataPoints : [
            @foreach($valsCat as $keyCat => $valueCat)
            
	    { label: "{{$keyCat}}",  y: {{$valueCat}}  },
            @endforeach
	]
    }]
});
 
chart1.render();
chart2.render();
</script>


            
            
            
            
            
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

   




@endsection