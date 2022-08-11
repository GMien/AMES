<?php
class Data extends CI_Model
{
    public $sFullAccess = "am,em,dm,xm,im,ar,mr,dr,pr,al,rl,pl,vp,vmp,vrp,vlp,vc,mta,mte,mtd,rca,rce,rcd,uma,ume,umd,ola,ole,old,dva,dve,dvd,vemp,aemp,eemp,demp,umma,ummd,umme";
    function __construct()
    {
        parent::__construct();
		header("Access-Control-Allow-Origin: *");	
    }
    function GetOptionValue($OptionName, $default)
    {
        $query = $this->db->query('SELECT option_value FROM tbl_options where option_name = ? LIMIT 1', array(
            $OptionName
        ));
        if ($query->num_rows() > 0)
            return trim($query->Row()->option_value);
        else
            return $default;
    }
    function SetOptionValue($OptionName, $OptionValue)
    {
        $query = $this->db->query('Update tbl_options set option_value = ? where option_name = ? LIMIT 1', array(
            $OptionValue,
            $OptionName
        ));
    }
    function updatebusiness($uid, $Businessname)
    {
        $sql   = " update  tbl_user set user_business= ?  where uid = ?";
        $query = $this->db->query($sql, array(
            $Businessname,
            $uid
        ));
        return 0;
    }
    function payment_report()
    {
        $sql   = " Select pay_id, p.uid, u.username, u.user_business,  item_name, mc_gross, f_trantime  from tbl_payments p 
             inner join tbl_user u on u.uid = p.uid
             where f_completed=1 order by f_trantime ";
        $query = $this->db->query($sql);
        return $query;
    }
    function edtpricing($id, $packagename, $packagedesc, $info1, $info2, $info3, $info4, $price, $days)
    {
        $sql   = " update  tbl_packages set packagename= ?, packagedesc=?, info1=?, info2=?, info3=?, info4=?, price=?, days=?   where pkid = ?";
        $query = $this->db->query($sql, array(
            $packagename,
            $packagedesc,
            $info1,
            $info2,
            $info3,
            $info4,
            $price,
            $days,
            $id
        ));
        return 0;
    }
    function pricing()
    {
        $sql   = " select * from tbl_packages order by pkid";
        $query = $this->db->query($sql);
        return $query;
    }
    function buyPackage($pkid, $parentid)
    {
        $rowPackage            = $this->get_package_info($pkid);
        $rowUser               = $this->getUserInfoRow($parentid);
        $query                 = $this->db->query('Insert Into tbl_payments  (p_buyer_name, p_buyer_email, p_buyer_business, p_password, item_name, item_number, mc_gross, f_completed, uid ) values(?,?,?,?,?,?,?,?,?)', array(
            $rowUser->username,
            $rowUser->user_email,
            $rowUser->user_business,
            "",
            $rowPackage->packagename . '-' . $rowPackage->packagedesc,
            $rowPackage->pkid,
            $rowPackage->price,
            0,
            $parentid
        ));
        $reault["payid"]       = $this->db->insert_id();
        $reault["price"]       = $rowPackage->price;
        $reault["item"]        = $rowPackage->packagename . '-' . $rowPackage->packagedesc;
        $reault["paypalemail"] = $this->GetOptionValue('paypal_email', '');
        if ($this->data->GetoptionValue('sandbox', '1') == '1')
            $reault["paypalurl"] = "https://www.sandbox.paypal.com/cgi-bin/webscr";
        else
            $reault["paypalurl"] = "https://www.paypal.com/cgi-bin/webscr";
        $reault["success"] = 1;
        return $reault;
    }
    function Register_UserAdmin($responce, $amount, $desc, $email, $days, $name, $password, $user_business)
    {
        $query  = $this->db->query('Insert Into tbl_payments  (p_buyer_name, p_buyer_email, p_buyer_business, p_password, item_name, item_number, mc_gross, f_completed ) values(?,?,?,?,?,?,?,?)', array(
            $name,
            $email,
            $user_business,
            $password,
            $desc,
            220,
            $amount,
            0
        ));
        $pay_id = $this->db->insert_id();
        $this->Prepare_Payment($pay_id, $days);
    }
    function Prepare_Payment($pay_id, $days)
    {
        $sql      = " select * from tbl_payments where pay_id = ?";
        $row      = $this->db->query($sql, $pay_id)->row();
        $Username = $row->p_buyer_name;
        $PkgID    = $row->item_number;
        $user_id  = $row->uid;
        if ($days <= 0) {
            $sql  = " select * from tbl_packages where pkid = ?";
            $row  = $this->db->query($sql, $PkgID)->row();
            $days = $row->days + 1;
        } else {
            $this->db->query("update tbl_payments set f_completed = 1  where pay_id = ?", $pay_id);
            $days = $days + 1;
        }
        $sql   = " select * from tbl_user where trim(username) = ?";
        $query = $this->db->query($sql, $Username);
        if ($query->num_rows() == 0) {
            $sql     = " insert into tbl_user (parent,username,password,usertype, user_email,user_business,deleted,user_access, expire_date   ) select -1, p_buyer_name, p_password, 1, p_buyer_email, p_buyer_business, 0, ?, DATE_ADD(UTC_DATE(),INTERVAL " . $days . " DAY) from tbl_payments where pay_id = ?";
            $query   = $this->db->query($sql, array(
                $this->sFullAccess,
                $pay_id
            ));
            $user_id = $this->db->insert_id();
            $this->db->query(" call MakedefaultRecords(" . $user_id . ") ");
			
			$this->updateRecipeCategories($user_id);
			$this->updateIngredientsType($user_id);
			$this->insertAssociation($user_id);
			
            $this->db->query("update tbl_user set parent = uid where usertype=1");
            $this->db->query("update tbl_payments set uid = ?  where pay_id = ?", array(
                $user_id,
                $pay_id
            ));
        } else {
            $sql = "update tbl_user set expire_date = DATE_ADD(expire_date,INTERVAL " . $days . " DAY) where parent=? and usertype=1";
            $this->db->query($sql, $user_id);
        }
    }
    function getUserInfoRow($uid)
    {
        $sql   = " select * from tbl_user where uid = ?";
        $query = $this->db->query($sql, $uid);
        return $query->row();
    }
    function getParent_User($ParentID)
    {
        $sql   = " select * from tbl_user where uid = ?";
        $query = $this->db->query($sql, $ParentID);
        return $query->row();
    }
    function LoginUserPayment($user, $pass)
    {
        $sql   = " select * from tbl_payments where trim(p_buyer_name) = ? and trim(p_password) = ?";
        $query = $this->db->query($sql, array(
            $user,
            $pass
        ));
        return $query->row();
    }
    function LoginUser($user, $pass)
    {
        $sql   = " select * from tbl_user where trim(username) = ? and trim(password) = ?";
        $query = $this->db->query($sql, array(
            $user,
            $pass
        ));
		if($query){
			//echo "1";
		}else{
			//echo "0";
		}
        return $query->row();
    }
    function getpackages()
    {
        $sql   = "select * from tbl_packages order by pkid";
        $query = $this->db->query($sql);
        return $query;
    }
    function get_package_info($pkid)
    {
        $sql   = "select * from tbl_packages where pkid = ?";
        $query = $this->db->query($sql, $pkid);
        return $query->row();
    }
    function changepass($uid, $password, $ParentID)
    {
        $sql   = "update tbl_user set password = ? where uid = ? and parent=?";
        $query = $this->db->query($sql, array(
            $password,
            $uid,
            $ParentID
        ));
        return 0;
    }
    function deluser($uid, $ParentID)
    {
        $sql   = "update tbl_user set deleted = 1 where uid = ? and parent=? and usertype=0";
        $query = $this->db->query($sql, array(
            $uid,
            $ParentID
        ));
        return 0;
    }
    function EditUser($uid, $username, $password, $ParentID, $sAccess)
    {
        $sql   = "select * from tbl_user where trim(username) = trim(?) and uid!=?";
        $query = $this->db->query($sql, array(
            $username,
            $uid
        ));
        if ($query->num_rows() > 0) {
            return 2;
        } else {
            $sql   = "update tbl_user set username = trim(?), password = trim(?), user_access = ?  where uid = ? and parent=?";
            $query = $this->db->query($sql, array(
                $username,
                $password,
                $sAccess,
                $uid,
                $ParentID
            ));
            return 0;
        }
    }
    function userinfo($uid, $ParentID)
    {
        $sql   = "select u.*, case u.usertype when 0 then 'Employee' when 1 then 'Admin' when 2 then 'Website Admin' end role from tbl_user u  where uid = ? and parent=?";
        $query = $this->db->query($sql, array(
            $uid,
            $ParentID
        ));
        return $query;
    }
    function AddUser($username, $password, $ParentID, $sAccess)
    {
        $sql   = "select * from tbl_user where trim(username) = trim(?) and parent=?";
        $query = $this->db->query($sql, array(
            $username,
            $ParentID
        ));
        if ($query->num_rows() > 0) {
            return -2;
        } else {
            $sql   = "insert into tbl_user(username, password, usertype, user_email, user_business, user_access, parent )
		 values(?,?,0,'','',?,?) ";
            $query = $this->db->query($sql, array(
                $username,
                $password,
                $sAccess,
                $ParentID
            ));
            return 0;
        }
    }
    function Get_User_Pass($uid)
    {
        $sql   = "select * from tbl_user where uid=?";
        $query = $this->db->query($sql, array(
            $uid
        ));
        $row   = $query->row();
        return $row->password;
    }
    function Get_User_Type($uid)
    {
        $sql   = "select * from tbl_user where uid=?";
        $query = $this->db->query($sql, array(
            $uid
        ));
        $row   = $query->row();
        return $row->usertype;
    }
    function Get_User_Access($uid)
    {
        $sql   = "select * from tbl_user where uid=?";
        $query = $this->db->query($sql, array(
            $uid
        ));
        $row   = $query->row();
        return $row->user_access;
    }
    function GetUsers($ParentID, $CurrentID)
    {
        $bAll     = false;
        $usertype = $this->Get_User_Type($CurrentID);
        if ($usertype == 0)
            $bAll = true;
        else {
            $sAccess = "," . $this->Get_User_Access($CurrentID) . ",";
            if (strpos($sAccess, 'vemp'))
                $bAll = true;
        }
        if ($usertype == 2) {
            $sql   = "select u.uid, u.username, u.parent, u2.user_business,u.datecreate, u.expire_date, u.user_email, 
		
		case u.usertype when 0 then 'Employee' when 1 then 'Admin' when 2 then 'Website Admin' end role, u.password
		
		 from tbl_user u
left outer join tbl_user u2 on u.parent = u2.uid where u.deleted =0 and u.usertype != 2";
            $query = $this->db->query($sql, array(
                $ParentID,
                $CurrentID
            ));
            return $query;
        } else {
            if ($bAll) {
                $sql   = "select u.*, case u.usertype when 0 then 'Employee' when 1 then 'Admin' when 2 then 'Website Admin' end role from       tbl_user u where parent = ? and deleted =0";
                $query = $this->db->query($sql, array(
                    $ParentID
                ));
                return $query;
            } else {
                $sql   = "select u.*, case u.usertype when 0 then 'Employee' when 1 then 'Admin' when 2 then 'Website Admin' end role from tbl_user u where parent = ? and deleted =0 and uid = ?";
                $query = $this->db->query($sql, array(
                    $ParentID,
                    $CurrentID
                ));
                return $query;
            }
        }
    }
    function DelDiv($mid, $ParentID)
    {
        $sql   = "select * from marketlist where DivisionID = ? and uid=?";
        $query = $this->db->query($sql, array(
            $mid,
            $ParentID
        ));
        if ($query->num_rows() > 0) {
            return -2;
        } else {
            $sql   = "delete from divisions where ID = ? and uid=?";
            $query = $this->db->query($sql, array(
                $mid,
                $ParentID
            ));
            return 0;
        }
    }
    function AddDiv($name, $ParentID)
    {
        $sql   = "select * from divisions where trim(DivisionName) = ? and uid=?";
        $query = $this->db->query($sql, array(
            $name,
            $ParentID
        ));
        if ($query->num_rows() > 0) {
            return -2;
        } else {
            $sql   = "insert into divisions (DivisionName, uid, createdby) values(trim(?),?,? )";
            $query = $this->db->query($sql, array(
                $name,
                $ParentID,
                $ParentID
            ));
            return 0;
        }
    }
    function Edit_Div($id, $name, $ParentID)
    {
        $sql   = "select * from divisions where trim(DivisionName) = ? and uid=? and ID != ?";
        $query = $this->db->query($sql, array(
            $name,
            $ParentID,
            $id
        ));
        if ($query->num_rows() > 0) {
            return 2;
        } else {
            $sql   = "update divisions set DivisionName = trim(?) where ID = ?";
            $query = $this->db->query($sql, array(
                $name,
                $id
            ));
            return 0;
        }
    }
    function DelOut($mid, $ParentID)
    {
        $sql   = "select * from marketlist where OutletID = ? and uid=?";
        $query = $this->db->query($sql, array(
            $mid,
            $ParentID
        ));
        if ($query->num_rows() > 0) {
            return -2;
        } else {
            $sql   = "delete from outlets where ID = ? and uid=?";
            $query = $this->db->query($sql, array(
                $mid,
                $ParentID
            ));
            return 0;
        }
    }
    function AddOut($name, $ParentID)
    {
        $sql   = "select * from outlets where trim(OutletName) = ? and uid=?";
        $query = $this->db->query($sql, array(
            $name,
            $ParentID
        ));
        if ($query->num_rows() > 0) {
            return -2;
        } else {
            $sql   = "insert into outlets (OutletName, uid, createdby) values(trim(?),?,? )";
            $query = $this->db->query($sql, array(
                $name,
                $ParentID,
                $ParentID
            ));
            return 0;
        }
    }
    function Edit_Out($id, $name, $ParentID)
    {
        $sql   = "select * from outlets where trim(OutletName) = ? and uid=? and ID != ?";
        $query = $this->db->query($sql, array(
            $name,
            $ParentID,
            $id
        ));
        if ($query->num_rows() > 0) {
            return 2;
        } else {
            $sql   = "update outlets set OutletName = trim(?) where ID = ?";
            $query = $this->db->query($sql, array(
                $name,
                $id
            ));
            return 0;
        }
    }
    function DelMea($mid, $ParentID)
    {
        $sql   = "delete from units where ID = ? and uid=?";
        $query = $this->db->query($sql, array(
            $mid,
            $ParentID
        ));
        return 0;
    }
    function Delumm($mid, $ParentID)
    {
        $sql   = "delete from unitms where ID = ? and uid=?";
        $query = $this->db->query($sql, array(
            $mid,
            $ParentID
        ));
        return 0;
    }
    function AddMea($name, $ParentID)
    {
        $sql   = "select * from units where trim(UnitOfMeasure) = ? and uid=?";
        $query = $this->db->query($sql, array(
            $name,
            $ParentID
        ));
        if ($query->num_rows() > 0) {
            return -2;
        } else {
            $sql   = "insert into units (UnitOfMeasure, uid, createdby) values(trim(?),?,? )";
            $query = $this->db->query($sql, array(
                $name,
                $ParentID,
                $ParentID
            ));
            return 0;
        }
    }
    function AddUmm($name, $ParentID)
    {
        $sql   = "select * from unitms where trim(UnitOfMeasure) = ? and uid=?";
        $query = $this->db->query($sql, array(
            $name,
            $ParentID
        ));
        if ($query->num_rows() > 0) {
            return -2;
        } else {
            $sql   = "insert into unitms (UnitOfMeasure, uid, createdby) values(trim(?),?,? )";
            $query = $this->db->query($sql, array(
                $name,
                $ParentID,
                $ParentID
            ));
            return 0;
        }
    }
    function Edit_Mea($id, $name, $ParentID)
    {
        $sql   = "select * from units where trim(UnitOfMeasure) = ? and uid=? and ID != ?";
        $query = $this->db->query($sql, array(
            $name,
            $ParentID,
            $id
        ));
        if ($query->num_rows() > 0) {
            return 2;
        } else {
            $sql   = "update units set UnitOfMeasure = trim(?) where ID = ?";
            $query = $this->db->query($sql, array(
                $name,
                $id
            ));
            return 0;
        }
    }
    function Edit_umm($id, $name, $ParentID)
    {
        $sql   = "select * from unitms where trim(UnitOfMeasure) = ? and uid=? and ID != ?";
        $query = $this->db->query($sql, array(
            $name,
            $ParentID,
            $id
        ));
        if ($query->num_rows() > 0) {
            return 2;
        } else {
            $sql   = "update unitms set UnitOfMeasure = trim(?) where ID = ?";
            $query = $this->db->query($sql, array(
                $name,
                $id
            ));
            return 0;
        }
    }
    function DelCat($mid, $ParentID)
    {
        $sql   = "select * from recipes where CategoryID = ? and uid=?";
        $query = $this->db->query($sql, array(
            $mid,
            $ParentID
        ));
        if ($query->num_rows() > 0) {
            return -2;
        } else {
            $sql   = "delete from categories where ID = ? and uid=?";
            $query = $this->db->query($sql, array(
                $mid,
                $ParentID
            ));
            return 0;
        }
    }
    function AddCat($name, $ParentID)
    {
        $sql   = "select * from categories where trim(RecipeCategory) = ? and uid=?";
        $query = $this->db->query($sql, array(
            $name,
            $ParentID
        ));
        if ($query->num_rows() > 0) {
            return -2;
        } else {
            $sql   = "insert into categories (RecipeCategory, uid, createdby) values(trim(?),?,? )";
            $query = $this->db->query($sql, array(
                $name,
                $ParentID,
                $ParentID
            ));
            return 0;
        }
    }
    function Edit_Cats($id, $name, $ParentID)
    {
        $sql   = "select * from categories where trim(RecipeCategory) = ? and uid=? and ID != ?";
        $query = $this->db->query($sql, array(
            $name,
            $ParentID,
            $id
        ));
        if ($query->num_rows() > 0) {
            return 2;
        } else {
            $sql   = "update categories set RecipeCategory = trim(?) where ID = ?";
            $query = $this->db->query($sql, array(
                $name,
                $id
            ));
            return 0;
        }
    }
    function Del_Merchtype($mid, $ParentID)
    {
        $sql   = "select * from ingredients where TypeID = ? and uid=?";
        $query = $this->db->query($sql, array(
            $mid,
            $ParentID
        ));
        if ($query->num_rows() > 0) {
            return -2;
        } else {
            $sql   = "delete from types where ID = ? and uid=?";
            $query = $this->db->query($sql, array(
                $mid,
                $ParentID
            ));
            return 0;
        }
    }
    function Add_Merch_Type($name, $ParentID)
    {
        $sql   = "select * from types where trim(IngredientType) = ? and uid=?";
        $query = $this->db->query($sql, array(
            $name,
            $ParentID
        ));
        if ($query->num_rows() > 0) {
            return -2;
        } else {
            $sql   = "insert into types (IngredientType, uid, createdby) values(trim(?),?,? )";
            $query = $this->db->query($sql, array(
                $name,
                $ParentID,
                $ParentID
            ));
            return 0;
        }
    }
    function get_merchtype($uid)
    {
        $sql   = "select * from types where uid=? order by IngredientType";
        $query = $this->db->query($sql, array(
            $uid
        ));
        return $query;
    }
    function Edit_Merch_Type($id, $name, $ParentID)
    {
        $sql   = "select * from types where trim(IngredientType) = ? and uid=? and ID != ?";
        $query = $this->db->query($sql, array(
            $name,
            $ParentID,
            $id
        ));
        if ($query->num_rows() > 0) {
            return 2;
        } else {
            $sql   = "update types set IngredientType = trim(?) where ID = ?";
            $query = $this->db->query($sql, array(
                $name,
                $id
            ));
            return 0;
        }
    }
    function Add_Marketlist($OutletID, $MarketDate, $FunctionID, $Recipes, $uid)
    {
        $InsertID = -1;
        $this->db->trans_start();
        $sIDs = "(";
        try {
            $i = 0;
            foreach ($Recipes as $key => $item) {
                $sSQL = " call SaveMarketList(?,?,?,?,?,?) ";
                $this->db->query($sSQL, array(
                    $OutletID,
                    $MarketDate,
                    $FunctionID,
                    $item['rid'],
                    $item['qt'],
                    $uid
                ));
                $InsertID = $this->db->insert_id();
                $sIDs     = $sIDs . $item['rid'] . ",";
            }
            $sIDs = $sIDs . "-1)";
            $sSQL = " Delete from marketlist where OutletID = ? and DateFor=? and DivisionID = ? and uid = ? and RecipeID not in " . $sIDs;
            $this->db->query($sSQL, array(
                $OutletID,
                $MarketDate,
                $FunctionID,
                $uid
            ));
        }
        catch (Exception $ex) {
            $this->db->trans_rollback();
            return -1;
        }
        $this->db->trans_complete();
        return $InsertID;
    }
    function Get_Marketlist_Data($OutletID, $MarketDate, $FunctionID, $uid)
    {
        $sSQL  = " Select m.ID, RecipeID, RecipeName,Quantity from marketlist m inner JOIN recipes r on m.RecipeID = r.ID where OutletID=? and DateFor=? and DivisionID=? and m.uid=? ";
        $query = $this->db->query($sSQL, array(
            $OutletID,
            $MarketDate,
            $FunctionID,
            $uid
        ));
        return $query;
    }
    function Get_Marketlist_Report($OutletID, $FunctionID, $FromDate, $ToDate, $uid)
    {
        $sSQL  = "Select IngredientID, IngredientName, t.IngredientType, concat(CONCAT(UnitOfMeasure,'-'),ConvertedUnitOfMeasure) UnitOfMeasure, 
       UnitEquivalent, UnitCost ,CategoryID, 
sum(ReqquiredPortion) ReqquiredPortion, sum(ToOrder)ToOrder, sum(TotalCost)TotalCost   from ";
        $sTmp  = "(

 Select t.RecipeID, t.Quantity ,


a.IngredientID, CategoryID,
round(a.Portion * t.Quantity / r.StandardYield  * (1+ (i.CookingLoss/100)),2)  ReqquiredPortion,
round(  (a.Portion * t.Quantity / r.StandardYield  * (1+ (i.CookingLoss/100)))/i.UnitEquivalent   ,2)  ToOrder,
round( round((a.Portion * t.Quantity / r.StandardYield  * (1+ (i.CookingLoss/100)))/i.UnitEquivalent   ,2)*i.UnitCost,2)   TotalCost

 from marketlist t 


 inner join recipes r on t.RecipeID = r.id
 inner join association a on r.id = a.RecipeID
 inner join ingredients i on i.id = a.IngredientID 

where t.DivisionID=" . $FunctionID . " and t.OutletID=" . $OutletID . " and t.uid=" . $uid . " and t.DateFor>='" . $FromDate . "' and 
t.DateFor<='" . $ToDate . "'

 ) recipes";
        $sSQL  = $sSQL . $sTmp;
        $sSQL  = $sSQL . " inner join ingredients i on i.id = IngredientID
inner join categories c on CategoryID = c.ID
inner join  types t on i.TypeID = t.id
group by IngredientID, IngredientName, UnitOfMeasure, 
       UnitEquivalent, UnitCost, IngredientType ";
        $query = $this->db->query($sSQL);
        return $query;
    }
    function Get_Marketlist_Details($Recipes)
    {
        $sSQL = "Select IngredientID, IngredientName, t.IngredientType, concat(CONCAT(UnitOfMeasure,'-'),ConvertedUnitOfMeasure) UnitOfMeasure, 
       UnitEquivalent, UnitCost ,CategoryID, 
sum(ReqquiredPortion) ReqquiredPortion, sum(ToOrder)ToOrder, sum(TotalCost)TotalCost   from ";
        $sTmp = "";
        foreach ($Recipes as $key => $item) {
            if (trim($sTmp) != "")
                $sTmp = $sTmp . " Union All ";
            $sTmp = $sTmp . " Select r.ID RecipeID, " . $item["qt"] . " ,

a.IngredientID, CategoryID,
round(a.Portion * " . $item["qt"] . " / r.StandardYield  * (1+ (i.CookingLoss/100)),2)  ReqquiredPortion,
round(  (a.Portion * " . $item["qt"] . " / r.StandardYield  * (1+ (i.CookingLoss/100)))/i.UnitEquivalent   ,2)  ToOrder,
round( round((a.Portion * " . $item["qt"] . " / r.StandardYield  * (1+ (i.CookingLoss/100)))/i.UnitEquivalent   ,2)*i.UnitCost,2)   TotalCost

 from  recipes r 
 inner join association a on r.id = a.RecipeID
 inner join ingredients i on i.id = a.IngredientID 

where r.ID =  " . $item["rid"];
        }
        if (trim($sTmp) != "")
            $sTmp = "( " . $sTmp . " ) recipes";
        else
            $sTmp = "( select 0 RecipeID, 0 CategoryID, 0 IngredientID, 0 ReqquiredPortion, 0 ToOrder, 0 TotalCost ) recipes";
        $sSQL  = $sSQL . $sTmp;
        $sSQL  = $sSQL . " inner join ingredients i on i.id = IngredientID
inner join categories c on CategoryID = c.ID
inner join  types t on i.TypeID = t.id
group by IngredientID, IngredientName, UnitOfMeasure, 
       UnitEquivalent, UnitCost, IngredientType ";
        $query = $this->db->query($sSQL);
        return $query;
    }
    function Get_Marketlist_Details_old($OutletID, $MarketDate, $FunctionID, $uid)
    {
        $sSQL = "Select IngredientID, IngredientName, t.IngredientType, concat(CONCAT(UnitOfMeasure,'-'),ConvertedUnitOfMeasure) UnitOfMeasure, 
       UnitEquivalent, UnitCost ,CategoryID, 
sum(ReqquiredPortion) ReqquiredPortion, sum(ToOrder)ToOrder, sum(TotalCost)TotalCost   from ";
        $sTmp = "(

 Select t.RecipeID, t.Quantity ,


a.IngredientID, CategoryID,
round(a.Portion * t.Quantity / r.StandardYield  * (1+ (i.CookingLoss/100)),2)  ReqquiredPortion,
round(  (a.Portion * t.Quantity / r.StandardYield  * (1+ (i.CookingLoss/100)))/i.UnitEquivalent   ,2)  ToOrder,
round( round((a.Portion * t.Quantity / r.StandardYield  * (1+ (i.CookingLoss/100)))/i.UnitEquivalent   ,2)*i.UnitCost,2)   TotalCost

 from marketlist t 


 inner join recipes r on t.RecipeID = r.id
 inner join association a on r.id = a.RecipeID
 inner join ingredients i on i.id = a.IngredientID 

where t.DivisionID=" . $FunctionID . " and t.OutletID=" . $OutletID . " and t.uid=" . $uid . " and t.DateFor='" . $MarketDate . "'

 ) recipes";
        $sSQL = $sSQL . $sTmp;
        $sSQL = $sSQL . " inner join ingredients i on i.id = IngredientID
inner join categories c on CategoryID = c.ID
inner join  types t on i.TypeID = t.id
group by IngredientID, IngredientName, UnitOfMeasure, 
       UnitEquivalent, UnitCost, IngredientType ";
        die($sSQL);
        $query = $this->db->query($sSQL);
        return $query;
    }
    function get_outlets_list($uid)
    {
        $sql   = ' select * from outlets where uid = ? order by OutletName';
        $query = $this->db->query($sql, $uid);
        return $query;
    }
    function get_divisions($uid)
    {
        $sql   = ' select * from divisions where uid = ? order by DivisionName';
        $query = $this->db->query($sql, $uid);
        return $query;
    }
    function get_recipe_details($id)
    {
        $sql   = ' select a.IngredientID, a.Portion, round(Portion + (Portion*CookingLoss/100),2) gps,i.UnitCost,i.CookingLoss, 
   round((Portion + (Portion*CookingLoss/100))/i.UnitEquivalent*i.UnitCost   ,2) csp, i.IngredientName, i.ConvertedUnitOfMeasure UnitOfMeasure, c.RecipeCategory, i.UnitEquivalent, r.* from recipes r 
            inner join association a on r.id = a.RecipeID
            inner join ingredients i on i.id = a.IngredientID
			inner join categories c on r.CategoryID = c.ID
            where r.id = ? order by i.IngredientName';
        $query = $this->db->query($sql, $id);
        return $query;
    }
    function Update_Cost_FC($recipeID, $Percent)
    {
        $sql   = ' select  round((sum( (Portion*(1+(CookingLoss/100)))/UnitEquivalent*UnitCost ) +  (sum( (Portion*(1+(CookingLoss/100)))/UnitEquivalent*UnitCost )*' . $Percent . '/100))/ r.StandardYield,2) cost,

round(((sum( (Portion*(1+(CookingLoss/100)))/UnitEquivalent*UnitCost ) +  (sum( (Portion*(1+(CookingLoss/100)))/UnitEquivalent*UnitCost )*' . $Percent . '/100))/ r.StandardYield)*100/r.PricePerServing,2) fc
from recipes r 
inner join association a on r.id = a.RecipeID
            inner join ingredients i on i.id = a.IngredientID
            where r.id = ?';
        $query = $this->db->query($sql, $recipeID);
        if ($query->num_rows() <= 0)
            return;
        $row   = $query->row();
        $FC    = $row->fc;
        $Cost  = $row->cost;
        $sql   = ' Update recipes set CostPerServing = ?, FC =? where id = ?';
        $query = $this->db->query($sql, array(
            $Cost,
            $FC,
            $recipeID
        ));
    }

    function add_recipe($uid, $createdby, $txtname, $preptime, $ssize, $syield, $txtprice, $txtproc, $typeid, $Merchandise, $Image, $instruction, $sunit)
    {

        $sql   = "select * from recipes where trim(RecipeName) = trim(?) and uid=?";
        $query = $this->db->query($sql, array(
            $txtname,
            $uid
        ));
        if ($query->num_rows() > 0) {
            return -2;
        }
        $this->db->trans_start();
        $percent  = $this->session->userdata('user_percent');
        $FC       = 0;
        $insertID = -1;
        try {
            $query    = $this->db->query('Insert Into recipes (
	sunit, 
	RecipeName,
	CategoryID, 
	StandardYield,
	ServingSize,
	PricePerServing,
	CostPerServing,
	FC,
	CookingProcedure,
	PreparationTime,
	CookingSpecifications,
	Image,
	uid,
	createdby, Deleted, DateCreated, DateModified )
	values(?,?,?,?,?,?,?,?,?,?,?,?,
	?,?,0,CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP())', array(
                $sunit,
                $txtname,
                $typeid,
                $syield,
                $ssize,
                $txtprice,
                0,
                0,
                $txtproc,
                $preptime,
                $instruction,
                $Image,
                $uid,
                $createdby
            ));
            $insertID = $this->db->insert_id();
            if ($insertID < 0) {
                $this->db->trans_rollback();
                return -1;
            }
            foreach ($Merchandise as $key => $item) {
                $this->db->query(' Insert into association (RecipeID, IngredientID, Portion) values(?,?,?)', array(
                    $insertID,
                    $item['merchid'],
                    $item['portion']
                ));
            }
            $this->Update_Cost_FC($insertID, $percent);
        }
        catch (Exception $ex) {
            $this->db->trans_rollback();
            return -1;
        }
        $this->db->trans_complete();
        return $insertID;
    }
    function edit_recipe($recipeid, $uid, $createdby, $txtname, $preptime, $ssize, $syield, $txtprice, $txtproc, $typeid, $Merchandise, $Image, $instruction, $sunit)
    {
        $sql   = "select * from recipes where trim(RecipeName) = trim(?) and uid=? AND ID != ?";
        $query = $this->db->query($sql, array(
            $txtname,
            $uid,
            $recipeid
        ));
        if ($query->num_rows() > 0) {
            return -2;
        }
        $this->db->trans_start();
        $insertID = $recipeid;
        $percent  = $this->session->userdata('user_percent');
        try {
            $query = $this->db->query('Update recipes set 
	sunit = ?,
	RecipeName = ?,
	CategoryID = ?, 
	StandardYield =?,
	ServingSize =?,
	PricePerServing =?,
	CostPerServing =?,
	FC =?,
	CookingProcedure =?,
	PreparationTime =?,
	CookingSpecifications =?,
	Image = ?,
	uid =?,
	createdby =?,
	DateModified=CURRENT_TIMESTAMP() where id = ? 
	', array(
                $sunit,
                $txtname,
                $typeid,
                $syield,
                $ssize,
                $txtprice,
                0,
                0,
                $txtproc,
                $preptime,
                $instruction,
                $Image,
                $uid,
                $createdby,
                $recipeid
            ));
            $this->db->query('delete from association where RecipeID = ?', $insertID);
            foreach ($Merchandise as $key => $item) {
                $this->db->query(' Insert into association (RecipeID, IngredientID, Portion) values(?,?,?)', array(
                    $insertID,
                    $item['merchid'],
                    $item['portion']
                ));
            }
            $this->Update_Cost_FC($insertID, $percent);
        }
        catch (Exception $ex) {
            $this->db->trans_rollback();
            return -1;
        }
        $this->db->trans_complete();
        return $this->db->insert_id();
    }
	
	function check_email($email)
    {
        $query = $this->db->query('select username, password, user_email from tbl_user t where trim(user_email) = trim(?)', array(
            $email
        ));
        if ($query->num_rows() > 0){
            $result = $query->result();
            return $result;
        }else{
            return false;    
        }
        
    }
	
    function check_username_email($username, $email)
    {
        $query = $this->db->query('select * from tbl_user t where trim(username) = trim(?)', array(
            $username
        ));
        if ($query->num_rows() > 0)
            return 1;
        $query = $this->db->query('select * from tbl_user t where trim(user_email) = trim(?)', array(
            $email
        ));
        if ($query->num_rows() > 0)
            return 2;
        return 0;
    }
    function Register_User($usertype, $parent, $username, $password, $user_email, $user_business, $item_number)
    {
        if ($usertype == 1) {
            $result    = (object) array(
                'price' => 0,
                'item' => '',
                'payid' => -10
            );
            $item_name = "";
            $mc_gross  = 0;
            $query     = $this->db->query('Select * From tbl_packages where pkid = ?', array(
                $item_number
            ));
            if ($query->num_rows() == 0) {
                return $result;
            }
            $row       = $query->row();
            $item_name = $row->packagename;
            $mc_gross  = $row->price;
            $this->db->query('truncate table tbl_payments');
            $query  = $this->db->query('Insert Into tbl_payments  (p_buyer_name, p_buyer_email, p_buyer_business, p_password, item_name, item_number, mc_gross, f_completed ) values(?,?,?,?,?,?,?,?)', array(
                $username,
                $user_email,
                $user_business,
                $password,
                $item_name,
                $item_number,
                $mc_gross,
                0
            ));
            $result = (object) array(
                'price' => $mc_gross,
                'item' => $item_name,
                'payid' => $this->db->insert_id()
            );
            return $result;
        }
        if ($usertype == 0) {
            $query = $this->db->query('Insert Into tbl_user (parent,usertype,username,password,user_email,user_business )
	values(?,?,?,?,?,?)', array(
                $parent,
                $usertype,
                $username,
                $password,
                $user_email,
                $user_business
            ));
            return $this->db->insert_id();
        }
    }
    function Get_Types($uid)
    {
        $query = $this->db->query('select * from types where uid = ? order by IngredientType', $uid);
        return $query;
    }
    function Get_Units($uid)
    {
        $query = $this->db->query('select * from units where uid = ? order by UnitOfMeasure', $uid);
        return $query;
    }
    function Get_umm($uid)
    {
        $query = $this->db->query('select * from unitms where uid = ? order by UnitOfMeasure', $uid);
        return $query;
    }
    function Get_Categories($uid)
    {
        $query = $this->db->query('select * from categories where uid = ? order by RecipeCategory', $uid);
        return $query;
    }
    function get_recipes($uid)
    {
        $query = $this->db->query('select r.*, c.RecipeCategory from recipes r inner join categories c on r.CategoryID  =c.ID where r.deleted=0 and r.uid = ? order by r.RecipeName ', $uid);
        return $query;
    }
    function get_merchandise($uid)
    {
        $query = $this->db->query('select t.IngredientType,i.* from ingredients i inner join types t on t.ID = i.TypeID and t.uid=i.uid where deleted=0 and i.uid = ? order by IngredientName ', $uid);
        return $query;
    }
    function update_merchandise($merchId, $IngredientName, $TypeID, $UnitEquivalent, $UnitOfMeasure, $ConvertedUnitOfMeasure, $UnitCost, $CookingLoss, $uid)
    {
        $sql   = "select * from ingredients where trim(IngredientName) = trim(?) and uid=? and ID != ?";
        $query = $this->db->query($sql, array(
            $IngredientName,
            $uid,
            $merchId
        ));
        if ($query->num_rows() > 0) {
            return -2;
        }
        try {
            $query = $this->db->query('Update ingredients set 
	IngredientName=?, TypeID = ?, 
	UnitEquivalent=?,
	UnitOfMeasure=?,
	ConvertedUnitOfMeasure=?,
	UnitCost=?,
	CookingLoss=? where ID = ?', array(
                $IngredientName,
                $TypeID,
                $UnitEquivalent,
                $UnitOfMeasure,
                $ConvertedUnitOfMeasure,
                $UnitCost,
                $CookingLoss,
                $merchId
            ));
        }
        catch (Exception $ex) {
            return 0;
        }
        return 1;
    }
    function add_merchandise($uid, $createdby, $IngredientName, $TypeID, $UnitEquivalent, $UnitOfMeasure, $ConvertedUnitOfMeasure, $UnitCost, $CookingLoss)
    {
        $sql   = "select * from ingredients where trim(IngredientName) = trim(?) and uid=?";
        $query = $this->db->query($sql, array(
            $IngredientName,
            $uid
        ));
        if ($query->num_rows() > 0) {
            return -2;
        }
        try {
            $query = $this->db->query('Insert Into ingredients ( 
	IngredientName,
	TypeID, 
	UnitEquivalent,
	UnitOfMeasure,
	ConvertedUnitOfMeasure,
	UnitCost,
	CookingLoss,
	uid,
	createdby, deleted, DateCreated, DateModified )
	values(?,?,?,?,?,?,?,?,?,0,CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP())', array(
                $IngredientName,
                $TypeID,
                $UnitEquivalent,
                $UnitOfMeasure,
                $ConvertedUnitOfMeasure,
                $UnitCost,
                $CookingLoss,
                $uid,
                $createdby
            ));
        }
        catch (Exception $ex) {
            return -1;
        }
        return $this->db->insert_id();
    }
    function del_merchandise($merchid)
    {
        $query = $this->db->query('update ingredients set deleted = 1 where id = ?', $merchid);
        return $this->db->affected_rows();
    }
    function del_recipe($recipeid)
    {
        $query = $this->db->query('update recipes set deleted = 1 where id = ?', $recipeid);
        return $this->db->affected_rows();
    }
	
	function updateRecipeCategories($user_id){
		$arr = array(
			"CHICKEN STIR FRY W/VEGGIES & NOODLES"=>"CHICKEN",
			"PORK PINAHAMONADO"=>"PORK",
			"BANGUS-TOFU SISIG"=>"SEAFOODS",
			"FISH ESCABECHE"=>"SEAFOODS",
			"PASTA BACON CARBONARA"=>"PASTA AND NOODLES",
			"TROPICAL HALO HALO"=>"DESSERT, PASTRIES",
			"BEEF NILAGA"=>"BEEF DISHES",
			"BARBECUE SAUCE"=>"SAUCES",
			"SOUTHERN FRIED CHICKEN DRUMSTICK"=>"CHICKEN",
			"BANANA TURON TOPPED W/ICE CREAM"=>"DESSERT, PASTRIES",
			"FISH FILLET IN MANGO-CILANTRO SALSA"=>"SEAFOODS",
			"PORK SISIG"=>"PORK"
		);
		
		foreach($arr as $recipe => $cat){
			$sql = "SELECT ID FROM categories WHERE RecipeCategory = '".$cat."' AND uid = ".$user_id;
			$cat = $this->db->query($sql);
			$cat_id = $cat->Row()->ID;
			
			$sql2= "UPDATE recipes SET CategoryID = '".$cat_id."' WHERE RecipeName='".$recipe."' AND uid=".$user_id;
			$this->db->query($sql2);
		}
	}
	
	function updateIngredientsType($user_id){
		$arr = array('BELL PEPPER GREEN'=>'VEGETABLE','BOK CHOY'=>'VEGETABLE','CORNSTARCH'=>'GROCERIES','FUSSILLI NOODLES (500GRAMS/PACK/SPIRAL)'=>'PASTA','GARLIC PEELED'=>'VEGETABLE','MUSHROOM BUTTON (200GRAMS/CN=DRAINED WT.)'=>'Canned/Bottle','ONION SPRING'=>'VEGETABLE','OYSTER SAUCE (PANDAN 907ML/BTL)'=>'GROCERIES','SALT ROCK'=>'GROCERIES','WINE,COOKING'=>'Canned/Bottle','YOUNG CORN'=>'VEGETABLE','CHICKEN WHOLE (1.1 TO 1.2KG/PC)'=>'CHICKEN','BELL PEPPER RED'=>'VEGETABLE','TENGA NG DAGA'=>'GROCERIES','SITSARO'=>'VEGETABLE','CARROTS'=>'VEGETABLE','CALAMANSI'=>'FRUITS','CILANTRO-WANSOY'=>'GROCERIES','CREAM DORY FILLET'=>'SEAFOODS','FLOUR -ALL PURPOSE'=>'BAKESHOP ITEMS','MANGO RIPE MED'=>'FRUITS','OLIVE OIL'=>'GROCERIES','ONION WHITE'=>'VEGETABLE','PEPPER BLACK (GROUND)'=>'GROCERIES','SALT ROCK IODIZED'=>'GROCERIES','SUGAR WHITE'=>'BAKESHOP ITEMS','TOMATO'=>'VEGETABLE','PICKLES WHOLE-RAM'=>'GROCERIES','PORK LIEMPO'=>'PORK','SALITRE'=>'GROCERIES','SUGAR BROWN'=>'GROCERIES','PINEAPPLE JUICE DM'=>'Canned/Bottle','PORK FAT'=>'PORK','PINEAPPLE CHUNKS DM'=>'GROCERIES','BUTTER UNSALTED ANCHOR'=>'Dairy','GINGER'=>'VEGETABLE','LIVER SPREAD'=>'GROCERIES','MAGIC SARAP'=>'GROCERIES','MAYONAISE B.F. WONDER MAYO'=>'GROCERIES','OIL,VEGETABLE'=>'Canned/Bottle','ONION RED'=>'VEGETABLE','PATIS'=>'GROCERIES','PORK MASKARA'=>'PORK','VINEGAR CANE'=>'Canned/Bottle','BANGUS BACK BONELESS'=>'SEAFOODS','COOKING OIL BAGUIO'=>'Canned/Bottle','EGG (LARGE)'=>'GROCERIES','SEASONING,KNORR'=>'Canned/Bottle','SILI LABUYO (CHILI HOT)'=>'VEGETABLE','SILI LONG 125GM'=>'VEGETABLE','SOY SAUCE DATU PUTI'=>'SEAFOODS','TOFU'=>'GROCERIES','VINEGAR DATU PUTI'=>'Canned/Bottle','DALAGANG BUKID-FISH'=>'SEAFOODS','SOY SAUCESILVER SWAN'=>'GROCERIES','STARCH MODIFIED'=>'BAKESHOP ITEMS','BACON SWIFT'=>'GROCERIES','BUTTER SALTED - MAGNOLIA'=>'GROCERIES','CHEESE CHEDDAR (MAGNOLIA)'=>'Dairy','CREAM-ALL PURPOSE 250G'=>'GROCERIES','MILK,EVAP-CARNATION'=>'GROCERIES','PARMESAN CHEESE'=>'Dairy','PARSLEY FRESH'=>'VEGETABLE','SPAGHETTI IDEAL 1K RAW'=>'PASTA','CALAMANSI JUICE'=>'GROCERIES','CAMOTE'=>'VEGETABLE','GULAMAN RED'=>'GROCERIES','ICE CRUSHED'=>'GROCERIES','MILK,EVAP-ALPINE'=>'GROCERIES','PANDAN LEAVES (77GRAMS'=>'VEGETABLE','PINEAPPLE TIDBITS 439G'=>'GROCERIES','PINIPIG'=>'GROCERIES','SABA MED,'=>'VEGETABLE','SAGO COOKED'=>'GROCERIES','BAGUIO BEANS'=>'VEGETABLE','BAGUIO PECHAY'=>'VEGETABLE','BEEF CUBE'=>'GROCERIES','CARABEEF'=>'BEEF','PEPPER BLACK WHOLE'=>'GROCERIES','POTATO'=>'VEGETABLE','CORN BABY'=>'VEGETABLE','CATSUP BANANA UFC'=>'Canned/Bottle','WORCESTERSHIRE SAUCE'=>'Canned/Bottle','HOT SAUCE UFC'=>'GROCERIES','CHICKEN DRUMSTICK'=>'CHICKEN','MODIFIED STARCH'=>'GROCERIES','LANGKA HINOG (MEAT ONLY)'=>'FRUITS','ICE CREAM MAGNOLIA'=>'GROCERIES');
		
		foreach($arr as $ing => $type){
			$sql = "SELECT ID FROM types WHERE IngredientType = '".$type."' AND uid = ".$user_id;
			$cat = $this->db->query($sql);
			$type_id = $cat->Row()->ID;
			
			$sql2= "UPDATE ingredients SET TypeID = '".$type_id."' WHERE IngredientName='".$ing."' AND uid=".$user_id;
			$this->db->query($sql2);
		}
	}
	
	function insertAssociation($user_id){
		
		$sql= "SELECT ID, IngredientName FROM ingredients WHERE uid=".$user_id;
		$result = $this->db->query($sql);
		$ingredients = $result->result();
		
		$arr_ingredients = array();
		foreach($ingredients as $val){
			$arr_ingredients[$val->ID] = $val->IngredientName;
		}
		
		$sql2 = "SELECT ID, RecipeName FROM recipes WHERE uid=".$user_id;
		$result = $this->db->query($sql2);
		$recipes = $result->result();
		
		$arr_recipes = array();
		
        $arr_recipes['CHICKEN STIR FRY W/ VEGGIES & NOODLES'] = array("25"=>"BELL PEPPER GREEN","30"=>"BOK CHOY","40"=>"CORNSTARCH","300"=>"FUSSILLI NOODLES (500GRAMS/PACK/SPIRAL)","10"=>"GARLIC PEELED","200"=>"MUSHROOM BUTTON (200GRAMS/CN=DRAINED WT.)","20"=>"ONION SPRING","30"=>"OYSTER SAUCE (PANDAN 907ML/BTL)","5"=>"SALT ROCK","15"=>"WINE,COOKING","300"=>"YOUNG CORN","700"=>"CHICKEN WHOLE (1.1 TO 1.2KG/PC)","50"=>"BELL PEPPER RED","25"=>"TENGA NG DAGA","200"=>"SITSARO","200"=>"CARROTS");
		
		$arr_recipes['FISH FILLET IN MANGO-CILANTRO SALSA'] = array("5"=>"BELL PEPPER GREEN","5"=>"BELL PEPPER RED","20"=>"CALAMANSI","5"=>"CILANTRO-WANSOY","1000"=>"CREAM DORY FILLET","20"=>"FLOUR-ALL PURPOSE","10"=>"GARLIC PEELED","1"=>"MANGO RIPE MED","2"=>"OLIVE OIL","10"=>"ONION WHITE","3"=>"PEPPER BLACK (GROUND)","5"=>"SALT ROCK IODIZED","2"=>"SUGAR WHITE","50"=>"TOMATO");
		
		$arr_recipes['PORK PINAHAMONADO'] = array("100"=>"CARROTS","13"=>"CORNSTARCH","20"=>"PICKLES WHOLE-RAM","700"=>"PORK LIEMPO","5"=>"SALITRE","10"=>"SALT ROCK IODIZED","100"=>"SUGAR BROWN","120"=>"PINEAPPLE JUICE DM","150"=>"PORK FAT","200"=>"PINEAPPLE CHUNKS DM");
		
		$arr_recipes['PORK SISIG'] = array("40"=>"BELL PEPPER GREEN","120"=>"BUTTER UNSALTED ANCHOR","30"=>"CALAMANSI","15"=>"GINGER","150"=>"LIVER SPREAD","5"=>"MAGIC SARAP","120"=>"MAYONAISE B.F. WONDER MAYO","60"=>"OIL,VEGETABLE","40"=>"ONION RED","100"=>"PATIS","1000"=>"PORK MASKARA","200"=>"VINEGAR CANE");
		
		$arr_recipes['BANGUS-TOFU SISIG'] = array("10"=>"BANGUS BACK BONELESS","150"=>"CALAMANSI","30"=>"COOKING OIL BAGUIO","1"=>"EGG (LARGE)","20"=>"GINGER","100"=>"MAYONAISE B.F. WONDER MAYO","45"=>"ONION RED","1"=>"PEPPER BLACK (GROUND)","5"=>"SALT ROCK IODIZED","5"=>"SEASONING,KNORR","3"=>"SILI LABUYO (CHILI HOT)","30"=>"SILI LONG 125GM","30"=>"SOY SAUCE DATU PUTI","15"=>"SUGAR BROWN","120"=>"TOFU","200"=>"VINEGAR DATU PUTI");
		
		$arr_recipes['PASTA BACON CARBONARA'] = array("100"=>"BACON SWIFT","30"=>"BUTTER SALTED - MAGNOLIA","100"=>"CHEESE CHEDDAR (MAGNOLIA)","200"=>"CREAM-ALL PURPOSE 250G","2"=>"EGG (LARGE)","200"=>"MILK,EVAP-CARNATION","200"=>"MUSHROOM BUTTON (200GRAMS/CN=DRAINED WT.)","60"=>"PARMESAN CHEESE","20"=>"PARSLEY FRESH","1000"=>"SPAGHETTI IDEAL 1K RAW");
		
		$arr_recipes['TROPICAL HALO HALO'] = array("2"=>"CALAMANSI JUICE","200"=>"CAMOTE","1"=>"GULAMAN RED","800"=>"ICE CRUSHED","120"=>"MILK,EVAP-ALPINE","3"=>"PANDAN LEAVES (77GRAMS","227"=>"PINEAPPLE TIDBITS 439G","120"=>"PINIPIG","4"=>"SABA MED","240"=>"SAGO COOKED","120"=>"SUGAR WHITE");
		
		$arr_recipes['BEEF NILAGA'] = array("100"=>"BAGUIO BEANS","200"=>"BAGUIO PECHAY","1"=>"BEEF CUBE","800"=>"CARABEEF","10"=>"GARLIC PEELED","30"=>"ONION RED","30"=>"PATIS","1"=>"PEPPER BLACK WHOLE","200"=>"POTATO","14"=>"SALT ROCK IODIZED","200"=>"CORN BABY");
		
		$arr_recipes['BARBECUE SAUCE'] = array("30"=>"ONION WHITE","100"=>"CATSUP BANANA UFC","60"=>"WORCESTERSHIRE SAUCE","20"=>"SUGAR BROWN","20"=>"SUGAR WHITE","30"=>"VINEGAR DATU PUTI","1"=>"HOT SAUCE UFC");
		
		$arr_recipes['SOUTHERN FRIED CHICKEN DRUMSTICK'] = array("100"=>"CHICKEN DRUMSTICK","2"=>"EGG (LARGE)","120"=>"FLOUR-ALL PURPOSE","80"=>"MILK,EVAP-ALPINE","1"=>"MODIFIED STARCH","120"=>"OIL,VEGETABLE","5"=>"PEPPER BLACK (GROUND)","5"=>"SALT ROCK");
		
		$arr_recipes['BANANA TURON TOPPED W/ ICE CREAM'] = array("5"=>"SABA MED","60"=>"SUGAR BROWN","30"=>"LANGKA HINOG (MEAT ONLY)","120"=>"COOKING OIL BAGUIO","300"=>"ICE CREAM MAGNOLIA");
		
		$arr_recipes['FISH ESCABECHE'] = array("71"=>"CARROTS","10"=>"DALAGANG BUKID-FISH","1"=>"EGG (LARGE)","60"=>"FLOUR-ALL PURPOSE","5"=>"SALT ROCK IODIZED","120"=>"SOY SAUCESILVER SWAN","30"=>"STARCH MODIFIED","30"=>"SUGAR BROWN","120"=>"VINEGAR DATU PUTI");
		
		
		foreach($recipes as $res){
			$recipe_id = $res->ID;
			$recipe_ings = $arr_recipes[$res->RecipeName];
			
			foreach($recipe_ings as $portion => $ingname){
				$ingredient_id = array_search($ingname, $arr_ingredients);
			
				$sql3 = "INSERT INTO association (RecipeID, IngredientID, Portion) VALUE ($recipe_id,$ingredient_id,$portion)";
				$result = $this->db->query($sql3);
			}
		}
	}
}
?>