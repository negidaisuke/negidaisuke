     <!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_5-1</title>
    </head>
    <body>   
       
        <?php
        $dsn = 'mysql:データベース名;host=localhost';
    $user = 'ユーザー名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
        if(isset($_POST["name"])&&isset($_POST["comment"])&&empty($_POST["edits"])&&$_POST["pass"]){
         if($_POST["name"]!=""&&$_POST["comment"]!="" &&$_POST["pass"]){
        $id=null;
        $name =($_POST["name"]);
        $comment = ($_POST["comment"]);
        $pass=($_POST["pass"]);
        $date = date("Y-m-d H:i:s");
       
       
  
    

    $stmt = $pdo->prepare('insert into table1 (id,name, comment, reg_date,password) values (?, ?, ?,?,?)');
			$stmt->execute([$id,$name, $comment,$date, $pass]);
         }
        }
        if(isset($_POST["delno"])&&isset($_POST["pass2"])){
           if ($_POST["delno"] != ""&&$_POST["pass2"]){
              $delete=$_POST["delno"];
              $pass2=$_POST["pass2"];
			$stmt = $pdo->prepare('delete from table1 where id=? and password=?');
			$stmt->execute([$delete, $pass2]);
			
		}
              }
           if(isset($_POST["number"])&&isset($_POST["pass3"])){//編集フォームが送信されたなら
               if($_POST["number"]!=""&&$_POST["pass3"]!=""){//編集フォームが空でないなら
            $number=$_POST["number"];//変数代入
            $pass3=$_POST["pass3"];
            $stmt = $pdo->prepare('select * from table1 where id=? and password=?');
			$stmt->execute([$number, $pass3]);
			if ($row = $stmt->fetch()) {
				$newname = $row['name'];
				$newcomment = $row['comment'];
			} 
		}
           }
           if(isset($_POST["name"])&&isset($_POST["comment"])&&isset($_POST["edits"])&&isset($_POST["pass"])){
               if($_POST["name"]!=""&&$_POST["comment"]!=""&&$_POST["edits"]!=""&&$_POST["pass"]!=""){
                   $edits=$_POST["edits"];
                   $name =$_POST["name"];
        $comment = $_POST["comment"];
        $date = date("Y-m-d H:i:s");
        $pass=$_POST["pass"];
        $stmt = $pdo->prepare('update table1 set name=?, comment=?,reg_date=?, password=? where id=?');
        $stmt->execute([$name, $comment,$date,$pass, $edits]);
               }
           }
        ?>


          <form action="#" method="post">
            <input type="text" name="name" placeholder="名前" value="<?php if(isset($newname)){echo $newname;}?>"><br>
            <input type="text" name="comment" placeholder="コメント" value="<?php if(isset($newcomment)){ echo $newcomment;}?>">
            <input type="hidden" name="edits" value="<?php if(isset($number)) {echo $number;} ?>"><br>
            <input type="password" name="pass" placeholder="パスワード">
            <input type="submit" name="submit"><br>
            <br>
         <input type="text" name="delno" placeholder="削除対象番号"><br>
            <input type="password" name="pass2" placeholder="パスワード">
            <input type="submit" name="delete" value="削除"><br>
            <br>
            </form>
            <form action="#" method="post">
            <input type="text" name="number" placeholder="編集対象番号"><br>
            <input type ="password" name="pass3" placeholder="パスワード">
            <input type="submit" name="edit" value="編集"><br>
            <br>
        </form>
        </body>
        <?php
        $sql = 'SELECT * FROM table1';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].',';
        echo $row['reg_date'].'<br>';
    echo "<hr>";
    }
    ?>
        </html>