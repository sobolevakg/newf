<?php

namespace Newfinder\Modules\Cli\Tasks;

class SellerTask extends BaseTask
{
    public function insertSellerAction()
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
            $sql = 'SELECT t_nfb_housing_complex.f_t1 AS slug_hc, t_nfb_builders.f_t1 AS slug_developers FROM t_seller 
			LEFT JOIN t_nfb_housing_complex ON t_nfb_housing_complex.f_id = t_seller.f_id_zk
			LEFT JOIN t_nfb_builders ON t_nfb_builders.f_id = t_seller.f_id_zastr';
            $param = $old_db->db->fetchAll($sql);
            $old_db->db->close();
            unset($old_db);
            foreach ($param as &$row) {
	       $developers_id = $this->db->fetchColumn(sprintf("SELECT id FROM developers WHERE slug = '%s'", $row['slug_developers']));
               $housing_complex_id = $this->db->fetchColumn(sprintf("SELECT id FROM housing_complex WHERE slug = '%s'", str_replace('zhk-', '', $row['slug_hc'])));
               if (!empty($developers_id) && !empty($housing_complex_id)){

                       $arrayToInsert = [
                            'developer_id' => $developers_id,
                            'housing_complex_id' => $housing_complex_id
                        ];

                       $seller_id = $this->db->fetchOne("SELECT id FROM seller WHERE developer_id = :developer_id AND housing_complex_id = :housing_complex_id", \PDO::FETCH_ASSOC, $arrayToInsert);
                       if (is_null($seller_id['id'])) {
                               $names = implode(',', array_keys($arrayToInsert));
                               $qs = implode(',', array_pad([], count($arrayToInsert), '?'));
                               $result_query = $this->db->execute(sprintf("INSERT INTO seller (%s) VALUES (%s)", $names, $qs), array_values($arrayToInsert));
                               if ($result_query) {
                                    $this->success("Entry added");
                               } else {
                                    $this->error("Entry not added");
                               }
                     }
               }
            }

        } catch (PDOException $e) {
            $this->error("Connection failed: " . $e->getMessage());
        }
    }


}
