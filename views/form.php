<?php
$menu = $menu ?? [
    'id' => '',
    'name' => '',
    'description' => '',
    'parent_menu_id' => '',
];
?>


<?php if (!empty($errors)): ?>
    <div class="form-error">
        <ul>
            <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars($err); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>


<!DOCTYPE html>
<html>
<head>
    <title><?= $menu['id'] ? 'Editar' : 'Creacion'; ?> Menú</title>
    <link rel="stylesheet" href="/test-dp/assets/css/formCard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
    <div class="title">
        <h1><?= $menu['id'] ? 'Editar:' : 'Formulario de alta:'; ?></h1>
    </div>
    <div class="form-card">
        <div class="form-header">
            <h2>Formulario</h2>
        </div>
        <form action="index.php?action=<?= $menu['id'] ? 'update' : 'store'; ?>" method="POST">
            <input type="hidden" name="id" value="<?= $menu['id']; ?>">

            <div class="form-group">
                <label for="parent_menu_id">Menu Padre</label>
                <select name="parent_menu_id" id="parent_menu_id">
                    <option value="">Seleccione una opción</option>
                    <?php foreach ($menuList as $m): ?>
                        <option value="<?= $m['id']; ?>" <?= $m['id'] == $menu['parent_menu_id'] ? 'selected' : '' ?>>
                            <?= $m['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($menu['name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea 
                    name="description" 
                    id="description"  
                    minlength="10" 
                    maxLength="150" 
                    required
                ><?= htmlspecialchars(trim($menu['description'])); ?></textarea>
            </div>

            <div class="form-actions">
                <a href="index.php" class="btn cancel"><i class="fas fa-times"></i> Cancelar</a>
                <button type="submit" class="btn save"><i class="fas fa-check"></i> Guardar</button>
            </div>
        </form>
    </div>

</body>
</html>
