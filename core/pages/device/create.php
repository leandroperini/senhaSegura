<div class="row justify-content-md-center">
    <div class="col-md-8">
        <h4 class="mb-3">Cadastro de Dispositivo</h4>
        <form class="needs-validation" novalidate method="post">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="firstName">Hostname:</label>
                    <input type="text" class="form-control" id="hostname" name="deviceData[hostname]" placeholder=""
                           value=""
                           required>
                    <div class="invalid-feedback">
                        Escreva no Hostname!
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="lastName">Endereço IP:</label>
                    <input type="text" class="form-control" name="deviceData[ip]" id="ip" placeholder="" value=""
                           required>
                    <div class="invalid-feedback">
                        Digite um endereço IP!
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="country">Tipo:</label>
                    <select class="custom-select d-block w-100" id="type" name="deviceData[type]" required>
                        <option value="">Selecione um tipo...</option>
                        <?php foreach ($deviceTypes as $deviceType): ?>
                            <option value="<?php echo $deviceType['id']; ?>"><?php echo $deviceType['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        Selecione um tipo!
                    </div>
                </div>
            </div>
            <button class="btn btn-senha-segura btn-lg btn-block" type="submit">Salvar</button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function (e) {
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    });
</script>