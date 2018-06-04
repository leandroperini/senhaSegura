<?php

require_once "core/models/DeviceType.php";
require_once "core/models/Device.php";


class TerminalController extends AppController {

    public function terminal() {
        $this->page         = 'terminal/terminal';
        $this->pageColWidth = 'col-6';
        $this->terminal     = &$_SESSION['terminal'];


        $device           = new Device();
        $this->deviceList = $device->columns('*')
                                   ->order('devices.id desc')
                                   ->get();
        if (isset($_POST['ssh'])) {
            if (isset($_POST['ssh']['command'])) {
                $this->runCommand($_POST['ssh']['command'], $_POST['ssh']['user'], $_POST['ssh']['password']);
            }
            if (isset($_POST['ssh']['user']) && isset($_POST['ssh']['password']) && isset($_POST['ssh']['device'])) {
                $device = $device->columns('ip')
                                 ->conditions([
                                                  'id =' => $_POST['ssh']['device'],
                                              ])
                                 ->get();

                $this->startSSH($_POST['ssh']['user'], $_POST['ssh']['password'], $device['ip']);
            }
        }
    }

    private function runCommand($command, $user = '', $password = '', $destination = '') {

        if (is_null($this->terminal)) {
            $this->terminal = [];
        }
        if (!is_null($this->terminal)) {
            if (@$this->terminal['connected'] !== true) {
                $this->startSSH($user, $password, $destination);
                if (!isset($this->terminal['history']['result'])) {
                    $this->terminal['history'] = [
                        'commands' => [],
                        'results'  => [],
                    ];
                }
                array_push($this->terminal['history']['commands'], $command);
                fwrite($this->terminal['shell'], $command);
                sleep(1);

                $retorno = "";
                while ($buffer = fread($this->terminal['shell'], 4096)) {
                    $retorno .= $buffer;
                }
                array_push($this->terminal['history']['results'], $retorno);

            }

        }
    }

    private function startSSH($user, $password, $destination) {
        $this->terminal['connected']  = false;
        $this->terminal['connection'] = ssh2_connect($destination, 22);
        if ($this->terminal['connection']) {
            $this->terminal['connected'] = ssh2_auth_password($this->terminal['connection'], $user, $password);
        }
        if ($this->terminal['connected']) {
            $this->terminal['shell'] = ssh2_shell($this->terminal['connection'], 'vt102', null, 80, 40, SSH2_TERM_UNIT_CHARS);
        }
        if ($this->terminal['shell'] === false) {
            $this->terminal['connected'] = false;
        } else {
            stream_set_blocking($this->terminal['shell'], true);
        }
    }

    private function finishSSH() {
        fclose($this->terminal['shell']);
    }

}
