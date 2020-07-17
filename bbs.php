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
        // print_r($_POST);

        //受け取ったidのレコードを削除
        if(isset($_POST["delete_id"])){
          $delete_id = $_POST["delete_id"];
          $sql = "DELETE FROM bbs WHERE id = :delete_id;";
          $stmt = $pdo->prepare($sql);
          $stmt->bindValue(":delete_id", $delete_id, PDO::PARAM_INT);
          $stmt->execute();
        }

        if(isset($_POST["content"]) && isset($_POST["user_name"])){
          $content = $_POST["content"];
          $user_name = $_POST["user_name"];
          //データベースに書き込む
          $sql = "INSERT INTO bbs (content, user_name, updated_at) VALUES (:content, :user_name, NOW());";
          $stmt = $pdo->prepare($sql);
          $stmt->bindValue(":content", $content, PDO::PARAM_STR);
          $stmt->bindValue(":user_name", $user_name, PDO::PARAM_STR);
          $stmt -> execute();
        }
        echo "投稿内容を受信:" . $content;
      ?>
      
      <h1>掲示板</h1>
      <h2>投稿フォーム</h2>
      <form action="bbs.php" method="post">
        <label>投稿内容</label>
        <input type="text" name="content">
        <label>投稿者</label>
        <input type="text" name="user_name">
        <button type="submit">送信</button>
      </form>

      <h2>発言リスト</h2>
        <?php
          //データベースからのデータ取得
          $sql = "SELECT * FROM bbs ORDER BY updated_at;";
          $stmt = $pdo->prepare($sql);
          $stmt->execute();
        ?>

        <table>
          <tr>
            <th>id</th>
            <th>日時</th>
            <th>投稿内容</th>
            <th>投稿者</th>
            <th></th>
          </tr>
           <?php  
          //取得したデータを表示する
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
          <tr>
            <td><?=$row["id"] ?></td>
            <td><?=$row["updated_at"] ?></td>
            <td><?=$row["content"] ?></td>
            <td><?=$row["user_name"] ?></td>
            <td>
              <form action="bbs.php" method="post">
                <input type="hidden" name="delete_id" value=<?= $row["id"] ?>>
                <button type="submit">削除</button>
              </form>
            </td>
          </tr>
        <?php } ?>
        </table>
    </body>
</html>