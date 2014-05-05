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
                $rankStr = "Advanced";
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

    public static function sign_in($email, $pass) {
        global $database;

        if($database->has('accounts', ['email' => $email])) {
            $userPass = $database->get('accounts', 'password', ['email' => $email]);
            if(hash('sha256', $pass) === $userPass) {
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                echo 'success';
            } else {
                echo 'password';
            }
        } else {

        }
    }

    public static function logged_in() {
        if($_SESSION['loggedin']) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public static function add_tournament($name, $date, $loc) {
        global $database;
        $database->insert('tournaments', [
                    'name' => $name,
                    'date' => $date,
                    'location' => $loc,
                    'register' => '[]',
                    'attend'   => '[]']);
        echo get_tournaments();
    }

    public static function add_user($email, $pass, $name, $num, $if_text, $carrier, $id) {
        global $database;
        if(!$database->has('accounts', ['email' => $email])) {
            if(!$database->has('accounts', ['number' => $num])) {
                // PHP dark magic won't let me have three $database->has()
                // I'm so sorry
                if(!in_array($id, $database->select('accounts', 'student-id'))) {
                    $database->insert('accounts', [
                            'email'         => $email,
                            'password'      => hash('sha256', $pass),
                            'first'         => explode(' ', $name)[0],
                            'last'          => explode(' ', $name)[1],
                            'number'        => $num,
                            'recieve-texts' => $if_text,
                            'carrier'       => $carrier,
                            'student-id'    => $id
                        ]);
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;
                    echo '0';
                } else {
                    echo '-3';
                }
            } else {
                echo '-2';
            }
        } else {
            echo '-1';
        }
    }
}
?>