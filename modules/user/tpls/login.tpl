
<div class="jumbotron">
{$bs.rowopen}
{$bs.cols.off.6.3}
<form method="post" action="index.php?module=user&action=authenticate">

{$bs.panel.open.info}
{$bs.panel.headopen}
  <span class="h3">Login</span>      

{$bs.close}

{$bs.panel.bodyopen}

{if $error}
{$bs.alert.danger} {$error.msg} {$bs.close}
{/if}
<div class="form-group">
<input class="form-control" type="text" placeholder="Username" name="username" />
</div>

<div class="form-group">
<input class="form-control" type="password" name="password" placeholder="Password" />
</div>
</form>


{$bs.close}
{$bs.panel.footopen}
<button class="btn btn-primary pull-right" type="submit">
Login
</button>
<div class="clearfix" />


{$bs.panel.footclose}
</form>

{$bs.close}
{$bs.close}
