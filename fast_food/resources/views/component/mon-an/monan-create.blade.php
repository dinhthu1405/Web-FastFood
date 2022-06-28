@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí thêm món ăn')
@section('content')
    <!-- Form controls -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><a href="{{ route('monAn.index') }}"><span class="text-muted fw-light">Danh sách
                        /</span></a> Thêm món ăn</h4>
            <form action="{{ route('monAn.store') }}" method="post" enctype="multipart/form-data">
                {!! @csrf_field() !!}
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Thêm món ăn</h5>
                        <div class="card-body">

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tên món</label>
                                <input type="text" name="TenMonAn" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Tên món" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control" name="images[]" accept="image/*"
                                    onchange="loadFile(event)" multiple id="images" placeholder="Hình ảnh" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Xem trước hình</label>
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="user-image col-md-6 text-center">
                                        {{-- <div class="preview-image"></div> --}}

                                        <img id="preview-image" src="{{ asset('assets/img/khongxacdinh.jpg') }}"
                                            alt="preview image" style="max-height: 200px;" data-target="#modal-add"
                                            data-bs-toggle="modal" data-bs-target='#modalCenter'>
                                        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Loại món ăn</label>
                                <select class="form-select" name="LoaiMonAn" id="exampleFormControlSelect1"
                                    aria-label="Default select example">
                                    <option selected>-- Chọn loại món ăn --</option>
                                    @foreach ($lstLoaiMonAn as $loaiMonAn)
                                        <option value="{{ $loaiMonAn->id }}">{{ $loaiMonAn->ten_loai }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Địa điểm</label>
                                <select class="form-select" name="DiaDiem" id="exampleFormControlSelect1"
                                    aria-label="Default select example">
                                    <option selected>-- Chọn địa điểm --</option>
                                    @foreach ($lstDiaDiem as $diaDiem)
                                        <option value="{{ $diaDiem->id }}">{{ $diaDiem->ten_dia_diem }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleDataList" class="form-label">Đơn giá</label>
                                <input type="text" name="DonGia" class="form-control format_number" min="1"
                                    id="" placeholder="Đơn giá" />

                            </div>
                            <div class="mb-3">
                                <label for="exampleDataList" class="form-label">Số lượng</label>
                                <input type="number" name="SoLuong" class="form-control" min="1"
                                    id="exampleFormControlInput1" placeholder="Số lượng" />

                            </div>
                            <div class="row">
                                <div class="col-md-5"></div>
                                <div class="col-md-5 mb-3">
                                    <button type="submit" class="btn btn-success py-2 mb-4">Thêm món</button>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </div>
            </form>
        </div>
    </div>
    <script>
        var loadFile = function(event) {
            var previewImage = document.getElementById('preview-image');
            previewImage.src = URL.createObjectURL(event.target.files[0]);
        };
        $(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML(
                                '<img id="preview-image1" style="max-width: 100%; max-height: 5%;">'
                            )).attr('src', event
                                .target
                                .result).appendTo(
                                placeToInsertImagePreview);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };

            $('#images').on('change', function() {
                imagesPreview(this, 'div.modal-content');
            });
        });
    </script>

@endsection
