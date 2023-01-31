<?php

function get_lectures()
{
  $lectures = [];
  if ($handle = opendir('.')) {
    while (false !== ($entry = readdir($handle))) {
      if (!is_dir($entry) || in_array($entry, [".", ".."])) {
        continue;
      }
      $lectures[] = $entry;
    }
    closedir($handle);
  }
  sort($lectures);
  return $lectures;
}

function get_examples()
{
  $examples = [];
  if ($handle = opendir('.')) {
    while (false !== ($entry = readdir($handle))) {
      $info = new SplFileInfo($entry);
      if (!in_array($info->getExtension(), ["php", "html", "htm", "js", "css", "xml", "xsl", "xsd", "sql"])) {
        continue;
      } elseif ($entry == "index.php") {
        continue;
      }
      $examples[] = $entry;
    }
    closedir($handle);
  }
  sort($examples);
  return $examples;
}

function list_lectures()
{
  $path = $_SERVER['REQUEST_URI'];
  foreach(get_lectures() as $entry) {
    echo "<a href=\"{$path}/{$entry}\">Lecture {$entry}</a><br>";
  }
}

function list_examples()
{
  $path = $_SERVER['REQUEST_URI'];
  foreach(get_examples() as $entry) {
    echo "<a href=\"{$path}{$entry}\">{$entry}</a><br>";
  }
}

function show_examples()
{
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome</title>
  </head>
  <body>
    <?php list_examples(); ?>
  </body>
</html>
<?php
}