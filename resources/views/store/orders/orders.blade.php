@extends('store.templates.master')

@section('content')

    <h1 class="title">Meus Pedidos</h1>

    <table class="table table-striped">
        <theade>
            <tr>
                <th>Número</th>
                <th>Total</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
        </theade>

        <tdoby>
            @forelse($orders as $order)
                <tr>
                    <td> {{ $order->id  }}</td>
                    <td> {{ $order->total }}</td>
                    <td> {{ $order->status }}</td>
                    <td>
                        <a href="{{ route('order.products', $order->id) }}">
                            Ver Produtos
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="20">Nenhum pedido realizado!</td>
                </tr>
            @endforelse
        </tdoby>
    </table>
@endsection


