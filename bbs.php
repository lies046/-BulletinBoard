<!DOCTYPE html>
  <html lang="ja">

    <head>
      <meta charset="utf-8">
      <title>掲示板</title>
    </head>
    
    <body>
      <h1>掲示板</h1>

      <h2>投稿フォーム</h2>
      <p>ここに投稿フォームを追加</p>
      <h2>発言リスト</h2>
        <?php
          //データベースに接続する
          $pdo = new PDO("mysql:host=127.0.0.1;dbname=lesson;charset=utf8", "root", "");

          //データベースからのデータ取得
          $sql = "SELECT * FROM bbs ORDER BY updated_at;";
          $stmt = $pdo->prepare($sql);
          $stmt->execute();

          //取得したデータを表示する
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          print_r($row);
          echo("<br/>");
          ?>

        <table>
          <tr></tr>
            <th>id</th>
            <th>日時</th>
            <th>投稿内容</th>
          </tr>
          <tr>
            <td>1</td>
            <td>2020-07-17</td>
            <td>こんにちは</td>
          </tr>
        </table>
    </body>
</html>