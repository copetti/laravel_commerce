@extends('app')

@section('content')

    <div class='container'>

        <h1>Categories</h1>


        <a class="btn btn-default" href="{{ route('products.create') }}">New Category</a>
        <br>
        <br>

        <table class="table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <a href="{{ route('products.edit',['id'=>$product->id]) }}"/>Edit |
                        <a href="{{ route('products.destroy',['id'=>$product->id]) }}"/>Delete
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection