@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí thêm món ăn')
@section('content')
<!-- Form controls -->
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Basic Inputs</h4>
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Thêm món ăn</h5>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tên món</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Tên món" />
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" name="images[]" accept="image/*" onchange="loadFile(event)" id="exampleFormControlInput1" placeholder="Hình ảnh" />
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Xem trước hình</label>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="user-image col-md-6 text-center">
                                <img id="preview-image" src="{{ asset('assets/img/khongxacdinh.jpg') }}" alt="preview image" style="max-height: 200px;">
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Example select</label>
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleDataList" class="form-label">Datalist example</label>
                        <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search..." />
                        <datalist id="datalistOptions">
                            <option value="San Francisco"></option>
                            <option value="New York"></option>
                            <option value="Seattle"></option>
                            <option value="Los Angeles"></option>
                            <option value="Chicago"></option>
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlSelect2" class="form-label">Example multiple select</label>
                        <select multiple class="form-select" id="exampleFormControlSelect2" aria-label="Multiple select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div>
                        <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var loadFile = function(event) {
                var previewImage = document.getElementById('preview-image');
                previewImage.src = URL.createObjectURL(event.target.files[0]);
            };
        </script>
        @endsection