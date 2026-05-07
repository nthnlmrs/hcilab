<x-app-layout>
    <div class="pt-6 pb-20 px-4 max-w-2xl mx-auto h-screen flex flex-col">
        <div class="flex items-center mb-6">
            <a href="{{ route('home') }}" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-museum-green shadow-sm mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="font-serif text-2xl font-bold text-museum-green">Scan QR</h1>
        </div>
        
        <div class="bg-white rounded-3xl p-6 shadow-soft flex-1 flex flex-col items-center justify-center mb-10 overflow-hidden relative">
            <p class="text-center text-gray-500 mb-6 text-xs uppercase font-black tracking-widest">Point camera at QR code</p>
            
            <div id="reader" class="w-full rounded-2xl overflow-hidden shadow-inner bg-black aspect-square"></div>
            
            <div id="result" class="mt-8 text-center w-full hidden animate-in fade-in zoom-in duration-300">
                <p class="text-sm font-bold text-green-600 mb-4 flex items-center justify-center gap-2">
                    <i class="fas fa-check-circle"></i> VALID QR FOUND
                </p>
                <a id="result-link" href="#" class="inline-block px-8 py-3 bg-museum-green text-white rounded-2xl text-sm font-bold shadow-lg hover:bg-museum-darkGreen w-full transition-all active:scale-95">
                    VIEW ARTIFACT DETAILS
                </a>
            </div>
            
            <button id="restart-btn" class="mt-6 px-8 py-3 border-2 border-museum-green text-museum-green rounded-2xl text-sm font-bold hover:bg-museum-green hover:text-white hidden w-full transition-all">
                SCAN ANOTHER CODE
            </button>
        </div>
    </div>

    <!-- Include Html5Qrcode library -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let html5QrcodeScanner;
            const resultDiv = document.getElementById('result');
            const resultLink = document.getElementById('result-link');
            const restartBtn = document.getElementById('restart-btn');
            
            function onScanSuccess(decodedText, decodedResult) {
                // Check if it's a valid museum URL (optional but recommended)
                if (decodedText.includes('/p/')) {
                    // Stop scanning
                    html5QrcodeScanner.clear();

                    // Show result
                    resultDiv.classList.remove('hidden');
                    restartBtn.classList.remove('hidden');

                    // Set link
                    resultLink.href = decodedText;

                    // Trigger haptic feedback if available
                    if (window.navigator.vibrate) window.navigator.vibrate(100);
                } else {
                    alert("Not a valid Museum Singhasari QR code.");
                }
            }

            function onScanFailure(error) {
                // handle scan failure, usually better to ignore and keep scanning
            }
            
            function startScanner() {
                resultDiv.classList.add('hidden');
                restartBtn.classList.add('hidden');
                
                html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader", {
                        fps: 15,
                        qrbox: {width: 200, height: 200},
                        aspectRatio: 1.0
                    }, false);
                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            }
            
            startScanner();
            
            restartBtn.addEventListener('click', function() {
                startScanner();
            });
        });
    </script>
</x-app-layout>
