<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">
            {{('Product Name')}} <label class="badge badge-success ml-3" style="cursor: pointer">{{('Asc/Dsc')}}</label>
        </th>
        <th scope="col">
            {{('Total Stock')}} <label class="badge badge-success ml-3" style="cursor: pointer">{{('Asc/Dsc')}}</label>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $key=>$data)
        <tr>
            <th scope="row">{{$key+1}}</th>
            <td>{{$data['name']}}</td>
            <td>{{$data['current_stock']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function () {
        $('input').addClass('form-control');
    });
</script>
