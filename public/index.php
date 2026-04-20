<?php
require __DIR__ . '/../app/controller/TodoController.php';

// jsonファイルのパスを指定
$filePath = '../todos.json';

$todoController = new TodoController();

// 配列を更新する
$todos = $todoController->getTodos($filePath);

// Todoを追加する関数
$todoController->addTodo($filePath, $todos);

$deleteId = -1;
//　Todoを削除する関数
$todoController->deleteTodo($filePath, $todos, $deleteId);

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
  <form method="POST" action="">
    <input type="text" name="title" placeholder="Todoを入力">
    <button type="submit">追加</button>
  </form>

  <h2>一覧</h2>

  <ul>
    <?php foreach ($todos as $todo): ?>
      <li>
        <?php echo htmlspecialchars($todo['title'], ENT_QUOTES, 'UTF-8'); ?>
        <a href="?delete_id=<?php echo $todo['id']; ?>">削除</a>
      </li>
    <?php endforeach ?>
  </ul>

</body>

</html>