<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="majors"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Major"></x-navbars.navs.auth>
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
                                                                <li class="px-2 dropdown-item"><button
                                                                        class="dropdown-item"
                                                                        type="submit">Delete</button></li>
                                                            </form>

                                                            <li class="px-2 " data-bs-toggle="modal"
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
                                                            class="text-secondary  text-xs font-weight-bold">{{ $major->created_at }}</span>
                                                    </td>
                                                </tr>


                                                {{-- edit majors --}}
                                                <div class="modal fade" id="editModal_{{ $index }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
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
                                                                    <button type="submit"
                                                                        class="btn btn-info">Lưu</button>
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
                {{ $majors->links('vendor.pagination.bootstrap-5') }}
            </div>
            <x-footers.auth></x-footers.auth>
        </div>

        {{-- add modals --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
