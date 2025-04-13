<?php

namespace App\Services;

class PasswordGeneratorService
{
   /**
     * Génère un mot de passe aléatoire.
     *
     * @param int $length Longueur du mot de passe
     * @return string Mot de passe généré
     */
    public function passwordGenerator(int $length): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*()-_';

        $randomPassword = substr(str_shuffle($characters), 0, $length);

        return $randomPassword;
    }
}
