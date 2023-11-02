<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="students"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Student Manager"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">

                {{-- table student --}}
                <div class="col-12">
                    <div class="input-group w-30">
                        <div class="px-4">
                            <button type="button" id="openModalButton" class="btn shadow border border-2 mr-4"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>

                        <div>

                        </div>
                        <form action="{{ route('students') }}" method="GET">
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
                                                student code</th>

                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                                NAME & EMAIL</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Phone</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Date of birth
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Address
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $index => $student)
                                            <tr>
                                                <td class="align-middle" style="width: 1px">
                                                    <div>
                                                        <button class="btn border border-1 shadow" type="button"
                                                            id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="fa fa-cog" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu border border-1" style="min-width: 5px"
                                                            aria-labelledby="dropdownMenuButton1">
                                                            <form
                                                                action="{{ route('students_delete', ['id' => $student->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <li class="px-2 dropdown-item">
                                                                    <button class="dropdown-item"
                                                                        type="submit">Delete</button>
                                                                </li>
                                                            </form>
                                                            <li class="px-2" data-bs-toggle="modal"
                                                                data-bs-target="#editModal_{{ $index }}">
                                                                <a class="dropdown-item" href="#">Edit</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>

                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $student->student_code }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $student->name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $student->email }}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">{{ $student->phone }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($student->date_of_birth)->format('d/m/Y') }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $student->location }}</span>
                                                </td>
                                            </tr>


                                            {{-- modal edit --}}
                                            <div class="modal fade" id="editModal_{{ $index }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close bg-dark"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form
                                                            action="{{ route('students_update', ['id' => $student->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="modal-body">
                                                                <h5>Thông tin sinh viên:</h5>
                                                                <div class="row">
                                                                    <div class="mb-3 col-md-3">
                                                                        <label class="form-label">Mã sinh viên</label>
                                                                        <input type="text" name="student_code"
                                                                            class="form-control border p-2"
                                                                            placeholder="Nhập mã sinh viên..."
                                                                            value="{{ $student->student_code }}"
                                                                            disabled>
                                                                    </div>
                                                                    <div class="mb-3 col-md-3">
                                                                        <label class="form-label">Name</label>
                                                                        <input type="text" name="name"
                                                                            class="form-control border p-2"
                                                                            placeholder="Nhập tên..."
                                                                            value="{{ $student->name }}">
                                                                    </div>
                                                                    <div class="mb-3 col-md-3">
                                                                        <label class="form-label">Date of birth</label>
                                                                        <input type="date" name="date_of_birth"
                                                                            class="form-control border p-2"
                                                                            placeholder="Nhập ngày sinh..."
                                                                            value="{{ $student->date_of_birth }}">
                                                                    </div>
                                                                    <div class="mb-3 col-md-3">
                                                                        <label class="form-label">Phone</label>
                                                                        <input type="text" name="phone"
                                                                            class="form-control border p-2"
                                                                            placeholder="Nhập số điện thoại..."
                                                                            value="{{ $student->phone }}">
                                                                    </div>
                                                                    <div class="mb-3 col-md-3">
                                                                        <label class="form-label">Location</label>
                                                                        <input type="text" name="location"
                                                                            class="form-control border p-2"
                                                                            placeholder="Nhập địa chỉ..."
                                                                            value="{{ $student->location }}">
                                                                    </div>
                                                                    <div class="mb-3 col-md-6">
                                                                        <label class="form-label">Email</label>
                                                                        <input type="email" name="email"
                                                                            class="form-control border p-2"
                                                                            placeholder="Nhập email..."
                                                                            value="{{ $student->email }}">
                                                                    </div>
                                                                    <div class="mb-3 col-md-4">
                                                                        <label class="form-label">Scholarship</label>
                                                                        <input type="text" name="scholarship"
                                                                            class="form-control border p-2"
                                                                            placeholder="Nhập số học bổng..."
                                                                            value="{{ $student->scholarship }}">
                                                                    </div>
                                                                    <div class="mb-3 col-md-6 mt-2 d-flex flex-column">
                                                                        <label class="form-label">Gender</label>
                                                                        <div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input"
                                                                                    type="radio" name="gender"
                                                                                    id="inlineRadio1" value="0"
                                                                                    {{ $student->gender == 0 ? 'checked' : '' }}>
                                                                                <label class="form-check-label"
                                                                                    for="inlineRadio1">Male</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input"
                                                                                    type="radio" name="gender"
                                                                                    id="inlineRadio2" value="1"
                                                                                    {{ $student->gender == 1 ? 'checked' : '' }}>
                                                                                <label class="form-check-label"
                                                                                    for="inlineRadio2">Female</label>
                                                                            </div>
                                                                        </div>
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
                    <div class="pagination py-2">
                        {{ $students->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>

                <!-- Modal add Student -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl   ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('students_add') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <h5>Thông tin sinh viên:</h5>
                                    <div class="row">
                                        <div class="mb-3 col-md-3">
                                            <label class="form-label">Mã sinh vien</label>
                                            <input type="text" name="student_code" class="form-control border p-2"
                                                placeholder="Enter student code..." value=''>
                                            @error('name')
                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control border p-2"
                                                placeholder="Enter name..." value=''>
                                            @error('name')
                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-3">
                                            <label class="form-label">Date of birth</label>
                                            <input type="date" name="date_of_birth"
                                                class="form-control border p-2" placeholder="Enter date..."
                                                value=''>
                                            @error('date')
                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-3">
                                            <label class="form-label">Phone</label>
                                            <input type="text" name="phone" class="form-control border p-2"
                                                placeholder="Enter phone..." value=''>
                                            @error('phone')
                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                        </div>

                                        <input type="hidden" name="password">

                                        <div class="mb-3 col-md-3">
                                            <label class="form-label">Location</label>
                                            <input type="text" name="location" class="form-control border p-2"
                                                placeholder="Enter loaction..." value=''>
                                            @error('Localtion')
                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control border p-2"
                                                placeholder="Enter email..." value=''>
                                            @error('email')
                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">scholarship</label>
                                            <input type="text" name="scholarship" class="form-control border p-2"
                                                placeholder="Enter học bổng..." value=''>
                                            @error('scholarship')
                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6 mt-2 d-flex flex-column">
                                            <label class="form-label">Gender</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="inlineRadio1" value="0" checked>
                                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="inlineRadio2" value="1">
                                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Hủy</button>
                                    <button type="submit" class="btn btn-warning">Lưu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
