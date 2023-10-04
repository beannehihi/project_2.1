<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="School Year"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="School Year"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4" style="height: 80vh">
            <div class="py-4">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    thêm liên khóa
                </button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClassModal">
                    Thêm lớp
                </button>
            </div>

            <div class="row">
                @foreach ($schoolYears as $index => $schoolYear)
                    <div class="col-xl-3 col-sm-3 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-header p-3 pt-2">
                                <div
                                    class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                    <h4 class="mb-0 text-white py-3">{{ $schoolYear->name }}</h4>
                                </div>
                                <div class="text-end pt-1">
                                    <p>
                                        <button class="btn btn-warning" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#a{{ $index }}" aria-expanded="false"
                                            aria-controls="a{{ $index }}">
                                            Class <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </button>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn " data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $index }}">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </button>
                                    </p>
                                </div>
                            </div>
                            @foreach ($classes as $class)
                                @if ($class->schoolYear_id === $schoolYear->id)
                                    <div class="card-footer p-3">
                                        <div class="collapse" id="a{{ $index }}">
                                            <a href="#">
                                                <div class="card card-body p-2 text-center fs-4 mb-2 ">
                                                    {{ $class->name }}
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    {{-- Modal update schoolYear --}}
                    <div class="modal fade" id="exampleModal{{ $index }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit liên khóa</h5>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('school_years_update', $schoolYear->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" value="{{ $schoolYear->id }}">
                                        <div class="modal-body">
                                            <div class="input-group input-group-dynamic mb-4">
                                                <input type="text" class="form-control"
                                                    aria-label="Amount (to the nearest dollar)"
                                                    value="{{ $schoolYear->name }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary h-4">cập nhật</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Modal Add -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Liên khóa</h5>
                            <button type="button" class="btn-close bg-primary" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('school_years_add') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">tên Liên khóa </label>
                                    <input name="name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary h-4">Thêm mới</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Add Class -->
            <div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addClassModalLabel">Thêm lớp</h5>
                            <button type="button" class="btn-close bg-primary" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="" method="">
                            @csrf
                            <div class="modal-body">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Tên lớp</label>
                                    <input name="class_name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Thêm lớp</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
