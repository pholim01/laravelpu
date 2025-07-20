<!DOCTYPE html>
<html>
<head>
    <title>Get Token</title>
</head>
<body>
    <h2>Ambil Token Akses</h2>

    <input type="text" id="username" placeholder="Username"><br><br>
    <input type="password" id="password" placeholder="Password"><br><br>

    <button onclick="getToken()">Dapatkan Token</button>

    <p id="message"></p>

    <br>
    <a href="/nakerekatalog">Lanjut ke halaman Tenaga Kerja ➡</a>

    <script>
        async function getToken() {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            const response = await fetch("http://34.101.235.69/ekatalog/apiv1/request_token", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    username: username,
                    password: password
                })
            });

            if (!response.ok) {
                document.getElementById("message").innerText = "Gagal mendapatkan token.";
                return;
            }

            const data = await response.json();

            localStorage.setItem("session_token", data.session_token);
            localStorage.setItem("api_key", password); 

            document.getElementById("message").innerText = "Token berhasil disimpan. Anda bisa lanjut.";
        }
    </script>
</body>
</html>
