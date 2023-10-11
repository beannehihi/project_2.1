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
                                <h4 class="mb-0 text-white py-3">D04</h4>

                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Niên Khóa</p>
                                <h4 class="mb-0">K13</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0 text-xl font-weight-bolder text-warning"><span
                                    class="text-success text-sm font-weight-bolder">Số lượng: </span>100
                            </p>

                            <p class="mb-0 text-xl font-weight-bolder text-danger"><span
                                    class="text-warning text-sm font-weight-bolder">Số lượng nợ học phí: </span>100
                            </p>
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
                                            <button type="button" class="btn shadow border border-2"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                                        @for ($i = 0; $i < 3; $i++)
                                            <tr>
                                                <td class="align-middle">
                                                    <button class="btn border border-1 shadow" type="button"
                                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                                    </button>
                                                    <ul class="dropdown-menu border border-1" style="min-width: 5px"
                                                        aria-labelledby="dropdownMenuButton1">
                                                        <li class="px-2 "><a class="dropdown-item "
                                                                href="#">Delete</a></li>
                                                        <li class="px-2 " data-bs-toggle="modal"
                                                            data-bs-target="#editModal"><a class="dropdown-item "
                                                                href="#">Edit</a></li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/team-2.jpg"
                                                                class="avatar avatar-sm me-3 border-radius-lg"
                                                                alt="user1">
                                                        </div>

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">John</h6>
                                                        <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>

                                                    </div>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">032151841</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">22/03/18</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a class="btn btn-warning rounded py-2" href="">
                                                        <span
                                                            class="text-secondary text-xl text-white font-weight-bold ">debt</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
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

                            <div class="modal-body">
                                <h5>Thông tin sinh viên:</h5>
                                <div class="row">
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
                                        <input type="date" name="date_of_birth" class="form-control border p-2"
                                            placeholder="Enter date..." value=''>
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

                                    <div class="mb-3 col-md-3">
                                        <label class="form-label">Location</label>
                                        <input type="text" name="loaction" class="form-control border p-2"
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
                                                <input class="form-check-input" type="radio"
                                                    name="inlineRadioOptions" id="inlineRadio1" value="option1"
                                                    checked>
                                                <label class="form-check-label" for="inlineRadio1">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                <label class="form-check-label" for="inlineRadio2">Female</label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="formFileSm" class="form-label">Image</label>
                                        <input class="form-control form-control-sm border border-2" id="formFileSm"
                                            type="file">

                                        <div class="avatar avatar-xl position-relative mt-2">
                                            <img src="{{ asset('assets') }}/img/bruce-mars.jpg" alt="profile_image"
                                                class="w-100 border-radius-lg shadow-sm">
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-4">
                                    <h5> sinh viên:</h5>
                                    <div class="mb-3 col-md-3">
                                        <label class="form-label">Class</label>
                                        <select name="classes" class="form-select p-2 border border-2"
                                            aria-label="Default select example" disabled>
                                            <option selected>DO4</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-md-3">
                                        <label class="form-label">Major</label>
                                        <select name="majors"
                                            class="form-select p-2 border border-2 form-select-sm rounded-2"
                                            aria-label=".form-select-sm example">
                                            <option selected>Choose Major...</option>
                                            <option value="1">One</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                <button type="button" class="btn btn-warning">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
