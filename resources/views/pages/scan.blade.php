<x-app-layout>
    <div class="pt-6 h-full flex flex-col">
        <div class="flex items-center mb-6">
            <a href="{{ route('home') }}" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-museum-green shadow-sm mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="font-serif text-2xl font-bold text-museum-green">Scan QR</h1>
        </div>
        
        <div class="bg-white rounded-3xl p-6 shadow-sm flex-1 flex flex-col items-center justify-center mb-4">
            <p class="text-center text-gray-500 mb-6 text-sm">Scan a QR code inside the museum to view its details.</p>
            
            <div id="reader" class="w-full max-w-sm rounded-2xl overflow-hidden shadow-inner bg-black"></div>
            
            <div id="result" class="mt-6 text-center w-full hidden">
                <p class="text-sm font-semibold text-green-600 mb-2"><i class="fas fa-check-circle"></i> QR Found!</p>
                <a id="result-link" href="#" class="inline-block px-6 py-2 bg-museum-green text-white rounded-full text-sm font-semibold hover:bg-museum-lightGreen w-full">View Page</a>
            </div>
            
            <button id="restart-btn" class="mt-4 px-6 py-2 border border-museum-green text-museum-green rounded-full text-sm font-semibold hover:bg-museum-green hover:text-white hidden w-full">Scan Again</button>
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
                // Stop scanning
                html5QrcodeScanner.clear();
                
                // Show result
                resultDiv.classList.remove('hidden');
                restartBtn.classList.remove('hidden');
                
                // Set link
                resultLink.href = decodedText;
                
                // Optional: Auto redirect
                // window.location.href = decodedText;
            }

            function onScanFailure(error) {
                // handle scan failure, usually better to ignore and keep scanning
            }
            
            function startScanner() {
                resultDiv.classList.add('hidden');
                restartBtn.classList.add('hidden');
                
                html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader", { fps: 10, qrbox: {width: 250, height: 250} }, false);
                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            }
            
            startScanner();
            
            restartBtn.addEventListener('click', function() {
                startScanner();
            });
        });
    </script>
</x-app-layout>
