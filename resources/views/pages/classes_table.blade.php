<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="Classes"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Classes"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">

                {{-- tag classes --}}
                <div class="col-3">
                    <div class="card my-4">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-warning shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <h4 class="mb-0 text-white py-3">{{ $classes->toArray()['name'] }} </h4>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Niên Khóa</p>
                                <h4 class="mb-0">{{ $classes->toArray()['school_year']['name'] }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <div class="d-flex bd-highlight text-uppercase">
                                <div class="p-2 bd-highlight text-warning h6">khai giảng:</div>
                                <div class="p-2 bd-highlight"></div>
                                <div class="ms-auto p-2 bd-highlight ">
                                    {{ date('d/m/Y', strtotime($classes->toArray()['created_at'])) }}</div>
                            </div>
                            <div class="d-flex bd-highlight text-uppercase">
                                <div class="p-2 bd-highlight text-info h6">sinh viên:</div>
                                <div class="p-2 bd-highlight"></div>
                                <div class="ms-auto p-2 bd-highlight ">{{ $studentCount }}</div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- table student --}}
                <div class="col-9">
                    <div class="card my-4">
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 ">
                                    <thead>
                                        <div class="px-2" style="display:flex">
                                            <button type="button" id="openModalButton"
                                                class="btn shadow border border-2" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                            <form action="{{ route('classes', ['id' => $classes->id]) }}" method="GET"
                                                class="ml-auto">
                                                <div class="position-relative mt-1 mx-12" style="flex: 1">
                                                    <div class="input-group input-group-outline">
                                                        <input type="text" class="form-control" name="search_text"
                                                            placeholder="Search by student code..."
                                                            style="padding-right: 70px !important">
                                                    </div>
                                                    <button type="submit"
                                                        class="btn btn-primary mb-0 position-absolute end-0 top-0"
                                                        style="border-radius: 0 6px 6px 0">
                                                        <i class="fa fa-search" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                student code</th>

                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                PHOTO</th>
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
                                                STATUS
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
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
                                                            <li class="px-2">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('classes.delete', $student->id) }}">
                                                                    Delete
                                                                </a>
                                                            </li>
                                                            <li class="px-2 " data-bs-toggle="modal"
                                                                data-bs-target="#editModal">
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
                                                    <div class="d-flex px-2 py-1" style="width: 1px;">
                                                        <div>
                                                            <img src="{{ $student->img }}"
                                                                class="avatar avatar-sm me-3 border-radius-lg"
                                                                alt="user1">
                                                        </div>

                                                    </div>
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
                                                        class="text-secondary text-xs font-weight-bold">{{ $student->date_of_birth }}</span>
                                                </td>
                                                <td class="align-middle" style="width: 1px">
                                                    <span class="btn btn-warning shadow" type="button"
                                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        Debt
                                                    </span>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="pagination">
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
                            <form action="{{ route('classes.add', ['class_id', $classes->id]) }}" method="POST">
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

                                        <div class="mb-3 col-md-3">
                                            <label class="form-label">Image</label>
                                            <input class="form-control form-control-sm border border-2" type="file"
                                                name="img">

                                            <div class="avatar avatar-xl position-relative mt-2">
                                                <img alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mt-4">
                                        <h5> sinh viên:</h5>
                                        <div class="mb-3 col-md-3">
                                            <label class="form-label">Class</label>
                                            <select name="class_id" class="form-select p-2 border border-2"
                                                aria-label="Default select example">
                                                <option value="{{ $classes->id }}" selected>{{ $classes->name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-3">
                                            <label class="form-label">Major</label>
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
