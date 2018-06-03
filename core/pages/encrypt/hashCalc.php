<div class="row justify-content-md-center">
    <div class="col-md-12">
        <h4 class="mb-3">Calculadora Hash</h4>
        <form class="needs-validation" novalidate method="post">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="plainValue">Valor à ser calculado:</label>
                    <input type="text" class="form-control" id="plainValue" name="plainValue" placeholder=""
                           required>
                    <div class="invalid-feedback">
                        Insira um texto para calcular.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="hashToCompare">Comparar com:</label>
                    <input type="text" class="form-control" name="hashToCompare" id="hashToCompare"
                           placeholder=""
                           value="">
                </div>
            </div>
            <button class="btn btn-senha-segura btn-lg btn-block" type="submit">Calcular</button>
        </form>
        <?php if (!empty(@$hashResult['sha5125k'])): ?>
            <div class="row">
                <div class="col-12">
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th scope="col">Tipo Hash</th>
                            <th scope="col">Hash Gerado</th>
                            <th scope="col">Resultado Comparação</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>SHA512 5000 Rounds</td>
                            <td><?php echo @$hashResult['sha5125k'] ?: '' ?></td>
                            <td><?php echo @$compareResult['sha5125k'] ?: '' ?></td>
                        </tr>
                        <tr>
                            <td>HMAC md5</td>
                            <td><?php echo @$hashResult['md5_hmac'] ?: '' ?></td>
                            <td><?php echo @$compareResult['md5_hmac'] ?: '' ?></td>
                        </tr>
                        <tr>
                            <td>Whirlpool</td>
                            <td><?php echo @$hashResult['whirlpool'] ?: '' ?></td>
                            <td><?php echo @$compareResult['whirlpool'] ?: '' ?></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>

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