<table class="table text-center">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Hostname</th>
        <th scope="col">IP</th>
        <th scope="col">Tipo</th>
        <th scope="col">Ação</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($deviceList ?: [] as $device): ?>
        <tr>
            <th scope="row"><?php echo $device['id']; ?></th>
            <td><?php echo $device['hostname']; ?></td>
            <td><?php echo $device['ip']; ?></td>
            <td><?php echo $device['name']; ?></td>
            <td>
                <a class="btn btn-senha-segura" href="/dispositivos/editar?device_id=<?php echo $device['id']; ?>">Editar
                </a>
                <a class="btn btn-danger" href="/dispositivos/remover?device_id=<?php echo $device['id']; ?>">Remover
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>



