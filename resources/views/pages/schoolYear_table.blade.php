<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="school_years"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Niên khóa"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4" style="height-auto">
            <div class="py-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addClassModal">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                </button>
            </div>

            <div class="row">
                @foreach ($schoolYears as $index => $schoolYear)
                    <div class="col-xl-3 col-sm-3 mb-xl-0 mb-4 py-5">
                        <div class="card">
                            <div class="card-header p-3 pt-2">
                                <div
                                    class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                    <h4 class="mb-0 text-white py-3">{{ $schoolYear->name }}</h4>
                                </div>
                                <div class="text-end pt-1">
                                    @if ($schoolYear->total_classes > 0)
                                        <button class="btn btn-warning" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#a{{ $index }}" aria-expanded="false"
                                            aria-controls="a{{ $index }}">
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </button>
                                    @else
                                        <button class="btn btn-warning" type="button" disabled>
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </button>
                                    @endif
                                    <!-- Button modal -->
                                    <button type="button" class="btn border border-1 shadow" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $index }}">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <p class="mb-0 text-xl font-weight-bolder text-warning"><span
                                        class="text-success text-sm font-weight-bolder">Số Lượng:
                                    </span>{{ $schoolYear->total_classes ?? 0 }}</p>
                            </div>

                            <div class="collapse" id="a{{ $index }}">
                                @foreach ($classes as $class)
                                    @if ($class->schoolYear_id === $schoolYear->id)
                                        <div class="card-footer p-3 ">
                                            <a href="classes/{{ $class->id }}">
                                                <div class="card card-body p-2 text-center fs-4 mb-2 ">
                                                    {{ $class->name }}
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="card-footer p-3"></div>
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
                                                <input type="text" class="form-control" name="name"
                                                    aria-label="Amount (to the nearest dollar)"
                                                    value="{{ $schoolYear->name }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary h-4">Cập nhật</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Modal Add SchoolYear -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">niên khóa</h5>
                            <button type="button" class="btn-close bg-primary" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('school_years_add') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">tên niên khóa </label>
                                    <input name="name" type="text" class="form-control">
                                    @error('name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
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
                        <form action="{{ route('class_add') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Tên lớp</label>
                                    <input name="name" type="text" class="form-control">
                                    @error('name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <select name="schoolYear_id" class="form-select form-select-lg mb-3"
                                    aria-label=".form-select-lg example">
                                    <option selected>Chọn liên khóa</option>
                                    @foreach ($schoolYears as $year)
                                        <option value={{ $year->id }}>{{ $year->name }}</option>
                                    @endforeach
                                </select>
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
