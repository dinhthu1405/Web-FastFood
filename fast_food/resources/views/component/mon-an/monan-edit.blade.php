@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí sửa món ăn')
@section('content')
    <!-- Form controls -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><a href="{{ route('monAn.index') }}"><span class="text-muted fw-light">Danh sách
                        /</span></a> Sửa món</h4>
            {!! @csrf_field() !!}
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
            @endif
            {{-- @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif --}}
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Sửa món</h5>
                    <div class="card-body">
                        <form action="{{ route('monAn.update', ['monAn' => $monAn]) }}" method="post"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tên món</label>
                                <input type="text" disabled name="TenMonAn" class="form-control"
                                    value="{{ $monAn->ten_mon }}" id="exampleFormControlInput1" placeholder="Tên món" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control" name="images[]" accept="image/*"
                                    onchange="loadFile(event)" multiple id="images" placeholder="Hình ảnh" />
                                @error('images')
                                    <div class="error">
                                        <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                            <strong style="font-size: 14px">{{ $message }}</strong>
                                        </span>
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Xem trước hình</label>
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="user-image col-md-6 text-center">

                                        {{-- @foreach ($lstHinhAnh as $image)
                                            <img id="preview-image" src="{{ asset("storage/$image->duong_dan") }}"
                                                alt="preview image" style="max-height: 200px;">
                                        @endforeach --}}
                                        <div class="col-md">

                                            <div id="carouselExample-cf" class="carousel carousel-dark slide carousel-fade"
                                                data-bs-ride="carousel">
                                                <ol class="carousel-indicators">
                                                    @foreach ($lstHinhAnh as $image)
                                                        @if ($loop->index == 0)
                                                            <li data-bs-target="#carouselExample-cf" data-bs-slide-to="0"
                                                                class="active"></li>
                                                        @else
                                                            <li data-bs-target="#carouselExample-cf"
                                                                data-bs-slide-to="{{ $loop->index }}"></li>
                                                        @endif
                                                    @endforeach
                                                </ol>
                                                <div class="carousel-inner">
                                                    @foreach ($lstHinhAnh as $image)
                                                        @if ($loop->index == 0)
                                                            <div class="carousel-item active">
                                                                <img class="d-block w-100" id="preview-image"
                                                                    src="{{ asset("storage/$image->duong_dan") }}"
                                                                    alt="preview image" style="max-height: 200px;"
                                                                    data-target="#modal-add" data-bs-toggle="modal"
                                                                    data-bs-target='#modalCenter' />
                                                            </div>
                                                        @endif
                                                        @if ($loop->index != 0)
                                                            <div class="carousel-item">
                                                                <img class="d-block w-100" id="preview-image"
                                                                    src="{{ asset("storage/$image->duong_dan") }}"
                                                                    alt="preview image" style="max-height: 200px;"
                                                                    data-target="#modal-add" data-bs-toggle="modal"
                                                                    data-bs-target='#modalCenter' />
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselExample-cf" role="button"
                                                    data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carouselExample-cf" role="button"
                                                    data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Loại món</label>
                                <select class="form-select" name="LoaiMonAn" id="exampleFormControlSelect1"
                                    aria-label="Default select example">
                                    <option selected>-- Chọn loại món --</option>
                                    @foreach ($lstLoaiMonAn as $loaiMonAn)
                                        <option value="{{ $loaiMonAn->id }}"
                                            @if ($loaiMonAn->id == $monAn->loai_mon_an_id) selected @endif>{{ $loaiMonAn->ten_loai }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Địa điểm</label>
                                <select class="form-select" name="DiaDiem" id="exampleFormControlSelect1"
                                    aria-label="Default select example">
                                    <option selected>-- Chọn địa điểm --</option>
                                    @foreach ($lstDiaDiem as $diaDiem)
                                        <option value="{{ $diaDiem->id }}"
                                            @if ($diaDiem->id == $monAn->dia_diem_id) selected @endif>
                                            {{ $diaDiem->ten_dia_diem }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleDataList" class="form-label">Đơn giá</label>
                                <input type="text" name="DonGia" class="form-control format_number" min="1"
                                    value="{{ old('DonGia', $monAn->don_gia) }}" onkeypress='validate(event)'
                                    id="exampleFormControlInput1" placeholder="Đơn giá" />
                                @error('DonGia')
                                    <div class="error">
                                        <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                            <strong style="font-size: 14px">{{ $message }}</strong>
                                        </span>
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleDataList" class="form-label">Số lượng</label>
                                <input type="number" name="SoLuong" class="form-control" min="1"
                                    value="{{ old('SoLuong', $monAn->so_luong) }}" id="exampleFormControlInput1"
                                    placeholder="Số lượng" />
                                @error('SoLuong')
                                    <div class="error">
                                        <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                            <strong style="font-size: 14px">{{ $message }}</strong>
                                        </span>
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Tình trạng món ăn</label>
                                <select class="form-select" name="TinhTrang" id="exampleFormControlSelect1"
                                    aria-label="Default select example">
                                    <option {{ $monAn->tinh_trang == 'Còn món' ? 'selected' : '' }}>Còn món</option>
                                    <option {{ $monAn->tinh_trang == 'Sắp hết' ? 'selected' : '' }}>Sắp hết</option>
                                    <option {{ $monAn->tinh_trang == 'Hết món' ? 'selected' : '' }}>Hết món</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-5"></div>
                                <div class="col-md-5 mb-3">
                                    <button type="submit" class="btn btn-success py-2 mb-4">Sửa món</button>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                // var loadFile = function(event) {
                //     var filesAmount = event.target.files.length;
                //     for (i = 0; i < filesAmount; i++) {
                //         var previewImage = document.getElementById('preview-image');
                //         previewImage.src = URL.createObjectURL(event.target.files[i]);
                //     }
                // };
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
            <script>
                function validate(evt) {
                    var theEvent = evt || window.event;

                    // Handle paste
                    if (theEvent.type === 'paste') {
                        key = event.clipboardData.getData('text/plain');
                    } else {
                        // Handle key press
                        var key = theEvent.keyCode || theEvent.which;
                        key = String.fromCharCode(key);
                    }
                    var regex = /[0-9]|\./;
                    if (!regex.test(key)) {
                        theEvent.returnValue = false;
                        if (theEvent.preventDefault) theEvent.preventDefault();
                    }
                }
            </script>
        @endsection
