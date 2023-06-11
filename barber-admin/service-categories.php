<?php
session_start();


$pageTitle = 'Categorias de Serviços';


include 'connect.php';
include 'Includes/functions/functions.php';
include 'Includes/templates/header.php';


if (isset($_SESSION['username_barbershop_Xw211qAAsq4']) && isset($_SESSION['password_barbershop_Xw211qAAsq4'])) {
    ?>

    <div class="container-fluid">


        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Categorias de Serviços</h1>

        </div>


        <?php
        $stmt = $con->prepare("SELECT * FROM service_categories");
        $stmt->execute();
        $rows_categories = $stmt->fetchAll();
        ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Categorias de Serviços</h6>
            </div>
            <div class="card-body">


                <button class="btn btn-success btn-sm" style="margin-bottom: 10px;" type="button" data-toggle="modal"
                    data-target="#add_new_category" data-placement="top">
                    <i class="fa fa-plus"></i>
                    Adicionar Categoria
                </button>


                <div class="modal fade" id="add_new_category" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Adicionar Nova Categoria</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="category_name">Nome da Categoria</label>
                                    <input type="text" id="category_name_input" class="form-control"
                                        placeholder="Nome da Categoria" name="category_name">
                                    <div class="invalid-feedback" id="required_category_name" style="display: none;">
                                        Nome da Categoria é obrigatório!
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-info" id="add_category_bttn"> Adicionar
                                    Categoria</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Categoria ID</th>
                                <th>Categoria NOME</th>
                                <th>Gerir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($rows_categories as $category) {
                                echo "<tr>";
                                echo "<td>";
                                echo $category['category_id'];
                                echo "</td>";
                                echo "<td>";
                                echo $category['category_name'];
                                echo "</td>";
                                echo "<td>";
                                if (strtolower($category["category_name"])) {
                                    $delete_data = "delete_" . $category["category_id"];
                                    $edit_data = "edit_" . $category["category_id"];
                                    ?>

                                    <ul>
                                        <li class="list-inline-item" data-toggle="tooltip" title="Edit">
                                            <button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="modal"
                                                data-target="#<?php echo $edit_data; ?>" data-placement="top"><i
                                                    class="fa fa-edit"></i></button>



                                            <div class="modal fade" id="<?php echo $edit_data; ?>" tabindex="-1" role="dialog"
                                                aria-labelledby="<?php echo $edit_data; ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Editar Categoria</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="category_name">Nome da Categoria</label>
                                                                <input type="text" class="form-control"
                                                                    id="<?php echo "input_category_name_" . $category["category_id"]; ?>"
                                                                    value="<?php echo $category["category_name"]; ?>">
                                                                <div class="invalid-feedback"
                                                                    id="<?php echo "invalid_input_" . $category["category_id"]; ?>">
                                                                    Nome da Categoria é obrigatório!
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancelar</button>
                                                            <button type="button" data-id="<?php echo $category['category_id']; ?>"
                                                                class="btn btn-success edit_category_bttn">Guardar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Categoria</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Tem a certeza que quer eliminar esta Categoria"

                                                            <?php echo $category['category_name']; ?>"?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancelar</button>
                                                            <button type="button" data-id="<?php echo $category['category_id']; ?>"
                                                                class="btn btn-danger delete_category_bttn">Eliminar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <?php
                                }
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

    <?php


    include 'Includes/templates/footer.php';
} else {
    header('Location: login.php');
    exit();
}

?>