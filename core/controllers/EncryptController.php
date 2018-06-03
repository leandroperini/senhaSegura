<?php

class EncryptController extends AppController {

    public function __construct() {
        $this->alphabetIndexes = [
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
            'H',
            'I',
            'J',
            'K',
            'L',
            'M',
            'N',
            'O',
            'P',
            'Q',
            'R',
            'S',
            'T',
            'U',
            'V',
            'W',
            'X',
            'Y',
            'Z',
        ];
        $this->plainAlphabet   = array_flip($this->alphabetIndexes);
        return parent::__construct();
    }

    public function encryptDecrypt() {
        $this->page        = 'encrypt/encryptDecrypt';
        $this->operation   = @$_POST['operation'] ?: 'encrypt';
        $this->shiftAmount = @$_POST['shiftAmount'] ?: mt_rand(1, 26);
        $this->keyword     = @$_POST['keyword'] ?: 'senhaSegura';
        $this->salt        = @$_POST['salt'] ?: $this->hashGen(microtime(true) . mt_rand() . $this->keyword, 'md5_hmac');

        $this->plainValue     = @$_POST['plainValue'] ?: '';
        $this->encryptedValue = @$_POST['encryptedValue'] ?: '';

        if (isset($_POST['plainValue']) || isset($_POST['encryptedValue'])) {
            if ($this->operation == 'encrypt') {
                $this->encryptResult['caesar']        = $this->caesarEncipher($_POST['plainValue'], $this->shiftAmount);
                $this->encryptResult['aes256salt']    = $this->aes256SaltEncrypt($_POST['plainValue'], $this->salt, $this->keyword);
                $this->encryptResult['caesarKeyword'] = $this->caesarKeyEncipher($_POST['plainValue'], $this->shiftAmount, $this->keyword);
            }
            if ($this->operation == 'decrypt') {
                $this->encryptResult['caesar']        = $this->caesarDecipher($_POST['encryptedValue'], $this->shiftAmount);
                $this->encryptResult['aes256salt']    = $this->aes256SaltDecrypt($_POST['encryptedValue'], $this->salt, $this->keyword);
                $this->encryptResult['caesarKeyword'] = $this->caesarKeyDecipher($_POST['encryptedValue'], $this->shiftAmount, $this->keyword);
            }

        }

    }

    private function hashGen($value, $type) {
        $hash = 'Hash não suportado.';
        switch ($type) {
            case'sha5125k':
                if (CRYPT_SHA512 == 1) {
                    $salt = md5('senhaSegura');
                    $hash = crypt($value, '$6$' . $salt . '$');
                }
                break;
            case'md5_hmac':
                $hash = hash_hmac('md5', sha1('senhaSegura'), $value);
                break;
            case'whirlpool':
                $hash = hash('whirlpool', $value);
                break;
        }
        return $hash;
    }

    function caesarEncipher($input, $shiftAmount) {
        $output = false;
        $input  = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($input));
        $input  = preg_replace("/[^a-z 0-9,.;:-?!¿\/@#$%&\*\(\)\|_\n]/i", "", $input);

        $inputArr = str_split($input);
        if (is_numeric($shiftAmount) && $shiftAmount != 0) {
            $shiftAmount = (integer)$shiftAmount;
            $output      = array_map(function ($value) use ($shiftAmount) {
                $encipheredChar = $value;
                if (preg_match('/[a-z]/i', $value)) {
                    $plainIndex      = $this->plainAlphabet[strtoupper($value)];
                    $alphabetSize    = count($this->plainAlphabet);
                    $encipheredIndex = ($plainIndex + $shiftAmount) % $alphabetSize;
                    $encipheredChar  = $this->alphabetIndexes[$encipheredIndex];
                    if (!ctype_upper($value)) {
                        $encipheredChar = strtolower($encipheredChar);
                    }
                }
                return $encipheredChar;
            }, $inputArr);
            $output      = implode($output);
        }
        return $output;
    }

    private function aes256SaltEncrypt($plainValue, $salt, $key) {
        $output = $plainValue;
        $method = "AES-256-CBC";

        $iv     = substr(hash('sha256', $key), 0, 16);
        $output = openssl_encrypt($plainValue, $method, $salt, 0, $iv);
        return $output;
    }

    private function caesarKeyEncipher($input, $shiftAmount, $keyword) {
        $this->changeAlphabet($keyword);
        return $this->caesarEncipher($input, $shiftAmount);
    }

    private function changeAlphabet($keyword) {
        $keyword               = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($keyword));
        $keyword               = preg_replace("/[^a-z]/i", "", $keyword);
        $keyword               = array_flip(array_flip(str_split(strtoupper($keyword))));
        $keyword               = implode($keyword);
        $newAlphabet           = $keyword . implode($this->alphabetIndexes);
        $this->alphabetIndexes = array_keys(array_flip(str_split($newAlphabet)));
        $this->plainAlphabet   = array_flip($this->alphabetIndexes);
    }

    private function caesarDecipher($input, $shiftAmount) {
        $output = $input;
        if (is_numeric($shiftAmount) && $shiftAmount != 0) {
            $plainAlphabetOrig     = $this->plainAlphabet;
            $alphabetIndexesOrig   = $this->alphabetIndexes;
            $this->plainAlphabet   = array_flip($this->plainAlphabet);
            $this->plainAlphabet   = $this->alphabetIndexes = array_reverse($this->plainAlphabet);
            $this->plainAlphabet   = array_flip($this->plainAlphabet);
            $shiftAmount           = abs($shiftAmount);
            $output                = $this->caesarEncipher($input, $shiftAmount);
            $this->plainAlphabet   = $plainAlphabetOrig;
            $this->alphabetIndexes = $alphabetIndexesOrig;
        }
        return $output;
    }

    private function aes256SaltDecrypt($encryptedValue, $salt, $key) {
        $output = $encryptedValue;
        $method = "AES-256-CBC";

        $iv     = substr(hash('sha256', $key), 0, 16);
        $output = openssl_decrypt($encryptedValue, $method, $salt, 0, $iv);
        return $output ?: $encryptedValue;
    }

    private function caesarKeyDecipher($input, $shiftAmount, $keyword) {
        $this->changeAlphabet($keyword);
        return $this->caesarDecipher($input, $shiftAmount);
    }

    public function hashCalc() {
        $this->page         = 'encrypt/hashCalc';
        $this->pageColWidth = 'col-10';
        if (isset($_POST['plainValue'])) {
            $this->hashResult['sha5125k']  = $this->hashGen($_POST['plainValue'], 'sha5125k');
            $this->hashResult['md5_hmac']  = $this->hashGen($_POST['plainValue'], 'md5_hmac');
            $this->hashResult['whirlpool'] = $this->hashGen($_POST['plainValue'], 'whirlpool');
        }
        if (isset($_POST['hashToCompare'])) {
            $this->compareResult['sha5125k']  = $this->hashCompare($this->hashResult['sha5125k'], $_POST['hashToCompare']) == true ? 'Igual' : 'Diferente';
            $this->compareResult['md5_hmac']  = $this->hashCompare($this->hashResult['md5_hmac'], $_POST['hashToCompare']) == true ? 'Igual' : 'Diferente';
            $this->compareResult['whirlpool'] = $this->hashCompare($this->hashResult['whirlpool'], $_POST['hashToCompare']) == true ? 'Igual' : 'Diferente';
        }
    }

    private function hashCompare($baseHash, $hashCompare) {
        $return = false;
        if (hash_equals($baseHash, $hashCompare)) {
            $return = true;
        }
        return $return;
    }

}
