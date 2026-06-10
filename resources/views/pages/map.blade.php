@section('section_name', 'Interactive Map')
<x-app-layout>
    <!-- Include Pannellum CDN Assets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>

    <div class="space-y-6 pb-12 pt-4">
        <!-- Main Virtual Tour & Interactive Map Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left & Center: 360° Viewer -->
            <div class="lg:col-span-2 flex flex-col gap-4">
                <div class="relative bg-white rounded-3xl p-3 shadow-md border border-gray-100 h-[500px] md:h-[600px] flex flex-col group">
                    <!-- Viewer Container -->
                    <div id="panorama-viewer" class="w-full flex-1 rounded-2xl overflow-hidden bg-gray-950 relative">
                        <!-- Loading Indicator Overlay -->
                        <div id="viewer-loader" class="absolute inset-0 bg-gray-950 flex flex-col items-center justify-center text-white z-50 transition-opacity duration-500 pointer-events-none">
                            <div class="w-12 h-12 border-4 border-museum-beige border-t-museum-brown rounded-full animate-spin mb-4"></div>
                            <p class="text-sm font-semibold text-museum-beige tracking-wider animate-pulse">MEMUAT PANORAMA 360°...</p>
                            <p class="text-xs text-gray-500 mt-1 max-w-xs text-center leading-relaxed">Menyiapkan gambar resolusi tinggi untuk pengalaman terbaik.</p>
                        </div>



                        <!-- Coordinate Debug Badge (Floating inside viewer) -->
                        <div class="absolute top-4 right-4 z-40 bg-black/60 backdrop-blur-md text-white px-3 py-2 rounded-xl text-[10px] font-mono border border-white/10 flex items-center gap-2 select-none shadow-md">
                            <i class="fas fa-crosshairs text-museum-beige"></i>
                            <span id="coord-text">Klik pintu untuk koordinat</span>
                        </div>

                        <!-- Fullscreen Custom Button -->
                        <button onclick="toggleViewerFullscreen()" class="absolute bottom-4 right-4 z-40 bg-black/60 hover:bg-black/80 backdrop-blur-md text-white p-3 rounded-xl border border-white/10 transition-all hover:scale-105 active:scale-95 shadow-md">
                            <i class="fas fa-expand text-sm"></i>
                        </button>
                    </div>
                </div>

                <!-- Scene Description Card -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex gap-4 items-start">
                    <div class="w-12 h-12 rounded-2xl bg-museum-green/10 flex items-center justify-center text-museum-green flex-shrink-0">
                        <i id="room-info-icon" class="fas fa-leaf text-xl"></i>
                    </div>
                    <div>
                        <h3 id="room-info-title" class="font-serif text-lg font-bold text-museum-green">Taman Singhasari</h3>
                        <p id="room-info-desc" class="text-sm text-gray-600 mt-1 leading-relaxed">
                            Area terbuka hijau di bagian belakang museum yang asri, cocok untuk bersantai dan menikmati suasana tenang setelah berkeliling.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right: Sidebar -->
            <div class="flex flex-col gap-6">
                <!-- Room Selection List -->
                <div class="bg-white rounded-3xl p-5 shadow-md border border-gray-100 flex-1 flex flex-col">
                    <h3 class="font-serif text-lg font-bold text-museum-green mb-4 flex items-center gap-2">
                        <i class="fas fa-list text-museum-brown"></i>
                        Daftar Area Museum
                    </h3>
                    <div class="space-y-2 flex-1 overflow-y-auto max-h-[600px] pr-1">
                        <!-- Garden -->
                        <button onclick="changeScene('garden')" id="btn-garden" class="w-full text-left p-3 rounded-2xl border border-museum-beige/30 hover:border-museum-green hover:bg-museum-beige/10 flex items-center gap-3 transition-all scene-select-btn">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-sm text-museum-text truncate">Taman Singhasari</h4>
                                <p class="text-[10px] text-gray-400">Luar Ruangan</p>
                            </div>
                            <div class="active-indicator w-2 h-2 rounded-full bg-emerald-500 opacity-0"></div>
                        </button>

                        <!-- Front 2 -->
                        <button onclick="changeScene('front2')" id="btn-front2" class="w-full text-left p-3 rounded-2xl border border-museum-beige/30 hover:border-museum-green hover:bg-museum-beige/10 flex items-center gap-3 transition-all scene-select-btn">
                            <div class="w-10 h-10 rounded-xl bg-museum-brown/10 text-museum-brown flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-road"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-sm text-museum-text truncate">Halaman Samping Kanan</h4>
                                <p class="text-[10px] text-gray-400">Halaman Depan</p>
                            </div>
                            <div class="active-indicator w-2 h-2 rounded-full bg-museum-brown opacity-0"></div>
                        </button>

                        <!-- Front 1 -->
                        <button onclick="changeScene('front1')" id="btn-front1" class="w-full text-left p-3 rounded-2xl border border-museum-beige/30 hover:border-museum-green hover:bg-museum-beige/10 flex items-center gap-3 transition-all scene-select-btn">
                            <div class="w-10 h-10 rounded-xl bg-museum-brown/10 text-museum-brown flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-door-open"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-sm text-museum-text truncate">Pintu Masuk Utama</h4>
                                <p class="text-[10px] text-gray-400">Halaman Depan</p>
                            </div>
                            <div class="active-indicator w-2 h-2 rounded-full bg-museum-brown opacity-0"></div>
                        </button>

                        <!-- Indoor 4 -->
                        <button onclick="changeScene('indoor4')" id="btn-indoor4" class="w-full text-left p-3 rounded-2xl border border-museum-beige/30 hover:border-museum-green hover:bg-museum-beige/10 flex items-center gap-3 transition-all scene-select-btn">
                            <div class="w-10 h-10 rounded-xl bg-museum-green/10 text-museum-green flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-scroll"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-sm text-museum-text truncate">Ruang Replika & Dokumen</h4>
                                <p class="text-[10px] text-gray-400">Lantai 1 - Indoor</p>
                            </div>
                            <div class="active-indicator w-2 h-2 rounded-full bg-museum-green opacity-0"></div>
                        </button>

                        <!-- Indoor 3 -->
                        <button onclick="changeScene('indoor3')" id="btn-indoor3" class="w-full text-left p-3 rounded-2xl border border-museum-beige/30 hover:border-museum-green hover:bg-museum-beige/10 flex items-center gap-3 transition-all scene-select-btn">
                            <div class="w-10 h-10 rounded-xl bg-museum-green/10 text-museum-green flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-wine-glass"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-sm text-museum-text truncate">Ruang Keramik & Logam</h4>
                                <p class="text-[10px] text-gray-400">Lantai 1 - Indoor</p>
                            </div>
                            <div class="active-indicator w-2 h-2 rounded-full bg-museum-green opacity-0"></div>
                        </button>

                        <!-- Indoor 2 -->
                        <button onclick="changeScene('indoor2')" id="btn-indoor2" class="w-full text-left p-3 rounded-2xl border border-museum-beige/30 hover:border-museum-green hover:bg-museum-beige/10 flex items-center gap-3 transition-all scene-select-btn">
                            <div class="w-10 h-10 rounded-xl bg-museum-green/10 text-museum-green flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-monument"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-sm text-museum-text truncate">Ruang Arca & Prasasti</h4>
                                <p class="text-[10px] text-gray-400">Lantai 1 - Indoor</p>
                            </div>
                            <div class="active-indicator w-2 h-2 rounded-full bg-museum-green opacity-0"></div>
                        </button>

                        <!-- Indoor 1 -->
                        <button onclick="changeScene('indoor1')" id="btn-indoor1" class="w-full text-left p-3 rounded-2xl border border-museum-beige/30 hover:border-museum-green hover:bg-museum-beige/10 flex items-center gap-3 transition-all scene-select-btn">
                            <div class="w-10 h-10 rounded-xl bg-museum-green/10 text-museum-green flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-landmark"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-sm text-museum-text truncate">Ruang Pameran Utama</h4>
                                <p class="text-[10px] text-gray-400">Lantai 1 - Indoor</p>
                            </div>
                            <div class="active-indicator w-2 h-2 rounded-full bg-museum-green opacity-0"></div>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Active Button Tailwind Styles -->
    <style>
        .active-scene-btn {
            background-color: rgba(213, 198, 177, 0.25);
            border-color: #1B4A47 !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .active-scene-btn .active-indicator {
            opacity: 1 !important;
        }
        .room-group rect {
            transition: all 0.25s ease;
        }
        .room-group:hover rect {
            fill: rgba(27, 74, 71, 0.08);
            stroke-width: 2.5px;
        }
        .room-group.active-room rect {
            fill: rgba(27, 74, 71, 0.15);
            stroke: #8A5A3C;
            stroke-width: 2.5px;
        }
    </style>

    <script type="text/javascript">
        // Room Metadata for UI updates (Single Source of Truth)
        const roomMeta = {
            garden: {
                title: "Taman Singhasari",
                desc: "Area terbuka hijau di bagian belakang museum yang asri, cocok untuk bersantai dan menikmati suasana tenang setelah berkeliling.",
                icon: "fas fa-leaf",
                pin: { cx: 375, cy: 50, color: "#22C55E" }
            },
            front2: {
                title: "Halaman Samping Kanan",
                desc: "Area luar museum sebelah kanan yang menampilkan keindahan arsitektur gedung museum dari sudut pandang yang berbeda.",
                icon: "fas fa-road",
                pin: { cx: 335, cy: 310, color: "#8A5A3C" }
            },
            front1: {
                title: "Halaman Samping Kiri",
                desc: "Pintu masuk utama Museum Singhasari yang menyambut para pengunjung dengan latar belakang bangunan megah berasitektur khas Jawa Timur.",
                icon: "fas fa-door-open",
                pin: { cx: 220, cy: 310, color: "#8A5A3C" }
            },
            indoor4: {
                title: "Ruang Replika & Dokumen",
                desc: "Menampilkan dokumen-dokumen sejarah, peta wilayah kekuasaan Singhasari, serta replika artefak berharga lainnya.",
                icon: "fas fa-scroll",
                pin: { cx: 340, cy: 135, color: "#1B4A47" }
            },
            indoor3: {
                title: "Ruang Keramik & Logam",
                desc: "Berisi piring, guci, mangkok keramik kuno hasil perdagangan, serta senjata dan perkakas logam peninggalan masa lampau.",
                icon: "fas fa-wine-glass",
                pin: { cx: 220, cy: 135, color: "#1B4A47" }
            },
            indoor2: {
                title: "Ruang Arca & Prasasti",
                desc: "Menyimpan replika arca-arca peninggalan Singhasari seperti Arca Prajnaparamita, Ganesha, dan prasasti bertuliskan aksara Jawa Kuno.",
                icon: "fas fa-monument",
                pin: { cx: 100, cy: 135, color: "#1B4A47" }
            },
            indoor1: {
                title: "Ruang Batu dan Candi",
                desc: "Ruangan pertama setelah memasuki museum, berisi berbagai koleksi pembuka, papan informasi sejarah Kerajaan Singhasari, dan pengenalan umum.",
                icon: "fas fa-landmark",
                pin: { cx: 220, cy: 225, color: "#1B4A47" }
            }
        };

        let pannellumViewer = null;

        // Initialize Pannellum Viewer when DOM is fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            try {
                // Base Config
                const config = {
                    "default": {
                        "firstScene": "garden",
                        "author": "Museum Singhasari",
                        "autoLoad": true,
                        "autoRotate": -1,
                        "compass": false,
                        "showControls": true
                    },
                    "scenes": {
                        "front1": {
                            "hfov": 80,
                            "pitch": 0,
                            "yaw": 0,
                            "type": "equirectangular",
                            "panorama": "/images/panorama/front1.jpg",
                            "haov": 290.0,
                            "vaov": 55.2,
                            "vOffset": 0.0,
                            "hotSpots": [
                                {
                                    "pitch": 8.2,
                                    "yaw": 45,
                                    "type": "scene",
                                    "sceneId": "front2"
                                },
                                {
                                    "pitch": 0,
                                    "yaw": -118,
                                    "type": "scene",
                                    "sceneId": "indoor1"
                                }
                            ]
                        },
                        "front2": {
                            "hfov": 80,
                            "pitch": 0,
                            "yaw": -90,
                            "type": "equirectangular",
                            "panorama": "/images/panorama/front2.jpg",
                            "haov": 290.0,
                            "vaov": 53.8,
                            "vOffset": 0.0,
                            "hotSpots": [
                                {
                                    "pitch": 1,
                                    "yaw": -132,
                                    "type": "scene",
                                    "sceneId": "front1"
                                },
                                {
                                    "pitch": 6.4,
                                    "yaw": 61,
                                    "type": "scene",
                                    "sceneId": "garden"
                                }
                            ]
                        },
                        "indoor1": {
                            "hfov": 80,
                            "pitch": -5,
                            "yaw": -20,
                            "type": "equirectangular",
                            "panorama": "/images/panorama/indoor1.jpg",
                            "haov": 290.0,
                            "vaov": 54.3,
                            "vOffset": 0.0,
                            "hotSpots": [
                                {
                                    "pitch": 8,
                                    "yaw": -106,
                                    "type": "scene",
                                    "sceneId": "front1"
                                },
                                {
                                    "pitch": 0.4,
                                    "yaw": -140,
                                    "type": "scene",
                                    "sceneId": "indoor2"
                                }
                            ]
                        },
                        "indoor2": {
                            "hfov": 80,
                            "pitch": -5,
                            "yaw": -10,
                            "type": "equirectangular",
                            "panorama": "/images/panorama/indoor2.jpg",
                            "haov": 290.0,
                            "vaov": 54.1,
                            "vOffset": 0.0,
                            "hotSpots": [
                                {
                                    "pitch": -3,
                                    "yaw": -132,
                                    "type": "scene",
                                    "sceneId": "indoor1"
                                },
                                {
                                    "pitch": -1,
                                    "yaw": 34,
                                    "type": "scene",
                                    "sceneId": "indoor3"
                                }
                            ]
                        },
                        "indoor3": {
                            "hfov": 80,
                            "pitch": -5,
                            "yaw": 0,
                            "type": "equirectangular",
                            "panorama": "/images/panorama/indoor3.jpg",
                            "haov": 290.0,
                            "vaov": 55.2,
                            "vOffset": 0.0,
                            "hotSpots": [
                                {
                                    "pitch": -0.4,
                                    "yaw": -126,
                                    "type": "scene",
                                    "sceneId": "indoor2"
                                },
                                {
                                    "pitch": -1.4,
                                    "yaw": 33,
                                    "type": "scene",
                                    "sceneId": "indoor4"
                                }
                            ]
                        },
                        "indoor4": {
                            "hfov": 80,
                            "pitch": -5,
                            "yaw": -15,
                            "type": "equirectangular",
                            "panorama": "/images/panorama/indoor4.jpg",
                            "haov": 290.0,
                            "vaov": 55.6,
                            "vOffset": 0.0,
                            "hotSpots": [
                                {
                                    "pitch": -5,
                                    "yaw": -133,
                                    "type": "scene",
                                    "sceneId": "indoor3"
                                },
                                {
                                    "pitch": 2.2,
                                    "yaw": 139,
                                    "type": "scene",
                                    "sceneId": "garden"
                                }
                            ]
                        },
                        "garden": {
                            "hfov": 80,
                            "pitch": 0,
                            "yaw": -45,
                            "type": "equirectangular",
                            "panorama": "/images/panorama/garden.jpg",
                            "haov": 290.0,
                            "vaov": 56.5,
                            "vOffset": 0.0,
                            "hotSpots": [
                                {
                                    "pitch": 5.2,
                                    "yaw": -95,
                                    "type": "scene",
                                    "sceneId": "front2"
                                }
                            ]
                        }
                    }
                };

                // Automatically map texts and titles from roomMeta
                Object.keys(config.scenes).forEach(sceneId => {
                    const scene = config.scenes[sceneId];
                    if (roomMeta[sceneId]) {
                        scene.title = roomMeta[sceneId].title;
                    }
                    if (scene.hotSpots) {
                        scene.hotSpots.forEach(hs => {
                            if (hs.type === 'scene' && hs.sceneId && roomMeta[hs.sceneId]) {
                                hs.text = "Pergi ke " + roomMeta[hs.sceneId].title;
                            }
                        });
                    }
                });

                // Update UI text values from roomMeta dynamically on page load
                Object.keys(roomMeta).forEach(sceneId => {
                    // Update Sidebar button titles
                    const btnTitleEl = document.querySelector(`#btn-${sceneId} h4`);
                    if (btnTitleEl) {
                        btnTitleEl.textContent = roomMeta[sceneId].title;
                    }
                    
                    // Update SVG blueprint floor labels
                    const svgTextEl = document.querySelector(`.room-group[data-room="${sceneId}"] text`);
                    if (svgTextEl) {
                        svgTextEl.textContent = roomMeta[sceneId].title;
                    }
                });

                // Initialize Pannellum viewer
                pannellumViewer = pannellum.viewer('panorama-viewer', config);

                // Listen to scene change events
                pannellumViewer.on('scenechange', function(sceneId) {
                    syncUIState(sceneId);
                });

                // Listen to mouse clicks to help locate hotspot coordinates
                pannellumViewer.on('mousedown', function(event) {
                    const coords = pannellumViewer.mouseEventToCoords(event);
                    if (coords && coords.length >= 2) {
                        const pitch = coords[0].toFixed(1);
                        const yaw = coords[1].toFixed(1);
                        document.getElementById('coord-text').innerHTML = `Pitch: <span class="text-amber-400 font-bold">${pitch}</span> | Yaw: <span class="text-amber-400 font-bold">${yaw}</span>`;
                        console.log(`Pannellum Click Coordinates: pitch: ${pitch}, yaw: ${yaw}`);
                    }
                });

                // Hide loader when the panorama is fully loaded
                pannellumViewer.on('load', function() {
                    const loader = document.getElementById('viewer-loader');
                    if (loader) {
                        loader.style.opacity = '0';
                        setTimeout(() => {
                            loader.style.display = 'none';
                        }, 500);
                    }
                });

                // Sync the UI initially
                syncUIState('garden');

            } catch (error) {
                console.error("Pannellum initialization failed:", error);
            }
        });

        // Function to change the scene in the viewer
        function changeScene(sceneId) {
            if (pannellumViewer) {
                // Show loader again
                const loader = document.getElementById('viewer-loader');
                if (loader) {
                    loader.style.display = 'flex';
                    loader.style.opacity = '1';
                }
                
                pannellumViewer.loadScene(sceneId);
                syncUIState(sceneId);
            }
        }

        // Synchronize UI sidebars, denah map indicators, and descriptions
        function syncUIState(sceneId) {
            const data = roomMeta[sceneId];
            if (!data) return;

            // 1. Update Title and Descriptions
            document.getElementById('room-info-title').textContent = data.title;
            document.getElementById('room-info-desc').textContent = data.desc;
            
            const iconEl = document.getElementById('room-info-icon');
            iconEl.className = `${data.icon} text-xl`;

            // 2. Update Sidebar Buttons Active State
            document.querySelectorAll('.scene-select-btn').forEach(btn => {
                btn.classList.remove('active-scene-btn');
            });
            const activeBtn = document.getElementById(`btn-${sceneId}`);
            if (activeBtn) {
                activeBtn.classList.add('active-scene-btn');
            }

            // 3. Update Denah Blueprint Rooms highlight
            document.querySelectorAll('.room-group').forEach(grp => {
                grp.classList.remove('active-room');
            });
            const activeRoomGroup = document.querySelector(`.room-group[data-room="${sceneId}"]`);
            if (activeRoomGroup) {
                activeRoomGroup.classList.add('active-room');
            }

            // 4. Update the pulsing PIN position on SVG map
            const pinGroup = document.getElementById('map-pin');
            if (pinGroup) {
                const circles = pinGroup.getElementsByTagName('circle');
                if (circles.length >= 3) {
                    // Update all circles to the new cx and cy coordinates
                    circles[0].setAttribute('cx', data.pin.cx);
                    circles[0].setAttribute('cy', data.pin.cy);
                    circles[0].setAttribute('fill', data.pin.color);

                    circles[1].setAttribute('cx', data.pin.cx);
                    circles[1].setAttribute('cy', data.pin.cy);
                    circles[1].setAttribute('fill', data.pin.color);

                    circles[2].setAttribute('cx', data.pin.cx);
                    circles[2].setAttribute('cy', data.pin.cy);
                }
            }
        }

        // Toggle Fullscreen mode for the viewer
        function toggleViewerFullscreen() {
            if (pannellumViewer) {
                pannellumViewer.toggleFullscreen();
            }
        }
    </script>
</x-app-layout>
