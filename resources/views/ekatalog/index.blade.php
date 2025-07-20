<!DOCTYPE html>
<html>

<head>
    <title>Data Tenaga Kerja</title>
</head>

<body>
    <h2>Data Tenaga Kerja</h2>

    <button onclick="getTenagaKerja()">Ambil Data</button>
    <br><br>
    <div id="result"></div>

    <br>


    <h3>Filter Tenaga Kerja: Sopir di Banda Aceh (Aceh)</h3>
    <button onclick="filterData()">Filter Data</button>
    <br><br>
    <div id="filtered-result"></div>

    <br>

    <h3>Hasil proses pengelompokan</h3>
    <button onclick="prosesPengelompokan()">Kelompokkan Berdasarkan Harga OH</button>
    <br><br>
    <div id="result-kelompok"></div>

    <br>

    <a href="/loginekatalog">⬅ Kembali ke halaman Token</a>

</body>
<script>
    async function getTenagaKerja() {
        const token = localStorage.getItem("session_token");
        const apiKey = localStorage.getItem("api_key");

        if (!token || !apiKey) {
            alert("Token atau API Key tidak ditemukan. Silakan login dulu.");
            return;
        }

        const response = await fetch("http://34.101.235.69/ekatalog/apiv1/datatable/tenagakerja?offset=0", {
            method: "GET",
            headers: {
                "X-DreamFactory-Api-Key": apiKey,
                "X-DreamFactory-Session-Token": token
            }
        });

        if (!response.ok) {
            alert("Gagal mengambil data.");
            return;
        }

        const data = await response.json();
        let html = "<ul>";
        data.resource.forEach((item, index) => {
            html += `<li>${index + 1}. ${item.nama}</li>`;
        });
        html += "</ul>";

        document.getElementById("result").innerHTML = html;
    }


    async function filterData() {
        const token = localStorage.getItem("session_token");
        const apiKey = localStorage.getItem("api_key");

        if (!token || !apiKey) {
            alert("Token atau API Key tidak ditemukan. Silakan login dulu.");
            return;
        }

        const url = "http://34.101.235.69/ekatalog/apiv1/datatable/tenagakerja?offset=0&search=tenagakerja=sopir";

        const response = await fetch(url, {
            method: "GET",
            headers: {
                "X-DreamFactory-Api-Key": apiKey,
                "X-DreamFactory-Session-Token": token
            }
        });

        if (!response.ok) {
            alert("Gagal mengambil data.");
            return;
        }

        const data = await response.json();

        // Filter berdasarkan Provinsi ID = 11 (Aceh), Kabupaten/Kota ID = 1171 (Banda Aceh)
        const filtered = data.resource.filter(item => {
            return item.provinsi_id == 11 && item.kabupaten_id == 1171 && item.tenagakerja.toLowerCase().includes("sopir");
        });

        // Tampilkan hasil dalam tabel
        let html = `
            <table border="1" cellpadding="5">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Provinsi</th>
                        <th>Kabupaten/Kota</th>
                        <th>Tenaga Kerja</th>
                        <th>Kode</th>
                        <th>Satuan</th>
                        <th>Harga OH</th>
                        <th>Harga OJ</th>
                        <th>Sumber Data</th>
                    </tr>
                </thead>
                <tbody>
        `;

        filtered.forEach((item, index) => {
            html += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.provinsi}</td>
                    <td>${item.kabupaten}</td>
                    <td>${item.tenagakerja}</td>
                    <td>${item.kode}</td>
                    <td>${item.satuan}</td>
                    <td>${item.harga_oh}</td>
                    <td>${item.harga_oj}</td>
                    <td>${item.sumber_data}</td>
                </tr>
            `;
        });

        html += "</tbody></table>";

        document.getElementById("filtered-result").innerHTML = html;
    }


    function hargaTenagaKerja(dataTenagaKerja) {
        // Filter hanya ambil properti provinsi, kabkota, harga_oh, dan tenagakerja
        const cleanedData = dataTenagaKerja.map(item => ({
            provinsi: item.provinsi,
            kabkota: item.kabupaten,
            harga_oh: item.harga_oh,
            tenagakerja: item.tenagakerja
        }));

        // Urutkan berdasarkan harga_oh dari tertinggi ke terendah
        cleanedData.sort((a, b) => b.harga_oh - a.harga_oh);

        // Kelompokkan berdasarkan harga_oh
        const grouped = {};
        cleanedData.forEach(item => {
            const key = item.harga_oh;
            if (!grouped[key]) {
                grouped[key] = [];
            }

            grouped[key].push({
                provinsi: item.provinsi,
                kabkota: item.kabkota,
                tenagakerja: item.tenagakerja
            });
        });

        console.log("Kelompok berdasarkan harga_oh:", grouped);
        return grouped;
    }


    async function prosesPengelompokan() {
        const token = localStorage.getItem("session_token");
        const apiKey = localStorage.getItem("api_key");

        const response = await fetch("http://34.101.235.69/ekatalog/apiv1/datatable/tenagakerja?offset=0", {
            method: "GET",
            headers: {
                "X-DreamFactory-Api-Key": apiKey,
                "X-DreamFactory-Session-Token": token
            }
        });

        const data = await response.json();
        const hasilKelompok = hargaTenagaKerja(data.resource);

        // Tampilkan hasil kelompok (opsional)
        let html = "<h3>Hasil Kelompok Berdasarkan Harga OH</h3>";
        for (const harga in hasilKelompok) {
            html += `<h4>Harga OH: ${harga}</h4><ul>`;
            hasilKelompok[harga].forEach(item => {
                html += `<li>${item.provinsi} - ${item.kabkota} (${item.tenagakerja})</li>`;
            });
            html += `</ul>`;
        }

        document.getElementById("result-kelompok").innerHTML = html;
    }
</script>


</html>