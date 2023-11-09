<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="tuition"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Tuition Manager"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid p-4">
            <div class="row">
                {{-- table --}}
                <div class="col-12 ">
                    <div class="input-group w-30">
                        <div class="px-2">
                            <button type="button" id="openModalButton" class="btn shadow border border-2"
                                data-mdb-toggle="modal" data-mdb-target="#addFeeModal">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="pe-2">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary border border-2 shadow"
                                data-mdb-toggle="modal" data-mdb-target="#updateTuitionModal">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
                        </div>
                        <form action="{{ route('tuition') }}" method="GET">
                            <div class="d-flex">
                                <input type="search" name="student_code" class="form-control rounded"
                                    placeholder="Search" aria-label="Search" aria-describedby="search-addon"
                                    style="width: 250px ; height: 37px;" />
                                <button type="submit" class="btn btn-outline-primary text-primary"
                                    style="height: 35px"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="card">
                        <div class="table-responsive ">
                            <table class="table align-items-center mb-0 table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            mã sinh viên</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                            tên sinh viên</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                            Chuyên Ngành & Niên khóa</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            trạng thái</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ngày đóng </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            nợ phí</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tuitionFees as $index => $tuition)
                                        <tr>
                                            <td style="width: 1px;">
                                                <div class="align-middle text-center text-xs w-5">
                                                    <button
                                                        onclick="printReceipt('{{ route('tuition.printReceipt', ['id' => $tuition->id]) }}')"
                                                        type="button" class="btn shadow border border-2">
                                                        <i class="fa fa-print" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="justify-content-center">
                                                    <h6 class="mb-0 text-xs">{{ $tuition->student->student_code }}
                                                    </h6>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $tuition->student->name }}
                                                </p>
                                            </td>
                                            <td>
                                                <h6 class="text-xl text-secondary mb-0">
                                                    {{ $tuition->fees->schoolYear->name }}</h6>
                                                <span class="text-xs text-secondary mb-0">
                                                    {{ $tuition->fees->major->name }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                @if ($tuition->fees->month === $tuition->times)
                                                    <span class="text-success text-xs font-weight-normal">
                                                        hoàn thành đợt: {{ $tuition->fees->month }}
                                                    </span>
                                                @elseif ($tuition->fees->month < $tuition->times)
                                                    <span class="text-success text-xs font-weight-normal">
                                                        Hoàn thành đợt: {{ $tuition->fees->month }}
                                                    </span>
                                                @else
                                                    <span class="text-danger text-xs font-weight-normal">
                                                        Chưa đóng đợt: {{ $tuition->fees->month }}
                                                    </span>
                                                @endif
                                            </td>


                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm text-secondary">
                                                    {{ \Carbon\Carbon::parse($tuition->created_at)->format('d/m/Y') }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @php
                                                    $calculatedValue = (($tuition->fees->total_fee - $tuition->student->scholarship) / 30) * ($tuition->fees->month - $tuition->times);
                                                @endphp
                                                <span
                                                    class="badge badge-sm {{ $calculatedValue <= 0 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ number_format($calculatedValue < 0 ? 0 : $calculatedValue, 0, ',', ',') }}
                                                    <span>VND</span>
                                                </span>
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pagination py-2">
                        {{-- {{ $tuitionFees->links('vendor.pagination.bootstrap-5') }} --}}
                    </div>
                </div>
            </div>
        </div>

        <!-- update Modal tuition_fee -->
        <div class="modal fade" id="updateTuitionModal" tabindex="-1" aria-labelledby="updateTuitionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form action="{{ route('tuition_update') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body">
                                <h5 class="text-uppercase">Cập nhật học phí sinh viên:</h5>
                                <div class="row">
                                    <div class="mb-3 col-md-7">
                                        <label for="tuition-select" class="form-label">Sinh viên</label>
                                        <input class="form-control mb-2" id="tuition-search" type="text"
                                            placeholder="Search...">
                                        <select class="form-select form-select-sm" name="student_ids[]"
                                            id="tuition-select" size="5" multiple
                                            aria-label=".form-select-sm example">
                                            @foreach ($feesOptions as $option)
                                                <option value="{{ $option['student_id'] }}">
                                                    {{ $option['description'] }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="mb-3 col-md-2">
                                        <label class="form-label">Lần đóng</label>
                                        <input type="number" name="times" class="form-control border p-2"
                                            placeholder="Nhập lần đóng..." value=''>
                                        @error('times')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label class="form-label">sô tiền cho 1 lần đóng</label>
                                        <input type="text" name="fee" class="form-control border p-2"
                                            placeholder="Nhập tiền..." value=''>
                                        @error('fee')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">đóng</button>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- add tuition fee --}}
        <div class="modal fade" id="addFeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form action="{{ route('tuition_add') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body">
                                <h5 class="text-uppercase">tạo học phí sinh viên:</h5>
                                <div class="row">
                                    <div class="mb-3 col-md-7">
                                        <label for="tuition-select" class="form-label">Sinh viên</label>
                                        <input class="form-control mb-2" id="tuition-search" type="text"
                                            placeholder="Search...">
                                        <select class="form-select form-select-sm" name="student_ids[]"
                                            id="tuition-select" size="5" multiple
                                            aria-label=".form-select-sm example">
                                            @foreach ($feesOptions as $option)
                                                <option value="{{ $option['student_id'] }}">
                                                    {{ $option['description'] }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="mb-3 col-md-2">
                                        <label class="form-label">Lần đóng</label>
                                        <input type="number" name="times" class="form-control border p-2"
                                            placeholder="Nhập lần đóng..." value='1'>
                                        @error('times')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label class="form-label">sô tiền cho 1 lần đóng</label>
                                        <input type="text" name="fee" class="form-control border p-2"
                                            placeholder="Nhập tiền..." value=''>
                                        @error('fee')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">đóng</button>
                            <button type="submit" class="btn btn-primary">lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- print --}}
        <script>
            function printReceipt(url) {
                // Open a new window with the URL provided by the Laravel route
                var printWindow = window.open(url, 'Print');

                // Wait for the content to load before printing
                printWindow.onload = function() {
                    setTimeout(function() { // Set timeout to ensure the content is fully rendered
                        printWindow.focus(); // Required for some browsers
                        printWindow.print(); // Opens the print dialog
                    }, 500);
                };
            }
        </script>

        {{-- search --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var searchInput = document.getElementById('tuition-search');
                var feeSelect = document.getElementById('tuition-select');

                searchInput.addEventListener('input', function() {
                    var searchTerm = searchInput.value.toLowerCase();

                    for (var i = 0; i < feeSelect.options.length; i++) {
                        var optionText = feeSelect.options[i].text.toLowerCase();
                        var isMatch = optionText.indexOf(searchTerm) > -1;
                        feeSelect.options[i].style.display = isMatch ? '' : 'none';
                    }
                });
            });
        </script>

        {{-- ajax --}}
        <script>
            $('#tuition-select').on('change', function() {
                var selectedStudentIds = $(this).val();

                if (selectedStudentIds) {
                    $.ajax({
                        url: '{{ route('tuition_update') }}', // Thay thế bằng URL xử lý Ajax trên máy chủ của bạn
                        method: 'POST',
                        data: {
                            student_ids: selectedStudentIds
                        },
                        success: function(data) {
                            console.log(data)
                            if (data) {
                                // Cập nhật giá trị của lần đóng và tiền thu một lần dựa trên dữ liệu đã lấy được
                                // Ở đây, tôi giả sử bạn chỉ muốn lấy dữ liệu của sinh viên đầu tiên trong danh sách
                                $('#times').val(data[0].times);
                                $('#fee').val(data[0].fee);
                            }
                        },
                        error: function() {
                            // Xử lý lỗi nếu cần
                        }
                    });
                } else {
                    // Nếu không có sinh viên nào được chọn, đặt giá trị của lần đóng và tiền thu một lần về mặc định
                    $('#times').val('1');
                    $('#fee').val('');
                }
            });
        </script>


    </main>
    <x-plugins></x-plugins>

</x-layout>
