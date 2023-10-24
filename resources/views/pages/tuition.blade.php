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
                        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                            aria-describedby="search-addon" />
                        <button type="button" class="btn btn-outline-primary text-primary" style="height: 35px"><i
                                class="fa fa-search" aria-hidden="true"></i></button>
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
                                            nợ</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $stud)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-xs">{{ $stud->student_code }}</h6>

                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $stud->name }}</p>
                                            </td>

                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-normal">đã hoàn thành
                                                    đợt: 1</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-danger">1000<span
                                                        class="text-white px-1">VND</span></span>
                                            </td>
                                            <td class="align-middle text-center text-xs">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-mdb-toggle="modal"
                                                    data-mdb-target="#exampleModal">
                                                    <span>đóng phí</span>
                                                </button>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pagination py-2">
                        {{ $students->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>


                <!-- Modal tuition fee-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-body">
                                    <h5 class="text-uppercase">đóng phí:</h5>
                                    <div class="row">
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Đợt đóng</label>
                                            <input type="text" name="total_fee" class="form-control border p-2"
                                                placeholder="nhập số đợt..." value=''>
                                            @error('name')
                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-3">
                                            <label class="form-label">phí phải đóng</label>
                                            <p class="py-2">30000000 <span class="text-success">VND</span></p>

                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">thu trước</label>
                                            <input type="text" name="month" class="form-control border p-2"
                                                placeholder="nhập số tiền phải thu..." value=''>

                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <h5> chuyên ngành & niên khóa</h5>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Niên khóa</label>
                                            <select name="schoolYear_id" class="form-select p-2 border border-2"
                                                aria-label="Default select example">
                                                <option selected>Choose SchoolYear...</option>
                                                <option value=""></option>
                                            </select>
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Chuyên Ngành</label>
                                            <select name="major_id"
                                                class="form-select p-2 border border-2 form-select-sm rounded-2"
                                                aria-label=".form-select-sm example">
                                                <option selected>Choose Major...</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">đóng</button>
                                <button type="button" class="btn btn-primary">lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>
    <x-plugins></x-plugins>

</x-layout>
