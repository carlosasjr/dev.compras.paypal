@extends('store.templates.master')

@section('content')
    <h1 class="title">Meu Carrinho de Compra: </h1>

    @if(session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Item</th>
            <th>Preço</th>
            <th>Qtd</th>
            <th>Sub. Total</th>
        </tr>
        </thead>

        <tbody>
        @forelse($items as $product)
            <tr>
                <td>
                    <div>
                        <img src="{{ url('assets/images/temp/' . $product['item']->image) }}" alt=""
                             class="product-item-img-cart">
                        <p class="cart-name-item">{{ $product['item']->name  }}</p>
                    </div>
                </td>
                <td>R$ {{ $product['item']->price }}</td>
                <td>
                    <a href="{{ route('decrement.cart', $product['item']->id) }}" class="item-add-remove">-</a>
                    {{ $product['qtd']  }}
                    <a href="{{ route('add.cart', $product['item']->id) }}" class="item-add-remove">+</a>
                </td>
                <td>R$ {{ $product['qtd'] * $product['item']->price }}</td>
            </tr>

        @empty
            <tr>
                <td colspan="20">Nenhum item no carrinho</td>
            </tr>

        @endforelse
        </tbody>
    </table>

    <div class="total-cart">
        <p><strong>Total: </strong> R$ {{ $total  }}</p>
    </div>

    @if( Session::has('cart') && Session::get('cart')->totalItems() > 0)
        <div class="cart-finish">
            <a href="{{ route('paypal')  }}" class="btn-finish">Finalizar Compra</a>
        </div>
    @endif


    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="SURF5ZNENQG3E">
        <input type="image" src="https://www.paypalobjects.com/pt_BR/BR/i/btn/btn_subscribeCC_LG.gif" border="0"
               name="submit" alt="PayPal - A maneira fácil e segura de enviar pagamentos online!">
        <img alt="" border="0" src="https://www.paypalobjects.com/pt_BR/i/scr/pixel.gif" width="1" height="1">
    </form>

@endsection

