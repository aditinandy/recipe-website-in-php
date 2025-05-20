<?php
// Initialize JSON file if it doesn't exist
function init_json_file() {
    $json_file = __DIR__ . '/../data/recipes.json';
    $uploads_dir = __DIR__ . '/../uploads';
    
    // Create directories if they don't exist
    if (!file_exists(__DIR__ . '/../data')) {
        mkdir(__DIR__ . '/../data', 0755, true);
    }
    
    if (!file_exists($uploads_dir)) {
        mkdir($uploads_dir, 0755, true);
    }
    
    // Create empty JSON file if it doesn't exist
    if (!file_exists($json_file)) {
        $empty_data = json_encode([], JSON_PRETTY_PRINT);
        file_put_contents($json_file, $empty_data);
    }
}

// Get all recipes from JSON file
function get_recipes() {
    $json_file = __DIR__ . '/../data/recipes.json';
    
    if (file_exists($json_file)) {
        $json_data = file_get_contents($json_file);
        return json_decode($json_data, true) ?: [];
    }
    
    return [];
}

// Add a new recipe to JSON file
function add_recipe($name, $description, $image_filename) {
    $json_file = __DIR__ . '/../data/recipes.json';
    $recipes = get_recipes();
    
    // Create a unique ID for the recipe
    $id = uniqid();
    
    // Add new recipe
    $recipes[] = [
        'id' => $id,
        'name' => $name,
        'description' => $description,
        'image' => $image_filename,
        'date_added' => date('Y-m-d H:i:s')
    ];
    
    // Save back to JSON file
    $json_data = json_encode($recipes, JSON_PRETTY_PRINT);
    file_put_contents($json_file, $json_data);
    
    return $id;
}

// Sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Initialize on first include
init_json_file();