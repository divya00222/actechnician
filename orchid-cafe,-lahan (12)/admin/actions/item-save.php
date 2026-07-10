<?php
/**
 * Orchid Cafe - Admin Action: Save Menu Item
 */
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../includes/auth.php';

require_admin_auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id          = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $category_id = (int)$_POST['category_id'];
    $name              = clean_input($_POST['name']);
    $short_description = clean_input($_POST['short_description']);
    $full_description  = clean_input($_POST['full_description']);
    $price             = (float)$_POST['price'];
    $discount_price = !empty($_POST['discount_price']) ? (float)$_POST['discount_price'] : null;
    $is_available   = isset($_POST['is_available']) ? 1 : 0;
    $is_featured    = isset($_POST['is_featured']) ? 1 : 0;
    $is_veg         = isset($_POST['is_veg']) ? 1 : 0;
    $is_chef_special = isset($_POST['is_chef_special']) ? 1 : 0;
    $is_popular      = isset($_POST['is_popular']) ? 1 : 0;
    $status          = clean_input($_POST['status'] ?? 'active');
    $sort_order      = (int)$_POST['sort_order'];

    // Handle Image Upload
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploaded = upload_image($_FILES['image'], 'menu');
        if ($uploaded) {
            $image_path = $uploaded;
        } else {
            set_flash_message('error', 'Invalid image format. Use JPG, PNG or WEBP.');
            redirect('../menu-items.php' . ($id ? "?id=$id" : ""));
        }
    }

    try {
        if ($id > 0) {
            // Update
            $sql = "UPDATE menu_items SET category_id = ?, name = ?, short_description = ?, full_description = ?, price = ?, discount_price = ?, is_available = ?, is_featured = ?, is_veg = ?, is_chef_special = ?, is_popular = ?, status = ?, sort_order = ?";
            $params = [$category_id, $name, $short_description, $full_description, $price, $discount_price, $is_available, $is_featured, $is_veg, $is_chef_special, $is_popular, $status, $sort_order];
            
            if ($image_path) {
                $sql .= ", image = ?";
                $params[] = $image_path;
            }
            
            $sql .= " WHERE id = ?";
            $params[] = $id;
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            set_flash_message('success', 'Menu item updated successfully.');
        } else {
            // Create
            $stmt = $pdo->prepare("INSERT INTO menu_items (category_id, name, short_description, full_description, price, discount_price, is_available, is_featured, is_veg, is_chef_special, is_popular, status, sort_order, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$category_id, $name, $short_description, $full_description, $price, $discount_price, $is_available, $is_featured, $is_veg, $is_chef_special, $is_popular, $status, $sort_order, $image_path]);
            set_flash_message('success', 'New menu item added successfully.');
        }
    } catch (PDOException $e) {
        set_flash_message('error', 'Database error: ' . $e->getMessage());
    }
}

redirect('../menu-items.php');
