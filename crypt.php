<?php

class cryptData
{
    private $password;
    private $salt;
    private $hash;
    private $methode;
    private $hashAlgo;
    private $pseudoBytes;
    private $multiplyer;

    public function __construct($password)
    {

        $this->password = $password;
        $this->hash = '$2y$10$0x7jLuGlub3qo3/MEWwHt.2EyMlAWAOCd.XhX9b8KuULqPZmKuDZW';
        $this->hashAlgo = PASSWORD_BCRYPT;
        $this->pseudoBytes = "æÍ÷‚‡ã¢";
        $this->salt = "044f4d75f5059369cda255227c84d7a0ad214e807d9f8ecdd6e95a92cd756877";
        $this->methode = 'AES256';
        $this->multiplyer = 4;
        if (!password_verify($this->password, $this->hash)) {
            exit("Wrong pass");
        }
    }

    public function generateUserData()
    {
        return password_hash($this->password, $this->hashAlgo);
    }

    public function encryptData($data)
    {
        for ($count = 0; $count < $this->multiplyer; $count++) {
            $data = openssl_encrypt($data, $this->methode, $this->password . $this->salt, false, $this->pseudoBytes);
        }
        return $data;
    }

    public function decryptData($data)
    {
        for ($count = 0; $count < $this->multiplyer; $count++) {
            $data = openssl_decrypt($data, $this->methode, $this->password . $this->salt, false, $this->pseudoBytes);
        }
        return $data;
    }
}

$crypto = new cryptData("pass");
echo $crypto->encryptData("a");
echo "\n";
echo $crypto->decryptData("QWiMyvLq8cMxIuNHJjDTy/lYUBgYnE7G9RVAGv86krxBNCflzwqShOpCLaRLMP1dmvm1dshjP5sK0TeqT3MS49pc8ja2ZMbT1DKC2xPk0mY=");
echo "\n";
