<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config['userEdit'] = array(
    array(
        'field' => 'user[first_name]',
        'label' => 'first name',
        'rules' => 'trim|required|checkName'
    ),
    array(
        'field' => 'user[last_name]',
        'label' => 'last name',
        'rules' => 'trim|required|checkName'
    ),
    array(
        'field' => 'user[username]',
        'label' => 'username',
        'rules' => 'trim|required'
    ),
    array(
        'field' => 'user[mobile]',
        'label' => 'mobile',
        'rules' => 'trim|required|numeric|exact_length[10]',
        'errors' =>array(
                    "exact_length" => "Mobile number should be 10 digit"
                    )
    ),
    array(
        'field' => 'user[email]',
        'label' => 'email id',
        'rules' => 'trim|required|valid_email|check_email'
    )
);

$config['userAdd'] = $config['userEdit'];
$config['userAdd'][] = array(
        'field' => 'user[password]',
        'label' => 'password',
        'rules' => 'trim|required|min_length[8]',
        'errors'=> array("min_length" => "The password should be Minimum 8 characters"),
    );

if(!is_company_user()){
    $config['userAdd'][] =    array(
        'field' => 'user[company_id]',
        'label' => 'company',
        'rules' => 'trim|required'
    );
    $config['userEdit'][] =    array(
        'field' => 'user[company_id]',
        'label' => 'company',
        'rules' => 'trim|required'
    );
}


$config['company'] = array(
    array(
        'field' => 'company[name]',
        'label' => 'company name',
        'rules' => 'trim|required|alpha_numeric'
    ),
    array(
        'field' => 'company[company_code]',
        'label' => 'company code',
        'rules' => 'trim|required'
    ),
    array(
        'field' => 'company[country_id]',
        'label' => 'country',
        'rules' => 'trim|required'
    ),
    array(
        'field' => 'company[rs_conversion_points]',
        'label' => 'Rs to conversion points',
        'rules' => 'trim|required|numeric'
    )
);

$config['contest'] = array(
    array(
        'field' => 'contest[name]',
        'label' => 'contest name',
        'rules' => 'trim|required|is_contest_name_exist'
    ),
    array(
        'field' => 'contest[start_date]',
        'label' => 'start date',
        'rules' => 'trim|required'
    ),
    array(
        'field' => 'contest[end_date]',
        'label' => 'end date',
        'rules' => 'trim|required|contest_end_date'
    ),
    array(
        'field' => 'contest[redem_end_date]',
        'label' => 'redemption end date',
        'rules' => 'trim|required|redemption_end_date'
    ),
    array(
        'field' => 'contest[remarks]',
        'label' => 'remarks',
        'rules' => 'trim|required'
    )
);

$config['reset_password'] = array(
    array(
        'field' => 'password',
        'label' => 'password',
        'rules' => 'trim|required|min_length[8]',
        'errors'=> array("min_length" => "The password should be Minimum 8 characters"),
    ),
    array(
        'field' => 'cpassword',
        'label' => 'confirm password',
        'rules' => 'trim|required|matches[password]'
    )
);
$config['voucher'] = array(
    array(
        'field' => 'voucher[voucher_name]',
        'label' => 'voucher name',
        'rules' => 'trim|required'
    ),
    array(
        'field' => 'voucher[voucher_code]',
        'label' => 'voucher code',
        'rules' => 'trim|required'
    ),
    array(
        'field' => 'voucher[voucher_points]',
        'label' => 'voucher points',
        'rules' => 'trim|required|numeric'
    ),
    array(
        'field' => 'voucher[company_id]',
        'label' => 'company',
        'rules' => 'trim|required'
    )
);
?>