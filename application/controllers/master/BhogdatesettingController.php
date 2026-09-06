<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BhogdatesettingController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url', 'security'));
        $this->load->library(array('form_validation', 'session', 'user_agent'));

        $this->load->model('master/BhogdatesetModel', 'dsetmod');
        $this->load->model('master/Admin_model', 'admod');

        $this->load->database();
    }

    public function manage_datesetting()
    {
        $arr['siteTitle'] = 'Manage Date Seeting';

        $masterId = $this->session->userdata('masterId');

        if (empty($masterId)) {
            redirect('master/login');
        }

        $adminrow = $this->admod->getAdminProfile($masterId);
        $temple_id = $adminrow->ad_temple;

        $arr['datesetdata'] = $this->dsetmod->getAllDateSetting($temple_id);

        $this->load->view(
            "master/master-bhogdateset-manage",
            $arr
        );
    }

    public function remove_datesetting($enc_dset_id)
    {
        $masterId = $this->session->userdata('masterId');

        if (empty($masterId)) {
            redirect('master/login');
        }

        $adminrow = $this->admod->getAdminProfile($masterId);
        $temple_id = $adminrow->ad_temple;

        $dset_id = $this->encryptcode->decrypt(
            $enc_dset_id,
            ENC_KEY_PASS
        );

        $dsetrow = $this->dsetmod->getPerDateSetting($dset_id);

        $dset_templeid = $dsetrow->dset_templeid;

        if ($dset_templeid == $temple_id) {

            $delrecord = $this->dsetmod->delPerDateSetting($dset_id);

            if ($delrecord) {

                $this->session->set_flashdata(
                    'feedback',
                    "Date removed successfully."
                );

                $this->session->set_flashdata(
                    'feedbackerr',
                    "alert-success"
                );

                redirect('master/bhog-datemgmt/manage');
            }

        } else {

            redirect('master/bhog-datemgmt/manage');
        }
    }

    public function add_datesetting()
    {
        $arr['siteTitle'] = 'Add Bhog Date Setting';

        $masterId = $this->session->userdata('masterId');

        if (empty($masterId)) {
            redirect('master/login');
        }

        $adminrow = $this->admod->getAdminProfile($masterId);
        $temple_id = $adminrow->ad_temple;

        $arr['templedata'] = $this->admod->getPerTemple($temple_id);

        $this->form_validation->set_error_delimiters(
            '<span class="error1">',
            '</span>'
        );

        $this->form_validation->set_rules(
            'dset_date',
            'Date',
            'trim|required|xss_clean|is_unique[tb_datesetting.dset_date]'
        );

        if ($this->form_validation->run() == true) {

            $data = $this->input->post();

            unset($data['submit_page']);

            $dset_date = $data['dset_date'];

            $data['dset_date'] = date(
                'Y-m-d',
                strtotime($dset_date)
            );

            $data['dset_templeid'] = $temple_id;
            
            if ($this->dsetmod->addDateSetting($data)) {

                $this->session->set_flashdata(
                    'feedback',
                    "Date Setting added successfully."
                );

                $this->session->set_flashdata(
                    'feedbackerr',
                    "alert-success"
                );

                redirect("master/bhog-datemgmt/manage");

            } else {

                $this->session->set_flashdata(
                    'feedback',
                    "Something wrong please try again."
                );

                $this->session->set_flashdata(
                    'feedbackerr',
                    "alert-danger"
                );

                redirect("master/bhog-datemgmt/manage");
            }

        } else {

            $this->load->view(
                'master/master-bhogdateset-add',
                $arr
            );
        }
    }
}