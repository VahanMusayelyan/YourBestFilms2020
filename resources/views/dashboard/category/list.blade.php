@extends('dashboard.layout')


@section('content')
<script>
 $('.nav-link').removeClass('active');
 $('#cat_link').addClass('active');
</script>
<div style="width: 82%;height: auto;float: right">
    <h1>Categories</h1>
    
    <table class="table table-bordered categoryTable">
        <tr>
            <th> ID </th>
            <th> NAME </th>
            <th> EDIT / DELETE </th>
        </tr>
    

    <?php
    foreach ($result as $key => $value) {
        echo "<tr>"
        . "<td>" . $value['id'] . "</td>"
        . "<td>" . $value['category'] . "</td>"
        . "<td><a class='editlink btn btn-info' href='".url('/admin/category/'.$value['id'])."/edit'>Edit</a>";
        ?>
        <form class="catform" action="{{route('category.destroy',$value['id'])}}" method='POST' enctype='multipart/form-data'>
                    @csrf
                    @method('DELETE')
          <?php echo "<button type='submit' class='btn btn-danger'>Delete</button></form></td></tr>";
    }
    ?>
        </table>
    {{ $result->links() }}
    
    <a class="btn btn-warning partnerAdd" href="/admin/category/create">ADD CATEGORY</a>

</div>

@endsection