<form action="" method="post">
    <?php if (empty(@$terminal['history']) || @$terminal['connected']): ?>
        <div class="row justify-content-md-center">
            <div class="col-3 mb-3">
                <label for="shiftAmount">Usuário:</label>
                <input type="text" class="form-control" name="ssh[user]" id="shiftAmount"
                       placeholder="Usuário" required>
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
<!--    --><?php //if (!empty(@$terminal['history']) || @$terminal['connected']): ?>
        <div class="row justify-content-md-center bg-dark">
            <div id="terminal" class="mb-5 p-3">
<!--                --><?php //foreach (@terminal['history']['commands'] ?: [] as $id => $command): ?>
<!--                    <span class="text-light">--><?php //echo $command; ?><!--</span><br>-->
<!--                    <span class="text-light">--><?php //echo $terminal['history']['results'][$id]; ?><!--</span><br>-->
                    <span class="text-light">senhaSegura@debian:~$ ls -la /etc</span><br>
                    <span class="text-light">total 1032<br>
drwxr-xr-x 118 root root    4096 Jun  4 04:37 .<br>
drwxr-xr-x  24 root root    4096 Apr  9 21:59 ..<br>
drwxr-xr-x   3 root root    4096 Mar 12 16:28 acpi<br>
-rw-r--r--   1 root root    3028 Aug  1  2017 adduser.conf<br>
-rw-r--r--   1 root root      51 Mar 12 16:44 aliases<br>
-rw-r--r--   1 root root   12288 Mar 12 16:44 aliases.db<br>
drwxr-xr-x   2 root root   16384 Mar 12 16:43 alternatives<br>
drwxr-xr-x   3 root root    4096 Mar 12 16:40 apache2<br>
drwxr-xr-x   3 root root    4096 Mar 12 16:27 apm<br>
drwxr-xr-x   3 root root    4096 Mar 12 16:33 apparmor<br>
drwxr-xr-x   9 root root    4096 Mar 12 16:41 apparmor.d<br>
drwxr-xr-x   3 root root    4096 Mar 12 16:33 apport<br>
drwxr-xr-x   6 root root    4096 Mar 12 16:42 apt<br>
-rw-r-----   1 root daemon   144 Jan 14  2016 at.deny<br>
drwxr-xr-x   2 root root    4096 Mar 12 16:36 at-spi2<br>
-rw-r--r--   1 root root    2188 Aug 31  2015 bash.bashrc<br>
-rw-r--r--   1 root root      45 Aug 12  2015 bash_completion<br>
drwxr-xr-x   2 root root    4096 Mar 12 16:33 bash_completion.d<br>
-rw-r--r--   1 root root     367 Jan 27  2016 bindresvport.blacklist<br>
drwxr-xr-x   2 root root    4096 Apr 12  2016 binfmt.d<br>
drwxr-xr-x   2 root root    4096 Mar 12 16:42 blackfire<br>
drwxr-xr-x   2 root root    4096 Mar 12 16:28 byobu<br>
drwxr-xr-x   3 root root    4096 Mar 12 16:27 ca-certificates<br>
-rw-r--r--   1 root root    8464 Mar 12 16:33 ca-certificates.conf<br>
-rw-r--r--   1 root root    7788 Mar 12 16:28 ca-certificates.conf.dpkg-old<br>
drwxr-xr-x   2 root root    4096 Mar 12 16:27 calendar<br>
drwxr-xr-x   4 root root    4096 Mar 12 16:43 chromium-browser<br>
                    <span class="text-light">senhaSegura@debian:~$ _</span><br>
<!--                --><?php //endforeach; ?>
                <input type="text" class="float-bottom" name="ssh[command]" autofocus>
            </div>
        </div>
<!--    --><?php //endif; ?>
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