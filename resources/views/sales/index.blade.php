@extends('sales.layouts.master')
@section('page_title')
    {{$setting->title}} | Home
@endsection
@section('links')
{{--    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">family Access</li>--}}
@endsection
@section('content')
      <h2 class="MainTiltle mb-5 ms-4">General Statistics</h2>
      <div class="row">
        <div class="col-lg-7 position-relative z-index-2">
          <div class="row">
{{--            <div class="col-lg-5 col-sm-6 p-2">--}}
{{--              <div class="card">--}}
{{--                <div class="card-body p-2">--}}
{{--                  <div class="row">--}}
{{--                    <div class="col-8">--}}
{{--                      <div class="numbers">--}}
{{--                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Money</p>--}}
{{--                        <h5 class="font-weight-bolder mb-0">--}}
{{--                          {{$today_money}}--}}
{{--                          <span class="text-success text-sm font-weight-bolder">EGP</span>--}}
{{--                        </h5>--}}
{{--                      </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-4 text-end">--}}
{{--                      <div class="icon icon-shape bg-gradient-primary shadow ms-auto text-center border-radius-md">--}}
{{--                        <i class="fas fa-sack-dollar"></i>--}}
{{--                      </div>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
            <div class="col-lg-5 col-sm-6 p-2">
              <div class="card">
                <div class="card-body p-2">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">New Clients</p>
                        <h5 class="font-weight-bolder mb-0">
                          +{{$new_clients}}
                        </h5>
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-primary shadow ms-auto text-center border-radius-md">
                        <i class="fas fa-sparkles"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-5 col-sm-6 p-2">
              <div class="card">
                <div class="card-body p-2">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Clients</p>
                        <h5 class="font-weight-bolder mb-0">
                          {{$clients_count}}
                        </h5>
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-primary shadow ms-auto text-center border-radius-md">
                        <i class="fas fa-globe-europe"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-7">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Clients overview</h6>
              <p class="text-sm">
{{--                <i class="fa fa-arrow-up text-success"></i>--}}
{{--                <span class="font-weight-bold">4% more</span> in 2021--}}
              </p>
            </div>
            <div class="card-body p-2">
              <div class="chart">
                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div id="globe" class="position-absolute end-0 top-10 mt-sm-3 mt-7 me-lg-7">
            <canvas width="700" height="600" class="w-lg-100 h-lg-100 w-75 h-75 me-lg-0 me-n10 mt-lg-5"></canvas>
          </div>
        </div>
      </div>
@endsection
@section('js')
    <script type="text/javascript" src="{{asset('assets/sales')}}/js/plugins/chartjs.min.js"></script>
    <script type="text/javascript" src="{{asset('assets/sales')}}/js/plugins/threejs.js"></script>
    <script type="text/javascript" src="{{asset('assets/sales')}}/js/plugins/orbit-controls.js"></script>
    <script>
        ///////////////////////////////////////////////////////
        // charts
        ///////////////////////////////////////////////////////
        //  chart-line
        var ctx2 = document.getElementById("chart-line").getContext("2d");
        var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
        gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors
        var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);
        gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
        gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors
        new Chart(ctx2, {
            type: "line",
            data: {
                labels: [@foreach($clients as $client) "{{$client['month']}}", @endforeach],
                datasets: [
                    {
                        label: "Clients",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#3A416F",
                        borderWidth: 3,
                        backgroundColor: gradientStroke2,
                        fill: true,
                        data: [@foreach($clients as $client) "{{$client['count']}}", @endforeach],
                        maxBarThickness: 6
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#b2b9bf',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#b2b9bf',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
        // globe
        (function () {
            const container = document.getElementById("globe");
            const canvas = container.getElementsByTagName("canvas")[0];
            const globeRadius = 100;
            const globeWidth = 4098 / 2;
            const globeHeight = 1968 / 2;

            function convertFlatCoordsToSphereCoords(x, y) {
                let latitude = ((x - globeWidth) / globeWidth) * -180;
                let longitude = ((y - globeHeight) / globeHeight) * -90;
                latitude = (latitude * Math.PI) / 180;
                longitude = (longitude * Math.PI) / 180;
                const radius = Math.cos(longitude) * globeRadius;
                return {
                    x: Math.cos(latitude) * radius,
                    y: Math.sin(longitude) * globeRadius,
                    z: Math.sin(latitude) * radius
                };
            }

            function makeMagic(points) {
                const {
                    width,
                    height
                } = container.getBoundingClientRect();
                // 1. Setup scene
                const scene = new THREE.Scene();
                // 2. Setup camera
                const camera = new THREE.PerspectiveCamera(45, width / height);
                // 3. Setup renderer
                const renderer = new THREE.WebGLRenderer({
                    canvas,
                    antialias: true
                });
                renderer.setSize(width, height);
                // 4. Add points to canvas
                // - Single geometry to contain all points.
                const mergedGeometry = new THREE.Geometry();
                // - Material that the dots will be made of.
                const pointGeometry = new THREE.SphereGeometry(0.5, 1, 1);
                const pointMaterial = new THREE.MeshBasicMaterial({
                    color: "#989db5",
                });
                for (let point of points) {
                    const {
                        x,
                        y,
                        z
                    } = convertFlatCoordsToSphereCoords(
                        point.x,
                        point.y,
                        width,
                        height
                    );
                    if (x && y && z) {
                        pointGeometry.translate(x, y, z);
                        mergedGeometry.merge(pointGeometry);
                        pointGeometry.translate(-x, -y, -z);
                    }
                }
                const globeShape = new THREE.Mesh(mergedGeometry, pointMaterial);
                scene.add(globeShape);
                container.classList.add("peekaboo");
                // Setup orbital controls
                camera.orbitControls = new THREE.OrbitControls(camera, canvas);
                camera.orbitControls.enableKeys = false;
                camera.orbitControls.enablePan = false;
                camera.orbitControls.enableZoom = false;
                camera.orbitControls.enableDamping = false;
                camera.orbitControls.enableRotate = true;
                camera.orbitControls.autoRotate = true;
                camera.position.z = -265;

                function animate() {
                    // orbitControls.autoRotate is enabled so orbitControls.update
                    // must be called inside animation loop.
                    camera.orbitControls.update();
                    requestAnimationFrame(animate);
                    renderer.render(scene, camera);
                }
                animate();
            }

            function hasWebGL() {
                const gl =
                    canvas.getContext("webgl") || canvas.getContext("experimental-webgl");
                if (gl && gl instanceof WebGLRenderingContext) {
                    return true;
                } else {
                    return false;
                }
            }

            function init() {
                if (hasWebGL()) {
                    window
                    window.fetch(
                        "https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-dashboard-pro/assets/js/points.json"
                    )
                        .then(response => response.json())
                        .then(data => {
                            makeMagic(data.points);
                        });
                }
            }
            init();
        })();

        $('#mainHome').addClass('active');
    </script>
@endsection
