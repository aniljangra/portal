<?php

class BhogdatesetModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllDateSetting($temple_id)
    {
        $this->db->from('tb_bhogdatesetting');
        $this->db->where("dset_templeid", $temple_id);
        $this->db->order_by("dset_date", "desc");
        $this->db->join(
            'tb_temple',
            'tb_temple.temple_id=tb_bhogdatesetting.dset_templeid',
            'left'
        );

        $query = $this->db->get();

        return $query->result();
    }

    public function getPerDateSetting($dset_id)
    {
        $this->db->from('tb_bhogdatesetting');
        $this->db->where("dset_id", $dset_id);
        $this->db->join(
            'tb_temple',
            'tb_temple.temple_id=tb_bhogdatesetting.dset_templeid',
            'left'
        );

        $query = $this->db->get();

        return $query->row();
    }

    public function delPerDateSetting($dset_id)
    {
        $this->db->where('dset_id', $dset_id);

        $query = $this->db->delete('tb_bhogdatesetting');

        return $query;
    }

    public function addDateSetting($data)
    {
        $dataInsert = array(
            'dset_date'     => $data['dset_date'],
            'dset_templeid' => $data['dset_templeid']
        );

        

        return $this->db->insert(
            'tb_bhogdatesetting',
            $dataInsert
        );
    }
}

?>