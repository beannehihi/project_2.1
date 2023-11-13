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


                        <form action="{{ route('tuition') }}" method="GET">
                            <div class="d-flex">
                                <input type="search" name="search_term" class="form-control rounded"
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
                                            nợ phí của đợt</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tuitionFees as $index => $tuition)
                                        @php
                                            $calculatedValue = (($tuition->fees->total_fee - $tuition->student->scholarship) / 30) * ($tuition->fees->month - $tuition->times);
                                        @endphp
                                        @if (!$showAllStudents || $calculatedValue > 0)
                                            <tr>
                                                <td style="width: 1px;">
                                                    <div class="align-middle text-center text-xs w-5">
                                                        <button type="button"
                                                            onclick="printReceipt('{{ route('tuition.printReceipt', ['id' => $tuition->id]) }}')"
                                                            class="btn shadow border border-2 @if ($calculatedValue > 0) disabled @endif">
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
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $tuition->student->name }}
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
                                                    @if ($tuition->fees->month - $tuition->times <= 0)
                                                        <span class="text-success text-xs font-weight-normal">
                                                            Hoàn thành đợt: {{ $tuition->fees->month }}
                                                        </span>
                                                    @elseif ($tuition->fees->month - $tuition->times == -30)
                                                        <span class="text-success text-xs font-weight-normal">
                                                            Hoàn thành cả khóa
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

                                                    <span
                                                        class="badge badge-sm {{ $calculatedValue <= 0 ? 'bg-success' : 'bg-danger' }}">
                                                        {{ number_format($calculatedValue < 0 ? 0 : $calculatedValue, 0, ',', ',') }}
                                                        <span>VND</span>
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <button type="button"
                                                        class="btn btn-primary border border-2 shadow"
                                                        data-mdb-toggle="modal"
                                                        data-mdb-target="#updateTuitionModal_{{ $index }}"
                                                        @if ($tuition->fees->month - $tuition->times === 0) disabled @endif
                                                        @if ($tuition->times >= 30) style="display: none;" @endif>
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            {{-- modal update tuition --}}
                                            <div class="modal fade" id="updateTuitionModal_{{ $index }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <form
                                                            action="{{ route('tuition.update', ['id' => $tuition->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <button type="button" class="btn-close"
                                                                    data-mdb-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="modal-body">
                                                                    <h5 class="text-uppercase">cập nhật phí sinh viên:
                                                                    </h5>
                                                                    <div class="row">
                                                                        <h6>đóng phí:</h6>
                                                                        <div></div>
                                                                        <div class="mb-3 col-md-2">
                                                                            <label class="form-label">đóng đợt</label>
                                                                            <input type="number" name="times"
                                                                                id=""
                                                                                class="form-control border p-2"
                                                                                placeholder="Nhập lần đóng..."
                                                                                value="0">
                                                                            @error('times')
                                                                                <p class='text-danger inputerror'>
                                                                                    {{ $message }}
                                                                                </p>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="mb-3 col-md-3">
                                                                            <label class="form-label">Số tiền phải đóng
                                                                                của đợt
                                                                            </label>
                                                                            <input type="text" name="fee"
                                                                                id=""
                                                                                class="form-control border p-2"
                                                                                placeholder="Nhập tiền..."
                                                                                value="{{ number_format((($tuition->fees->total_fee - $tuition->student->scholarship) / 30) * ($tuition->fees->month - $tuition->times), 0, ',', '.') }}"
                                                                                readonly>
                                                                            @error('fee')
                                                                                <p class='text-danger inputerror'>
                                                                                    {{ $message }}
                                                                                </p>
                                                                            @enderror
                                                                        </div>
                                                                        <h6>Thông tin sinh viên:</h6>
                                                                        <div class="mb-3 col-md-7">
                                                                            <label for="tuition-select"
                                                                                class="form-label">Sinh viên</label>
                                                                            <select class="form-select form-select-sm"
                                                                                name="student_id" id="tuition-select"
                                                                                aria-label=".form-select-sm example"
                                                                                readonly>
                                                                                @foreach ($feesOptions as $option)
                                                                                    <option
                                                                                        value="{{ $option['student_id'] }}"
                                                                                        {{ $tuition->student_id == $option['student_id'] ? 'selected' : '' }}>
                                                                                        {{ $option['description'] }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-mdb-dismiss="modal">đóng</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">lưu</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pagination py-2">
                        {{ $tuitionFees->links('vendor.pagination.bootstrap-5') }}
                    </div>
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


        <script>
            // Add this JavaScript to make the select element readonly
            document.getElementById('tuition-select').addEventListener('mousedown', function(e) {
                e.preventDefault();
                this.blur();
                return false;
            });
        </script>




    </main>
    <x-plugins></x-plugins>

</x-layout>
