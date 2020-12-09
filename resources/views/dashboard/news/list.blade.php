@extends('dashboard.layout')


@section('content')
<script>
 $('.nav-link').removeClass('active');
 $('#news_link').addClass('active');
</script>
<div style="width: 82%;height: auto;float: right">
    <h1>News</h1>
    
    <table class="table table-bordered newsTable">
        <tr>
            <th> ID </th>
            <th> HEADER </th>
            <th> TEXT </th>
            <th> IMG </th>
            <th> EDIT / DELETE </th>
        </tr>
    

    <?php
    foreach ($result as $key => $value) {
        echo "<tr>"
        . "<td>" . $value['id'] . "</td>"
        . "<td>" . $value['header'] . "</td>"
        . "<td>" . $value['text'] . "</td>"
        . "<td><img src='/storage/app/public/" . $value['img'] . "' style='width:40px'></td>"
        . "<td class='edit_delete'><a class='editlink btn btn-info' href='".url('/admin/news/'.$value['id'])."/edit'>Edit</a>";
        ?>
        <form action="{{route('news.destroy',$value['id'])}}" method='POST' enctype='multipart/form-data'>
                    @csrf
                    @method('DELETE')
          <?php echo "<button type='submit' class='btn btn-danger'>Delete</button></form></td></tr>";
    }
    ?>
        </table>
    {{ $result->links() }}
    
    <a class="btn btn-warning partnerAdd" href="/admin/news/create">ADD NEWS</a>

</div>

@endsection