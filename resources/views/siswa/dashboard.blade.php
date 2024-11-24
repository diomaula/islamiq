<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/shalat.css') }}">
    @include('layouts.header')
</head>

<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main">
            @include('layouts.navbar')
            <main class="content px-3 py-4">
                <div class="container-fluid">

                    <div class="card mb-4">
                        <div class="card-body">
                            <h1 class="fw-bold fs-4 mb-3 text-center">JADWAL SHALAT BANYUWANGI</h1>
                            <p style="text-align:center;">Tanggal: {{ $date }}</p>
                            <p id="countdown" style="text-align:center;">Hitung Mundur ke Sholat : <span id="time-remaining">00:00:00</span></p>
                        </div>
                    </div>

                    <div id="notification" class="notification" style="display: none;">
                        Sudah memasuki waktu shalat!
                    </div>

                    <table>
                        <tr>
                            <th>Shalat</th>
                            <th>Waktu</th>
                        </tr>
                        <tr>
                            <td>Subuh</td>
                            <td id="Fajr">{{ $timings['Fajr'] }}</td>
                        </tr>
                        <tr>
                            <td>Terbit</td>
                            <td>{{ $timings['Sunrise'] }}</td>
                        </tr>
                        <tr>
                            <td>Dzuhur</td>
                            <td id="Dhuhr">{{ $timings['Dhuhr'] }}</td>
                        </tr>
                        <tr>
                            <td>Ashar</td>
                            <td id="Asr">{{ $timings['Asr'] }}</td>
                        </tr>
                        <tr>
                            <td>Maghrib</td>
                            <td id="Maghrib">{{ $timings['Maghrib'] }}</td>
                        </tr>
                        <tr>
                            <td>Isya</td>
                            <td id="Isha">{{ $timings['Isha'] }}</td>
                        </tr>
                        <tr>
                            <td>Imsak</td>
                            <td>{{ $timings['Imsak'] }}</td>
                        </tr>
                    </table>
                </div>
            </main>
        </div>
    </div>
    @include('layouts.script')

    <script>
        const times = {
            Fajr: document.getElementById('Fajr').innerText,
            Dhuhr: document.getElementById('Dhuhr').innerText,
            Asr: document.getElementById('Asr').innerText,
            Maghrib: document.getElementById('Maghrib').innerText,
            Isha: document.getElementById('Isha').innerText,
        };

        const now = new Date("{{ $now }}");

        function updateCountdown() {
            const now = new Date(); 

            const prayerTimes = Object.values(times).map(time => {
                const [hours, minutes] = time.split(':').map(Number);
                return new Date(now.getFullYear(), now.getMonth(), now.getDate(), hours, minutes);
            });

            const nextPrayerTime = prayerTimes.find(time => time > now); // Cari waktu sholat berikutnya

            if (!nextPrayerTime) {
                document.getElementById('time-remaining').innerText = "Semua waktu sholat telah berlalu untuk hari ini.";
                return;
            }

            const remainingTime = nextPrayerTime - now; // Hitung selisih waktu

            const hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

            document.getElementById('time-remaining').innerText = 
            `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

        }

        function checkPrayerTimes() {
            const now = new Date();

            Object.keys(times).forEach((prayer) => {
                const [hours, minutes] = times[prayer].split(':').map(Number);
                const prayerTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), hours, minutes);

                if (Math.abs(prayerTime - now) < 1000) {
                    document.getElementById('notification').style.display = 'block';

                    const audio = new Audio("{{ asset('assets/azdan.mp3') }}");
                    audio.play();
                }
            });
        }

        setInterval(updateCountdown, 1000);
        setInterval(checkPrayerTimes, 1000);
    </script>
    @include('layouts.footer')
</body>

</html>