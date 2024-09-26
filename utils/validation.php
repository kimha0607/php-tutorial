<?php
  class Validation {
    static function clean ($str) {
      $str = trim($str);
      $str = stripcslashes($str);
      $str = htmlspecialchars($str);
      return $str;
    }

    static function require($str) {
      return !empty(trim($str));
  }
  }
?>