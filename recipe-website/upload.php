<?php
// Include necessary files
require_once 'includes/functions.php';
include 'includes/header.php';
?>

<h2>Upload a New Recipe</h2>

<form action="process_upload.php" method="post" enctype="multipart/form-data" style="max-width: 600px; margin: 0 auto;">
    <div style="margin-bottom: 15px;">
        <label for="recipe_name" style="display: block; margin-bottom: 5px; font-weight: bold;">Recipe Name:</label>
        <input type="text" id="recipe_name" name="recipe_name" required 
               style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
    </div>
    
    <div style="margin-bottom: 15px;">
        <label for="description" style="display: block; margin-bottom: 5px; font-weight: bold;">Description:</label>
        <textarea id="description" name="description" rows="6" required
                  style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;"></textarea>
        <p style="margin-top: 5px; font-size: 0.8em; color: #666;">
            Include ingredients, preparation steps, and any cooking tips.
        </p>
    </div>
    
    <div style="margin-bottom: 15px;">
        <label for="recipe_image" style="display: block; margin-bottom: 5px; font-weight: bold;">Recipe Image:</label>
        <input type="file" id="recipe_image" name="recipe_image" accept="image/*" required
               style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        <p style="margin-top: 5px; font-size: 0.8em; color: #666;">
            Upload an image of your prepared dish (JPG, PNG formats, max 5MB).
        </p>
    </div>
    
    <div style="margin-top: 20px;">
        <button type="submit" style="background-color: #50b3a2; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer;">
            Upload Recipe
        </button>
    </div>
</form>

<?php include 'includes/footer.php'; ?>