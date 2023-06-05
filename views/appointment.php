<link rel="stylesheet" href="Design/css/appointment-page-style.css">

<section class="booking_section">
    <div id="modal" class="modal" style="display: none;">
        <div class="modal-content">
            <form method="post" id="appointment_form" action="/appointment">
                <div class="select_services_div tab_reservation" id="services_tab" style="display: none;">
                    <div class="alert alert-danger" role="alert" style="display: none">
                        Escolha pelo menos um dos nossos serviços
                    </div>
                    <div class="text_header">
                        <span>
                            1. Escolha o(s) serviço(s) pretendido(s)
                        </span>
                    </div>
                    <div class="items_tab">
                        <?php foreach ($services as $service) { ?>
                            <div class="itemListElement">
                                <div class="item_details">
                                    <div>
                                        <?php echo $service['name']; ?>
                                    </div>
                                    <div class="item_select_part">
                                        <span class="service_duration_field">
                                            <?php echo $service['duration']; ?> min
                                        </span>
                                        <div class="service_price_field">
                                            <span style="font-weight: bold;">
                                                <?php echo $service['price']; ?>€
                                            </span>
                                        </div>
                                        <div class="select_item_bttn">
                                            <div class="btn-group-toggle" data-toggle="buttons">
                                                <label class="service_label item_label btn btn-secondary">
                                                    <input type="checkbox" name="selected_services[]"
                                                        value="<?php echo $service['service_id']; ?>" autocomplete="off"
                                                        onclick="handleServiceSelection(event)">Selecione
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>


                <div class="select_employee_div tab_reservation" id="employees_tab" style="display: none;">
                    <div class="alert alert-danger" role="alert" style="display: none">
                        Escolha um dos nossos barbeiros!
                    </div>
                    <div class="text_header">
                        <span>
                            2. Escolha do barbeiro
                        </span>
                    </div>
                    <div class="btn-group-toggle" data-toggle="buttons">
                        <div class="items_tab">
                            <?php
                            $displayedEmployees = [];

                            foreach ($employees as $employee) {
                                $fullName = $employee['first_name'] . " " . $employee['last_name'];


                                if (in_array($fullName, $displayedEmployees)) {
                                    continue;
                                }


                                $displayedEmployees[] = $fullName;

                                echo "<div class='itemListElement'>";
                                echo "<div class='item_details'>";
                                echo "<div>";
                                echo $fullName;
                                echo "</div>";
                                echo "<div class='item_select_part'>";
                                ?>
                                <div class="select_item_bttn">
                                    <label class="item_label btn btn-secondary active">
                                        <input type="radio" class="radio_employee_select" name="selected_employee"
                                            value="<?php echo $employee['employee_id'] ?>">Selecione
                                    </label>
                                </div>
                                <?php
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>


                <div class="select_date_time_div tab_reservation" id="calendar_tab" style="display: none;">
                    <div class="alert alert-danger" role="alert" style="display: none">
                        Escolha a hora
                    </div>

                    <div class="text_header">
                        <span>
                            3. Escolha o dia e hora
                        </span>
                    </div>

                    <div class="calendar_tab" style="overflow-x: auto; overflow-y: visible;" id="calendar_tab_in">
                        <div id="calendar_loading">
                            <img src="/design/images/ajax_loader_gif.gif"
                                style="display: block; margin-left: auto; margin-right: auto;">
                        </div>
                    </div>
                </div>

                <div class="client_details_div tab_reservation" id="client_tab" style="display: none;">
                    <div class="text_header">
                        <span>
                            4. Detalhes Cliente
                        </span>
                    </div>

                    <div>
                        <div class="form-group colum-row row">
                            <div class="col-sm-6">
                                <input type="text" name="client_first_name" id="client_first_name" class="form-control"
                                    placeholder="First Name" minlength="3" maxlength="60" required>
                                <span class="invalid-feedback">Este campo é obrigatório</span>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="client_last_name" id="client_last_name" class="form-control"
                                    placeholder="Last Name" minlength="3" maxlength="60" required>
                                <span class="invalid-feedback">Este campo é obrigatório</span>
                            </div>
                            <div class="col-sm-6">
                                <input type="email" name="client_email" id="client_email" class="form-control"
                                    placeholder="E-mail">
                                <span class="invalid-feedback">Email inválido!</span>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="client_phone_number" id="client_phone_number"
                                    class="form-control" placeholder="Phone number">
                                <span class="invalid-feedback">Número telemóvel inválido</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="overflow:auto;padding: 30px 0px;">
                    <div style="float:right;">
                        <input type="hidden" name="submit_book_appointment_form">
                        <button type="button" id="prevBtn" class="next_prev_buttons" style="background-color: #bbbbbb;"
                            onclick="nextPrev(-1)">Anterior</button>
                        <button type="button" id="nextBtn" class="next_prev_buttons"
                            onclick="nextPrev(1)">Próximo</button>
                    </div>
                </div>

                <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                </div>
            </form>
        </div>
    </div>

</section>