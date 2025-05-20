<?php
// Include necessary files
require_once 'includes/functions.php';
include 'includes/header.php';

// Get recipe ID from URL parameter
$recipe_id = isset($_GET['id']) ? $_GET['id'] : '';

// Get all recipes
$recipes = get_recipes();

// Find the selected recipe
$recipe = null;
foreach ($recipes as $r) {
    if ($r['id'] === $recipe_id) {
        $recipe = $r;
        break;
    }
}

// If recipe not found, redirect to index
if (!$recipe) {
    $_SESSION['message'] = 'Recipe not found.';
    $_SESSION['message_type'] = 'error';
    header('Location: index.php');
    exit;
}
?>

<div class="recipe-detail" style="max-width: 800px; margin: 0 auto; background-color: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
    <h2><?php echo htmlspecialchars($recipe['name']); ?></h2>
    
    <div style="margin: 20px 0;">
        <?php if (!empty($recipe['image']) && file_exists('uploads/' . $recipe['image'])): ?>
            <img src="uploads/<?php echo htmlspecialchars($recipe['image']); ?>" 
                 alt="<?php echo htmlspecialchars($recipe['name']); ?>" 
                 style="max-width: 100%; border-radius: 8px; display: block; margin: 0 auto;">
        <?php else: ?>
            <div style="width: 100%; height: 300px; background-color: #eee; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                <p>No image available</p>
            </div>
        <?php endif; ?>
    </div>
    
    <div style="margin-top: 20px;">
        <h3>Description</h3>
        <div style="line-height: 1.8; white-space: pre-wrap; background-color: #f9f9f9; padding: 15px; border-radius: 5px; border-left: 4px solid #50b3a2;">
            <?php echo nl2br(htmlspecialchars($recipe['description'])); ?>
        </div>
    </div>
    
    <div style="margin-top: 30px; color: #666; font-size: 0.9em;">
        <p>Added on: <?php echo htmlspecialchars($recipe['date_added']); ?></p>
    </div>
    
    <div style="margin-top: 30px;">
        <a href="index.php" style="display: inline-block; background-color: #50b3a2; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px;">
            &larr; Back to All Recipes
        </a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>