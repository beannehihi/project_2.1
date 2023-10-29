<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="school_years"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Niên khóa"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div id="data-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0 ">
                                        <thead>
                                            <div class="px-2" style="display:flex">
                                                <button type="button" class="btn shadow border border-2"
                                                    data-mdb-toggle="modal" data-mdb-target="#exampleModal">
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
                                                    Majors</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Create at
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($schoolYears as $schoolYear)
                                                <tr>
                                                    <td class="align-middle w-2">
                                                        <button class="btn border border-1 shadow" type="button"
                                                            id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="fa fa-cog" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu border border-1" style="min-width: 5px"
                                                            aria-labelledby="dropdownMenuButton1">
                                                            <form
                                                                action="   {{ route('school_years_delete', ['id' => $schoolYear->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <li class="px-2 dropdown-item"><button
                                                                        class="dropdown-item"
                                                                        type="submit">Delete</button></li>
                                                            </form>

                                                            <li class="px-4 dropdown-item" data-mdb-toggle="modal"
                                                                data-mdb-target="#editModal">
                                                                edit
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <p class="text-xs text-uppercase text-secondary mb-0">
                                                            {{ $schoolYear->name }}</p>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary  text-xs font-weight-bold">{{ $schoolYear->created_at }}</span>
                                                    </td>
                                                </tr>

                                                {{-- edit --}}
                                                <div class="modal fade" id="editModal" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="btn-close"
                                                                    data-mdb-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="modal-body">
                                                                    <h5 class="text-uppercase">sửa Niên khóa:</h5>
                                                                    <form action="school_years_update" method="post">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $schoolYear->id }}">
                                                                        <div class="row">
                                                                            <div class="mb-3 col-md-12">
                                                                                <label class="form-label">tên niên
                                                                                    khóa</label>
                                                                                <input type="text" name="name"
                                                                                    class="form-control border p-2"
                                                                                    placeholder="nhập tên niên khóa..."
                                                                                    value='{{ $schoolYear->name }}'>
                                                                                @error('name')
                                                                                    <p class='text-danger inputerror'>
                                                                                        {{ $message }} </p>
                                                                                @enderror
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="pagination">
                {{ $schoolYears->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-mdb-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <h5 class="text-uppercase">tạo Niên khóa:</h5>
                            <form action="school_years_add" method="post">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">tên niên khóa</label>
                                        <input type="text" name="name" class="form-control border p-2"
                                            placeholder="nhập tên niên khóa..." value=''>
                                        @error('name')
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


    </main>
    <x-plugins></x-plugins>

</x-layout>
