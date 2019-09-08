<div class="container-fluid margin-top-10"> 

  <form  id ="form" name="editview"  method="post"  action="index.php?module=user&action=getNewpwd"  enctype="multipart/form-data" >
    <div  class="panel panel-info" >
      <div  class="panel-heading" >Users | Change Password</div>
        <div  class="panel-body" >
          <div  class="form-group" >
            <div  class="row" >
              <div  class="col-md-6" >
                <div  class="input-group" ><span  class="input-group-addon" >Name</span><input  id="name"  name="name"  type="text"  value="{$changepwd.user_name}"  class="form-control"  />
                </div>
              </div>
</div>
</div>
<div  class="form-group" >
<div  class="row" >
<div  class="col-md-12" >
<div  class="input-group" ><span  class="input-group-addon" >Description</span>
<textarea  id="description"  name="description"  class="form-control" ></textarea>
</div>
</div>
</div>
</div>



<div  class="row" >

<div  class="col-md-6" >
<div  class="form-group" >
<div  class="input-group" ><span  class="input-group-addon" >New Password</span>
<input  id="user_hash_new"  name="user_hash_new"  type="text"  value=""  class="form-control"  />
</div>
</div>

</div>


<div  class="col-md-6" >
<div  class="form-group" >
<div  class="input-group" ><span  class="input-group-addon" >Confirm Password</span>
<input  id="confirm_user_hash"  name="confirm_user_hash"  type="text"  value=""  class="form-control"  />
</div>
</div>
</div>
</div>



<input id="pwdid" name="id"  value="{$changepwd.id}"  type="hidden" >
</input>
</div>
<div  class="panel-footer" >
<button id="btn" class="btn btn-primary pull-right" onclick="return checkpwd()">Save</button>
<div class="clearfix">
</div>
</div>
</div>
</form>

</div>
<script
	src="modules/user/assets/js/custom.js"></script>
