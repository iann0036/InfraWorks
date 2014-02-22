<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_users extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database('default');
        $this->load->library('session');
    }

    public function count() {
        return count($this->getUsers());
    }

    public function auth($username,$password) {
        if (!$this->_doAuth($username,$password))
            return false;

        $user = $this->getUser($username);
        if (!isset($user['admin']))
            return false;
        if ($user['admin']!=1)
            return false;

        $this->session->set_userdata(array(
            'name' => $user['name'],
            'username' => $username
        ));

        return true;
    }

    private function _doAuth($user,$pass) {
        $ldapserver = 'ldap.testathon.net';
        $ldappass     = $pass;
        $ldaptree    = "CN=".$user.",OU=users,DC=testathon,DC=net";

        $ldapconn = ldap_connect($ldapserver) or die("Could not connect to LDAP server.");
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

        if($ldapconn) {
            // binding to ldap server
            $ldapbind = @ldap_bind($ldapconn, $ldaptree, $ldappass);
            // verify binding
            if ($ldapbind) {
                ldap_close($ldapconn);

                return true;
            } else
                return false;
        } else
            return false;
    }

    public function getUserType($username) {
        $users = $this->getUsers();
        foreach ($users as $user) {
            if ($user['username']==$username)
                return $user['link'];
        }

        return null;
    }

    public function addUserToDatabase($username) {
        $users = $this->getUsers();
        foreach ($users as $user) {
            if ($user['username']==$username) {
                $insert_data = array(
                    'username' => $username,
                    'email' => $user['email'],
                    'name' => $user['name']
                );
                $this->db->insert('users',$insert_data);
            }
        }
    }

    public function getNameByUsername($username) {
        $users = $this->getUsers();
        foreach ($users as $user) {
            if ($user['username']==$username)
                return $user['name'];
        }

        return null;
    }

    public function getUser($username) {
        $users = $this->getUsers();
        foreach ($users as $user) {
            if ($user['username']==$username)
                return $user;
        }

        return null;
    }

    public function getUsers() {
        $database_users = array();
        $ldap_users = $this->getLDAPUsers();

        $result = $this->db->get('users');

        foreach ($result->result_array() as $user) {
            $database_users[] = $user;
        }

        $users = $this->userMerge($database_users,$ldap_users);

        return $users;
    }

    private function userMerge($database_users,$ldap_users) {
        $skip_user = false;
        $users = array();

        foreach ($ldap_users as $ldap_user) {
            foreach ($database_users as $database_user) {
                if ($ldap_user['username']==$database_user['username']) {
                    $ldap_user['link'] = 'both';
                    $ldap_user['admin'] = $database_user['admin'];
                    break;
                }
                $ldap_user['link'] = 'ldap';
            }
            $users[] = $ldap_user;
        }

        foreach ($database_users as $database_user) {
            foreach ($users as $user) {
                $skip_user = false;
                if ($user['username']==$database_user['username']) {
                    $skip_user = true;
                    break;
                }
            }
            if (!$skip_user) {
                $database_user['link'] = 'database';
                $users[] = $database_user;
            }
        }

        return $users;
    }

    public function getLDAPUsers() {
        $users = array();

        $ldapserver = 'ldap.testathon.net';
        $ldapuser      = 'stuart';
        $ldappass     = 'stuart';
        $ldaptree    = "OU=users,DC=testathon,DC=net";

        $ldapconn = ldap_connect($ldapserver) or die("Could not connect to LDAP server.");
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

        if($ldapconn) {
            // binding to ldap server
            //$ldapbind = ldap_bind($ldapconn, $ldapuser, $ldappass) or die ("Error trying to bind: ".ldap_error($ldapconn));
            $ldapbind = ldap_bind($ldapconn) or die ("Error trying to bind: ".ldap_error($ldapconn));
            // verify binding
            if ($ldapbind) {
                $result = ldap_search($ldapconn,$ldaptree, "(cn=*)") or die ("Error in search query: ".ldap_error($ldapconn));
                $data = ldap_get_entries($ldapconn, $result);
                // iterate over array and print data for each entry
                for ($i=0; $i<$data["count"]; $i++) {
                    $user = array(
                        'username' => $data[$i]["cn"][0]
                    );
                    if (isset($data[$i]["mail"][0])) {
                        $user['email'] = $data[$i]["mail"][0];
                    } else {
                        $user['email'] = null;
                    }
                    if (isset($data[$i]["displayName"][0])) {
                        $user['name'] = $data[$i]["displayName"][0];
                    } else {
                        $user['name'] = 'No Name';
                    }
                    $users[] = $user;
                }

                ldap_close($ldapconn);

                return $users;
            } else
                return null;
        } else
            return null;
    }
}