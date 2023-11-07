<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="majors"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Major"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="input-group w-30">
                        <div class="px-4">
                            <button type="button" class="btn shadow border border-2" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>

                        <form action="{{ route('majors') }}" method="GET">
                            <div class="d-flex">
                                <input type="search" name="search_term" class="form-control rounded"
                                    placeholder="Search" aria-label="Search" aria-describedby="search-addon"
                                    style="width: 250px ; height: 37px;" />
                                <button type="submit" class="btn btn-outline-primary text-primary"
                                    style="height: 35px"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </form>
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
                                                Majors</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Create at
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($majors as $index => $major)
                                            <tr>
                                                <td class="align-middle w-2">
                                                    <button class="btn border border-1 shadow" type="button"
                                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                                    </button>
                                                    <ul class="dropdown-menu border border-1" style="min-width: 5px"
                                                        aria-labelledby="dropdownMenuButton1">
                                                        <form action="{{ route('majors_delete', $major->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <li class="px-2 dropdown-item"><button class="dropdown-item"
                                                                    type="submit">Delete</button></li>
                                                        </form>

                                                        <li class="px-2 dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#editModal_{{ $index }}"><button
                                                                class="dropdown-item " href="#">Edit</button>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-uppercase text-secondary mb-0">
                                                        {{ $major->name }}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary  text-xs font-weight-bold">{{ \Carbon\Carbon::parse($major->created_at)->format('d/m/Y') }}</span>
                                                </td>
                                            </tr>


                                            {{-- edit majors --}}
                                            <div class="modal fade" id="editModal_{{ $index }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close bg-dark"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('major_update', $major->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="id"
                                                                value="{{ $major->id }}">
                                                            <div class="modal-body">
                                                                <h5>Sửa chuyên ngành:</h5>
                                                                <div class="row">
                                                                    <div class="mb-3 col-md-12">
                                                                        <label class="form-label">Major Name</label>
                                                                        <input type="text" name="name"
                                                                            class="form-control border border-info p-2"
                                                                            placeholder="Enter major..."
                                                                            value='{{ $major->name }}'>
                                                                        @error('name')
                                                                            <p class='text-danger inputerror'>
                                                                                {{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Hủy</button>
                                                                <button type="submit" class="btn btn-info">Lưu</button>
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
                {{ $majors->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>

        {{-- add modals major --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('majors_add') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <h5>Thêm chuyên ngành:</h5>
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Major Name</label>
                                    <input type="text" name="name" class="form-control border border-info p-2 "
                                        placeholder="Enter major..." value=''>
                                    @error('name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-info">Lưu</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>



    </main>
    <x-plugins></x-plugins>

</x-layout>
