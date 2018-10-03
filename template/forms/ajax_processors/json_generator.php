<?php
 
    // Cegak akses langsung ke source Ajax.
    if ( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) ) {
 
        // Set header type konten.
        header("Content-Type: application/json; charset=UTF-8");
 
        // Deklarasi variable untuk koneksi ke database.
        $host     = "localhost";        // Server database
        $username = "root";             // Username database
        $password = "";             // Password database
        $database = "dev_kostin";     // Nama database
 
        // Koneksi ke database.
        $conn = new mysqli($host, $username, $password, $database);
 
        // Deklarasi variable keyword buah.
        $username = $_GET["query"];
 
        // Query ke database.
        $query = $conn->query("SELECT * FROM kostin_user WHERE user_name LIKE '%$username%' ORDER BY user_name DESC");
        $result = $query->fetch_all(MYSQLI_ASSOC);
 
        // Format bentuk data untuk autocomplete.
        foreach($result as $data)
        {
            $output['suggestions'][] = [
                'value' => $data['user_name'],
                'username'  => $data['user_name']
            ];
        }
 
        if (!empty($output)) {
            // Encode ke format JSON.
            echo json_encode($output);
        }
 
    } else {
 
        // Tampilkan peringatan.
        echo 'No direct access source!';
    }
?>