<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends My_User
{

    public $order = 'user/payment/order';
    public $confirmation = 'user/payment/confirmation'; 
    public $waiting = 'user/payment/waiting'; 
    public $success = 'user/payment/success';    

    public function __construct(){
        parent::__construct();

        $this->load->model('lms/_Courses');
        $this->load->model('lms/_Lesson');

        $this->load->model('user/M_Payment');
        $this->load->model('user/M_Payment_Coupon');                
        $this->load->model('user/M_Payment_Free');
        $this->load->model('user/M_Payment_Midtrans');                        
        $this->load->model('user/M_Profile');              
    }   

    /**
     * Page Index
     */
    public function order($id)
    {

        $site = $this->site;
        $widget= $this->widget; 
        $courses = $this->M_Payment->read($site,$id);

        $data = [
        'site' => $site,
        'widget' => $widget,    
        'courses' =>  $courses,
        ];

        $this->load->view($this->order, $data);
    }   

    /**
     * Check Coupon
     */
    public function use_coupon(){

        if ($this->input->is_ajax_request()) {

            $process = $this->M_Payment_Coupon->check_coupon();

            if ($process['status'] == 'valid_not_free_manual') {
                echo json_encode([
                    'status' => 'valid_not_free_manual',
                    'discount_coupon' => $process['discount_coupon'],
                    'price_total' => $process['price_total'],
                    'message' => 'Kode Voucher valid',
                    ]);
            }elseif ($process['status'] == 'valid_not_free_midtrans') {
                echo json_encode([
                    'status' => 'valid_not_free_midtrans',
                    'discount_coupon' => $process['discount_coupon'],
                    'price_total' => $process['price_total'],
                    'midtrans_token' => $process['midtrans_token'],                    
                    'message' => 'Kode Voucher valid',
                    ]);
            }
            elseif ($process['status'] == 'valid_to_free') {
                echo json_encode([
                    'status' => 'valid_to_free',
                    'discount_coupon' => $process['discount_coupon'],
                    'price_total' => $process['price_total'],
                    'free_code' => $process['free_code'],
                    'message' => 'Kode Voucher valid',
                    ]);
            }elseif ($process['status'] == 'coupon_reuse') {
                echo json_encode([
                    'status' => 'invalid',
                    'message' => 'Kode Voucher sudah pernah digunakan.',
                    ]);
            }elseif ($process['status'] == 'coupon_expired') {
                echo json_encode([
                    'status' => 'invalid',
                    'message' => 'Kode Voucher sudah expired.',
                    ]);
            }
            else{
                echo json_encode([
                    'status' => 'invalid',
                    'message' => 'Kode Voucher tidak valid',
                    ]);
            }

        }else{
            redirect(base_url());
        }        
    }

    /**
     * Free Courses by coupon
     */
    public function process_free(){

        if ($this->input->post()) {

            $process = $this->M_Payment_Free->process_free();

            if ($process) {
                redirect(base_url('payment/success'));
            }else{
                redirect(base_url());
            }        

        }else{
            redirect(base_url());
        } 
    }

    public function waiting(){

        $site = $this->site;

        $data = array(
            'site' => $site,
            'classbody' => 'o-page--center',
            );

        $this->load->view($this->waiting, $data);
    }


    public function success(){

        $site = $this->site;

        $data = array(
            'site' => $site,
            'classbody' => 'o-page--center',
            );

        $this->load->view($this->success, $data);
    }    

    /**
     * Manual
     */
    public function confirmation(){
        echo "kaowkakwa";
    }

    /**
     * Midtrans
     */
    public function process(){

        if ($this->input->is_ajax_request()) {

            $process = $this->M_Payment_Midtrans->process();

            if ($process) {

                echo json_encode([
                    'status' => true,
                    'message' => $this->lang->line('success_transaction'),
                    'redirect' => $process
                    ]);
            }else{

                echo json_encode([
                    'status' => false,
                    'message' => $this->lang->line('failed_transaction')
                    ]);
            }

        }else{
            redirect(base_url());
        }

    } 

    /**
     * Midtrans
     */
    public function notification(){

        $notification = $this->M_Payment_Midtrans->handle();

        echo json_encode($notification);
    }
}