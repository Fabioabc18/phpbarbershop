<?php
session_start();


$pageTitle = 'Clientes';


include 'connect.php';
include 'Includes/functions/functions.php';
include 'Includes/templates/header.php';


if (isset($_SESSION['username_barbershop_Xw211qAAsq4']) && isset($_SESSION['password_barbershop_Xw211qAAsq4'])) {
    ?>


    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Clientes</h1>

        </div>


        <?php
        $stmt = $con->prepare("SELECT * FROM clients");
        $stmt->execute();
        $rows_clients = $stmt->fetchAll();
        ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Clientes</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Apelido</th>
                                <th scope="col">Nº Telemóvel</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Gerir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($rows_clients as $client) {
                                echo "<tr>";
                                echo "<td>";
                                echo $client['client_id'];
                                echo "</td>";
                                echo "<td>";
                                echo $client['first_name'];
                                echo "</td>";
                                echo "<td>";
                                echo $client['last_name'];
                                echo "</td>";
                                echo "<td>";
                                echo $client['phone_number'];
                                echo "</td>";
                                echo "<td>";
                                echo $client['client_email'];
                                echo "</td>";
                                echo "<td>";
                                $delete_data = "delete_" . $client['client_id'];
                                ?>
                                <ul class="list-inline m-0">
                                    <li class="list-inline-item" data-toggle="tooltip" title="Delete">
                                        <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="modal"
                                            data-target="#<?php echo $delete_data; ?>" data-placement="top"><i
                                                class="fa fa-trash"></i></button>
                                        <div class="modal fade" id="<?php echo $delete_data; ?>" tabindex="-1" role="dialog"
                                            aria-labelledby="<?php echo $delete_data; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Cliente</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Tem a certeza que pretende eliminar esse cliente "
                                                        <?php echo $client['first_name']; ?>"?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancelar</button>
                                                        <button type="button" data-id="<?php echo $client['client_id']; ?>"
                                                            class="btn btn-danger delete_client_bttn">Eliminar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <?php
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <style>
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .table-bordered td {
            vertical-align: middle;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }

        .list-inline-item {
            display: inline-block;
        }

        .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-danger {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }
    </style>

    <?php

    include 'Includes/templates/footer.php';
} else {
    header('Location: clients.php');
    exit();
}
?>