<?php
// app/controller/TodoController.phpを読み込む
require_once __DIR__ . '/../app/controller/TodoController.php';

$todoController = new TodoController();
$todos = $todoController->getTodos();
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

  <ul>
    <?php foreach ($todos as $todo) : ?>
      <li><?php echo htmlspecialchars($todo); ?></li>
    <?php endforeach; ?>
  </ul>

  <form method="POST" action="">
    <input type="text" name="title" placeholder="Todoを入力">
    <button type="submit">追加</button>
  </form>

</body>

</html>