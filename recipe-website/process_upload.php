<?php
// Include necessary files
require_once 'includes/functions.php';
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $recipe_name = isset($_POST['recipe_name']) ? sanitize_input($_POST['recipe_name']) : '';
    $description = isset($_POST['description']) ? sanitize_input($_POST['description']) : '';
    
    // Validate recipe name and description
    if (empty($recipe_name) || empty($description)) {
        $_SESSION['message'] = 'Recipe name and description are required.';
        $_SESSION['message_type'] = 'error';
        header('Location: upload.php');
        exit;
    }
    
    // Handle file upload
    $image_filename = '';
    if (isset($_FILES['recipe_image']) && $_FILES['recipe_image']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        
        // Validate file type
        if (!in_array($_FILES['recipe_image']['type'], $allowed_types)) {
            $_SESSION['message'] = 'Only JPG and PNG image formats are allowed.';
            $_SESSION['message_type'] = 'error';
            header('Location: upload.php');
            exit;
        }
        
        // Validate file size (max 5MB)
        if ($_FILES['recipe_image']['size'] > 5 * 1024 * 1024) {
            $_SESSION['message'] = 'Image size should not exceed 5MB.';
            $_SESSION['message_type'] = 'error';
            header('Location: upload.php');
            exit;
        }
        
        // Generate a unique filename
        $file_extension = pathinfo($_FILES['recipe_image']['name'], PATHINFO_EXTENSION);
        $image_filename = uniqid('recipe_') . '.' . $file_extension;
        $upload_path = __DIR__ . '/uploads/' . $image_filename;
        
        // Move the uploaded file to the uploads directory
        if (!move_uploaded_file($_FILES['recipe_image']['tmp_name'], $upload_path)) {
            $_SESSION['message'] = 'Failed to upload the image. Please try again.';
            $_SESSION['message_type'] = 'error';
            header('Location: upload.php');
            exit;
        }
    } else {
        $_SESSION['message'] = 'Please select an image file.';
        $_SESSION['message_type'] = 'error';
        header('Location: upload.php');
        exit;
    }
    
    // Add recipe to JSON file
    add_recipe($recipe_name, $description, $image_filename);
    
    // Set success message and redirect to homepage
    $_SESSION['message'] = 'Recipe uploaded successfully!';
    header('Location: index.php');
    exit;
} else {
    // If not submitted via POST, redirect to upload form
    header('Location: upload.php');
    exit;
}