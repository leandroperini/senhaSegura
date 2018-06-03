<?php



require_once "core/models/DeviceType.php";
require_once "core/models/Device.php";


class DeviceController extends AppController {

    public function create() {
        $this->page        = 'device/create';
        $this->deviceTypes = $this->getTypes();
        if (isset($_POST['deviceData'])) {
            $device        = new Device();
            $result        = $device->insert([

                                                 'hostname' => $_POST['deviceData']['hostname'],
                                                 'ip'       => $_POST['deviceData']['ip'],
                                                 'type_id'  => $_POST['deviceData']['type'],
                                             ]);
            $this->message = [
                'type' => 'danger',
                'text' => 'Erro ao cadastrar dispositivo!',
            ];
            if ($result) {
                $this->message = [
                    'type' => 'success',
                    'text' => 'Dispositivo inserido com sucesso!',
                ];
            }
        }
    }

    private function getTypes() {
        $types = new DeviceType();
        return $types->columns('*')
                     ->order('name')
                     ->get();
    }

    public function update() {
        $this->page = 'device/edit';
        $device     = new Device();
        if (isset($_POST['deviceData'])) {
            $result        = $device->conditions([
                                                     'id =' => $_POST['deviceData']['id'] ?: 0,
                                                 ])
                                    ->update([
                                                 'hostname' => $_POST['deviceData']['hostname'],
                                                 'ip'       => $_POST['deviceData']['ip'],
                                                 'type_id'  => $_POST['deviceData']['type'],
                                             ]);
            $this->message = [
                'type' => 'danger',
                'text' => 'Erro ao alterar dispositivo!',
            ];
            if ($result) {
                $this->message = [
                    'type' => 'success',
                    'text' => 'Dispositivo alterado com sucesso!',
                ];
            }
        }
        $device     = new Device();
        $this->deviceTypes = $this->getTypes();
        $this->device      = $device->columns('*')
                                    ->conditions([
                                                     'id =' => $_GET['device_id'] ?: 0,
                                                 ])
                                    ->order('devices.id desc')
                                    ->get();
    }

    public function delete() {
        $device        = new Device();
        $result        = $device->conditions([
                                                 'id =' => $_GET['device_id'] ?: 0,
                                             ])
                                ->delete();
        $this->message = [
            'type' => 'danger',
            'text' => 'Erro ao remover dispositivo!',
        ];
        if ($result) {
            $this->message = [
                'type' => 'success',
                'text' => 'Dispositivo removido com sucesso!',
            ];
        }
        $this->show();
    }

    public function show() {
        $this->page       = 'device/show';
        $device           = new Device();
        $this->deviceList = $device->columns('devices.*, device_types.name')
                                   ->join([
                                              'device_types' => 'device_types.id = devices.type_id',
                                          ])
                                   ->order('devices.id desc')
                                   ->get();
    }
}
