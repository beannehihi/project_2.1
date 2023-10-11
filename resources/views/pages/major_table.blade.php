<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="majors"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Major"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
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
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Phone</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Date of birth
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
                                                                href="#">Edit</a>
                                                        </li>
                                                    </ul>
                                                </td>

                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">032151841</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">22/03/18</span>
                                                </td>

                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
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
