@extends('frontend.layouts.app')
@section('title', 'Bütün tortlar')
@section('content')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{ route('welcome') }}">Ana səhifə</a></li>
                            <li>></li>
                            <li>Bütün məhsullar</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--shop  area start-->
    <div class="shop_area shop_reverse">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <!--sidebar widget start-->
                    <div class="sidebar_widget">
                        <div class="widget_list widget_categories">
                            <h2>Kateqoriyalar</h2>
                            <ul>
                                @foreach($categories AS $category)
                                    <li><a style="color:white" href="{{ route('categoryShow' , $category->id) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!--sidebar widget end-->
                </div>
                <div class="col-lg-9 col-md-12">
                    <!--shop wrapper start-->

                    <!--shop tab product start-->
                    <div class="tab-content">
                        <div class="tab-pane grid_view fade show active" id="large" role="tabpanel">
                            <div class="row">
                                @foreach($products AS $product)
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <div class="single_product" style="background-color: transparent;">
                                            <div class="product_thumb">
                                                <a class="primary_img" href="{{ route('productShow' , $product->id) }}">
                                                    <img src="{{ asset("storage/".$product->preview_image) }}" alt="">
                                                </a>
                                            </div>
                                            <div class="product_content">
                                                <div class="tag_cate">
                                                    <a href="#" tabindex="0">{{ $product->category->name }}</a>
                                                </div>
                                                <h3><a href="{{ route('productShow' , $product->id) }}"
                                                       tabindex="0">{{ $product->name }}</a></h3>
                                                <div class="price_box">
                                                    <span
                                                        class="current_price">{{ $product->price }} 	.00 &#8380;</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--shop tab product end-->

                    
                        
                            {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}

                        
                    

                    <!--shop wrapper end-->
                </div>
            </div>
        </div>
    </div>
    <!--shop  area end-->
@endsection
