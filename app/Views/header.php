<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php print ROUTE; ?>public/img/Dental.ico">
    <title>Clinica Internacional | <?php print $data["title"]; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a href="" class="navbar-brand ms-3">Clinica Internacional</a>
    </nav>
    <div class="container -fluid">
        <div class="row content">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <?php 
                if (isset($data["errors"])){
                    if (count($data["errors"]) > 0) {
                        foreach ($data["errors"] as $error) {
                            print "<div class='alert alert-danger mt-3'>";
                            foreach ($data["errors"] as $value){
                                print ".$value.<br>";
                            }
                        }
                        print "</div>";
                    }
                }
                
                
                
                ?>