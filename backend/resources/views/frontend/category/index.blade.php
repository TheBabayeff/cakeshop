@extends('frontend.layouts.app')
@section('title', 'Tort Kateqoriyaları')

@section('content')

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{ route('welcome') }}">Əsas Səhifə</a></li>
                            <li>></li>
                            <li>Kateqoriyalar</li>
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

                <div class="col-lg-12 col-md-12">
                    <!--shop wrapper start-->

                    <!--shop tab product start-->
                    <div class="tab-content">
                        <div class="tab-pane grid_view fade show active" id="large" role="tabpanel">
                            <div class="row">
                                @foreach($categories AS $category)
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <div class="single_product" style="background-color: transparent">
                                            <div class="product_thumb">
                                                <a class="primary_img"
                                                   href="{{ route('categoryShow' , $category->id) }}"><img
                                                        src="{{ asset('storage/'.$category->image) }}" alt=""></a>
                                            
                                                <div class="tag_cate" style="text-align: center;">
                                                    <a href="{{ route('categoryShow' , $category->id) }}">{{ $category->name }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--shop tab product end-->
                    <!--shop toolbar start-->
                    {!! $categories->withQueryString()->links('pagination::bootstrap-5') !!}

                    <!--shop toolbar end-->
                    <!--shop wrapper end-->
                </div>
            </div>
        </div>
    </div>
    <!--shop  area end-->
@endsection
