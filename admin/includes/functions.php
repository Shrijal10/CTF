<?php
// Database connection configuration
$host = 'localhost'; 
$dbname = 'ctf'; 
$username = 'root'; 
$password = ''; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
    exit();
}

// Function to add a new CTF name to the database
function createCTF($conn, $ctfName) {
    try {
        $sql = "INSERT INTO ctf_names (Names) VALUES (:ctfName)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ctfName', $ctfName, PDO::PARAM_STR);
        $stmt->execute();
        return ['success' => true, 'message' => 'CTF Name added successfully.'];
    } catch (PDOException $e) {
        return ['success' => false, 'message' => 'Failed to add CTF Name: ' . $e->getMessage()];
    }
}

// Function to fetch existing CTF names from the database
function getCTFNames($conn) {
    try {
        $sql = "SELECT Names FROM ctf_names";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ['success' => true, 'data' => $results];
    } catch (PDOException $e) {
        return ['success' => false, 'message' => 'Failed to fetch CTF Names: ' . $e->getMessage()];
    }
}

// Handle AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'createCTF') {
        if (isset($_POST['ctfName']) && !empty($_POST['ctfName'])) {
            $ctfName = $_POST['ctfName'];
            $response = createCTF($conn, $ctfName);
        } else {
            $response = ['success' => false, 'message' => 'CTF Name is required.'];
        }
    } elseif ($_POST['action'] === 'fetchCTFNames') {
        $response = getCTFNames($conn);
    }
    echo json_encode($response);
}
?>
