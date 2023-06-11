<?php
ob_start();
session_start();


$pageTitle = 'Serviços';


include 'connect.php';
include 'Includes/functions/functions.php';
include 'Includes/templates/header.php';


echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";


if (isset($_SESSION['username_barbershop_Xw211qAAsq4']) && isset($_SESSION['password_barbershop_Xw211qAAsq4'])) {
    ?>

    <div class="container-fluid">


        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">Serviços</h1>

        </div>

        <?php
        $do = '';

        if (isset($_GET['do']) && in_array($_GET['do'], array('Add', 'Edit'))) {
            $do = htmlspecialchars($_GET['do']);
        } else {
            $do = 'Manage';
        }

        if ($do == 'Manage') {
            $query = $con->prepare("SELECT * 
                FROM services AS s, service_categories AS sc 
                WHERE s.category_id = sc.category_id 
                ORDER BY s.category_id");
            $query->execute();
            $all_services = $query->fetchAll();
            ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Serviços</h6>
                </div>
                <div class="card-body">



                    <a href="services.php?do=Add" class="btn btn-success btn-sm" style="margin-bottom: 10px;">
                        <i class="fa fa-plus"></i>
                        Adicionar Serviço
                    </a>



                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Nome do Serviço</th>
                                <th scope="col">Categoria do Serviço</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Preço</th>
                                <th scope="col">Duração</th>
                                <th scope="col">Gerir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($all_services as $service) {
                                echo "<tr>";
                                echo "<td>";
                                echo $service['name'];
                                echo "</td>";
                                echo "<td>";
                                echo $service['category_name'];
                                echo "</td>";
                                echo "<td style = 'width:30%'>";
                                echo $service['description'];
                                echo "</td>";
                                echo "<td>";
                                echo $service['price'];
                                echo "</td>";
                                echo "<td>";
                                echo $service['duration'];
                                echo "</td>";
                                echo "<td>";
                                $delete_data = "delete_" . $service["service_id"];
                                ?>
                                <ul class="list-inline m-0">



                                    <li class="list-inline-item" data-toggle="tooltip" title="Editar">
                                        <button class="btn btn-success btn-sm rounded-0">
                                            <a href="services.php?do=Edit&service_id=<?php echo $service['service_id']; ?>"
                                                style="color: white;">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </button>
                                    </li>



                                    <li class="list-inline-item" data-toggle="tooltip" title="Eliminar">
                                        <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="modal"
                                            data-target="#<?php echo $delete_data; ?>" data-placement="top"><i
                                                class="fa fa-trash"></i></button>



                                        <div class="modal fade" id="<?php echo $delete_data; ?>" tabindex="-1" role="dialog"
                                            aria-labelledby="<?php echo $delete_data; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Serviço</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Tem a certeza que quer eliminar este Serviço "
                                                        <?php echo $service['name']; ?>"?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancelar</button>
                                                        <button type="button" data-id="<?php echo $service['service_id']; ?>"
                                                            class="btn btn-danger delete_service_bttn">Eliminar</button>
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
            <?php
        } elseif ($do == 'Add') {
            ?>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Adicionar Novo Serviço</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="services.php?do=Add">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_name">Nome do Serviço</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo (isset($_POST['name'])) ? htmlspecialchars($_POST['name']) : '' ?>"
                                        placeholder="Nome do Serviço" name="name">
                                    <?php
                                    $add_service_form = 0;
                                    if (isset($_POST['add_new_service'])) {
                                        if (empty(test_input($_POST['name']))) {
                                            ?>
                                            <div class="invalid-feedback" style="display: block;">
                                                Nome do Serviço é obrigatório!
                                            </div>
                                            <?php

                                            $add_service_form = 1;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php
                                $stmt = $con->prepare("SELECT * FROM service_categories");
                                $stmt->execute();
                                $rows_categories = $stmt->fetchAll();
                                ?>
                                <div class="form-group">
                                    <label for="service_category">Categoria do Serviço</label>
                                    <select class="custom-select" name="service_category">
                                        <?php
                                        foreach ($rows_categories as $category) {
                                            echo "<option value = '" . $category['category_id'] . "'>";
                                            echo $category['category_name'];
                                            echo "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_duration">Duração do serviço(min)</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo (isset($_POST['duration'])) ? htmlspecialchars($_POST['duration']) : '' ?>"
                                        placeholder="Duração do serviço" name="duration">
                                    <?php

                                    if (isset($_POST['add_new_service'])) {
                                        if (empty(test_input($_POST['duration']))) {
                                            ?>
                                            <div class="invalid-feedback" style="display: block;">
                                                Duração do serviço é obrigatória!
                                            </div>
                                            <?php

                                            $add_service_form = 1;
                                        } elseif (!ctype_digit(test_input($_POST['duration']))) {
                                            ?>
                                            <div class="invalid-feedback" style="display: block;">
                                                Duração Inválida!
                                            </div>
                                            <?php

                                            $add_service_form = 1;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_price">Preço do serviço(€)</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo (isset($_POST['price'])) ? htmlspecialchars($_POST['price']) : '' ?>"
                                        placeholder="Preço do serviço" name="price">
                                    <?php

                                    if (isset($_POST['add_new_service'])) {
                                        if (empty(test_input($_POST['price']))) {
                                            ?>
                                            <div class="invalid-feedback" style="display: block;">
                                                Preço do serviço é obrigatório!
                                            </div>
                                            <?php

                                            $add_service_form = 1;
                                        } elseif (!is_numeric(test_input($_POST['price']))) {
                                            ?>
                                            <div class="invalid-feedback" style="display: block;">
                                                Preço inválido!
                                            </div>
                                            <?php

                                            $add_service_form = 1;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Descrição do serviço</label>
                                    <textarea class="form-control" name="description"
                                        style="resize: none;"><?php echo (isset($_POST['description'])) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                                    <?php

                                    if (isset($_POST['add_new_service'])) {
                                        if (empty(test_input($_POST['description']))) {
                                            ?>
                                            <div class="invalid-feedback" style="display: block;">
                                                Descrição do serviço é obrigatória!
                                            </div>
                                            <?php

                                            $add_service_form = 1;
                                        } elseif (strlen(test_input($_POST['description'])) > 300) {
                                            ?>
                                            <div class="invalid-feedback" style="display: block;">

                                                A descrição do serviço tem que ser menor de 300 letras
                                            </div>
                                            <?php

                                            $add_service_form = 1;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>



                        <button type="submit" name="add_new_service" class="btn btn-primary">Adicionar Serviço</button>

                    </form>

                    <?php


                    if (isset($_POST['add_new_service']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $add_service_form == 0) {
                        $service_name = test_input($_POST['name']);
                        $service_category = $_POST['service_category'];
                        $service_duration = test_input($_POST['duration']);
                        $service_price = test_input($_POST['price']);
                        $service_description = test_input($_POST['description']);

                        try {
                            $stmt = $con->prepare("insert into services(name,description,price,duration,category_id) values(?,?,?,?,?) ");
                            $stmt->execute(array($service_name, $service_description, $service_price, $service_duration, $service_category));

                            ?>


                            <script type="text/javascript">
                                swal("Novo Serviço", "O novo serviço foi criado com sucesso").then((value) => {
                                    window.location.replace("services.php");
                                });
                            </script>

                            <?php

                        } catch (Exception $e) {
                            echo "<div class = 'alert alert-danger' style='margin:10px 0px;'>";
                            echo 'Error occurred: ' . $e->getMessage();
                            echo "</div>";
                        }

                    }
                    ?>
                </div>
            </div>


            <?php
        } elseif ($do == "Edit") {
            $service_id = (isset($_GET['service_id']) && is_numeric($_GET['service_id'])) ? intval($_GET['service_id']) : 0;

            if ($service_id) {
                $stmt = $con->prepare("Select * from services where service_id = ?");
                $stmt->execute(array($service_id));
                $service = $stmt->fetch();
                $count = $stmt->rowCount();

                if ($count > 0) {
                    ?>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Editar Serviço</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="services.php?do=Edit&service_id=<?php echo $service_id; ?>">

                                <input type="hidden" name="service_id" value="<?php echo $service['service_id']; ?>">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="service_name">Nome do Serviço</label>
                                            <input type="text" class="form-control" value="<?php echo $service['name'] ?>"
                                                placeholder="Novo do serviço" name="name">
                                            <?php
                                            $flag_edit_service_form = 0;

                                            if (isset($_POST['edit_service_sbmt'])) {
                                                if (empty(test_input($_POST['name']))) {
                                                    ?>
                                                    <div class="invalid-feedback" style="display: block;">
                                                        Nome do serviço é obrigatório
                                                    </div>
                                                    <?php

                                                    $flag_edit_service_form = 1;
                                                }

                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <?php
                                        $stmt = $con->prepare("SELECT * FROM service_categories");
                                        $stmt->execute();
                                        $rows_categories = $stmt->fetchAll();
                                        ?>
                                        <div class="form-group">
                                            <label for="service_category">Categoria do Serviço</label>
                                            <select class="custom-select" name="service_category">
                                                <?php
                                                foreach ($rows_categories as $category) {
                                                    if ($category['category_id'] == $service['category_id']) {
                                                        echo "<option value = '" . $category['category_id'] . "' selected>";
                                                        echo $category['category_name'];
                                                        echo "</option>";
                                                    } else {
                                                        echo "<option value = '" . $category['category_id'] . "'>";
                                                        echo $category['category_name'];
                                                        echo "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="service_duration">Duração do Serviço(min)</label>
                                            <input type="text" class="form-control" value="<?php echo $service['duration'] ?>"
                                                placeholder="Durtação do Serviço" name="duration">
                                            <?php

                                            if (isset($_POST['edit_service_sbmt'])) {
                                                if (empty(test_input($_POST['duration']))) {
                                                    ?>
                                                    <div class="invalid-feedback" style="display: block;">
                                                        Duração do Serviço é obrigatório!
                                                    </div>
                                                    <?php

                                                    $flag_edit_service_form = 1;
                                                } elseif (!ctype_digit(test_input($_POST['duration']))) {
                                                    ?>
                                                    <div class="invalid-feedback" style="display: block;">
                                                        Duração inválida!
                                                    </div>
                                                    <?php

                                                    $flag_edit_service_form = 1;
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="service_price">Preço do Serviço(€)</label>
                                            <input type="text" class="form-control" value="<?php echo $service['price'] ?>"
                                                placeholder="Preço do Serviço" name="price">
                                            <?php

                                            if (isset($_POST['edit_service_sbmt'])) {
                                                if (empty(test_input($_POST['price']))) {
                                                    ?>
                                                    <div class="invalid-feedback" style="display: block;">
                                                        Serviço é obrigatório!
                                                    </div>
                                                    <?php

                                                    $flag_edit_service_form = 1;
                                                } elseif (!is_numeric(test_input($_POST['price']))) {
                                                    ?>
                                                    <div class="invalid-feedback" style="display: block;">
                                                        Preço inválido!
                                                    </div>
                                                    <?php

                                                    $flag_edit_service_form = 1;
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="service_description">Descrição do Serviço</label>
                                            <textarea class="form-control" name="description"
                                                style="resize: none;"><?php echo $service['description']; ?></textarea>
                                            <?php

                                            if (isset($_POST['edit_service_sbmt'])) {
                                                if (empty(test_input($_POST['description']))) {
                                                    ?>
                                                    <div class="invalid-feedback" style="display: block;">
                                                        Descrição do Serviço é obrigatória!
                                                    </div>
                                                    <?php

                                                    $flag_edit_service_form = 1;
                                                } elseif (strlen(test_input($_POST['description'])) > 300) {
                                                    ?>
                                                    <div class="invalid-feedback" style="display: block;">
                                                        A descrição do serviço tem que ser menor de 300 letras
                                                    </div>
                                                    <?php

                                                    $flag_edit_service_form = 1;
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>


                                <button type="submit" name="edit_service_sbmt" class="btn btn-primary">Guardar</button>
                            </form>

                            <?php

                            if (isset($_POST['edit_service_sbmt']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $flag_edit_service_form == 0) {
                                $service_id = $_POST['service_id'];
                                $service_name = test_input($_POST['name']);
                                $service_category = $_POST['service_category'];
                                $service_duration = test_input($_POST['duration']);
                                $service_price = test_input($_POST['price']);
                                $service_description = test_input($_POST['description']);

                                try {
                                    $stmt = $con->prepare("update services set name = ?, description = ?, price = ?, duration = ?, category_id = ? where service_id = ? ");
                                    $stmt->execute(array($service_name, $service_description, $service_price, $service_duration, $service_category, $service_id));

                                    ?>


                                    <script type="text/javascript">
                                        swal("Serviço Atualizado", "O serviço foi atualizado com sucesso", "sucesso").then((value) => {
                                            window.location.replace("services.php");
                                        });
                                    </script>

                                    <?php

                                } catch (Exception $e) {
                                    echo "<div class = 'alert alert-danger' style='margin:10px 0px;'>";
                                    echo 'Error occurred: ' . $e->getMessage();
                                    echo "</div>";
                                }

                            }
                            ?>
                        </div>
                    </div>
                    <?php
                } else {
                    header('Location: services.php');
                    exit();
                }
            } else {
                header('Location: services.php');
                exit();
            }
        }
        ?>
    </div>

    <?php


    include 'Includes/templates/footer.php';
} else {
    header('Location: login.php');
    exit();
}

?>