
function checkpwd(){
	
	var user=document.getElementById('user_hash_new').value;	
//alert(user);	
	var user_confirm=document.getElementById('confirm_user_hash').value;
	
	var pwdid=document.getElementById('pwdid').value
//alert(user_confirm);
	//var url="index.php?module=user&action=getNewpwd";
	
	if(user == user_confirm){
		//var url="./index.php?module=user&action=getAjaxtNewpwd&new="+user+"&pwdi="+pwdid";
		//document.getElementById("form").submit();
		//$.post(url);
		//alert("Password not matched")
		return true;
	}else {
		alert("Password not matched");
		return false;
	}
}
