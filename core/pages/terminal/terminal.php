<form action="" method="post">
    <?php if (empty(@$terminal['history']) || @$terminal['connected']): ?>
        <div class="row justify-content-md-center">
            <div class="col-3 mb-3">
                <label for="shiftAmount">Usuário:</label>
                <input type="text" class="form-control" name="ssh[user]" id="shiftAmount"
                       placeholder="Usuário" required autofocus>
                <div class="invalid-feedback">
                    Digite o usuário!
                </div>
            </div>
            <div class="col-3 mb-3">
                <label for="shiftAmount">Senha:</label>
                <input type="password" class="form-control" name="ssh[password]" id="shiftAmount"
                       placeholder="••••••" required>
                <div class="invalid-feedback">
                    Digite a senha!
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="device">Dispositivo:</label>
                <select class="custom-select d-block w-100" id="device" name="ssh[device]" required>
                    <option value="">Selecione um dispositivo...</option>
                    <?php foreach ($deviceList ?: [] as $device): ?>
                        <option value="<?php echo $device['id']; ?>"><?php echo $device['hostname']; ?>
                            - <?php echo $device['ip']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    Selecione um tipo!
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <button class="btn btn-senha-segura btn-lg col-6 mb-2" type="submit">Conectar</button>
        </div>
    <?php else: ?>
        <div class="row justify-content-md-center">
            <button class="btn btn-senha-segura btn-lg col-6 mb-2" type="submit">Terminar Sessão</button>
        </div>
    <?php endif; ?>
    <?php if (!empty(@$terminal['history']) || @$terminal['connected']): ?>
        <div class="row justify-content-md-center bg-dark">
            <div id="terminal" class="mb-5 p-3">
                <?php foreach ($terminal['history']['commands'] ?: [] as $id => $command): ?>
                    <span class="text-light"><?php echo $command; ?></span><br>
                    <span class="text-light"><?php echo $terminal['history']['results'][$id]; ?></span><br>
                <?php endforeach; ?>
                <input type="text" class="float-bottom" name="ssh[command]" autofocus>
            </div>
        </div>
    <?php endif; ?>
</form>
<script>
    $(document).ready(function (e) {
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

</script>