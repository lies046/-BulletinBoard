<!DOCTYPE html>
  <html lang="ja">

    <head>
      <meta charset="utf-8">
      <title>掲示板</title>
    </head>
    
    <body>
      <?php
        //データベースに接続する
        $pdo = new PDO("mysql:host=127.0.0.1;dbname=lesson;charset=utf8", "root", "");

        //受け取ったデータを表示
        print_r($_POST);

        if(isset($_POST["content"])){
          $content = $_POST["content"];
          //データベースに書き込む
          $sql = "INSERT INTO bbs (content, updated_at) VALUES (:content, NOW());";
          $stmt = $pdo->prepare($sql);
          $stmt->bindValue(":content", $content, PDO::PARAM_STR);
          $stmt -> execute();
        }else{
          $content = "なし";
        }
        echo "投稿内容を受信:" . $content;
      ?>
      <h1>掲示板</h1>

      <h2>投稿フォーム</h2>
      <form action="bbs.php" method="POST">
        <label>投稿内容</label>
        <input type="text" name="content">
        <button type="submit">送信</button>
      </form>
      <h2>発言リスト</h2>
        <?php
          //データベースに接続する
          $pdo = new PDO("mysql:host=127.0.0.1;dbname=lesson;charset=utf8", "root", "");

          //データベースからのデータ取得
          $sql = "SELECT * FROM bbs ORDER BY updated_at;";
          $stmt = $pdo->prepare($sql);
          $stmt->execute();

          //取得したデータを表示する
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          echo("<br/>");
          }
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