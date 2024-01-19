@extends('seller_layout')
@section('seller_content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Danh mục sản phẩm</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            @foreach ($edit_cate as $key => $value)
                <form class="" action="{{ URL::to('/update-category') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-box">
                                <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Sửa danh mục</h5>
                                <?php
                                $message = Session::get('message');
                                if (isset($message)) {
                                    echo '<p class="text-muted mb-4 mt-3 style="color:green""> <strong>Thông báo : </strong>' . $message . '</p>';
                                    Session::put('message', null);
                                } else {
                                    echo '<p class="text-muted mb-4 mt-3">.</p>';
                                } ?>
                                <input type="hidden" name="cateID" value="{{ $value->CategoryID }}">
                                <div class="form-group mb-3">
                                    <label for="product-name">Tên danh mục <span class="text-danger">*</span></label>
                                    <input type="text" id="product-name" value="{{ $value->CategoryName }}"
                                        name="cateName" class="form-control" placeholder="Tên danh mục">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="product-description">Mô tả danh mục <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" value="{{ $value->CategoryDescrip }}" id="product-description" name="cateDes"
                                        rows="5"></textarea>
                                </div>
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="text-center mb-3">
                                <button type="button" class="btn w-sm btn-light waves-effect">Cancel</button>
                                <button type="submit" name="add-category-product"
                                    class="btn w-sm btn-success waves-effect waves-light">Sửa</button>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </form>
            @endforeach
            <!-- end row -->


            <!-- file preview template -->
            <div class="d-none" id="uploadPreviewTemplate">
                <div class="card mt-1 mb-0 shadow-none border">
                    <div class="p-2">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="">
                            </div>
                            <div class="col pl-0">
                                <a href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name></a>
                                <p class="mb-0" data-dz-size></p>
                            </div>
                            <div class="col-auto">
                                <!-- Button -->
                                <a href="#" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                    <i class="dripicons-cross"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div> <!-- container -->

    </div> <!-- content -->
@endsection
