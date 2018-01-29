<?php

namespace Newfinder\Modules\Cli\Tasks;

use Newfinder\Helpers\GeoHelper;
use Newfinder\Helpers\StrHelper;

class TestTask extends BaseTask
{
   
    public function insertEnvObjectsAction()
    {
        $this->db->execute('SET NAMES utf8;');
        $sql = 'SELECT id, school, clinics, kindergartens, grocery_stores, cafe FROM housing_complex_newf';
        $param = $this->db->fetchAll($sql);
        foreach ($param as &$row) {
            array_walk($row, function (&$value, $key) {
                if ($key != 'id') {
                    $value = array_chunk(preg_split('/[;|]+/', trim($value, ';')), 2);
                }
            });
            $array_env_obj[] = $row;
        }

        foreach ($array_env_obj as $type => &$array_param) {
            $housing_complex_id = $this->db->fetchOne("SELECT id FROM housing_complex WHERE newf_id = '" . $array_param['id'] . "'");
            if (is_null($housing_complex_id['id'])) {
                $this->warn("Housing complex with newf_id: " . $array_param['id'] . " is not found in the table housing_complex");
            }
            foreach ($array_param as $key => &$param) {
                switch ($key) {
                    case 'school':
                        $env_type_id = 1;
                        break;
                    case 'kindergartens':
                        $env_type_id = 2;
                        break;
                    case 'clinics':
                        $env_type_id = 3;
                        break;
                    case 'grocery_stores':
                        $env_type_id = 4;
                        break;
                    case 'cafe':
                        $env_type_id = 5;
                        break;
                }
                if (is_array($param)) {
                    foreach ($param as &$val) {
                        if (isset($val[1]) && isset($val[0])) {
                            $geo = explode(" ", trim($val[0]));
                            $envObjToInsert = [
                                'env_type_id' => $env_type_id,
                                'name' => $val[1],
                                'latitude' => $geo[1],
                                'longitude' => $geo[0]
                            ];

                            $env_objects_id = $this->db->fetchOne("SELECT id FROM env_objects WHERE env_type_id = :env_type_id AND name = :name AND latitude = :latitude AND longitude = :longitude", \PDO::FETCH_ASSOC, $envObjToInsert);
                            if (is_null($env_objects_id['id'])) {
                                $names = implode(',', array_keys($envObjToInsert));
                                $qs = implode(',', array_pad([], count($envObjToInsert), '?'));
                                $result_query = $this->db->execute(sprintf("INSERT INTO env_objects (%s) VALUES (%s)", $names, $qs), array_values($envObjToInsert));
                                if ($result_query) {
                                    $this->success("Entry added");
                                    if (!is_null($housing_complex_id['id'])) {
                                        $env_objects_id = $this->db->lastInsertId();
                                        $this->db->execute("INSERT INTO env_objects_housing_complex (env_objects_id, housing_complex_id) VALUES ($env_objects_id, " . $housing_complex_id['id'] . ");");
                                    }
                                } else {
                                    $this->error("Entry not added");
                                }
                            } else {
                                $env_objects_housing_complex_id = $this->db->fetchOne("SELECT id FROM env_objects_housing_complex WHERE env_objects_id = :env_objects_id AND housing_complex_id = :housing_complex_id", \PDO::FETCH_ASSOC, ['env_objects_id' => $env_objects_id['id'], 'housing_complex_id' => $housing_complex_id['id']]);
                                if (is_null($env_objects_housing_complex_id['id']) && !is_null($housing_complex_id['id'])) {
                                    $result_query = $this->db->execute("INSERT INTO env_objects_housing_complex (env_objects_id, housing_complex_id) VALUES (" . $env_objects_id['id'] . ", " . $housing_complex_id['id'] . ");");
                                    if ($result_query) {
                                        $this->success("Сonnection successfully created");
                                    } else {
                                        $this->error("Сonnection is not created");
                                    }
                                };
                            }
                        }
                    }
                }
            }
        }
    }

    public function updateMetroSlugAction()
    {
        $metroDic = $this->db->fetchAll("SELECT id, old_slug FROM geo_metro WHERE old_slug IS NOT NULL");
        foreach ($metroDic as $row) {
            $this->db->execute(sprintf("UPDATE geo_metro SET slug='%s' WHERE id=%d", "metro-" . $row["old_slug"], $row["id"]));
        }
    }

    public function updateDistrictSlugAction()
    {
        $strHelper = new StrHelper();
        $dic = $this->db->fetchAll("SELECT id, name FROM geo_district WHERE region_id IN (50,77,90)");
        foreach ($dic as $row) {
            $this->db->execute(sprintf("UPDATE geo_district SET slug='%s' WHERE id=%d", $strHelper->makeUrl($row['name']), $row["id"]));
        }
    }

    public function createGeoAreaSlugAction()
    {
        $this->db->execute('SET NAMES utf8;');
        $helper = new StrHelper();
        $rows = $this->db->fetchAll("SELECT id, name FROM geo_area WHERE region_id IN (50,77,90)");
        foreach ($rows as $row) {
            $slug = $helper->makeUrl($row['name']);
            $id = $row['id'];
            $this->db->execute(sprintf("UPDATE geo_area SET slug='%s' WHERE id=%d", $slug, $id));
        }
    }

    public function updateDescriptionHousingComplexAction()
    {
        $connection_old =
            [
                "host" => "*",
                "username" => "*",
                "password" => "*",
                "dbname" => "*"
            ];

        $old_db = clone $this;
        $old_db->db = clone $this->db;

        try {
            $old_db->db->connect($connection_old);
            $this->success("Connected successfully");
            $sql = 'SELECT f_t1 AS slug, f_description AS description, f_name AS name from t_nfb_housing_complex';
            $param = $old_db->db->fetchAll($sql);
            $old_db->db->close();
            unset($old_db);
            foreach ($param as &$row) {
                $this->log("Обработка таблицы housing_complex..");
                $housing_complex_id = $this->db->fetchColumn(sprintf("SELECT id FROM housing_complex WHERE slug = '%s'", str_replace('zhk-', '', $row['slug'])));
                if (!empty($housing_complex_id)){
                     $this->log("Добавление описания для ЖК id:".$housing_complex_id);
                     $result_query = $this->db->execute(sprintf("UPDATE housing_complex SET note='%s' WHERE id=%d", base64_decode($row['description']), $housing_complex_id));
                     if ($result_query) {
                        $this->success("Запись обновлена");
                     } else {
                        $this->error("Не удалось обновить запись id:".$housing_complex_id);
                     }
                }else{
                    $this->log("Ищу ".base64_decode($row['name']));
	                $housing_complex_id = $this->db->fetchColumn(sprintf("SELECT id FROM housing_complex WHERE name = '%s'", base64_decode($row['name'])));
	                if (!empty($housing_complex_id)){
	                    $this->log("Найден ЖК id:".$housing_complex_id);
	                    $result_query = $this->db->execute(sprintf("UPDATE housing_complex SET note='%s' WHERE id=%d", base64_decode($row['description']), $housing_complex_id));
                         if ($result_query) {
                            $this->success("Запись обновлена");
                         } else {
                            $this->error("Не удалось обновить запись id:".$housing_complex_id);
                         }
	                }else{
	                    $this->warn("Не найден ".base64_decode($row['name']));
                            echo "\n1 - Ввести ID\n2 - Продолжить\nВаш выбор: ";
                            $in = trim(readline());
                            if (is_numeric($in)) {
                                $choice = (int)$in;
                                if ($choice == 1) {
                                     echo "\nВведите ID\n0 - Отменить\nВаш выбор: ";
                                     $in_id = trim(readline());
                                     if (is_numeric($in_id)) {
                                         $id = (int)$in_id;
                                         if ($id == 0) {
                                            $this->log("Операция отменена");
                                         }else{
                                            $result_query = $this->db->execute(sprintf("UPDATE housing_complex SET note='%s' WHERE id=%d", base64_decode($row['description']), $id));
                                             if ($result_query) {
                                                $this->success("Запись обновлена");
                                             } else {
                                                $this->error("Не удалось обновить запись id:".$id);
                                             }
                                         }
                                      }
                                } elseif ($choice == 2) {
                                    continue;
                                }
                            }

                        }
	                
	            }
            }

        } catch (PDOException $e) {
            $this->error("Connection failed: " . $e->getMessage());
        }
    }

    public function updateRubricsSlugAction()
    {
        $strHelper = new StrHelper();
        $result = $this->db->fetchAll("SELECT id, name FROM rubriks");
        foreach ($result as $row) {
            $this->db->execute(sprintf("UPDATE rubriks SET slug='%s' WHERE id=%d", $strHelper->makeUrl($row['name']), $row["id"]));
        }
    }
}
