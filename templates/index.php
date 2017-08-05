<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Course PHP -  Task 10</title>

        <!-- Bootstrap -->
        <link href="<?php echo PATH;?>css/bootstrap.min.css" rel="stylesheet">

        <!-- My style -->
        <link href="<?php echo PATH;?>css/style.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container mt-50">
            <?php if (isset($error))
            { ?>

                <div class="row">
                    <div class="col-md-12">

                        <?php echo $error;?>

                    </div>
                </div>

            <?php } ?>
            <div class="row">
                <h2>Task 10</h2>
                <div class="col-md-12">
                    <h3>Distinct:</h3>
                    <?php  echo $distinct;?>
                </div>
                <div class="col-md-12">
                    <h3>INNER JOIN:</h3>
                    <?php  echo $innerJoin;?>
                </div>
                <div class="col-md-12">
                    <h3>LEFT JOIN:</h3>
                    <?php  echo $leftJoin;?>
                </div>
                <div class="col-md-12">
                    <h3>RIGHT JOIN:</h3>
                    <?php  echo $rightJoin;?>
                </div>
                <div class="col-md-12">
                    <h3>CROSS JOIN:</h3>
                    <?php  echo $crossJoin;?>
                </div>
                <div class="col-md-12">
                    <h3>NATURAL JOIN:</h3>
                    <?php  echo $naturalJoin;?>
                </div>
                <div class="col-md-12">
                    <h3>Group by:</h3>
                    <?php  echo $groupBy;?>
                </div>
                <div class="col-md-12">
                    <h3>Having:</h3>
                    <?php  echo $having;?>
                </div>
                <div class="col-md-12">
                    <h3>Order:</h3>
                    <?php  echo $orderBy;?>
                </div>
                <div class="col-md-12">
                    <h3>Limit:</h3>
                    <?php  echo $limit;?>
                </div>
            </div>

        </div>
         <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
         <!-- Include all compiled plugins (below), or include individual files as needed -->
         <script src="<?php echo PATH;?>js/bootstrap.min.js"></script>

    </body>
</html>

