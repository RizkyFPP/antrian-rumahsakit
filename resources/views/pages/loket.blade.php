<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loket {{ $loket }} - Sistem Antrian</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        body { background: radial-gradient(circle at top left, #002b1e, #000); color: #eafff9; font-family: 'Poppins', sans-serif; margin: 0; padding: 40px; text-align: center; }
        h1 { font-size: 2.5em; color: #00ffc3; text-shadow: 0 0 15px #00ffc3; margin-bottom: 40px; }
        .glass { background: rgba(0, 255, 195, 0.1); border: 1px solid rgba(0, 255, 195, 0.3); border-radius: 20px; padding: 40px; margin: 0 auto 40px; max-width: 700px; }
        .antrian-aktif { width: 220px; margin: 0 auto; padding: 15px 20px; border-radius: 15px; background: rgba(255,255,255,0.2); color: #fff; }
        .nomor-besar { font-size: 2.5rem; font-weight: bold; color: #00ffc3; text-shadow: 0 0 40px #00ffc3; }
        button { margin: 10px; padding: 15px 40px; border: none; border-radius: 12px; font-size: 18px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; }
        .next { background: linear-gradient(90deg, #00c853, #00e676); color: #fff; }
        .repeat { background: linear-gradient(90deg, #ffeb3b, #ffc107); color: #000; }
        .skip { background: linear-gradient(90deg, #d50000, #ff1744); color: #fff; }
        .list-menunggu { max-width: 800px; margin: 60px auto 0; background: rgba(0, 255, 195, 0.08); border-radius: 16px; padding: 20px; }
        .list-menunggu h2 { color: #00ffc3; margin-bottom: 20px; text-shadow: 0 0 10px #00ffc3; }
        .list-menunggu li { list-style: none; font-size: 20px; margin: 10px 0; background: rgba(255,255,255,0.05); border-radius: 10px; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; }
        .list-menunggu button { background: linear-gradient(90deg, #00bcd4, #0097a7); color: #fff; border: none; border-radius: 8px; padding: 8px 16px; font-size: 16px; }
    </style>
</head>
<body>
    <h1>🎫 LOKET {{ $loket }} - PELAYANAN</h1>

    <div class="glass antrian-aktif">
        <h2>Sedang Dilayani</h2>
        <div class="nomor-besar" id="nomorAntrian">{{ $antrianAktif->nomor_antrian ?? '---' }}</div>
        <div id="loketNama">Loket {{ $loket }}</div>
    </div>

    <div>
        <form action="{{ route('loket.next', $loket) }}" method="POST" style="display:inline">
            @csrf
            <button class="next">➡️ Panggil Berikutnya</button>
        </form>

        <button class="repeat" type="button" id="btnUlangPanggilan">🔁 Ulangi Panggilan</button>

        <form action="{{ route('loket.skip', $loket) }}" method="POST" style="display:inline">
            @csrf
            <button class="skip">⏭ Lewati</button>
        </form>
    </div>

    <div class="list-menunggu">
        <h2>Antrian Menunggu</h2>
        <ul>
            @forelse($antrianMenunggu as $a)
                <li>
                    <span>{{ $a->nomor_antrian }} — {{ $a->pendaftaran->nama ?? 'Tanpa Nama' }}</span>
                    <form action="{{ route('loket.panggil', $a->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">🔊 Panggil</button>
                    </form>
                </li>
            @empty
                <li>Tidak ada antrian menunggu</li>
            @endforelse
        </ul>
    </div>

    <script>
        function playAnnouncement(nomor, loket) {
            if (!nomor || nomor === '---') return;
            const angka = nomor.toString().split('').map(a => {
                const map = { '0': 'nol','1': 'satu','2': 'dua','3': 'tiga','4': 'empat','5': 'lima','6': 'enam','7': 'tujuh','8': 'delapan','9': 'sembilan' };
                return map[a] || a;
            }).join(' ');
            const text = `Nomor antrian ${angka}, silakan menuju ${loket}.`;
            speechSynthesis.cancel();
            setTimeout(() => {
                const u = new SpeechSynthesisUtterance(text);
                u.lang = 'id-ID';
                u.rate = 0.9;
                speechSynthesis.speak(u);
            }, 400);
        }

        document.getElementById('btnUlangPanggilan').addEventListener('click', () => {
            const nomor = document.getElementById('nomorAntrian').innerText.trim();
            playAnnouncement(nomor, 'loket {{ $loket }}');
        });

        @if(session('success'))
        window.onload = function() {
            const nomor = "{{ $antrianAktif->nomor_antrian ?? '' }}";
            playAnnouncement(nomor, 'loket {{ $loket }}');
        }
        @endif
    </script>
</body>
</html>
