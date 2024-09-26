<?php
class User
{
  private $table_name = "Users";
  private $conn;

  function __construct($db_conn)
  {
    $this->conn = $db_conn;
  }

  function insert($data)
  {
    try {
      $sql = "INSERT INTO $this->table_name (username, full_name, address, phone_number, password) VALUES (:username, :full_name, :address, :phone_number, :password)";
      $stmt = $this->conn->prepare($sql);
      return $stmt->execute($data);
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  function is_username_unique($username)
  {
    try {
      $sql = 'SELECT username FROM ' . $this->table_name . ' WHERE username=?';
      $stmt = $this->conn->prepare($sql);
      $res = $stmt->execute([$username]);
      if ($stmt->rowCount() > 0)
        return 0;
      else
        return 1;
    } catch (PDOException $e) {
      return 0;
    }
  }

  function auth($username, $password)
  {
    try {
      $sql = 'SELECT * FROM ' . $this->table_name . ' WHERE username=?';
      $stmt = $this->conn->prepare($sql);
      $res = $stmt->execute([$username]);
      if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch();
        $db_username = $user["username"];
        $db_password = $user["password"];
        $db_user_full_name = $user["full_name"];
        $db_user_id = $user["user_id"];
        $db_address = $user["address"];
        $db_user_phone = $user["phone_number"];

        if ($db_username === $username) {
          if (password_verify($password, $db_password)) {
            $this->user_id = $db_user_id;
            $this->username = $db_username;
            $this->full_name = $db_user_full_name;
            $this->address = $db_address;
            $this->phone_number = $db_user_phone;
            return true;
          } else
            return false;
        } else
          return false;
      } else
        return false;
    } catch (PDOException $e) {
      return false;
    }
  }

  function getUser()
  {
    $data = array(
      'user_id' => $this->user_id,
      'username' => $this->username,
      'full_name' => $this->full_name,
      'phone_number' => $this->phone_number,
      'address' => $this->address
    );
    return $data;
  }
}
?>