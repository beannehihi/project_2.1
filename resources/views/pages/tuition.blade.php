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
                        <div class="px-4">
                            <button type="button" id="openModalButton" class="btn shadow border border-2"
                                data-mdb-toggle="modal" data-mdb-target="#addFeeModal">
                                <i class="fa fa-plus" aria-hidden="true"></i>
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
                                            mã sinh viên</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                            tên sinh viên</th>

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
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tuitionFees as $index => $tuition)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-xs">{{ $tuition->student->student_code }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $tuition->student->name }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-normal">
                                                    Đã đóng đợt: {{ $tuition->times }}
                                                </span>
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
                                            <td class="align-middle text-center text-xs w-5 ">
                                                <!-- Check if the times equals 30 to disable the button -->
                                                <button type="button" class="btn btn-primary mb-0"
                                                    data-mdb-toggle="modal"
                                                    data-mdb-target="#editModal_{{ $index }}"
                                                    {{ $tuition->times == 30 ? 'disabled' : '' }}>
                                                    <span>Edit Fee</span>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal update fee-->
                                        <div class="modal fade" id="editModal_{{ $index }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <form
                                                        action="{{ route('tuition_update', ['id' => $tuition->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close"
                                                                data-mdb-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="modal-body">
                                                                <h5 class="text-uppercase">cập nhật học phí sinh viên:
                                                                </h5>
                                                                <div class="row">
                                                                    <div class="mb-3 col-md-5">
                                                                        <label class="form-label">Mã sinh sinh
                                                                            viên</label>
                                                                        <input type="text" name="student_code"
                                                                            class="form-control border p-2"
                                                                            placeholder="Nhập mã sinh viên..."
                                                                            value='{{ $tuition->student->student_code }}'>

                                                                        @error('student_code')
                                                                            <p class='text-danger inputerror'>
                                                                                {{ $message }} </p>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3 col-md-3">
                                                                        <label class="form-label">Lần đóng</label>
                                                                        <input type="number" name="times"
                                                                            class="form-control border p-2"
                                                                            placeholder="Nhập lần đóng..."
                                                                            value='{{ $tuition->times }}'>
                                                                        @error('times')
                                                                            <p class='text-danger inputerror'>
                                                                                {{ $message }} </p>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3 col-md-4">
                                                                        <label class="form-label">sô tiền cho 1 lần
                                                                            đóng</label>
                                                                        <input type="text" name="fee"
                                                                            class="form-control border p-2"
                                                                            placeholder="Nhập tiền..."
                                                                            value='{{ $tuition->fee }}'>
                                                                        @error('fee')
                                                                            <p class='text-danger inputerror'>
                                                                                {{ $message }} </p>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3 col-md-7">
                                                                        <label class="form-label">niên khóa &
                                                                            Chuyên ngành</label>
                                                                        <select name="fee_id"
                                                                            class="form-select form-select-sm"
                                                                            aria-label=".form-select-sm example">
                                                                            @foreach ($fees as $fee)
                                                                                <option value="{{ $fee->id }}"
                                                                                    @if ($fee->id === $tuition->fee_id) selected @endif>
                                                                                    Liên khóa:
                                                                                    {{ $fee->schoolYear->name }} -
                                                                                    Chuyên ngành:
                                                                                    {{ $fee->major->name }} - Tổng
                                                                                    tiền:
                                                                                    {{ number_format($fee->total_fee, 0, ',', ',') }}
                                                                                    VND
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
                                    <div class="mb-3 col-md-5">
                                        <label class="form-label">Mã sinh sinh viên</label>
                                        <input type="text" name="student_code" class="form-control border p-2"
                                            placeholder="Nhập mã sinh viên..." value=''>
                                        @error('student_code')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label class="form-label">Lần đóng</label>
                                        <input type="number" name="times" class="form-control border p-2"
                                            placeholder="Nhập lần đóng..." value='1'>
                                        @error('times')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">sô tiền cho 1 lần đóng</label>
                                        <input type="text" name="fee" class="form-control border p-2"
                                            placeholder="Nhập tiền..." value=''>
                                        @error('fee')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-7">
                                        <label class="form-label">niên khóa & Chuyên ngành</label>
                                        <select name="fee_id" class="form-select form-select-sm"
                                            aria-label=".form-select-sm example" size="10">
                                            @foreach ($fees as $fee)
                                                {{-- <option selected>Open this select menu</option> --}}
                                                <option value="{{ $fee->id }}">Liên khóa:
                                                    {{ $fee->schoolYear->name }}
                                                    - Chuyên ngành: {{ $fee->major->name }} - tổng tiền:
                                                    {{ number_format($fee->total_fee, 0, ',', ',') }} VND
                                                </option>
                                            @endforeach
                                        </select>
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


    </main>
    <x-plugins></x-plugins>

</x-layout>
