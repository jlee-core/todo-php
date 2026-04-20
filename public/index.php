<?php
require __DIR__ . '/../app/Controllers/TodoController.php';

$controller = new TodoController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $controller->store();
}

if (isset($_GET['delete'])) {
  $controller->delete();
}

$todos = $controller->index();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todoアプリ</title>
</head>

<body>
  <h1>Todoアプリ</h1>
  <form method="POST" action="index.php">
    <input type="text" name="title" placeholder="Todoを入力">
    <button type="submit">追加</button>
  </form>

  <h2>一覧</h2>

  <ul>
    <?php foreach ($todos as $todo): ?>
      <li>
        <?= htmlspecialchars($todo->toArray()['title']); ?>
        <a href="?delete=<?= $todo->toArray()['id'] ?>">削除</a>
      </li>
    <?php endforeach ?>
  </ul>

</body>

</html>