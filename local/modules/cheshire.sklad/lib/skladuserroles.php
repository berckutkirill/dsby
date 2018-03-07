<?php

namespace Cheshire\Sklad;

class SkladUserRoles {

    //const SUPERUSER = 'admin';
    const MANAGER = 'manager';
    const ADMIN = 'admin';
    const MOGILEV = 'mogilev';
    const SKLAD = 'sklad';
    
    static function getHaystack() {
        return [
            // self::SUPERUSER => 1,
            self::MANAGER => 8,
            self::ADMIN => 9,
            self::MOGILEV => 10,
            self::SKLAD => 11,
        ];
    }
    static function getRoleId($role) {
        $haystack = self::getHaystack();
        return $haystack[$role];
    }
    static function getRole($id) {
        $haystack = self::getHaystack();
        $ROLES = \Bitrix\Main\UserTable::getUserGroupIds($id);
        

        foreach ($ROLES as $roleId) {
            
            if ($role = array_search($roleId, $haystack)) {
                return $role;
            }
        }
        return false;
    }

    static function getRights($component, $USER) {
        $ROLE = self::getRole($USER->getId());
        $RIGHTS = [];
        if ($component == 'sklad:documents') {
            if ($ROLE == self::MANAGER) {
                $RIGHTS = ['ADD' => ['D' => 1], 'READ' => ['D' => 1]];
            } elseif ($ROLE == self::ADMIN) {
                $RIGHTS = [
                    'WATCH_ALL' => ['D' => 1],
                    'ADD' => ['D' => 1],
                    'READ' => ['D' => 1],
                    'UPDATE' => ['D' => 1],
                ];
            } elseif ($ROLE == self::MOGILEV) {
                $RIGHTS = [
                    'WATCH_ALL' => ['A' => 1, 'D' => 1],
                    'ADD' => ['A' => 1],
                    'READ' => ['A' => 1, 'D' => 1],
                    'UPDATE' => ['A' => 1],
                ];
            } elseif ($ROLE == self::SKLAD) {
                $RIGHTS = [
                    'WATCH_ALL' => ['A' => 1, 'D' => 1],
                    'READ' => ['A' => 1, 'D' => 1],
                    'UPDATE' => ['A' => 1, 'D' => 1]
                ];
            }
        } 

        return $RIGHTS;
    }

}
