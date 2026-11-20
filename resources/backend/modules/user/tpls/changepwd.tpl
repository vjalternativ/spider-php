<div class="container-fluid margin-top-10">

  <form  id ="form" name="editview"  method="post"  action="index.php?module=user&action=getNewpwd"  enctype="multipart/form-data" >
    <div  class="panel panel-info" >
      <div  class="panel-heading" >Users | Change Password</div>
        <div  class="panel-body" >
{if $success}
{$bs.alert.success} {$success.msg} {$bs.close}
{/if}
{if $error}
{$bs.alert.danger} {$error.msg} {$bs.close}
{/if}
          <div  class="form-group" >
            <div  class="row" >
              <div  class="col-md-6" >
                <div  class="input-group" ><span  class="input-group-addon" >Username</span>
                  <input  id="user_name"  type="text"  value="{$changepwd.user_name|escape}"  class="form-control"  readonly="readonly"  tabindex="-1"  />
                </div>
              </div>
              <div  class="col-md-6" >
                <div  class="input-group" ><span  class="input-group-addon" >Name</span>
                  <input  id="name"  type="text"  value="{$changepwd.name|escape}"  class="form-control"  readonly="readonly"  tabindex="-1"  />
                </div>
              </div>
            </div>
          </div>
<div  class="form-group" >
<div  class="row" >
<div  class="col-md-12" >
<div  class="input-group" ><span  class="input-group-addon" >Description</span>
<textarea  id="description"  class="form-control"  readonly="readonly"  tabindex="-1" >{$changepwd.description|escape}</textarea>
</div>
</div>
</div>
</div>



<div  class="row" >

<div  class="col-md-6" >
<div  class="form-group" >
<div  class="input-group" ><span  class="input-group-addon" >New Password</span>
<input  id="user_hash_new"  name="user_hash_new"  type="password"  autocomplete="new-password"  value=""  class="form-control"  />
</div>
</div>

</div>


<div  class="col-md-6" >
<div  class="form-group" >
<div  class="input-group" ><span  class="input-group-addon" >Confirm Password</span>
<input  id="confirm_user_hash"  name="confirm_user_hash"  type="password"  autocomplete="new-password"  value=""  class="form-control"  />
</div>
</div>
</div>
</div>



<input id="pwdid" name="id"  value="{$changepwd.id|escape}"  type="hidden" >
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
