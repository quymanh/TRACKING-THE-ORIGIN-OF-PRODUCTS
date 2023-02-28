<?php 
    session_start();
    include "../connectdb.php";
    include "config-admin.php";
    do {
        echo "haha";
        if ($_SESSION['role'] == '0') {
            
                if (isset($_GET['id_acc'])) {
                    $statement_dlt_xnhs = $pdo->prepare("DELETE FROM users WHERE id=?");
                    $statement_dlt_xnhs->execute(array($_GET['id_acc']));
                    header("Location: ".BASE_URL.'admin/index.php');
                }
        } else {
            header("Location: ".BASE_URL);
        } 
    } while (false);
?>