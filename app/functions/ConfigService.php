<?php

namespace App\Functions;

class ConfigService{
  
  public static function getServicesList()
  {
    $sql =
    "SELECT
      wan_services.id AS `id`,
      wan_services.service_code AS `code`,
      wan_services.service_name AS `name`,
      wan_services.service_description AS `desc`,
      wan_services.service_status AS `status` 
    FROM
      `soutenance_lic`.`wan_services`
    WHERE 1 = 1 ";
    return $sql;
  }

  public static function getUsersList()
  {
    $req =
    'SELECT
      `user`.id,
      `user`.matricule,
      `user`.first_name,
      `user`.last_name,
      `user`.date_of_birth,
      `user`.phone_number,
      `user`.numero_cni,
      `user`.username,
      `user`.address,
      `user`.ville,
      `user`.country,
      `user`.sexe,
      `user`.slug,
      `user`.email,
      `user`.account_status,
      role.role_name,
      pos.pos_name,
      `user`.role_id, 
      `user`.position_id, 
      `user`.avatar, 
      `user`.slug, 
      `user`.created_at
    FROM
      wan_users AS `user`
      LEFT JOIN wan_positions AS pos ON `user`.position_id = pos.id
      INNER JOIN wan_roles AS role ON `user`.role_id = role.id
    WHERE 1=1 ';
    return $req;
  }

}