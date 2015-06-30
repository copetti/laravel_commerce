@extends('app')

@section('content')

    <div class='container'>

        <h1>Products</h1>


        <a class="btn btn-default" href="{{ route('products.create') }}">New Product</a>
        <br>
        <br>

        <table class="table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ str_limit($product->description, 50,'...') }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>
                        <a href="{{ route('products.edit',['id'=>$product->id]) }}"/>Edit |
                        <a href="{{ route('products.destroy',['id'=>$product->id]) }}"/>Delete |
                        <a href="{{ route('products.images',['id'=>$product->id]) }}"/>Images
                    </td>
                </tr>
            @endforeach
        </table>

        {!! $products->render() !!}
    </div>

@endsection