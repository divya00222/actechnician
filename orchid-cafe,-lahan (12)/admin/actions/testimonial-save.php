<?php
/**
 * Orchid Cafe - Admin Action: Save Testimonial
 */
require_once '../../includes/db.php';
require_once '../../includes/functions.php';
require_once '../../includes/auth.php';

require_admin_auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id            = isset($_POST['id']) ? (int)$_POST['id'] : null;
    $customer_name = clean_input($_POST['customer_name'] ?? '');
    $rating        = (int)($_POST['rating'] ?? 5);
    $review        = clean_input($_POST['review'] ?? '');
    $is_featured   = isset($_POST['is_featured']) ? 1 : 0;
    $status        = clean_input($_POST['status'] ?? 'active');

    // Handle Image Upload
    $image_url = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../../uploads/testimonials/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $file_ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $new_filename = 'test_' . time() . '.' . $file_ext;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $new_filename)) {
            $image_url = 'uploads/testimonials/' . $new_filename;
        }
    }

    try {
        if ($id) {
            $sql = "UPDATE testimonials SET customer_name = ?, rating = ?, review = ?, is_featured = ?, status = ?, updated_at = CURRENT_TIMESTAMP";
            $params = [$customer_name, $rating, $review, $is_featured, $status];
            if ($image_url) {
                $sql .= ", customer_image = ?";
                $params[] = $image_url;
            }
            $sql .= " WHERE id = ?";
            $params[] = $id;
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            set_flash_message('success', 'Testimonial updated.');
        } else {
            $stmt = $pdo->prepare("INSERT INTO testimonials (customer_name, customer_image, rating, review, is_featured, status) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$customer_name, $image_url, $rating, $review, $is_featured, $status]);
            set_flash_message('success', 'New testimonial added.');
        }
    } catch (PDOException $e) {
        set_flash_message('error', 'Error: ' . $e->getMessage());
    }

    header('Location: ../testimonials.php');
    exit;
} else {
    header('Location: ../testimonials.php');
    exit;
}
?>
