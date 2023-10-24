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
                    <div class="card my-4">
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 ">
                                    <thead>
                                        <div class="px-2" style="display:flex">
                                            <button type="button" class="btn shadow border border-2"
                                                data-bs-toggle="modal" data-bs-target="#feeAddModal">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                            <div class="position-relative mt-1 mx-12" style="flex: 1">
                                                <div class="input-group input-group-outline">
                                                    <label class="form-label">Search</label>
                                                    <input type="text" class="form-control"
                                                        style="padding-right: 70px !important">
                                                </div>
                                                <button class="btn btn-primary mb-0 position-absolute end-0 top-0"
                                                    style="border-radius: 0 6px 6px 0"><i class="fa fa-search"
                                                        aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                SchoolYear & Major</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Payment period</th>
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

                                                        <li class="px-2 " data-bs-toggle="modal"
                                                            data-bs-target="#editModal_{{ $index }}"><button
                                                                class="dropdown-item " href="#">Edit</button>
                                                        </li>
                                                    </ul>
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
                                                        {{ $fee->total_fee }}<span
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
                                                                            <label class="form-label">tổng phí</label>
                                                                            <input type="text" name="total_fee"
                                                                                class="form-control border p-2"
                                                                                placeholder="Enter name..."
                                                                                value='{{ $fee->total_fee }}' disabled>
                                                                            @error('name')
                                                                                <p class='text-danger inputerror'>
                                                                                    {{ $message }} </p>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="mb-3 col-md-4">
                                                                            <label class="form-label">Đợt đóng</label>
                                                                            <input type="number" name="month"
                                                                                class="form-control border p-2"
                                                                                placeholder="Enter date..."
                                                                                value='{{ $fee->month }}'>
                                                                            @error('date')
                                                                                <p class='text-danger inputerror'>
                                                                                    {{ $message }} </p>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-4">
                                                                        <h5> chuyên ngành & niên khóa</h5>
                                                                        <div class="mb-3 col-md-6">
                                                                            <label class="form-label">Niên khóa</label>
                                                                            <select name="schoolYear_id"
                                                                                class="form-select p-2 border border-2"
                                                                                aria-label="Default select example">
                                                                                <option selected>Choose SchoolYear...
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
            <div class="pagination">
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
                                    <label class="form-label">tổng phí</label>
                                    <input type="text" name="total_fee" class="form-control border p-2"
                                        placeholder="Enter name..." value=''>
                                    @error('name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Đợt đóng</label>
                                    <input type="text" name="month" class="form-control border p-2"
                                        placeholder="Enter date..." value=''>
                                    @error('date')
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



    </main>
    <x-plugins></x-plugins>

</x-layout>
