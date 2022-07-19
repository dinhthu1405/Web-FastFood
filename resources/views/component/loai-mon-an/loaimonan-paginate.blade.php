<form method="post">
    @csrf
    <div class="row">
        <div class="col-md-3">
            <h5 class="card-header">Danh sách loại món</h5>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-2"></div>
        <div class="col-md-1"></div>
        <div class="col-md-1"></div>
        <div class="col-md-2">
            <div class="form-group">
                <label for=""></label>
                <button formaction="{{ route('loaiMonAn.xoaNhieu') }}" type="submit"
                    class="form-control btn btn-primary">Xoá
                    lựa chọn</button>
            </div>

        </div>
        <div class="col-md-2"></div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>STT</th>
                    <th>Tên loại</th>
                    {{-- <th>Chỉnh sửa</th> --}}
                    <th>Xoá</th>
                    <th><input type="checkbox" class="checkAll" /></th>
                </tr>
            </thead>
            <?php $count = $lstLoaiMonAn->perPage() * ($lstLoaiMonAn->currentPage() - 1) + 1; ?>
            @foreach ($lstLoaiMonAn as $loaiMonAn)
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td> {{ $count++ }} </td>
                        <td>
                            <strong>{{ $loaiMonAn->ten_loai }}</strong>
                        </td>
                        {{-- <td><a href="{{ route('loaiMonAn.edit', $loaiMonAn->id) }}"><button type="button" id="btn-edit"
                                class="btn btn-warning py-2 mb-4" data-target="#modal-edit" data-bs-toggle="modal"
                                data-bs-target="#modalCenter-Edit">
                                <i class="bx bx-edit-alt me-1"></i> </button></a> </td> --}}
                        <td> <button type="button" id="btn-delete" class="btn btn-danger py-2 mb-4"
                                data-target="#modal-edit" data-bs-toggle="modal"
                                data-bs-target="#modalCenter-Delete{{ $loaiMonAn->id }}">
                                <i class="bx bx-trash me-1"></i> </button></td>
                        <!-- Modal Cảnh báo -->
                        <div class="modal fade" id="modalCenter-Delete{{ $loaiMonAn->id }}" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="mb-3" style="text-align: center">
                                                <img src="{{ asset('assets/img/icons/unicons/!.png') }}"
                                                    alt="" width="180px" height="75px">
                                            </div>
                                            <div class="mb3 text-nowrap" style="text-align: center">
                                                <span style="font-size: 22px;">Bạn có chắc muốn xoá loại món này</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="padding: 3%">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-2">
                                            <button formaction="{{ route('loaiMonAn.xoa', $loaiMonAn->id) }}"
                                                type="submit" class="btn btn-danger btn-delete-confirm"
                                                data-bs-dismiss="modal">Xoá</button>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" value="delete"
                                                class="btn btn-primary btn-delete-close">Huỷ</button>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <td class="selectBox"><input name='ids[]' type="checkbox" id="checkItem"
                                value="{{ $loaiMonAn->id }}"></td>
                        {{-- onclick="return confirm('Bạn có chắc muốn xoá loại món ăn này, vì nó có thể ảnh hưởng đến món ăn; đánh giá và bình luận')" --}}
                    </tr>
                </tbody>
                <script>
                    $(document).on('click', '.btn-delete-close', function(e) {
                        $('#modalCenter-Delete{{ $loaiMonAn->id }}').modal('hide');
                    });
                </script>
            @endforeach
        </table>
    </div>
    @if ($lstLoaiMonAn->total() > 5)
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <!-- Basic Pagination -->
                    <nav aria-label="Page navigation">
                        <ul class="paginate">
                            {!! $lstLoaiMonAn->appends($request->except('page'))->onEachSide(1)->links() !!}
                        </ul>
                    </nav>
                    <!--/ Basic Pagination -->
                </div>
            </div>
        </div>
    @else
    @endif
    </div>
</form>
