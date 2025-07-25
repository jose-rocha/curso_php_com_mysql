<?php

namespace public\utils\class;

class AuthLogout
{
    public function logoutUser($data): array {
        foreach($data as $sessionData) {
            if (isset($_SESSION[$sessionData])) {
                unset($_SESSION[$sessionData]);
            }
        }
        
        session_destroy();
        return [...$data];
    }
}