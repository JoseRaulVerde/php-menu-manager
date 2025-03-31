<!DOCTYPE html>
<html>
<head>
    <title>Detalles</title>
    <link rel="stylesheet" href="/test-dp/assets/css/details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="tabs">

    <h1>Evaluacion</h1>
        <?php foreach ($menuFather as $father): ?>
            <a 
                href="index.php?action=menu&id=<?= $father['id']; ?>"
                class="<?= $father['id'] == ($menu['parent_menu_id'] ?? $menu['id']) ? 'active' : '' ?>"
            >
                <?= htmlspecialchars($father['name']); ?>
                <i class="fas fa-caret-down"></i>
            </a>
        <?php endforeach; ?>
    </div>

         <div class="submenu-buttons">
             <?php foreach ($children as $child): ?>
                <a 
                href="index.php?action=menu&id=<?= $child['id']; ?>"
                class="<?= $child['id'] == $menu['id'] ? 'active' : '' ?>"
                >
                <?= htmlspecialchars($child['name']); ?>
            </a>
            <?php endforeach; ?>
        </div>

     <div class='description-container'>
         <div class="content-box">
             <strong><?= htmlspecialchars($menu['description']); ?></strong><br>
         </div>
            
    </div>
    <br>
    <a href="index.php">
        <button class="btn cancel"><i class="fas fa-arrow-left"></i> Volver</button>
    </a>

</body>
</html>
