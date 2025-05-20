<?php
// Include necessary files
require_once 'includes/functions.php';
include 'includes/header.php';

// Get all recipes
$recipes = get_recipes();
?>

<h2>All Recipes</h2>

<?php if (empty($recipes)): ?>
    <p>No recipes have been uploaded yet. Be the first to <a href="upload.php">share a recipe</a>!</p>
<?php else: ?>
    <div class="recipes-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
        <?php foreach ($recipes as $recipe): ?>
            <a href="view_recipe.php?id=<?php echo urlencode($recipe['id']); ?>" style="text-decoration: none; color: inherit;">
                <div class="recipe-card" style="border: 1px solid #ddd; border-radius: 5px; padding: 15px; background-color: white; transition: transform 0.2s, box-shadow 0.2s; cursor: pointer;" 
                     onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.1)';" 
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                    <h3><?php echo htmlspecialchars($recipe['name']); ?></h3>
                    
                    <?php if (!empty($recipe['image']) && file_exists('uploads/' . $recipe['image'])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($recipe['image']); ?>" 
                             alt="<?php echo htmlspecialchars($recipe['name']); ?>" 
                             style="width: 100%; height: 200px; object-fit: cover; border-radius: 5px;">
                    <?php else: ?>
                        <div style="width: 100%; height: 200px; background-color: #eee; display: flex; align-items: center; justify-content: center; border-radius: 5px;">
                            <p>No image available</p>
                        </div>
                    <?php endif; ?>
                    
                    <p><?php 
                    // Show only a preview of the description (first 100 characters)
                    $desc = htmlspecialchars($recipe['description']);
                    echo nl2br(strlen($desc) > 100 ? substr($desc, 0, 100) . '...' : $desc); 
                    ?></p>
                    
                    <div style="font-size: 0.8em; color: #666; margin-top: 10px;">
                        Added on: <?php echo htmlspecialchars($recipe['date_added']); ?>
                    </div>
                    
                    <div style="text-align: center; margin-top: 15px;">
                        <span style="display: inline-block; padding: 8px 12px; background-color: #50b3a2; color: white; border-radius: 4px; font-size: 0.9em;">
                            View Recipe
                        </span>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>