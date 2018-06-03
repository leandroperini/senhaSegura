<div class="row justify-content-md-center">
    <div class="col-md-12">
        <h4 class="mb-3">Criptografador</h4>
        <form class="needs-validation" novalidate method="post">
            <input type="hidden" name="operation" id="operation" value="<?php echo $operation; ?>">
            <div class="row mb-3 justify-content-md-center">
                <div class="col-3 mb-3">
                    <label for="shiftAmount">Casas à mover(Cifra de César):</label>
                    <input type="number" class="form-control" name="shiftAmount" id="shiftAmount"
                           placeholder=""
                           value="<?php echo $shiftAmount; ?>">
                </div>
                <div class="col-4 mb-3">
                    <label for="keyword">Palavra Chave (Cifra de César | AES-256):</label>
                    <input type="text" class="form-control" name="keyword" id="keyword"
                           placeholder=""
                           maxlength="26"
                           value="<?php echo $keyword; ?>">
                </div>
                <div class="col-4 mb-3">
                    <label for="salt">SALT(AES-256):</label>
                    <input type="text" class="form-control" name="salt" id="salt"
                           placeholder=""
                           value="<?php echo $salt; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12 mb-3">
                    <label for="plainValue">Valor à ser criptgografado:</label>
                    <textarea class="form-control" name="plainValue" id="plainValue" rows="5"
                    ><?php echo $plainValue; ?></textarea>
                </div>
                <button class="btn btn-success btn-lg btn-block col-10 offset-1" type="submit" onclick="$
                ('#operation').val('encrypt').parent('form').submit(); ">
                    <span class="oi oi-lock-locked"></span>
                    <span>Criptografar</span>
                    <span class="oi oi-lock-locked"></span>
                </button>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="encryptedValue">Valor criptografado:</label>
                    <textarea class="form-control" name="encryptedValue" id="encryptedValue" rows="5"
                    ><?php echo $encryptedValue; ?></textarea>
                </div>
                <button class="btn btn-danger btn-lg btn-block col-10 offset-1" type="submit" onclick="$
                ('#operation').val('decrypt').parent('form').submit(); ">
                    <span class="oi oi-lock-unlocked"></span>
                    <span>Descriptografar</span>
                    <span class="oi oi-lock-unlocked"></span>
                </button>
            </div>
        </form>
        <?php if (!empty(@$encryptResult['caesar']) || !empty(@$decryptResult['caesar'])): ?>
            <div class="row">
                <div class="col-12">
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th scope="col">Tipo Criptografia</th>
                            <?php if ($operation == 'encrypt'): ?>
                                <th scope="col">Valor Criptografado</th>
                            <?php else: ?>
                                <th scope="col">Valor Desriptografado</th>
                            <?php endif; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Cifra de César</td>
                            <td><?php echo @$encryptResult['caesar'] ?: '' ?></td>
                        </tr>
                        <tr>
                            <td>AES-256 com SALT</td>
                            <td><?php echo @$encryptResult['aes256salt'] ?: '' ?></td>
                        </tr>
                        <tr>
                            <td>Cifra de César com palavra-chave</td>
                            <td><?php echo @$encryptResult['caesarKeyword'] ?: '' ?></td>
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