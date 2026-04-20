<?php

// require_once __DIR__ . '/../model/Todo.php';

class TodoController
{
    public function getTodos($filePath)
    {
        //存在確認,　無かったら早期リターン
        if (!file_exists($filePath)) {
            return [];
        }

        // json変数に読み込み
        $json = file_get_contents($filePath);

        // todos, falseの場合は空配列
        return json_decode($json, true) ?? [];
    }

    public function addTodo($filePath, $todos)
    {
        //　空白文字を除去、空文字チェック
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');

            //空文字ではない場合,新しTodoを作成
            if ($title !== '') {
                $newTodo = [
                    'id' => count($todos) + 1,
                    'title' => $title,
                    'created_at' => date('c')
                ];

                // 配列に追加
                $todos[] = $newTodo;

                file_put_contents(
                    $filePath,
                    json_encode($todos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
                );
                header('Location: index.php');
            }
        }
    }

    public function deleteTodo($filePath, $todos, $deleteId)
    {

        if (isset($_GET['delete_id'])) {
            $deleteId = (int)$_GET['delete_id'];
            foreach ($todos as $index => $todo) {
                if ($todo['id'] == $deleteId) {
                    unset($todos[$index]);
                    break;
                }
            }

            $todos = array_values($todos);

            file_put_contents(
                $filePath,
                json_encode($todos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
            );

            header('Location: index.php');
            exit;
        }
    }
}
