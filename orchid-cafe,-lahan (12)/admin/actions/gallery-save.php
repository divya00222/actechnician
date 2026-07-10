<?php
/**
 * Orchid Cafe - Admin Action: Save Gallery Image
 */
require_once '../../includes/db.php';
require_once '../../includes/functions.php';
require_once '../../includes/auth.php';

require_admin_auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id         = isset($_POST['id']) ? (int)$_POST['id'] : null;
    $title      = clean_input($_POST['title'] ?? '');
    $category   = clean_input($_POST['category'] ?? 'other');
    $alt_text   = clean_input($_POST['alt_text'] ?? '');
    $sort_order = (int)($_POST['sort_order'] ?? 0);

    // Handle Image Upload
    $image_url = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../../uploads/gallery/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $file_ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed_exts = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($file_ext, $allowed_exts)) {
            $new_filename = 'gallery_' . time() . '_' . rand(1000, 9999) . '.' . $file_ext;
            $dest_path = $upload_dir . $new_filename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $dest_path)) {
                $image_url = 'uploads/gallery/' . $new_filename;
            }
        }
    }

    try {
        if ($id) {
            // Update
            $sql = "UPDATE gallery_images SET title = ?, category = ?, alt_text = ?, sort_order = ?, updated_at = CURRENT_TIMESTAMP";
            $params = [$title, $category, $alt_text, $sort_order];

            if ($image_url) {
                $sql .= ", image_url = ?";
                $params[] = $image_url;
            }

            $sql .= " WHERE id = ?";
            $params[] = $id;

            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            set_flash_message('success', 'Gallery image updated.');
        } else {
            // Create
            if (!$image_url) {
                set_flash_message('error', 'Please select an image file.');
                header('Location: ../gallery.php');
                exit;
            }
            $stmt = $pdo->prepare("INSERT INTO gallery_images (title, category, image_url, alt_text, sort_order) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $category, $image_url, $alt_text, $sort_order]);
            set_flash_message('success', 'Image uploaded successfully!');
        }
    } catch (PDOException $e) {
        set_flash_message('error', 'Error: ' . $e->getMessage());
    }

    header('Location: ../gallery.php');
    exit;
} else {
    header('Location: ../gallery.php');
    exit;
}
?>
