<?php

include_once("bd.php");
include_once("header.php");
?>

<!doctype html>
<html lang="ru">
<head>
  <title> СКЛАД </title>  
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <?php
    $host = 'localhost';  // Хост, у нас все локально
    $user = 'root';    // Имя созданного вами пользователя
    $pass = ''; // Установленный вами пароль пользователю
    $db_name = 'testmvd';   // Имя базы данных
    $link = mysqli_connect($host, $user, $pass, $db_name); // Соединяемся с базой

    // Ругаемся, если соединение установить не удалось
    if (!$link) {
      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
      exit;
    }

    //Если переменная Name передана
    if (!isset($_POST["Name"])) {
      echo "
      <div id='mydiv'>Нечего передавать в базу данных. Остановлено</div>
      <script>
      $('#mydiv').delay(5000).hide(0);
      </script>
      "

      ;      
    }
    else{
      //Если это запрос на обновление, то обновляем
      if (isset($_GET['red_id'])) {
          $sql = mysqli_query($link, "UPDATE `products` SET `Name` = '{$_POST['Name']}',`Price` = '{$_POST['Price']}' WHERE `ID`={$_GET['red_id']}");
          echo "<script> alert('Товар изменен в базе успешно')</script>";
      } else {
          //Иначе вставляем данные, подставляя их в запрос
          $sql = mysqli_query($link, "INSERT INTO `products` (`Name`, `Price`) VALUES ('{$_POST['Name']}', '{$_POST['Price']}')");
      }

      //Если вставка прошла успешно
      if ($sql) {
        echo "<script> alert('Товар добавлен в базу успешно')</script>";
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
      }
    }

    if (isset($_GET['del_id'])) { //проверяем, есть ли переменная
      //удаляем строку из таблицы
      $sql = mysqli_query($link, "DELETE FROM `products` WHERE `ID` = {$_GET['del_id']}");
      if ($sql) {
        echo "<script> alert('Товар удален успешно')</script>";
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
      }
    }

    //Если передана переменная red_id, то надо обновлять данные. Для начала достанем их из БД
    if (isset($_GET['red_id'])) {
      $sql = mysqli_query($link, "SELECT `ID`, `Name`, `Price` FROM `products` WHERE `ID`={$_GET['red_id']}");
      $product = mysqli_fetch_array($sql);
    }
  ?>

<br>
<div class="container">
  <table border='1'class="table table-dark">
    <tr>
      <td>№ п/п</td>
      <td>Наименование</td>
      <td>Цена</td>
      <td>Удаление</td>
      <td>Редактирование</td>
    </tr>
    <?php

    $sql="SELECT * FROM products";
    $result = mysqli_query($link, $sql);
    if ($result) {
      while($row = mysqli_fetch_array($result)) {      
        echo '<tr>' .
             "<td>{$row['ID']}</td>" .
             "<td>{$row['Name']}</td>" .
             "<td>{$row['Price']} ₽</td>" .             
             "<td><a href='?del_id={$row['ID']}'><img src='img/delete.jpg' class='rounded mx-auto d-block' alt='' style='width:100px;'></a></td>".             
             "<td><a href='?red_id={$row['ID']}'><img src='img/remove.jpg' class='rounded mx-auto d-block' alt='' style='width:200px;'></a></td>".             
             '</tr>';
      }
    }    
    ?>
  </table>  
</div>


<br>
<div class="container">
<form action="" method="post">


    <label for="exampleInputName">Наименование</label>
    <input type="text" name="Name" class="form-control" value="<?= isset($_GET['red_id']) ? $product['Name'] : ''; ?>">
    <label for="exampleInputPrice">Цена</label>
    <input type="text" name="Price" class="form-control" value="<?= isset($_GET['red_id']) ? $product['Price'] : ''; ?> руб.">    
    <br>
    <td colspan="2"><input class="btn btn-primary btn-lg btn-block" type="submit" value="Добавить товар"></td>
</form>
</div>
</div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>