<?php include_once("header.php");
print '<h1 class="text-center">' . $data["subtitle"] . '</h1>';
print '<div class="alert alert-' . $data["color"] . ' mt-3">';
print '<h4>' . $data["text"] . '</h4>';
print '</div>';
print '<a href="' . ROUTE . $data["url"] . '" class="btn ' . $data["buttonColor"] . '">';
print $data["buttonText"] . '</a>';
include_once("footer.php"); ?>