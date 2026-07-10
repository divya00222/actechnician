<?php
/**
 * Orchid Cafe - Admin Action: Save Special Offer
 */
require_once '../../includes/db.php';
require_once '../../includes/functions.php';
require_once '../../includes/auth.php';

require_admin_auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id             = isset($_POST['id']) ? (int)$_POST['id'] : null;
    $title          = clean_input($_POST['title'] ?? '');
    $description    = clean_input($_POST['description'] ?? '');
    $discount_value = clean_input($_POST['discount_value'] ?? '');
    $code           = clean_input($_POST['code'] ?? '');
    $expiry_date    = !empty($_POST['expiry_date']) ? $_POST['expiry_date'] : null;
    $status         = clean_input($_POST['status'] ?? 'active');

    // Handle Image Upload
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploaded = upload_image($_FILES['image'], 'offers');
        if ($uploaded) {
            $image = $uploaded;
        }
    }

    try {
        if ($id) {
            $sql = "UPDATE offers SET title = ?, description = ?, discount_value = ?, code = ?, expiry_date = ?, status = ?";
            $params = [$title, $description, $discount_value, $code, $expiry_date, $status];

            if ($image) {
                $sql .= ", image = ?";
                $params[] = $image;
            }

            $sql .= " WHERE id = ?";
            $params[] = $id;

            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            set_flash_message('success', 'Offer updated successfully.');
        } else {
            $stmt = $pdo->prepare("INSERT INTO offers (title, description, discount_value, code, expiry_date, image, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $description, $discount_value, $code, $expiry_date, $image, $status]);
            set_flash_message('success', 'New offer added successfully!');
        }
    } catch (PDOException $e) {
        set_flash_message('error', 'Error: ' . $e->getMessage());
    }

    header('Location: ../offers.php');
    exit;
} else {
    header('Location: ../offers.php');
    exit;
}
?>
