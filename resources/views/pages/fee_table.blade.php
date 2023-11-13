<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="fees"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Fees"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                {{-- fee table schoolYear --}}
                <div class="col-12">
                    <div class="input-group w-30">
                        <div class="px-4">
                            <button type="button" class="btn shadow border border-2" data-bs-toggle="modal"
                                data-bs-target="#feeAddModal">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>

                        <form action="{{ route('fees') }}" method="GET">
                            <div class="d-flex">
                                <input type="search" name="search_term" class="form-control rounded"
                                    placeholder="Search" aria-label="Search" aria-describedby="search-addon"
                                    style="width: 250px ; height: 37px;" />
                                <button type="submit" class="btn btn-outline-primary text-primary"
                                    style="height: 35px"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </form>

                        <div class="d-flex justify-content-end ms-3">
                            <button id="updateButton" class="btn btn-primary" style="width: 216px; height: 37px;">
                                <p class="text-sm">kiểm tra hạn đợt đóng</p>
                            </button>
                        </div>


                    </div>
                    <div class="card ">
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 ">
                                    <thead>

                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tên học phí</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                SchoolYear & Major</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Đọt</th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Total fee</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fees as $index => $fee)
                                            <tr>
                                                <td class="align-middle w-2">
                                                    <button class="btn border border-1 shadow" type="button"
                                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                                    </button>
                                                    <ul class="dropdown-menu border border-1" style="min-width: 5px"
                                                        aria-labelledby="dropdownMenuButton1">
                                                        <form action="{{ route('fees_delete', $fee->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <li class="px-2 dropdown-item"><button class="dropdown-item"
                                                                    type="submit">Delete</button></li>
                                                        </form>

                                                        <li class="px-2 dropdown-item " data-bs-toggle="modal"
                                                            data-bs-target="#editModal_{{ $index }}"><button
                                                                class="dropdown-item " href="#">Edit</button>
                                                        </li>


                                                    </ul>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-uppercase text-secondary mb-0">
                                                        {{ $fee->name }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <h6 class="text-xl text-secondary mb-0">{{ $fee->schoolYear->name }}
                                                    </h6>
                                                    <span
                                                        class="text-xs text-secondary mb-0">{{ $fee->major->name }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-uppercase text-secondary mb-0">
                                                        {{ $fee->month }}</p>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <p class="text-secondary  text-xs font-weight-bold">
                                                        {{ number_format($fee->total_fee, 0, ',', ',') }}<span
                                                            class="text-uppercase text-success">VND</span> </p>
                                                </td>
                                            </tr>

                                            {{-- modal edit fee --}}
                                            <div class="modal fade" id="editModal_{{ $index }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close bg-dark"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('fees_update', $fee->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="id"
                                                                value="{{ $fee->id }}">
                                                            <div class="modal-body">
                                                                <div class="modal-body">
                                                                    <h5>Tổng học phí:</h5>
                                                                    <div class="row">
                                                                        <div class="mb-3 col-md-4">
                                                                            <label class="form-label">Tên học
                                                                                phí</label>
                                                                            <input type="text" name="name"
                                                                                class="form-control border p-2"
                                                                                placeholder="Enter name..."
                                                                                value=' {{ $fee->name }}'>
                                                                            @error('name')
                                                                                <p class='text-danger inputerror'>
                                                                                    {{ $message }} </p>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="mb-3 col-md-4">

                                                                            <label class="form-label">tổng
                                                                                phí</label>
                                                                            <input type="text" name="total_fee"
                                                                                class="form-control border p-2"
                                                                                placeholder="Enter name..."
                                                                                value='{{ $fee->total_fee }}'>
                                                                            @error('name')
                                                                                <p class='text-danger inputerror'>
                                                                                    {{ $message }} </p>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="mb-3 col-md-4">
                                                                            <label class="form-label">đợt</label>
                                                                            <input type="number" name="month"
                                                                                class="form-control border p-2"
                                                                                placeholder="Enter đợt..."
                                                                                min="{{ $fee->month }}"
                                                                                value='{{ $fee->month }}'>
                                                                            @error('name')
                                                                                <p class='text-danger inputerror'>
                                                                                    {{ $message }} </p>
                                                                            @enderror
                                                                        </div>

                                                                    </div>
                                                                    <div class="row mt-4">
                                                                        <h5> chuyên ngành & niên khóa</h5>
                                                                        <div class="mb-3 col-md-6">
                                                                            <label class="form-label">Niên
                                                                                khóa</label>
                                                                            <select name="schoolYear_id"
                                                                                class="form-select p-2 border border-2"
                                                                                aria-label="Default select example">
                                                                                <option selected>Choose
                                                                                    SchoolYear...
                                                                                </option>
                                                                                @foreach ($schoolYears as $year)
                                                                                    <option
                                                                                        value="{{ $year->id }}"
                                                                                        {{ $year->id == $fee->schoolYear_id ? 'selected' : '' }}>
                                                                                        {{ $year->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <div class="mb-3 col-md-6">
                                                                            <label class="form-label">Chuyên
                                                                                Ngành</label>
                                                                            <select name="major_id"
                                                                                class="form-select p-2 border border-2 form-select-sm rounded-2"
                                                                                aria-label=".form-select-sm example">
                                                                                <option selected>Choose Major...
                                                                                </option>
                                                                                @foreach ($majors as $major)
                                                                                    <option
                                                                                        value="{{ $major->id }}"
                                                                                        {{ $major->id == $fee->major_id ? 'selected' : '' }}>
                                                                                        {{ $major->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Hủy</button>
                                                                    <button type="submit"
                                                                        class="btn btn-warning">Lưu</button>
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
                    </div>
                </div>
            </div>
            <div class="pagination py-2">
                {{ $fees->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>

        {{-- modal add fee  --}}
        <div class="modal fade" id="feeAddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('fees_add') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <h5>Tổng học phí:</h5>
                            <div class="row">

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Tên học phí</label>
                                    <input type="text" name="name" class="form-control border p-2"
                                        placeholder="Enter name..." value=''>
                                    @error('name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">tổng phí</label>
                                    <input type="text" name="total_fee" class="form-control border p-2"
                                        placeholder="Enter phí..." value=''>
                                    @error('name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">đợt</label>
                                    <input type="number" name="month" class="form-control border p-2"
                                        placeholder="Enter đợt..." value='1'>
                                    @error('name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                            </div>

                            <div class="row mt-4">
                                <h5> chuyên ngành & niên khóa</h5>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Niên khóa</label>
                                    <select name="schoolYear_id" class="form-select p-2 border border-2"
                                        aria-label="Default select example">
                                        <option selected>Choose SchoolYear...</option>
                                        @foreach ($schoolYears as $year)
                                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Chuyên Ngành</label>
                                    <select name="major_id"
                                        class="form-select p-2 border border-2 form-select-sm rounded-2"
                                        aria-label=".form-select-sm example">
                                        <option selected>Choose Major...</option>
                                        @foreach ($majors as $major)
                                            <option value="{{ $major->id }}">{{ $major->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-warning">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const updateButton = document.getElementById("updateButton");
                updateButton.addEventListener("click", handleUpdateButtonClick);

                // Hiển thị số ngày tháng năm hiện tại
                const currentDate = moment().format('DD/MM/YYYY');
                const currentDateElement = document.getElementById("currentDate");
                currentDateElement.textContent = currentDate;
            });

            function handleUpdateButtonClick() {
                const currentDate = moment();
                const lastUpdateDate = moment(
                    "{{ $fee->updated_at }}"); // Đổi $fee->updated_at thành trường thời gian cập nhật của bạn

                if (currentDate.diff(lastUpdateDate, 'months') >= 1) {
                    updateButton.classList.remove('btn-success');
                    updateButton.classList.add('btn-info');
                    Swal.fire({
                        icon: 'info',
                        title: 'Cập nhật đợt',
                        text: 'Đã hết một tháng. Hãy cập nhật đợt!'
                    });
                } else {
                    const remainingDays = moment.duration(lastUpdateDate.add(1, 'months').diff(currentDate)).asDays();
                    const remainingDaysRounded = Math.round(remainingDays);

                    updateButton.classList.remove('btn-info');
                    updateButton.classList.add('btn-success');

                    Swal.fire({
                        icon: 'success',
                        title: 'Chưa cần cập nhật',
                        text: `còn ${remainingDaysRounded} ngày kết thúc đợt!`
                    });
                }
            }
        </script>


        <script>
            document.addEventListener("DOMContentLoaded", function() {
                checkAndUpdateNotification();
            });

            function checkAndUpdateNotification() {
                const currentDate = moment();
                const lastUpdateDate = moment(
                    "YOUR_LAST_UPDATE_DATE"); // Thay YOUR_LAST_UPDATE_DATE bằng ngày bạn đã cập nhật đợt lần cuối

                const daysDiff = currentDate.diff(lastUpdateDate, "days");

                if (daysDiff >= 30) {
                    // Hiển thị thông báo cần cập nhật đợt
                    Swal.fire({
                        icon: 'info',
                        title: 'Cập nhật đợt',
                        text: 'Đã hết một tháng. Hãy cập nhật đợt!'
                    });
                } else {
                    // Hiển thị thông báo chưa hết một tháng

                }
            }
        </script>







    </main>
    <x-plugins></x-plugins>

</x-layout>
