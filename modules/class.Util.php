<?php
class Util {
    public static function getUser($email) {
        global $database;
        return $database->get('accounts', '*', ['email' => $email]);
    }

    public static function editUser($email, $field, $new) {
        global $database;
        $database->update('accounts', [$field => $new], ['email' => $email]);
    }

    public static function formatPhoneNum($num) {
        return "(" . substr($num, 0, 3) . ") " . substr($num, 3, 3) . "-" . substr($num, 6, 4);
    }

    public static function getRank($rankNum) {
        $rankStr;
        switch ($rankNum) {
            case 0:
                $rankStr = "Novice";
                break;
            case 1:
                $rankStr = "Varsity";
                break;
            case 2:
                $rankStr = "Site Administrator";
                break;
            case 3:
                $rankStr = "Coach";
                break;
            default:
                $rankStr = "N/A";
                break;
        }
        return $rankStr;
    }
}
?>