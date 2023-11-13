<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            {{-- card --}}
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize text-uppercase">Số Lượng Chuyên Ngành</p>
                                <h4 class="mb-0">{{ $majorsCount }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons">person</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Số lượng Sinh Viên</p>
                                <h4 class="mb-0">{{ $studentsCount }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Số Lượng liên Khóa</p>
                                <h4 class="mb-0">{{ $schoolYearCount }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">

                        </div>
                    </div>
                </div>

            </div>

            {{-- chart --}}
            <div class="row mt-4">
                <div class=" col-md-5 mt-4 mb-4 ">
                    <div class="card z-index-2 ">
                        <div class="card-header p-0 position-relative mt-n4 z-index-2 bg-transparent mx-100%">
                            <div class="bg-gradient shadow-secondary  border-radius-lg py-3 pe-1">
                                <div class="chart text-white">
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 ">Thống kê</h6>
                            <p class="text-sm ">Tỉ lệ sinh viên nợ học phí của mỗi niên khóa</p>
                            <hr class="dark horizontal">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>
    </div>
    {{-- js chart --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const chartData = @json($chartData);

        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'bar', // Loại biểu đồ, có thể là 'bar', 'line', etc.
            data: chartData, // Sử dụng dữ liệu từ controller
            options: {
                indexAxis: 'x', // Chọn trục cho biểu đồ cột nằm ngang
                scales: {
                    y: {
                        beginAtZero: true // Yêu cầu trục y bắt đầu từ 0
                    }
                },
                plugins: {
                    legend: {
                        display: true
                    },
                    title: {
                        display: true,
                        text: 'Tỉ lệ sinh viên nợ học phí'
                    }
                }
            }
        });
    </script>
</x-layout>
