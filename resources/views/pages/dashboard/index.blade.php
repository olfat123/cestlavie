@extends('layouts.admin.dashboard')
@section('title','Dashboard')
@if(Auth::check() && $authUser->can('view_dashboard'))
@section('d-content')
    <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium hierarchical_show"
         data-uk-grid-margin>
        <div>
            <div class="md-card">
                <div class="md-card-content">
                    <span class="uk-text-muted uk-text-small">Active Customers</span>
                    <h2 class="uk-margin-remove">{{$customers_count}}</h2>
                </div>
            </div>
        </div>
{{--        <div>--}}
{{--            <div class="md-card">--}}
{{--                <div class="md-card-content">--}}
{{--                    <span class="uk-text-muted uk-text-small">Sales</span>--}}
{{--                    <h2 class="uk-margin-remove">{{$orders_count}} EGP</h2>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <div class="md-card">--}}
{{--                <div class="md-card-content">--}}
{{--                    <span class="uk-text-muted uk-text-small">Completed Orders</span>--}}
{{--                    <h2 class="uk-margin-remove">{{$orders_completed_count}}</h2>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <div class="md-card">--}}
{{--                <div class="md-card-content">--}}
{{--                    <span class="uk-text-muted uk-text-small">Products</span>--}}
{{--                    <h2 class="uk-margin-remove">{{$products_count}}</h2>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
{{--    <div class="uk-grid" data-uk-grid-margin>--}}
{{--        <div class="uk-width-medium-1-1">--}}
{{--            <div class="md-card">--}}
{{--                <div class="md-card-toolbar">--}}
{{--                    <h3 class="md-card-toolbar-heading-text">--}}
{{--                        Latest Orders--}}
{{--                    </h3>--}}
{{--                </div>--}}
{{--                <div class="md-card-content">--}}
{{--                    <div class="uk-overflow-container">--}}
{{--                        <table class="uk-table">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th class="uk-text-nowrap">Order</th>--}}
{{--                                <th class="uk-text-nowrap">Status</th>--}}
{{--                                <th class="uk-text-nowrap">Customer</th>--}}
{{--                                <th class="uk-text-nowrap">Total</th>--}}
{{--                                <th class="uk-text-nowrap">Date</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($orders as $order)--}}
{{--                                <tr class="uk-table-middle">--}}
{{--                                    <td class="uk-width-2-10 uk-text-nowrap">--}}
{{--                                        <a href="{{route('order.admin.show',$order->id)}}">#{{$order->short_id}}</a>--}}
{{--                                    </td>--}}
{{--                                    <td class="uk-width-2-10 uk-text-nowrap">--}}
{{--                                        <span--}}
{{--                                            class="uk-badge uk-badge-{{$order->status->color}}">{{$order->status->title}}</span>--}}
{{--                                    </td>--}}
{{--                                    <td class="uk-width-2-10">--}}
{{--                                        {{$order->user->full_name}}--}}
{{--                                    </td>--}}
{{--                                    <td class="uk-width-2-10">--}}
{{--                                        {{number_format($order->amount)}}--}}
{{--                                    </td>--}}
{{--                                    <td class="uk-width-3-10">--}}
{{--                                        {{$order->created_at->format('d-m-Y')}}--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="uk-grid" data-uk-grid-margin>--}}
{{--        <div class="uk-width-medium-1-1">--}}
{{--            <div class="md-card">--}}
{{--                <div class="md-card-toolbar">--}}
{{--                    <h3 class="md-card-toolbar-heading-text">--}}
{{--                        Products about to get out of stock--}}
{{--                    </h3>--}}
{{--                </div>--}}
{{--                <div class="md-card-content">--}}
{{--                    <div class="uk-overflow-container">--}}
{{--                        <table class="uk-table">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th class="uk-text-nowrap uk-text-left">Product</th>--}}
{{--                                <th class="uk-text-nowrap">Remaining Quantity</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($products as $product)--}}
{{--                                <tr class="uk-table-middle">--}}
{{--                                    <td class="uk-width-7-10 uk-text-left">--}}
{{--                                        <a href="{{route('product.admin.edit',$product->id)}}">{{$product->info->title}}</a>--}}
{{--                                    </td>--}}
{{--                                    <td class="uk-width-3-10">--}}
{{--                                        {{$product->quantity}}--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
@endif
