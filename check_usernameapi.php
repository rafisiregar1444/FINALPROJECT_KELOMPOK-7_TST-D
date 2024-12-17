<?php
include 'database2.php'; 

class Controller
{
    public function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if (isset($data['username']) && isset($data['ticketId'])) {
                $this->processAPIRequest($data['username'], $data['ticketId']);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => "Data tidak lengkap."
                ]);
            }
        } else {
            $this->renderView();
        }
    }

    private function processAPIRequest($username, $ticketId)
    {
        global $conn;

        $stmt = $conn->prepare("SELECT u.kode_pt, pt.ultah, pt.nama_pts FROM user_lists u JOIN tbl_perguruan_tinggi pt ON u.kode_pt = pt.kd_pts WHERE u.username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $today = date('m-d');
            $birthday = date('m-d', strtotime($user['ultah'])); 
            $kampus = substr($user['nama_pts'], 0, 30);  
            
            include 'database.php';
            $stmtTicket = $conn->prepare("SELECT harga FROM rute WHERE id = :ticketId");
            $stmtTicket->execute(['ticketId' => $ticketId]);
            $ticket = $stmtTicket->fetch(PDO::FETCH_ASSOC);

            if ($ticket) {
                $price = $ticket['harga'];

                $response = [];

                if ($today == $birthday) {
                    $discountedPrice = $price * 0.9;
                    $response['status'] = 'success';
                    $response['message'] = "Selamat Ulang Tahun untuk $kampus! Anda mendapatkan diskon 10%.";
                    $response['discounted_price'] = number_format($discountedPrice, 0, ',', '.');
                } else {
                    $response['status'] = 'success';
                    $response['message'] = "Harga tiket normal! Rp " . number_format($price, 0, ',', '.');
                }

                echo json_encode($response); 
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => "Tiket tidak ditemukan."
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => "Username tidak ditemukan."
            ]);
        }
    }

    private function renderView()
    {
        global $conn;
        include 'database2.php'; 

        $stmt = $conn->prepare("SELECT u.kode_pt, pt.ultah, pt.nama_pts FROM user_lists u JOIN tbl_perguruan_tinggi pt ON u.kode_pt = pt.kd_pts WHERE u.username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $today = date('m-d');
            $birthday = date('m-d', strtotime($user['ultah'])); 
            $kampus = substr($user['nama_pts'], 0, 30);  

            include 'database.php';
            $stmtTicket = $conn->prepare("SELECT harga FROM rute WHERE id = :ticketId");
            $stmtTicket->execute(['ticketId' => $ticketId]);
            $ticket = $stmtTicket->fetch(PDO::FETCH_ASSOC);

            if ($ticket) {
                $price = $ticket['harga'];

                $response = [];

                if ($today == $birthday) {
                    $discountedPrice = $price * 0.95; 
                    $response['status'] = 'success';
                    $response['message'] = "Selamat Ulang Tahun untuk $kampus! Anda mendapatkan diskon 10%.";
                    $response['discounted_price'] = number_format($discountedPrice, 0, ',', '.');
                } else {
                    $response['status'] = 'success';
                    $response['message'] = "Harga tiket normal! Rp " . number_format($price, 0, ',', '.');
                }

                echo "<h3>{$response['message']}</h3>";
                if (isset($response['discounted_price'])) {
                    echo "<p>Harga tiket setelah diskon: Rp {$response['discounted_price']}</p>";
                } else {
                    echo "<p>Harga tiket: Rp {$price}</p>";
                }
            } else {
                echo "<p>Tiket tidak ditemukan.</p>";
            }
        } else {
            echo "<p>Username tidak ditemukan.</p>";
        }
    }
}

$controller = new Controller();
$controller->handleRequest();
?>
