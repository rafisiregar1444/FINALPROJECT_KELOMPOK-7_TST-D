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

        $stmt = $conn->prepare("SELECT l.voucher, u.username, u.nama_pt, lb.nama_lomba
                                FROM tbl_lomba_mahasiswa AS l
                                JOIN user_lists AS u ON l.id_userx = u.id_userx
                                JOIN tbl_lomba AS lb ON l.id_lomba = lb.id_lomba
                                WHERE u.username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $voucher = $user['voucher']; 
            $kampus = substr($user['nama_pt'], 0, 30);
            $lomba = $user['nama_lomba'];

            include 'database.php';
            $stmtTicket = $conn->prepare("SELECT harga FROM rute WHERE id = :ticketId");
            $stmtTicket->execute(['ticketId' => $ticketId]);
            $ticket = $stmtTicket->fetch(PDO::FETCH_ASSOC);

            if ($ticket) {
                $price = $ticket['harga'];

                if (!empty($voucher)) {
                    $discountedPrice = $price * 0.95; 
                    echo json_encode([
                        'status' => 'success',
                        'message' => "Selamat $kampus! telah memenangkan lomba $lomba <br> Anda berhak mendapat diskon 5%.",
                        'discounted_price' => number_format($discountedPrice, 0, ',', '.')
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'success',
                        'message' => "Harga tiket normal!",
                        'price' => number_format($price, 0, ',', '.')
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => "Tiket tidak ditemukan."
                ]);
            }
        } else {

            echo json_encode([
                'status' => 'error',
                'message' => "Username tidak ditemukan. Harga tiket normal!"
            ]);
        }
    }

    private function renderView()
    {
        include 'database2.php'; 

        $stmt = $conn->prepare("SELECT l.voucher, u.username, u.nama_pt, lb.nama_lomba
                                FROM tbl_lomba_mahasiswa AS l
                                JOIN user_lists AS u ON l.id_userx = u.id_userx
                                JOIN tbl_lomba AS lb ON l.id_lomba = lb.id_lomba
                                WHERE u.username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $voucher = $user['voucher'];  
            $kampus = substr($user['nama_pt'], 0, 30);
            $lomba = $user['nama_lomba'];

            include 'database.php';
            $stmtTicket = $conn->prepare("SELECT harga FROM rute WHERE id = :ticketId");
            $stmtTicket->execute(['ticketId' => $ticketId]);
            $ticket = $stmtTicket->fetch(PDO::FETCH_ASSOC);

            if ($ticket) {
                $price = $ticket['harga'];

                if (!empty($voucher)) {
                    $discountedPrice = $price * 0.95; 
                    echo "<h3>Selamat $kampus! Telah memenangkan lomba $lomba</h3>";
                    echo "<p>Anda berhak mendapat diskon 5%. Harga tiket setelah diskon: Rp " . number_format($discountedPrice, 0, ',', '.') . "</p>";
                } else {
                    echo "<h3>Harga tiket normal: Rp " . number_format($price, 0, ',', '.') . "</h3>";
                }
            } else {
                echo "<p>Tiket tidak ditemukan.</p>";
            }
        } else {
            echo "<p>Username tidak ditemukan. Harga tiket normal!</p>";
        }
    }
}

$controller = new Controller();
$controller->handleRequest();
?>
