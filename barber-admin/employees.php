<?php
ob_start();
session_start();


$pageTitle = 'Employees';


include 'connect.php';
include 'Includes/functions/functions.php';
include 'Includes/templates/header.php';


echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";


if (isset($_SESSION['username_barbershop_Xw211qAAsq4']) && isset($_SESSION['password_barbershop_Xw211qAAsq4'])) {
    ?>

    <div class="container-fluid">


        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Colaboradores</h1>
        </div>

        <?php
        $do = '';

        if (isset($_GET['do']) && in_array($_GET['do'], array('Add', 'Edit'))) {
            $do = htmlspecialchars($_GET['do']);
        } else {
            $do = 'Manage';
        }

        if ($do == 'Manage') {
            $stmt = $con->prepare("SELECT * FROM employees");
            $stmt->execute();
            $rows_employees = $stmt->fetchAll();

            ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Colaboradores</h6>
                </div>
                <div class="card-body">


                    <a href="employees.php?do=Add" class="btn btn-success btn-sm" style="margin-bottom: 10px;">
                        <i class="fa fa-plus"></i>
                        Adicionar Colaboradores
                    </a>


                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Apelido</th>
                                    <th scope="col">Nº Telemóvel</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Fotografia</th>
                                    <th scope="col">Gerir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($rows_employees as $employee) {
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $employee['first_name'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $employee['last_name'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $employee['phone_number'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $employee['email'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $employee['photo'];
                                    echo "</td>";
                                    echo "<td>";
                                    $delete_data = "delete_employee_" . $employee["employee_id"];
                                    ?>
                                    <ul class="list-inline m-0">



                                        <li class="list-inline-item" data-toggle="tooltip" title="Edit">
                                            <button class="btn btn-success btn-sm rounded-0">
                                                <a href="employees.php?do=Edit&employee_id=<?php echo $employee['employee_id']; ?>"
                                                    style="color: white;">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </button>
                                        </li>



                                        <li class="list-inline-item" data-toggle="tooltip" title="Delete">
                                            <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="modal"
                                                data-target="#<?php echo $delete_data; ?>" data-placement="top"><i
                                                    class="fa fa-trash"></i></button>



                                            <div class="modal fade" id="<?php echo $delete_data; ?>" tabindex="-1" role="dialog"
                                                aria-labelledby="<?php echo $delete_data; ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Colaborador</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Tem a certeza que pretende eliminar este colaborador?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancelar</button>
                                                            <button type="button" data-id="<?php echo $employee['employee_id']; ?>"
                                                                class="btn btn-danger delete_employee_bttn">Eliminar</button>
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
            <?php
        } elseif ($do == 'Add') {
            ?>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Adicionar novo colaborador</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="employees.php?do=Add" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employee_fname">Nome</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo (isset($_POST['employee_fname'])) ? htmlspecialchars($_POST['employee_fname']) : '' ?>"
                                        placeholder="Nome" name="employee_fname">
                                    <?php
                                    $add_employee_form_employee_form = 0;
                                    if (isset($_POST['add_new_employee'])) {
                                        if (empty(test_input($_POST['employee_fname']))) {
                                            ?>
                                            <div class="invalid-feedback" style="display: block;">
                                                Nome obrigatório!
                                            </div>
                                            <?php

                                            $add_employee_form_employee_form = 1;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employee_lname">Apelido</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo (isset($_POST['employee_lname'])) ? htmlspecialchars($_POST['employee_lname']) : '' ?>"
                                        placeholder="Apelido" name="employee_lname">
                                    <?php
                                    if (isset($_POST['add_new_employee'])) {
                                        if (empty(test_input($_POST['employee_lname']))) {
                                            ?>
                                            <div class="invalid-feedback" style="display: block;">
                                                Apelido obrigatório!
                                            </div>
                                            <?php

                                            $add_employee_form_employee_form = 1;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employee_phone">Nº de Telemóvel</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo (isset($_POST['employee_phone'])) ? htmlspecialchars($_POST['employee_phone']) : '' ?>"
                                        placeholder="Nº de Telemóvel" name="employee_phone">
                                    <?php
                                    if (isset($_POST['add_new_employee'])) {
                                        if (empty(test_input($_POST['employee_phone']))) {
                                            ?>
                                            <div class="invalid-feedback" style="display: block;">
                                                Nº de Telemóvel obrigatório!
                                            </div>
                                            <?php

                                            $add_employee_form_employee_form = 1;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employee_email">Email</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo (isset($_POST['employee_email'])) ? htmlspecialchars($_POST['employee_email']) : '' ?>"
                                        placeholder="E-mail" name="employee_email">
                                    <?php
                                    if (isset($_POST['add_new_employee'])) {
                                        if (empty(test_input($_POST['employee_email']))) {
                                            ?>
                                            <div class="invalid-feedback" style="display: block;">
                                                Email obrigatório!
                                            </div>
                                            <?php

                                            $add_employee_form_employee_form = 1;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="photo">Fotografia</label>
                        <input type="file" class="form-control"
                            value="<?php echo (isset($_FILES['photo']['name'])) ? htmlspecialchars($_FILES['photo']['name']) : '' ?>"
                            placeholder="Fotografia" name="photo">
                        <?php
                        if (isset($_POST['add_new_employee'])) {
                            if (empty($_FILES['photo']['name'])) {
                                ?>
                                <div class="invalid-feedback" style="display: block;">
                                    Fotografia obrigatória!
                                </div>
                                <?php

                                $add_employee_form_employee_form = 1;
                            }
                        }
                        ?>
                    </div>
                </div>



                <button type="submit" name="add_new_employee" class="btn btn-primary">Adicionar Colaborador</button>

                </form>

                <?php



                if (isset($_POST['add_new_employee']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $add_employee_form_employee_form == 0) {
                    $employee_fname = test_input($_POST['employee_fname']);
                    $employee_lname = $_POST['employee_lname'];
                    $employee_phone = test_input($_POST['employee_phone']);
                    $employee_email = test_input($_POST['employee_email']);


                    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
                        $temp_name = $_FILES['photo']['tmp_name'];
                        $photo_path = 'C:/xampp\tmp' . $_FILES['photo']['name'];


                        move_uploaded_file($temp_name, $photo_path);

                        try {
                            $stmt = $con->prepare("INSERT INTO employees (first_name, last_name, phone_number, email, photo) VALUES (?, ?, ?, ?, ?)");
                            $stmt->execute(array($employee_fname, $employee_lname, $employee_phone, $employee_email, $photo_path));

                            ?>
                            <script type="text/javascript">
                                swal("Novo Colaborador", "O novo colaborador foi inserido com sucesso", "sucesso").then((value) => {
                                    window.location.replace("employees.php");
                                });
                            </script>
                            <?php
                        } catch (Exception $e) {
                            echo "<div class='alert alert-danger' style='margin:10px 0px;'>";
                            echo 'Error occurred: ' . $e->getMessage();
                            echo "</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger' style='margin:10px 0px;'>";
                        echo "Erro no envio da foto.";
                        echo "</div>";
                    }
                }

                ?>
            </div>
        </div>
        <?php
        } elseif ($do == 'Edit') {
            $employee_id = (isset($_GET['employee_id']) && is_numeric($_GET['employee_id'])) ? intval($_GET['employee_id']) : 0;

            if ($employee_id) {
                $stmt = $con->prepare("Select * from employees where employee_id = ?");
                $stmt->execute(array($employee_id));
                $employee = $stmt->fetch();
                $count = $stmt->rowCount();

                if ($count > 0) {
                    ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Editar colaborador</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="employees.php?do=Edit&employee_id=<?php echo $employee_id; ?>">

                            <input type="hidden" name="employee_id" value="<?php echo $employee['employee_id']; ?>">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employee_fname">Nome</label>
                                        <input type="text" class="form-control" value="<?php echo $employee['first_name'] ?>"
                                            placeholder="Nome" name="employee_fname">
                                        <?php
                                        $edit_employee_form = 0;
                                        if (isset($_POST['edit_employee_sbmt'])) {
                                            if (empty(test_input($_POST['employee_fname']))) {
                                                ?>
                                                <div class="invalid-feedback" style="display: block;">
                                                    Nome obrigatório!
                                                </div>
                                                <?php

                                                $edit_employee_form = 1;
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employee_lname">Apelido</label>
                                        <input type="text" class="form-control" value="<?php echo $employee['last_name'] ?>"
                                            placeholder="Apelido" name="employee_lname">
                                        <?php
                                        if (isset($_POST['edit_employee_sbmt'])) {
                                            if (empty(test_input($_POST['employee_lname']))) {
                                                ?>
                                                <div class="invalid-feedback" style="display: block;">
                                                    Apelido obrigatório!
                                                </div>
                                                <?php

                                                $edit_employee_form = 1;
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employee_phone">Nº de Telemóvel</label>
                                        <input type="text" class="form-control" value="<?php echo $employee['phone_number'] ?>"
                                            placeholder="Nº de Telemóvel" name="employee_phone">
                                        <?php
                                        if (isset($_POST['edit_employee_sbmt'])) {
                                            if (empty(test_input($_POST['employee_phone']))) {
                                                ?>
                                                <div class="invalid-feedback" style="display: block;">
                                                    Nº de Telemóvel obrigatório!
                                                </div>
                                                <?php

                                                $edit_employee_form = 1;
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employee_email">Email</label>
                                        <input type="text" class="form-control" value="<?php echo $employee['email'] ?>"
                                            placeholder="Email" name="employee_email">
                                        <?php
                                        if (isset($_POST['edit_employee_sbmt'])) {
                                            if (empty(test_input($_POST['employee_email']))) {
                                                ?>
                                                <div class="invalid-feedback" style="display: block;">
                                                    Email obrigatório!
                                                </div>
                                                <?php

                                                $edit_employee_form = 1;
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>


                            <button type="submit" name="edit_employee_sbmt" class="btn btn-primary">
                                Editar Colaborador
                            </button>
                        </form>
                        <?php

                        if (isset($_POST['edit_employee_sbmt']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $edit_employee_form == 0) {
                            $employee_fname = test_input($_POST['employee_fname']);
                            $employee_lname = $_POST['employee_lname'];
                            $employee_phone = test_input($_POST['employee_phone']);
                            $employee_email = test_input($_POST['employee_email']);
                            $employee_id = $_POST['employee_id'];

                            try {
                                $stmt = $con->prepare("update employees set first_name = ?, last_name = ?, phone_number = ?, email = ? where employee_id = ? ");
                                $stmt->execute(array($employee_fname, $employee_lname, $employee_phone, $employee_email, $employee_id));

                                ?>


                                <script type="text/javascript">
                                    swal("Colaborador atualizado", "O colaborador foi atualizado com sucesso", "sucesso").then((value) => {
                                        window.location.replace("employees.php");
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
                    header('Location: employees.php');
                    exit();
                }
            } else {
                header('Location: employees.php');
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