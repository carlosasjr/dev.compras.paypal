@extends('store.templates.master')

@section('content')
        <h1 class="title">Lançamentos mais recentes:</h1>

        <div class="row">
            @foreach($products as $product)
                <article class="col-12 col-sm-6 col-md-3">
                    <div class="product-item">
                        <img alt="" class="product-item-img" src="{{"assets/images/temp/{$product->image}"}}">
                        <h1>{{ $product->name }}</h1>
                        <a class="btn btn-buy" href="{{ route('add.cart', $product->id) }}">
                            <i class="fas fa-shopping-cart"></i>
                            Adicionar ao Carrinho
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
@endsection



