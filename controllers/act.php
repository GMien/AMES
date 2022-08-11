<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Act extends CI_Controller
{
    public $access = array('am', 'em', 'dm', 'xm', 'im', 'ar', 'mr', 'dr', 'pr', 'al', 'rl', 'pl', 'vp', 'vmp', 'vrp', 'vlp', 'vc', 'mta', 'mte', 'mtd', 'rca', 'rce', 'rcd', 'uma', 'ume', 'umd', 'ola', 'ole', 'old', 'dva', 'dve', 'dvd', 'vemp', 'aemp', 'eemp', 'demp', 'umma', 'ummd', 'umme');
    public function index()
    {
        $act = $this->input->post('act');
        if ($act == "")
            $act = $this->input->get('act');
        if ($act == 'merch') {
            $this->get_merchandise();
        } else if ($act == 'newmerch') {
            $this->add_merchandise();
        } else if ($act == 'delmerch') {	
            $this->del_merchandise();
        } else if ($act == 'editmerch') {
            $this->edit_merchandise();
        } else if ($act == 'register') {
            $this->register();
        } else if ($act == 'typemeasure') {
            $this->typesandmeasures();
        } else if ($act == 'umm') {
            $this->umm();
        } else if ($act == 'recipes') {
            $this->get_recipes();
        } else if ($act == 'categories') {
            $this->get_categories();
        } else if ($act == 'newrecipe') {
            $this->add_recipe();
        } else if ($act == 'getrecipeinf') {
            $this->get_recipe_details();
        } else if ($act == 'edtrecipe') {
            $this->edit_recipe();
        } else if ($act == 'delrecipe') {
            $this->del_recipe();
        } else if ($act == 'marketcombo') {
            $this->Get_market_Combos();
        } else if ($act == 'marketdetails') {
            $this->Get_Marketlist_Details();
        } else if ($act == 'getmarketdata') {
            $this->Get_Marketlist_Data();
        } else if ($act == 'savemarketlist') {
            $this->Save_Marketlist();
        } else if ($act == 'reprecipes') {
            $this->get_recipes_rep();
        } else if ($act == 'marketreport') {
            $this->Get_Marketlist_Report();
        } else if ($act == 'edtmerchtype') {
            $this->Edit_Merch_Type();
        } else if ($act == 'merchtype') {
            $this->Get_Merchtype();
        } else if ($act == 'addmarchtype') {
            $this->Add_Merch_Type();
        } else if ($act == 'delmarchtype') {
            $this->Del_Merchtype();
        } else if ($act == 'edtcats') {
            $this->Edit_Cats();
        } else if ($act == 'addcat') {
            $this->AddCat();
        } else if ($act == 'delcat') {
            $this->DelCat();
        } else if ($act == 'delmea') {
            $this->DelMea();
        } else if ($act == 'delumm') {
            $this->Delumm();
        } else if ($act == 'addmea') {
            $this->AddMea();
        } else if ($act == 'addumm') {
            $this->AddUmm();
        } else if ($act == 'edtmea') {
            $this->Edit_Mea();
        } else if ($act == 'edtumm') {
            $this->Edit_umm();
        } else if ($act == 'delout') {
            $this->DelOut();
        } else if ($act == 'addout') {
            $this->AddOut();
        } else if ($act == 'edtout') {
            $this->Edit_Out();
        } else if ($act == 'deldiv') {
            $this->DelDiv();
        } else if ($act == 'adddiv') {
            $this->AddDiv();
        } else if ($act == 'edtdiv') {
            $this->Edit_Div();
        } else if ($act == 'getusers') {
            $this->GetUsers();
        } else if ($act == 'adduser') {
            $this->AddUser();
        } else if ($act == 'userinfo') {
            $this->userinfo();
        } else if ($act == 'edtuser') {
            $this->EditUser();
        } else if ($act == 'deluser') {
            $this->deluser();
        } else if ($act == 'changepass') {
            $this->changepass();
        } else if ($act == 'acc') {
            $this->acc();
        } else if ($act == 'pkg') {
            $this->getpackages();
        } else if ($act == 'adminset') {
            $this->adminset();
        } else if ($act == 'pricing') {
            $this->pricing();
        } else if ($act == 'edtpricing') {
            $this->edtpricing();
        } else if ($act == 'payrep') {
            $this->payment_report();
        } else if ($act == 'merchexp') {
            $this->Merch_Excel_Export();
        } else if ($act == 'merchomp') {
            $this->merchomp();
        } else if ($act == 'updatebusiness') {
            $this->updatebusiness();
        } else if ($act == 'edtx') {
            $this->Register_UserAdmin();
        } else if ($act == 'chkusr') {
            $this->checkuser();
        }
    }
    public function umm()
    {
        $responce        = (object) array();
        $responce->types = array();
        $responce->units = array();
        $i               = 0;
        if ($this->input->post('type') == '') {
            $query = $this->data->Get_umm($this->session->userdata('parentid'));
            $i     = 0;
            foreach ($query->result() as $row) {
                $responce->units[$i] = array(
                    'id' => $row->ID,
                    'name' => $row->UnitOfMeasure
                );
                $i++;
            }
        } else {
            $query = $this->data->Get_umm($this->session->userdata('parentid'));
            $i     = 0;
            foreach ($query->result() as $row) {
                $responce->rows[$i]['id']   = $row->ID;
                $responce->rows[$i]['cell'] = array(
                    'id' => $row->ID,
                    'name' => $row->UnitOfMeasure
                );
                $i++;
            }
        }
        die(json_encode($responce));
    }
    public function checkuser()
    {
        $Result         = (object) array(
            'success' => 0,
            'message' => '',
            'data1' => '',
            'data2' => '',
            'data3' => ''
        );
        $username       = $this->input->post('username');
        $user_email     = $this->input->post('email');
        $checkDuplicate = $this->data->check_username_email($username, $user_email);
        if ($checkDuplicate != 0) {
            if ($checkDuplicate == 1)
                $Result->message = "Username already exists!";
            else if ($checkDuplicate == 2)
                $Result->message = "Email address already exists!";
            die(json_encode($Result));
        }
        $Result->success = 1;
        die(json_encode($Result));
    }
    public function Register_UserAdmin()
    {
        $responce      = (object) array(
            'success' => 0
        );
        $amount        = $this->input->post('amount');
        $desc          = $this->input->post('desc');
        $email         = $this->input->post('email');
        $expiredate    = $this->input->post('expiredate');
        $name          = $this->input->post('name');
        $password      = $this->input->post('password');
        $user_business = $this->input->post('user_business');
        $days          = $this->input->post('days');
        $this->data->Register_UserAdmin($responce, $amount, $desc, $email, $days, $name, $password, $user_business);
    }
    public function updatebusiness()
    {
        $responce          = (object) array(
            'success' => 0
        );
        $responce->message = '';
        $uid               = $this->session->userdata('parentid');
        if ($uid == "") {
            $responce->message = "Please login!";
            die(json_encode($responce));
        }
        $Businessname = $this->input->post('business');
        $this->data->updatebusiness($uid, trim($Businessname));
        $responce->success = 1;
        die(json_encode($responce));
    }
    public function merchomp()
    {
        $responce          = (object) array(
            'success' => 0
        );
        $responce->message = '';
        $uid               = $this->session->userdata('parentid');
        if ($uid == "") {
            $responce->message = "Please login!";
            die(json_encode($responce));
        }
        $file        = "user_data/tmp/" . $this->input->post('filename');
        $objReader   = new PHPExcel_Reader_Excel5();
        $objPHPExcel = $objReader->load($file);
        $s           = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, 2)->getValue();
        if ($s != "Type") {
        }
        $objWorksheet       = $objPHPExcel->getActiveSheet();
        $highestRow         = $objWorksheet->getHighestRow();
        $highestColumn      = $objWorksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        if ($highestColumnIndex != 7) {
            $responce->message = "Data is not valid!";
            $responce->data    = $highestColumnIndex;
            die(json_encode($responce));
        }
        $totalRows = 0;
        $Imported  = 0;
        for ($row = 2; $row <= $highestRow; ++$row) {
            $DT                         = (object) array();
            $DT->MerchandiseName        = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
            $DT->Type                   = $objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
            $DT->UnitEquivalent         = $objWorksheet->getCellByColumnAndRow(2, $row)->getValue();
            $DT->UnitofMeasure          = $objWorksheet->getCellByColumnAndRow(3, $row)->getValue();
            $DT->ConvertedUnitofMeasure = $objWorksheet->getCellByColumnAndRow(4, $row)->getValue();
            $DT->UnitCost               = $objWorksheet->getCellByColumnAndRow(5, $row)->getValue();
            $DT->CookingLoss            = $objWorksheet->getCellByColumnAndRow(6, $row)->getValue();
            $sql                        = " insert IGNORE INTO types set IngredientType = ? , uid= ?, createdby = ? ";
            $query                      = $this->db->query($sql, array(
                $DT->Type,
                $uid,
                $uid
            ));
            $sql                        = " select ID from types where trim(IngredientType) = trim(?) and uid= ? ";
            $DT->TypeID                 = $this->db->query($sql, array(
                $DT->Type,
                $uid
            ))->row()->ID;
            $totalRows++;
            $sql = " insert IGNORE INTO ingredients set 	
	IngredientName=?,
TypeID=?,
UnitEquivalent=?,
UnitOfMeasure=?,
ConvertedUnitOfMeasure=?,
UnitCost=?,
CookingLoss=?,
DateCreated= UTC_TIMESTAMP(),
Deleted=0, uid= ?, createdby = ? ";
            $this->db->query($sql, array(
                $DT->MerchandiseName,
                $DT->TypeID,
                $DT->UnitEquivalent,
                $DT->UnitofMeasure,
                $DT->ConvertedUnitofMeasure,
                $DT->UnitCost,
                $DT->CookingLoss,
                $uid,
                $uid
            ));
            if ($this->db->affected_rows() > 0)
                $Imported++;
        }
        $responce->success  = 1;
        $responce->total    = $totalRows;
        $responce->imported = $Imported;
        die(json_encode($responce));
    }
    public function Merch_Excel_Export()
    {
        $uid = $this->session->userdata('parentid');
        if ($uid == "")
            die('');
        $query    = $this->data->get_merchandise($uid);
        $i        = 0;
        $filename = "Merchandise.xls";
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Merchandises');
        $this->excel->getActiveSheet()->setCellValue('A1', 'Merchandise Name');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Type');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Unit Equivalent');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Unit of Measure');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Converted Unit of Purchase');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Unit Cost');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Cooking Loss');
        $r = 2;
        $c = 0;
        foreach ($query->result() as $row) {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($c, $r, $row->IngredientName);
            $c++;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($c, $r, $row->IngredientType);
            $c++;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($c, $r, $row->UnitEquivalent);
            $c++;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($c, $r, $row->UnitOfMeasure);
            $c++;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($c, $r, $row->ConvertedUnitOfMeasure);
            $c++;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($c, $r, $row->UnitCost);
            $c++;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($c, $r, $row->CookingLoss);
            $r++;
            $c = 0;
        }
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }
    public function payment_report()
    {
        $responce = (object) array(
            'success' => 0
        );
        $query    = $this->data->payment_report();
        $i        = 0;
        foreach ($query->result() as $row) {
            $responce->rows[$i]['id']   = $row->pay_id;
            $responce->rows[$i]['cell'] = array(
                $row->username,
                $row->user_business,
                $row->item_name,
                $row->mc_gross . ' $',
                $row->f_trantime
            );
            $i++;
        }
        $responce->success = 1;
        die(json_encode($responce));
    }
    public function edtpricing()
    {
        $responce    = (object) array(
            'success' => 0
        );
        $days        = $this->input->post('days');
        $id          = $this->input->post('id');
        $info1       = $this->input->post('info1');
        $info2       = $this->input->post('info2');
        $info3       = $this->input->post('info3');
        $info4       = $this->input->post('info4');
        $packagedesc = $this->input->post('packagedesc');
        $packagename = $this->input->post('packagename');
        $price       = $this->input->post('price');
        $res         = $this->data->edtpricing($id, $packagename, $packagedesc, $info1, $info2, $info3, $info4, $price, $days);
        if ($res == 0) {
            $responce->success = 1;
            $responce->data    = "";
        }
        die(json_encode($responce));
    }
    public function pricing()
    {
        $responce = (object) array(
            'success' => 0
        );
        $query    = $this->data->pricing();
        $i        = 0;
        foreach ($query->result() as $row) {
            $responce->rows[$i]['id']   = $row->pkid;
            $responce->rows[$i]['cell'] = array(
                "",
                $row->packagename,
                $row->packagedesc,
                $row->info1,
                $row->info2,
                $row->info3,
                $row->info4,
                $row->price,
                $row->days
            );
            $i++;
        }
        $responce->success = 1;
        die(json_encode($responce));
    }
    public function adminset()
    {
        $responce   = (object) array(
            'success' => 0
        );
        $txtPaypal  = $this->input->post('txtPaypal');
        $txtadmin   = $this->input->post('txtadmin');
        $txtsupport = $this->input->post('txtsupport');
        $this->data->SetOptionValue('paypal_email', $txtPaypal);
        $this->data->SetOptionValue('admin_email', $txtadmin);
        $this->data->SetOptionValue('support_email', $txtsupport);
        $responce->txtPaypal  = $this->data->GetOptionValue('paypal_email', $txtPaypal);
        $responce->txtadmin   = $this->data->GetOptionValue('admin_email', $txtadmin);
        $responce->txtsupport = $this->data->GetOptionValue('support_email', $txtsupport);
        $responce->success    = 1;
        die(json_encode($responce));
    }
    public function getpackages()
    {
        $responce          = (object) array(
            'success' => 0
        );
        $res               = $this->data->getpackages();
        $responce->success = 1;
        $responce->data    = $res->result_array();
        die(json_encode($responce));
    }
    public function acc()
    {
        $responce          = (object) array(
            'success' => 0
        );
        $ParentID          = $this->session->userdata('parentid');
        $uid               = $this->session->userdata('uid');
        $res               = $this->data->getUserInfoRow($uid);
        $responce->success = 1;
        $responce->data    = $res->user_access;
        die(json_encode($responce));
    }
    public function changepass()
    {
        $responce          = (object) array(
            'success' => 0
        );
        $ParentID          = $this->session->userdata('parentid');
        $uid               = $this->session->userdata('uid');
        $password          = trim($this->input->post('pass'));
        $res               = $this->data->changepass($uid, $password, $ParentID);
        $responce->success = 1;
        $responce->data    = $password;
        die(json_encode($responce));
    }
    public function AddUser()
    {
        $responce = (object) array(
            'success' => 0
        );
        $ParentID = $this->session->userdata('parentid');
        $username = $this->input->post('txtname');
        $password = $this->input->post('txtpass');
        $sAccess  = "";
        foreach ($this->access as $accessTag) {
            if ($this->input->post($accessTag) != "")
                $sAccess = $sAccess . $accessTag . ',';
        }
        $res               = $this->data->AddUser($username, $password, $ParentID, $sAccess);
        $responce->success = 1;
        $responce->data    = $res;
        die(json_encode($responce));
    }
    public function EditUser()
    {
        $responce = (object) array(
            'success' => 0
        );
        $ParentID = $this->session->userdata('parentid');
        $username = $this->input->post('txtname');
        $password = $this->input->post('txtpass');
        $uid      = $this->input->post('merchid');
        $sAccess  = "";
        foreach ($this->access as $accessTag) {
            if ($this->input->post($accessTag) != "")
                $sAccess = $sAccess . $accessTag . ',';
        }
        $res               = $this->data->EditUser($uid, $username, $password, $ParentID, $sAccess);
        $responce->success = 1;
        $responce->data    = $res;
        die(json_encode($responce));
    }
    public function deluser()
    {
        $responce          = (object) array(
            'success' => 0
        );
        $ParentID          = $this->session->userdata('parentid');
        $uid               = $this->input->post('merchid');
        $res               = $this->data->deluser($uid, $ParentID);
        $responce->success = 1;
        $responce->data    = $res;
        die(json_encode($responce));
    }
    public function GetUsers()
    {
        $responce  = (object) array(
            'success' => 0
        );
        $ParentID  = $this->session->userdata('parentid');
        $CurrentID = $this->session->userdata('uid');
        $query     = $this->data->GetUsers($ParentID, $CurrentID);
        $i         = 0;
        foreach ($query->result() as $row) {
            $responce->rows[$i]['id']   = $row->uid;
            $responce->rows[$i]['cell'] = array(
                $row->uid,
                $row->username,
                $row->role,
                $row->user_email,
                $row->user_business,
                $row->datecreate,
                $row->expire_date,
                $row->password
            );
            $i++;
        }
        $responce->success = 1;
        die(json_encode($responce));
    }
    public function userinfo()
    {
        $responce = (object) array(
            'success' => 0
        );
        $ParentID = $this->session->userdata('parentid');
        $uid      = $this->input->post('uid');
        if ($ParentID == '') {
            die(json_encode($responce));
        }
        $query                 = $this->data->userinfo($uid, $ParentID);
        $row                   = $query->row();
        $responce->username    = $row->username;
        $responce->password    = $row->password;
        $responce->user_access = $row->user_access;
        $responce->success     = 1;
        die(json_encode($responce));
    }
    public function DelDiv()
    {
        $responce          = (object) array(
            'success' => 0
        );
        $mid               = $this->input->post('mid');
        $ParentID          = $this->session->userdata('parentid');
        $res               = $this->data->DelDiv($mid, $ParentID);
        $responce->success = 1;
        $responce->data    = $res;
        die(json_encode($responce));
    }
    public function AddDiv()
    {
        $responce          = (object) array(
            'success' => 0
        );
        $name              = $this->input->post('name');
        $ParentID          = $this->session->userdata('parentid');
        $res               = $this->data->AddDiv($name, $ParentID);
        $responce->success = 1;
        $responce->data    = $res;
        die(json_encode($responce));
    }
    public function Edit_Div()
    {
        $responce = (object) array(
            'success' => 0
        );
        $id       = $this->input->post('id');
        $name     = $this->input->post('name');
        $ParentID = $this->session->userdata('parentid');
        $res      = $this->data->Edit_Div($id, $name, $ParentID);
        if ($res == 0)
            $responce->success = 1;
        $responce->data = $res;
        $responce->grid = 'div';
        die(json_encode($responce));
    }
    public function DelOut()
    {
        $responce          = (object) array(
            'success' => 0
        );
        $mid               = $this->input->post('mid');
        $ParentID          = $this->session->userdata('parentid');
        $res               = $this->data->DelOut($mid, $ParentID);
        $responce->success = 1;
        $responce->data    = $res;
        die(json_encode($responce));
    }
    public function AddOut()
    {
        $responce          = (object) array(
            'success' => 0
        );
        $name              = $this->input->post('name');
        $ParentID          = $this->session->userdata('parentid');
        $res               = $this->data->AddOut($name, $ParentID);
        $responce->success = 1;
        $responce->data    = $res;
        die(json_encode($responce));
    }
    public function Edit_Out()
    {
        $responce = (object) array(
            'success' => 0
        );
        $id       = $this->input->post('id');
        $name     = $this->input->post('name');
        $ParentID = $this->session->userdata('parentid');
        $res      = $this->data->Edit_Out($id, $name, $ParentID);
        if ($res == 0)
            $responce->success = 1;
        $responce->data = $res;
        $responce->grid = 'out';
        die(json_encode($responce));
    }
    public function DelMea()
    {
        $responce          = (object) array(
            'success' => 0
        );
        $mid               = $this->input->post('mid');
        $ParentID          = $this->session->userdata('parentid');
        $res               = $this->data->DelMea($mid, $ParentID);
        $responce->success = 1;
        $responce->data    = $res;
        die(json_encode($responce));
    }
    public function Delumm()
    {
        $responce          = (object) array(
            'success' => 0
        );
        $mid               = $this->input->post('mid');
        $ParentID          = $this->session->userdata('parentid');
        $res               = $this->data->Delumm($mid, $ParentID);
        $responce->success = 1;
        $responce->data    = $res;
        die(json_encode($responce));
    }
    public function AddUmm()
    {
        $responce          = (object) array(
            'success' => 0
        );
        $name              = $this->input->post('name');
        $ParentID          = $this->session->userdata('parentid');
        $res               = $this->data->AddUmm($name, $ParentID);
        $responce->success = 1;
        $responce->data    = $res;
        die(json_encode($responce));
    }
    public function AddMea()
    {
        $responce          = (object) array(
            'success' => 0
        );
        $name              = $this->input->post('name');
        $ParentID          = $this->session->userdata('parentid');
        $res               = $this->data->AddMea($name, $ParentID);
        $responce->success = 1;
        $responce->data    = $res;
        die(json_encode($responce));
    }
    public function Edit_Mea()
    {
        $responce = (object) array(
            'success' => 0
        );
        $id       = $this->input->post('id');
        $name     = $this->input->post('name');
        $ParentID = $this->session->userdata('parentid');
        $res      = $this->data->Edit_Mea($id, $name, $ParentID);
        if ($res == 0)
            $responce->success = 1;
        $responce->data = $res;
        $responce->grid = 'mea';
        die(json_encode($responce));
    }
    public function Edit_umm()
    {
        $responce = (object) array(
            'success' => 0
        );
        $id       = $this->input->post('id');
        $name     = $this->input->post('name');
        $ParentID = $this->session->userdata('parentid');
        $res      = $this->data->Edit_umm($id, $name, $ParentID);
        if ($res == 0)
            $responce->success = 1;
        $responce->data = $res;
        $responce->grid = 'mea';
        die(json_encode($responce));
    }
    public function DelCat()
    {
        $responce          = (object) array(
            'success' => 0
        );
        $mid               = $this->input->post('mid');
        $ParentID          = $this->session->userdata('parentid');
        $res               = $this->data->DelCat($mid, $ParentID);
        $responce->success = 1;
        $responce->data    = $res;
        die(json_encode($responce));
    }
    public function AddCat()
    {
        $responce          = (object) array(
            'success' => 0
        );
        $name              = $this->input->post('name');
        $ParentID          = $this->session->userdata('parentid');
        $res               = $this->data->AddCat($name, $ParentID);
        $responce->success = 1;
        $responce->data    = $res;
        die(json_encode($responce));
    }
    public function Edit_Cats()
    {
        $responce = (object) array(
            'success' => 0
        );
        $id       = $this->input->post('id');
        $name     = $this->input->post('name');
        $ParentID = $this->session->userdata('parentid');
        $res      = $this->data->Edit_Cats($id, $name, $ParentID);
        if ($res == 0)
            $responce->success = 1;
        $responce->data = $res;
        $responce->grid = 'cats';
        die(json_encode($responce));
    }
    public function Del_Merchtype()
    {
        $responce          = (object) array(
            'success' => 0
        );
        $mid               = $this->input->post('mid');
        $ParentID          = $this->session->userdata('parentid');
        $res               = $this->data->Del_Merchtype($mid, $ParentID);
        $responce->success = 1;
        $responce->data    = $res;
        die(json_encode($responce));
    }
    public function Add_Merch_Type()
    {
        $responce          = (object) array(
            'success' => 0
        );
        $name              = $this->input->post('name');
        $ParentID          = $this->session->userdata('parentid');
        $res               = $this->data->Add_Merch_Type($name, $ParentID);
        $responce->success = 1;
        $responce->data    = $res;
        die(json_encode($responce));
    }
    public function Get_Merchtype()
    {
        $responce		   = (object) array();
		$page              = $this->input->post('page');
        $total_pages       = 1;
        $count             = 0;
        $responce->page    = 1;
        $responce->total   = 1;
        $query             = $this->data->get_merchtype($this->session->userdata('parentid'));
        $responce->records = $query->num_rows();
        $i                 = 0;
        foreach ($query->result() as $row) {
            $responce->rows[$i]['id']   = $row->ID;
            $responce->rows[$i]['cell'] = array(
                $row->IngredientType
            );
            $i++;
        }
        die(json_encode($responce));
    }
    public function Edit_Merch_Type()
    {
        $responce = (object) array(
            'success' => 0
        );
        $id       = $this->input->post('id');
        $name     = $this->input->post('name');
        $ParentID = $this->session->userdata('parentid');
        $res      = $this->data->Edit_Merch_Type($id, $name, $ParentID);
        if ($res == 0)
            $responce->success = 1;
        $responce->data = $res;
        $responce->grid = 'mtype';
        die(json_encode($responce));
    }
    public function Get_Marketlist_Report()
    {
        $responce          = (object) array(
            'success' => 0
        );
        $uid               = $this->session->userdata('parentid');
        $recipeid          = $this->input->post('recipeid');
        $Quantity          = $this->input->post('quantity');
        $OutletID          = $this->input->post('outletid');
        $FromDate          = $this->input->post('fromdate');
        $ToDate            = $this->input->post('todate');
        $FunctionID        = $this->input->post('functionid');
        $query             = $this->data->Get_Marketlist_Report($OutletID, $FunctionID, $FromDate, $ToDate, $uid);
        $responce->success = 1;
        $responce->data    = $query->result_array();
        die(json_encode($responce));
    }
    public function get_recipes_rep()
    {
        $responce = new stdClass();
        $page              = $this->input->post('page');
        $total_pages       = 1;
        $count             = 0;
        $responce->page    = $page;
        $responce->total   = $total_pages;
        $ParentID          = $this->session->userdata('parentid');
        $query             = $this->data->get_recipes($ParentID);
        $responce->records = $query->num_rows();
        $i                 = 0;
        foreach ($query->result() as $row) {
            $responce->rows[$i]['id']   = $row->ID;
            $responce->rows[$i]['cell'] = array(
                $row->RecipeName,
                $row->RecipeCategory,
                $row->StandardYield,
                $row->ServingSize,
                $row->PricePerServing,
                $row->CostPerServing,
                $row->FC,
                $row->CategoryID
            );
            $i++;
        }
        die(json_encode($responce));
    }
    public function Save_Marketlist()
    {
        $responce   = (object) array(
            'success' => 0
        );
        $uid        = $this->session->userdata('parentid');
        $OutletID   = $this->input->post('outletid');
        $MarketDate = $this->input->post('marketdate');
        $FunctionID = $this->input->post('functionid');
        $i          = 0;
        $Recipes    = array();
        while ($this->input->post('q' . $i) != NULL && trim($this->input->post('q' . $i)) != '') {
            array_push($Recipes, array(
                'rid' => $this->input->post('r' . $i),
                'qt' => $this->input->post('q' . $i)
            ));
            $i++;
        }
        $res = $this->data->Add_Marketlist($OutletID, $MarketDate, $FunctionID, $Recipes, $uid);
        if ($res >= 0)
            $responce->success = 1;
        die(json_encode($responce));
    }
    public function Get_Marketlist_Data()
    {
        $responce          = (object) array(
            'success' => 0
        );
        $uid               = $this->session->userdata('parentid');
        $OutletID          = $this->input->post('outletid');
        $MarketDate        = $this->input->post('marketdate');
        $FunctionID        = $this->input->post('functionid');
        $query             = $this->data->Get_Marketlist_Data($OutletID, $MarketDate, $FunctionID, $uid);
        $responce->success = 1;
        $responce->data    = $query->result_array();
        die(json_encode($responce));
    }
    public function Get_Marketlist_Details()
    {
        $responce   = (object) array(
            'success' => 0
        );
        $uid        = $this->session->userdata('parentid');
        $recipeid   = $this->input->post('recipeid');
        $Quantity   = $this->input->post('quantity');
        $OutletID   = $this->input->post('outletid');
        $MarketDate = $this->input->post('marketdate');
        $FunctionID = $this->input->post('functionid');
        $i          = 0;
        $Recipes    = array();
        while ($this->input->post('q' . $i) != NULL && trim($this->input->post('q' . $i)) != '') {
            array_push($Recipes, array(
                'rid' => $this->input->post('r' . $i),
                'qt' => $this->input->post('q' . $i)
            ));
            $i++;
        }
        $query             = $this->data->Get_Marketlist_Details($Recipes);
        $responce->success = 1;
        $responce->data    = $query->result_array();
        die(json_encode($responce));
    }
    public function Get_market_Combos()
    {
        $responce           = (object) array(
            'success' => 0
        );
        $uid                = $this->session->userdata('parentid');
        $responce->outlets  = array();
        $responce->fnctions = array();
        $responce->recipes  = array();
        if ($this->input->post('type') == '') {
            $query = $this->data->get_outlets_list($uid);
            $i     = 0;
            foreach ($query->result() as $row) {
                $responce->outlets[$i] = array(
                    'id' => $row->ID,
                    'name' => $row->OutletName
                );
                $i++;
            }
            $query = $this->data->get_divisions($uid);
            $i     = 0;
            foreach ($query->result() as $row) {
                $responce->fnctions[$i] = array(
                    'id' => $row->ID,
                    'name' => $row->DivisionName
                );
                $i++;
            }
            $query = $this->data->get_recipes($uid);
            $i     = 0;
            foreach ($query->result() as $row) {
                $responce->recipes[$i] = array(
                    'id' => $row->ID,
                    'name' => $row->RecipeName
                );
                $i++;
            }
        } else if ($this->input->post('type') == 'out') {
            $query = $this->data->get_outlets_list($uid);
            $i     = 0;
            foreach ($query->result() as $row) {
                $responce->rows[$i]['id']   = $row->ID;
                $responce->rows[$i]['cell'] = array(
                    'id' => $row->ID,
                    'name' => $row->OutletName
                );
                $i++;
            }
        } else if ($this->input->post('type') == 'div') {
            $query = $this->data->get_divisions($uid);
            $i     = 0;
            foreach ($query->result() as $row) {
                $responce->rows[$i]['id']   = $row->ID;
                $responce->rows[$i]['cell'] = array(
                    'id' => $row->ID,
                    'name' => $row->DivisionName
                );
                $i++;
            }
        }
        $responce->date    = date('Y/m/d');
        $responce->success = 1;
        die(json_encode($responce));
    }
    public function del_recipe()
    {
        $Result   = (object) array(
            'success' => 0
        );
        $recipeid = $query = $this->input->post('recipeid');
        $query    = $this->data->get_recipe_details($recipeid);
        if ($query->num_rows() <= 0)
            return;
        $row             = $query->row();
        $ImageFile       = 'user_data/' . $this->session->userdata('parentid') . '/' . $row->Image;
        $Result->success = $this->data->del_recipe($recipeid);
        die(json_encode($Result));
    }
    public function edit_recipe()
    {
        $Result      = (object) array(
            'success' => 0
        );
        $txtname     = $this->input->post('txtname');
        $preptime    = $this->input->post('preptime');
        $ssize       = $this->input->post('ssize');
        $syield      = $this->input->post('syield');
        $txtprice    = $this->input->post('txtprice');
        $txtproc     = $this->input->post('txtproc');
        $typeid      = $this->input->post('typeid');
        $Image       = $this->input->post('image');
        $instruction = $this->input->post('txtinst');
        $uid         = $this->session->userdata('parentid');
        $createdby   = $this->session->userdata('uid');
        $sunit       = $this->input->post('cbsunit');
        $recipeid    = $this->input->post('merchid');
        $Merchandise = array();
        $i           = 0;
        while ($this->input->post('m' . $i) != NULL && trim($this->input->post('m' . $i)) != '') {
            array_push($Merchandise, array(
                'merchid' => $this->input->post('m' . $i),
                'portion' => $this->input->post('p' . $i)
            ));
            $i++;
        }
        $rowid = $this->data->edit_recipe($recipeid, $uid, $createdby, $txtname, $preptime, $ssize, $syield, $txtprice, $txtproc, $typeid, $Merchandise, $Image, $instruction, $sunit);
        if ($rowid >= 0) {
            $Result->success = 1;
            if (trim($Image) != '') {
                try {
                    if (file_exists('user_data/tmp/' . $Image))
                        copy('user_data/tmp/' . $Image, 'user_data/' . $uid . "/" . $Image);
                }
                catch (Exception $exce) {
                }
            }
        } else if ($rowid == -2) {
            $Result->success = -2;
        }
        $Result->id = $rowid;
        die(json_encode($Result));
    }
    public function get_recipe_details()
    {
        $Result              = (object) array(
            'success' => 0
        );
        $repid               = $this->input->post('recipeid');
        $query               = $this->data->get_recipe_details($repid);
        $Result->merchandise = array();
        $i                   = 0;
        foreach ($query->result() as $row) {
            if ($i == 0) {
                $Result->RecipeName            = $row->RecipeName;
                $Result->CategoryID            = $row->CategoryID;
                $Result->StandardYield         = $row->StandardYield;
                $Result->ServingSize           = $row->ServingSize;
                $Result->PricePerServing       = $row->PricePerServing;
                $Result->CostPerServing        = $row->CostPerServing;
                $Result->FC                    = $row->FC;
                $Result->CookingProcedure      = $row->CookingProcedure;
                $Result->PreparationTime       = $row->PreparationTime;
                $Result->CookingSpecifications = $row->CookingSpecifications;
                $Result->catname               = $row->RecipeCategory;
                $Result->sunit                 = $row->sunit;
                $Result->date                  = date("Y/m/d", strtotime($row->DateCreated));
                if (trim($row->Image) == '') {
                    $Result->Image   = 'img/nis.png';
                    $Result->imgFile = "";
                } else {
                    $imgPath         = 'user_data/' . $this->session->userdata('parentid') . '/' . $row->Image;
                    $Result->Image   = site_url($imgPath);
                    $Result->imgFile = $row->Image;
                }
            }
            array_push($Result->merchandise, array(
                'ingid' => $row->IngredientID,
                'ingname' => $row->IngredientName,
                'unit' => $row->UnitOfMeasure,
                'portion' => $row->Portion,
                'ueq' => $row->UnitEquivalent,
                'gps' => $row->gps,
                'unitcost' => $row->UnitCost,
                'csp' => $row->csp
            ));
            $i++;
        }
        $Result->success = 1;
        die(json_encode($Result));
    }

public function create_cropped_thumbnail($image_path, $thumb_width, $thumb_height, $prefix) {

        if (!(is_integer($thumb_width) && $thumb_width > 0) && !($thumb_width === "*")) {
            echo "The width is invalid";
            exit(1);
        }

        if (!(is_integer($thumb_height) && $thumb_height > 0) && !($thumb_height === "*")) {
            echo "The height is invalid";
            exit(1);
        }

        $extension = pathinfo($image_path, PATHINFO_EXTENSION);
        switch ($extension) {
            case "jpg":
            case "jpeg":
                $source_image = imagecreatefromjpeg($image_path);
                break;
            case "gif":
                $source_image = imagecreatefromgif($image_path);
                break;
            case "png":
                $source_image = imagecreatefrompng($image_path);
                break;
            default:
                exit(1);
                break;
        }

        $source_width = imageSX($source_image);
        $source_height = imageSY($source_image);

        if (($source_width / $source_height) == ($thumb_width / $thumb_height)) {
            $source_x = 0;
            $source_y = 0;
        }

        if (($source_width / $source_height) > ($thumb_width / $thumb_height)) {
            $source_y = 0;
            $temp_width = $source_height * $thumb_width / $thumb_height;
            $source_x = ($source_width - $temp_width) / 2;
            $source_width = $temp_width;
        }

        if (($source_width / $source_height) < ($thumb_width / $thumb_height)) {
            $source_x = 0;
            $temp_height = $source_width * $thumb_height / $thumb_width;
            $source_y = ($source_height - $temp_height) / 2;
            $source_height = $temp_height;
        }

        $target_image = ImageCreateTrueColor($thumb_width, $thumb_height);

        imagecopyresampled($target_image, $source_image, 0, 0, $source_x, $source_y, $thumb_width, $thumb_height, $source_width, $source_height);

        switch ($extension) {
            case "jpg":
            case "jpeg":
                imagejpeg($target_image, $prefix . "" . $image_path);
                break;
            case "gif":
                imagegif($target_image, $prefix . "" . $image_path);
                break;
            case "png":
                imagepng($target_image, $prefix . "" . $image_path);
                break;
            default:
                exit(1);
                break;
        }

        imagedestroy($target_image);
        imagedestroy($source_image);
    }

    public function add_recipe()
    {
        $Result      = (object) array(
            'success' => 0,
            'message' => ''
        );
        $txtname     = $this->input->post('txtname');
        $preptime    = $this->input->post('preptime');
        $ssize       = $this->input->post('ssize');
        $syield      = $this->input->post('syield');
        $txtprice    = $this->input->post('txtprice');
        $txtproc     = $this->input->post('txtproc');
        $typeid      = $this->input->post('typeid');
        $Image       = $this->input->post('image');
        $instruction = $this->input->post('txtinst');
        $sunit       = $this->input->post('cbsunit');
        $uid         = $this->session->userdata('parentid');
        $createdby   = $this->session->userdata('uid');
        $Merchandise = array();
        $i           = 0;
        while ($this->input->post('m' . $i) != NULL && trim($this->input->post('m' . $i)) != '') {
            array_push($Merchandise, array(
                'merchid' => $this->input->post('m' . $i),
                'portion' => $this->input->post('p' . $i)
            ));
            $i++;
        }
        
        $rowid = $this->data->add_recipe($uid, $createdby, $txtname, $preptime, $ssize, $syield, $txtprice, $txtproc, $typeid, $Merchandise, $Image, $instruction, $sunit);
        
        $imageURL = "'"."user_data/".$uid."/".$Image."'";
        
        if ($rowid >= 0) {
            $Result->success = 1;

            if (trim($Image) != '') {
                try {
                    copy('user_data/tmp/' . $Image, 'user_data/' . $uid . "/" . $Image);
                }
                catch (Exception $exce) {
                }
            }
        } else if ($rowid == -2) {
            $Result->success = -2;
        }
        $Result->id = $rowid; 
        
        if (trim($Image) != '') $this->create_cropped_thumbnail('user_data/' . $uid . "/" . $Image,  400, 300,'');  

        die(json_encode($Result));
        // echo json_encode($Result); 
    }

    public function get_recipes()
    {
		$responce = (object) array();
        $page              = $this->input->post('page');
        $total_pages       = 1;
        $count             = 0;
        $responce->page    = $page;
        $responce->total   = $total_pages;
        $ParentID          = $this->session->userdata('parentid');
        $query             = $this->data->get_recipes($ParentID);
        $responce->records = $query->num_rows();
        $i                 = 0;
        foreach ($query->result() as $row) {
            $img = "";
            if (trim($row->Image) == '')
                $img = site_url('img/ni.png');
            else
                $img = site_url('user_data') . '/' . $ParentID . '/' . $row->Image;
            $responce->rows[$i]['id']   = $row->ID;
            $responce->rows[$i]['cell'] = array(
                $row->RecipeName,
                $row->CategoryID,
                $row->StandardYield,
                $row->ServingSize,
                $row->CookingProcedure,
                $row->RecipeCategory,
                $img
            );
            $i++;
        }
        die(json_encode($responce));
    }
    public function register()
    {
        $Result         = (object) array(
            'success' => 0,
            'message' => '',
            'data1' => '',
            'data2' => '',
            'data3' => ''
        );
        $username       = $this->input->post('txtusername');
        $password       = $this->input->post('txtpass');
        $user_business  = $this->input->post('txtbusiness');
        $item_number    = $this->input->post('item_number');
        $user_email     = $this->input->post('txtemail');
        $checkDuplicate = $this->data->check_username_email($username, $user_email);
        if ($checkDuplicate != 0) {
            if ($checkDuplicate == 1)
                $Result->message = "Username already exists!";
            else if ($checkDuplicate == 2)
                $Result->message = "Email address already exists!";
            die(json_encode($Result));
        }
        $usertype = 1;
        $parent   = -1;
        $InsertID = $this->data->Register_User($usertype, $parent, $username, $password, $user_email, $user_business, $item_number);
        if ($this->data->GetoptionValue('sandbox', '1') == '1')
            $Result->purl = "https://www.sandbox.paypal.com/cgi-bin/webscr";
        else
            $Result->purl = "https://www.paypal.com/cgi-bin/webscr";
        $Result->pm      = $this->data->GetoptionValue('paypal_email', '');
        $Result->data1   = $InsertID->payid;
        $Result->success = 1;
        $Result->payid   = $InsertID->payid;
        $Result->item    = $InsertID->item;
        $Result->price   = $InsertID->price;
        $Result->base    = site_url('');
        die(json_encode($Result));
    }
    function typesandmeasures()
    {
        $responce        = (object) array();
        $responce->types = array();
        $responce->units = array();
        $i               = 0;
        if ($this->input->post('type') == '') {
            $query = $this->data->Get_Types($this->session->userdata('parentid'));
            foreach ($query->result() as $row) {
                $responce->types[$i] = array(
                    'id' => $row->ID,
                    'name' => $row->IngredientType
                );
                $i++;
            }
            $query = $this->data->Get_Units($this->session->userdata('parentid'));
            $i     = 0;
            foreach ($query->result() as $row) {
                $responce->units[$i] = array(
                    'id' => $row->ID,
                    'name' => $row->UnitOfMeasure
                );
                $i++;
            }
            $query = $this->data->Get_umm($this->session->userdata('parentid'));
            $i     = 0;
            foreach ($query->result() as $row) {
                $responce->umm[$i] = array(
                    'id' => $row->ID,
                    'name' => $row->UnitOfMeasure
                );
                $i++;
            }
        } else {
            $query = $this->data->Get_Units($this->session->userdata('parentid'));
            $i     = 0;
            foreach ($query->result() as $row) {
                $responce->rows[$i]['id']   = $row->ID;
                $responce->rows[$i]['cell'] = array(
                    'id' => $row->ID,
                    'name' => $row->UnitOfMeasure
                );
                $i++;
            }
        }
        die(json_encode($responce));
    }
    function get_categories()
    {
        $query           = $this->data->Get_Categories($this->session->userdata('parentid'));
        $responce        = (object) array();
        $responce->types = array();
        $responce->units = array();
        $i               = 0;
        if ($this->input->post('type') == '') {
            foreach ($query->result() as $row) {
                $responce->cats[$i] = array(
                    'id' => $row->ID,
                    'name' => $row->RecipeCategory
                );
                $i++;
            }
            $query = $this->data->get_merchandise($this->session->userdata('parentid'));
            $i     = 0;
            foreach ($query->result() as $row) {
                $responce->merch[$i] = array(
                    'id' => $row->ID,
                    'name' => $row->IngredientName,
                    'unit' => $row->UnitOfMeasure,
                    'cunit' => $row->ConvertedUnitOfMeasure
                );
                $i++;
            }
        } else {
            $i = 0;
            foreach ($query->result() as $row) {
                $responce->rows[$i]['id']   = $row->ID;
                $responce->rows[$i]['cell'] = array(
                    'id' => $row->ID,
                    'name' => $row->RecipeCategory
                );
                $i++;
            }
        }
        die(json_encode($responce));
    }
    function get_merchandise()
    {
        $responce		   = (object) array();
		$page              = $this->input->post('page');
        $total_pages       = 1;
        $count             = 0;
        $responce->page    = $page;
        $responce->total   = $total_pages;
        $query             = $this->data->get_merchandise($this->session->userdata('parentid'));
        $responce->records = $query->num_rows();
        $i                 = 0;
        foreach ($query->result() as $row) {
            $responce->rows[$i]['id']   = $row->ID;
            $responce->rows[$i]['cell'] = array(
                $row->IngredientName,
                $row->IngredientType,
                $row->UnitEquivalent,
                $row->UnitOfMeasure,
                $row->ConvertedUnitOfMeasure,
                $row->UnitCost,
                $row->CookingLoss,
                $row->TypeID
            );
            $i++;
        }
        die(json_encode($responce));
    }
    function edit_merchandise()
    {
        $Result                 = (object) array(
            'success' => 0,
            'message' => '',
            'data1' => '',
            'data2' => '',
            'data3' => ''
        );
        $merchId                = $this->input->post('merchid');
        $IngredientName         = $this->input->post('mname');
        $TypeID                 = $this->input->post('typeid');
        $UnitEquivalent         = $this->input->post('uq');
        $UnitOfMeasure          = $this->input->post('uom');
        $ConvertedUnitOfMeasure = $this->input->post('cuom');
        $UnitCost               = $this->input->post('ucost');
        $CookingLoss            = $this->input->post('loss');
        $uid                    = $this->session->userdata('parentid');
        $affected               = $this->data->update_merchandise($merchId, $IngredientName, $TypeID, $UnitEquivalent, $UnitOfMeasure, $ConvertedUnitOfMeasure, $UnitCost, $CookingLoss, $uid);
        if ($affected > 0) {
            $Result->success = 1;
        }
        if ($affected == -2) {
            $Result->success = -2;
        }
        $Result->data1 = $affected;
        die(json_encode($Result));
    }
    function add_merchandise()
    {
        $Result                 = (object) array(
            'success' => 0,
            'message' => '',
            'data1' => '',
            'data2' => '',
            'data3' => ''
        );
        $IngredientName         = $this->input->post('mname');
        $TypeID                 = $this->input->post('typeid');
        $UnitEquivalent         = $this->input->post('uq');
        $UnitOfMeasure          = $this->input->post('uom');
        $ConvertedUnitOfMeasure = $this->input->post('cuom');
        $UnitCost               = $this->input->post('ucost');
        $CookingLoss            = $this->input->post('loss');
        $uid                    = $this->session->userdata('parentid');
        $createdby              = $this->session->userdata('uid');
        $rowid                  = $this->data->add_merchandise($uid, $createdby, $IngredientName, $TypeID, $UnitEquivalent, $UnitOfMeasure, $ConvertedUnitOfMeasure, $UnitCost, $CookingLoss);
        if ($rowid >= 0) {
            $Result->success = 1;
        }
        if ($rowid == -2) {
            $Result->success = -2;
        }
        $Result->id = $rowid;
        die(json_encode($Result));
    }
    function del_merchandise()
    {
        $Result          = (object) array(
            'success' => 0
        );
        $Result->success = $this->data->del_merchandise($this->input->post('merchid'));
        die(json_encode($Result));
    }
}