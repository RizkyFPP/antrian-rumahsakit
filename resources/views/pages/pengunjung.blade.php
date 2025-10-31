<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Layar Antrian Rumah Sakit</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
    * { box-sizing: border-box; }
    body {
      background: radial-gradient(circle at top, #002920, #000);
      color: #eafff9;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
      position: relative;
    }
    body::before {
      content: "";
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at 30% 20%, rgba(0,255,195,0.08), transparent 60%),
                  radial-gradient(circle at 70% 80%, rgba(0,255,195,0.08), transparent 60%);
      animation: moveGlow 15s ease-in-out infinite alternate;
    }
    @keyframes moveGlow {
      from { transform: translateY(0); opacity: 0.7; }
      to { transform: translateY(-20px); opacity: 0.5; }
    }
    header {
      position: absolute;
      top: 25px;
      left: 6%;
      font-size: clamp(18px, 2vw, 28px);
      font-weight: 700;
      color: #00ffc3;
      text-shadow: 0 0 20px #00ffc3, 0 0 45px #00bfa5;
      animation: fadeIn 1.5s ease;
      letter-spacing: 1.5px;
    }
    .clock {
      position: absolute;
      top: 25px;
      right: 6%;
      text-align: right;
      font-size: clamp(12px, 1vw, 16px);
      font-weight: 500;
      color: #b8fff0;
      text-shadow: 0 0 8px #00ffc3;
    }
    .main-antrian {
      text-align: center;
      margin-top: 120px;
      padding: 15px;
      animation: fadeUp 1.2s ease;
      z-index: 2;
    }
    .main-antrian h1 {
      font-size: clamp(16px, 2vw, 28px);
      color: #00ffc3;
      text-shadow: 0 0 25px #00ffc3, 0 0 50px #00bfa5;
      letter-spacing: 2px;
      margin-bottom: 10px;
      text-transform: uppercase;
    }
    .nomor-besar {
      font-size: clamp(55px, 8vw, 100px);
      font-weight: 700;
      letter-spacing: 4px;
      background: linear-gradient(180deg, #00fff2, #00bfa5);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-shadow: 0 0 40px rgba(0,255,195,0.6);
      animation: pulseGlow 2s ease-in-out infinite alternate;
    }
    @keyframes pulseGlow {
      0% { text-shadow: 0 0 25px #00ffc3; }
      100% { text-shadow: 0 0 60px #00ffea; }
    }
    .list-antrian {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
      gap: 15px;
      margin: 40px 10% 70px;
      width: 80%;
      animation: fadeUp 1.5s ease;
      z-index: 2;
    }
    .box {
      background: rgba(0, 255, 195, 0.07);
      border: 1px solid rgba(0, 255, 195, 0.2);
      border-radius: 12px;
      padding: 12px 8px;
      text-align: center;
      box-shadow: 0 0 15px rgba(0, 255, 195, 0.12);
      backdrop-filter: blur(6px);
      transition: all 0.3s ease;
    }
    .box:hover {
      transform: translateY(-4px);
      box-shadow: 0 0 25px rgba(0, 255, 195, 0.3);
    }
    .box h3 {
      font-size: clamp(15px, 1.8vw, 22px);
      margin: 0;
      color: #00ffc3;
      font-weight: 700;
      text-shadow: 0 0 10px #00ffc3;
    }
    .box p {
      font-size: clamp(10px, 0.9vw, 13px);
      margin-top: 4px;
      color: #bfffee;
      text-shadow: 0 0 5px #00ffc3;
    }
    footer {
      position: relative;
      bottom: 15px;
      color: #00ffc3;
      font-size: clamp(10px, 0.8vw, 13px);
      letter-spacing: 1.5px;
      text-shadow: 0 0 8px #00ffc3;
      text-align: center;
      margin-bottom: 20px;
      opacity: 0.85;
    }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(25px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
  </style>
</head>
<body>

  <header>🏥 RSU Syifa Medika Banjar</header>
  <div class="clock" id="clock"></div>

  <div class="main-antrian">
    <h1>🔔 SEDANG DILAYANI</h1>
    <div class="nomor-besar">
      {{ $antrianAktif->nomor_antrian ?? '---' }}
    </div>
    <div class="loket">
      <p>Loket {{ strtoupper($antrianAktif->loket ?? '-') }}</p>
    </div>
  </div>

  <div class="list-antrian">
    @foreach($antrianMenunggu as $antrian)
      <div class="box">
        <h3>{{ $antrian->nomor_antrian }}</h3>
        <p>Loket {{ strtoupper($antrian->loket ?? '-') }}</p>
      </div>
    @endforeach
  </div>

  <footer>💡 SISTEM ANTRIAN RSU Syifa Medika Banjar © {{ date('Y') }}</footer>

  <script>
    // Jam digital
    function updateClock() {
      const now = new Date();
      const dayName = now.toLocaleDateString('id-ID', { weekday: 'long' });
      const date = now.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
      const time = now.toLocaleTimeString('id-ID', { hour12: false });
      document.getElementById('clock').innerHTML = `${time}<br>${dayName}, ${date}`;
    }
    setInterval(updateClock, 1000);
    updateClock();

    // Auto refresh setiap 5 detik
    setInterval(() => location.reload(), 5000);
  </script>
</body>
</html>
