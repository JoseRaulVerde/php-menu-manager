<!DOCTYPE html>
<html>
<head>
    <title>Menú</title>
    <link rel="stylesheet" href="/test-dp/assets/css/style.css">
    <link rel="stylesheet" href="/test-dp/assets/css/modalError.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .clickable {
            cursor: pointer;
        }

        .clickable:hover {
            background-color: #eef5ff;
        }
    </style>
</head>
<body>

<!-- Modal de error -->
<?php if (!empty($errors)): ?>
    <div class="modal-error">
        <div class="modal-box">
            <h2><i class="fas fa-exclamation-triangle"></i> Error</h2>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
            <form method="get">
                <button type="submit" class="modal-close">Cerrar</button>
            </form>
        </div>
    </div>
<?php endif; ?>
<!-- -->

<h1>Menú</h1>
<div class="table-header">
    Tabla de Menús
    <a href="index.php?action=create">
        <button>New</button>
    </a>
</div>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Menú Padre</th>
            <th>Descripción</th>
            <th class="action">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($menu as $u): ?>
            <tr>
                <td><?= $u['id']; ?></td>

                <td class="clickable"
                    onclick="window.location='index.php?action=menu&id=<?= $u['id']; ?>&father=<?= $u['parent_menu_id']; ?>'">
                    <?= Formatter::truncateWithTooltip($u['name'], 20); ?>
                </td>

                <td><?= Formatter::truncateWithTooltip($u['parent_name'] ?: '', 20); ?></td>

                <td class="clickable"
                    onclick="window.location='index.php?action=menu&id=<?= $u['id']; ?>&father=<?= $u['parent_menu_id']; ?>'">
                    <?= Formatter::truncateWithTooltip($u['description'], 50); ?>
                </td>

                <td>
                    <div class="center-actios">
                        <div class="icon-buttons">
                            <a href="index.php?action=edit&id=<?= $u['id']; ?>" onclick="event.stopPropagation();">
                                <button class="btn edit">
                                    <i class="fas fa-pen"></i> Editar
                                </button>
                            </a>
                            <form 
                                action="index.php?action=delete&id=<?= $u['id']; ?>" 
                                method="POST"
                                onsubmit="event.stopPropagation(); return confirm('¿Seguro que deseas eliminar este menú (<?= $u['name']; ?>)?');"
                            >
                                <button class="btn delete">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
