<?php
    $rootPath = "";
    while(!file_exists($rootPath . "index.php")){
        $rootPath = "../$rootPath";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="<?php echo $rootPath ?>views/backend/partials/css/style.css">
</head>
<body>

<div class="Top-nav">
    <div class="Login-info-div">
        <?php
            if(isset($_SESSION['name'])){
        ?>
            <p>
                <?php echo $_SESSION['name']; ?>
                &nbsp;
                <a href="/logoutFunction">Log out</a>
            </p>
        <?php
            }
        ?>
    </div>
</div>


<div class="Admin-main-section">
    <aside>

        <nav>
            <ul>
                <li>
                    <a href="/adminProducts">Products</a>
                </li>
                <li>
                    <a href="/adminUsers">Users</a>
                </li>
                <li>
                    <a href="/adminMedia">Media</a>
                </li>
                <li>
                    <a href="/adminNews">News</a>
                </li>
            </ul>
        </nav>
    </aside>