<section class="contact-section" id="contact-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 sm-padding">
                <div class="contact-info">
                    <h2>Entra em contacto connosco<br>envia-nos a tua mensagem!</h2>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat eveniet consectetur non
                        reiciendis libero id porro beatae vitae quasi nobis!</p>
                    <h3>Lorem ipsum dolor sit.<br>Queluz, 2745-052</h3>
                    <h4>
                        <span style="font-weight: bold">Email:</span> barbershop@gmail.com<br>
                        <span style="font-weight: bold">Telemóvel:</span> +351 960 000 000
                    </h4>
                </div>
            </div>
            <div class="col-lg-6 sm-padding">
                <div class="contact-form">
                    <form id="contact_form" method="post" action="/contact">
                        <div class="form-group colum-row row">
                            <div class="col-sm-6">
                                <input type="text" id="contact_name" name="name" class="form-control" placeholder="Nome"
                                    minlength="3" maxlength="60" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="email" id="contact_email" name="email" class="form-control"
                                    placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="text" id="contact_subject" name="subject" class="form-control"
                                    minlength="3" maxlength="150" placeholder="Assunto" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <textarea id="contact_message" name="message" cols="30" rows="5"
                                    class="form-control message" placeholder="Mensagem" minlength="5" maxlength="2000"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" id="contact_send" class="default_btn" name="send">Enviar
                                    Mensagem</button>
                            </div>
                        </div>
                    </form>
                    <div id="contact_status_message"></div>
                </div>
            </div>
        </div>
    </div>
</section>