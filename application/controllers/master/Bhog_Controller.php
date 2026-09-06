<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bhog_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url', 'security', 'string'));
        $this->load->library(array('form_validation', 'session', 'user_agent'));

        $this->load->model('master/Bhog_model', 'bhogmod');
        $this->load->model('master/admin_model', 'admod');

        $this->load->database();
    }

    public function manage_bhog_booking()
    {
        $arr['siteTitle'] = 'Manage Bhog Booking';

        $masterId = $this->session->userdata('masterId');

        if (empty($masterId)) {
            redirect('master/login');
        }

        $arr['admdata'] = $this->admod->getAdminProfile($masterId);
        $temple_id = $arr['admdata']->ad_temple;

        $arr['bhogdata'] = $this->bhogmod->getAllBookingBhog($temple_id);

        $this->load->view(
            "master/master-bhog-booking-manage",
            $arr
        );
    }

    public function view_bhogbooking($enc_bb_id)
    {
        $arr['siteTitle'] = 'View Bhog';

        $masterId = $this->session->userdata('masterId');

        if (empty($masterId)) {
            redirect('master/login');
        }

        $bb_id = $this->encryptcode->decrypt(
            $enc_bb_id,
            ENC_KEY_PASS
        );

        $arr['bhogrow'] = $this->bhogmod->getPerBhogBooking($bb_id);

        $this->load->view(
            "master/master-bhog-booking-view",
            $arr
        );
    }

    public function manage_bhog_success()
    {
        $arr['siteTitle'] = 'Manage Bhog Booking';

        $masterId = $this->session->userdata('masterId');

        if (empty($masterId)) {
            redirect('master/login');
        }

        $arr['bhogdata'] = $this->bhogmod->getAllBhogBookingSuccess();

        $this->load->view(
            "master/master-manage-bhog-success",
            $arr
        );
    }

    public function search_bhog()
    {
        $arr['siteTitle'] = 'Search Bhog';

        $masterId = $this->session->userdata('masterId');

        if (empty($masterId)) {
            redirect('master/login');
        }

        $adminrow = $this->admod->getAdminProfile($masterId);

        $this->form_validation->set_error_delimiters(
            '<span class="error1">',
            '</span>'
        );

        $this->form_validation->set_rules(
            'from_date',
            'From Date',
            'trim|required|xss_clean'
        );

        $this->form_validation->set_rules(
            'to_date',
            'To Date',
            'trim|required|xss_clean'
        );

        if ($this->form_validation->run() == true) {

            $data = $this->input->post();

            unset($data['submit_page']);

            $from_date = $data['from_date'];
            $to_date = $data['to_date'];

            if ($from_date != "") {
                $from_date = date(
                    'Y-m-d',
                    strtotime($from_date)
                );
            }

            if ($to_date != "") {
                $to_date = date(
                    'Y-m-d',
                    strtotime($to_date)
                );
            }

            $search_date = $from_date . "|" . $to_date;

            $enc_search_date = $this->encryptcode->encrypt(
                $search_date,
                ENC_KEY_PASS
            );

            redirect(
                "master/bhog-booking/searchlist/$enc_search_date"
            );

        } else {

            $this->load->view(
                'master/master-bhog-search',
                $arr
            );
        }
    }

    public function search_bhoglist($enc_dates)
    {
        $arr['siteTitle'] = 'Search Bhog';

        $masterId = $this->session->userdata('masterId');

        if (empty($masterId)) {
            redirect('master/login');
        }

        $adminrow = $this->admod->getAdminProfile($masterId);

        $ad_temple = $adminrow->ad_temple;

        $this->form_validation->set_error_delimiters(
            '<span class="error1">',
            '</span>'
        );

        $this->form_validation->set_rules(
            'from_date',
            'From Date',
            'trim|required|xss_clean'
        );

        $this->form_validation->set_rules(
            'to_date',
            'To Date',
            'trim|required|xss_clean'
        );

        $datedata = $this->encryptcode->decrypt(
            $enc_dates,
            ENC_KEY_PASS
        );

        $date_ar = explode("|", $datedata);

        $from_date = $date_ar[0];
        $to_date = $date_ar[1];

        $arr['bhogdata'] = $this->bhogmod->getAllBhogBookingSearch(
            $ad_temple,
            $from_date,
            $to_date
        );

        /*
         * Export CSV
         */
        if (isset($_POST['submit_export'])) {

            $this->form_validation->set_error_delimiters(
                '<span class="error1">',
                '</span>'
            );

            $this->form_validation->set_rules(
                'exportfield',
                'Export Form',
                'trim|required'
            );

            $data = $this->input->post();

            $bbid = isset($data['bbid']) ? $data['bbid'] : array();

            if (!empty($bbid)) {

                $datatoexcel = array();

                if (count($bbid) > 0) {

                    $sr = 1;

                    foreach ($bbid as $bb_id) {

                        $bbdata = $this->bhogmod->getPerBhogBooking($bb_id);

                        /*
                         * These fields assume your Bhog table uses
                         * the same structure as the Chola table.
                         * Change them if your Bhog fields are different.
                         */

                        $temple_name = $bbdata->temple_name;
                        $bb_orderno = $bbdata->bb_orderno;
                        $bb_bookfordate = $bbdata->bb_bookfordate;
                        $bb_name = $bbdata->bb_name;
                        $bb_mobile = $bbdata->bb_mobile;
                        $bb_amount = $bbdata->bb_amount;
                        $bb_transstatus = $bbdata->bb_transstatus;
                        $bb_bankrefno = $bbdata->bb_bankrefno;
                        $bb_aadhar = $bbdata->bb_aadhar;

                        $bb_devotee_name1 = $bbdata->bb_devotee_name1;
                        $bb_devotee_mobile1 = $bbdata->bb_devotee_mobile1;
                        $bb_devotee_aadhar1 = $bbdata->bb_devotee_aadhar1;

                        $bb_devotee_name2 = $bbdata->bb_devotee_name2;
                        $bb_devotee_mobile2 = $bbdata->bb_devotee_mobile2;
                        $bb_devotee_aadhar2 = $bbdata->bb_devotee_aadhar2;

                        $bb_devotee_name3 = $bbdata->bb_devotee_name3;
                        $bb_devotee_mobile3 = $bbdata->bb_devotee_mobile3;
                        $bb_devotee_aadhar3 = $bbdata->bb_devotee_aadhar3;

                        $bb_devotee_name4 = $bbdata->bb_devotee_name4;
                        $bb_devotee_mobile4 = $bbdata->bb_devotee_mobile4;
                        $bb_devotee_aadhar4 = $bbdata->bb_devotee_aadhar4;

                        $bb_devotee_name5 = $bbdata->bb_devotee_name5;
                        $bb_devotee_mobile5 = $bbdata->bb_devotee_mobile5;
                        $bb_devotee_aadhar5 = $bbdata->bb_devotee_aadhar5;

                        $bb_proof = $bbdata->bb_proof;

                        $proof_final = base_url() . $bb_proof;

                        $bb_subdatetime = $bbdata->bb_subdatetime;

                        $datatoexcel[$bb_id]['sr_no'] = $sr;
                        $datatoexcel[$bb_id]['bb_orderno'] = $bb_orderno;
                        $datatoexcel[$bb_id]['temple_name'] = $temple_name;
                        $datatoexcel[$bb_id]['bb_bookfordate'] = $bb_bookfordate;
                        $datatoexcel[$bb_id]['bb_name'] = $bb_name;
                        $datatoexcel[$bb_id]['bb_mobile'] = $bb_mobile;
                        $datatoexcel[$bb_id]['bb_aadhar'] = $bb_aadhar;

                        $datatoexcel[$bb_id]['bb_devotee_name1'] = $bb_devotee_name1;
                        $datatoexcel[$bb_id]['bb_devotee_mobile1'] = $bb_devotee_mobile1;
                        $datatoexcel[$bb_id]['bb_devotee_aadhar1'] = $bb_devotee_aadhar1;

                        $datatoexcel[$bb_id]['bb_devotee_name2'] = $bb_devotee_name2;
                        $datatoexcel[$bb_id]['bb_devotee_mobile2'] = $bb_devotee_mobile2;
                        $datatoexcel[$bb_id]['bb_devotee_aadhar2'] = $bb_devotee_aadhar2;

                        $datatoexcel[$bb_id]['bb_devotee_name3'] = $bb_devotee_name3;
                        $datatoexcel[$bb_id]['bb_devotee_mobile3'] = $bb_devotee_mobile3;
                        $datatoexcel[$bb_id]['bb_devotee_aadhar3'] = $bb_devotee_aadhar3;

                        $datatoexcel[$bb_id]['bb_devotee_name4'] = $bb_devotee_name4;
                        $datatoexcel[$bb_id]['bb_devotee_mobile4'] = $bb_devotee_mobile4;
                        $datatoexcel[$bb_id]['bb_devotee_aadhar4'] = $bb_devotee_aadhar4;

                        $datatoexcel[$bb_id]['bb_devotee_name5'] = $bb_devotee_name5;
                        $datatoexcel[$bb_id]['bb_devotee_mobile5'] = $bb_devotee_mobile5;
                        $datatoexcel[$bb_id]['bb_devotee_aadhar5'] = $bb_devotee_aadhar5;

                        $datatoexcel[$bb_id]['bb_amount'] = $bb_amount;
                        $datatoexcel[$bb_id]['bb_transstatus'] = $bb_transstatus;
                        $datatoexcel[$bb_id]['bb_bankrefno'] = $bb_bankrefno;
                        $datatoexcel[$bb_id]['bb_proof'] = $proof_final;
                        $datatoexcel[$bb_id]['bb_subdatetime'] = $bb_subdatetime;

                        $sr++;
                    }

                    $filename = 'bhog_booking'
                        . date('d')
                        . date('m')
                        . date('y')
                        . date('h')
                        . date('i')
                        . date('s')
                        . '.csv';

                    header('Content-type: text/csv');
                    header("Content-Disposition: attachment; filename=$filename");
                    header('Pragma: no-cache');
                    header('Expires: 0');

                    $file = fopen('php://output', 'w');

                    fputcsv($file, array(
                        'Sr No.',
                        'Order Number',
                        'Temple Name',
                        'Booking For Date',
                        'Name',
                        'Mobile Number',
                        'Aadhaar Card',
                        'Member Name 1',
                        'Member Mobile 1',
                        'Member Aadhaar Card 1',
                        'Member Name 2',
                        'Member Mobile 2',
                        'Member Aadhaar Card 2',
                        'Member Name 3',
                        'Member Mobile 3',
                        'Member Aadhaar Card 3',
                        'Member Name 4',
                        'Member Mobile 4',
                        'Member Aadhaar Card 4',
                        'Member Name 5',
                        'Member Mobile 5',
                        'Member Aadhaar Card 5',
                        'Amount',
                        'Payment Status',
                        'Bank Ref. Number',
                        'Passport Photo',
                        'Date'
                    ));

                    foreach ($datatoexcel as $datatoexcelval) {
                        fputcsv($file, $datatoexcelval);
                    }

                    exit;

                } else {

                    $this->session->set_flashdata(
                        'feedback',
                        "Please select record to export 1"
                    );

                    $this->session->set_flashdata(
                        'feedbackerr',
                        "alert-danger"
                    );

                    redirect(
                        "master/bhog-booking/searchlist/$enc_dates"
                    );
                }
            }
        }

        $this->load->view(
            'master/master-bhog-searchlist',
            $arr
        );
    }
}