<?php
  ////////////////////////////////////////////////////////////
  // 2005-2008 (C) Кузнецов М.В., Симдянов И.В.
  // PHP. Практика создания Web-сайтов
  // IT-студия SoftTime 
  // http://www.softtime.ru   - портал по Web-программированию
  // http://www.softtime.biz  - коммерческие услуги
  // http://www.softtime.mobi - мобильные проекты
  // http://www.softtime.org  - некоммерческие проекты
  ////////////////////////////////////////////////////////////
  // Выставляем уровень обработки ошибок 
  // (http://www.softtime.ru/info/articlephp.php?id_article=23)
  error_reporting(E_ALL & ~E_NOTICE);

  // Включаем заголовок страницы
  require_once("../utils/top.php");

  echo "<p class=help>Произошла исключительная 
        ситуация (ExceptionObject) - попытка 
        использования в качестве элемента управления
        объекта, класс которого не является 
        производным от базового класса field.
        {$exc->getMessage()}.</p>";
  echo "<p class=help>Ошибка в файле {$exc->getFile()}
        в строке {$exc->getLine()}.</p>";

  // Включаем завершение страницы
  require_once("../utils/bottom.php");
  exit();
?>