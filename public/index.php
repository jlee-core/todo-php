<?php
// jsonファイルのパスを指定
$filePath = '../todos.json';

// 配列宣言
$todoList = [];

// 存在確認
if (file_exists($filePath)) {
  // json変数に読み込み
  $json = file_get_contents($filePath);
  // todoList配列に格納, falseの場合は空配列
  $todoList = json_decode($json, true) ?? [];
}

//　空白文字を除去、空文字チェック
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = trim($_POST['title'] ?? '');

  //空文字ではない場合,新しTodoを作成
  if ($title !== '') {
    $newTodo = [
      'id' => count($todoList) + 1,
      'title' => $title,
      'created_at' => date('c')
    ];

    // 配列に追加
    $todoList[] = $newTodo;

    // 配列をjson形式に変換して保存
    file_put_contents(
      $filePath,
      json_encode($todoList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
  }
}
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

  </ul>

  <form method="POST" action="">
    <input type="text" name="title" placeholder="Todoを入力">
    <button type="submit">追加</button>
  </form>



  <h2>一覧</h2>
  <ul>
    <?php foreach ($todoList as $todo): ?>
      <li>
        <?php echo htmlspecialchars($todo['title'], ENT_QUOTES, 'UTF-8'); ?>
      </li>
    <?php endforeach ?>
  </ul>

</body>

</html>