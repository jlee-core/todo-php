<?php

// require_once __DIR__ . '/../model/Todo.php';

class TodoController
{
    private $todoList = [];

    public function getTodoList($filePath)
    {
        //存在確認,　無かったら早期リターン
        if (!file_exists($filePath)) {
            return [];
        }

        // json変数に読み込み
        $json = file_get_contents($filePath);

        // todoList配列に格納, falseの場合は空配列
        $todoList = json_decode($json, true) ?? [];
    }

    public function addTodo($filePath, $todoList)
    {
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
    }
}
