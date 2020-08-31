<html>
<head>

<link rel="stylesheet"
	href="{$baseurl}include/vjlib/assets/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" href="{$baseurl}modules/chat/assets/css/chat.css" />
<script src="{$baseurl}include/vjlib/assets/js/jquery-3.1.1.min.js"></script>
<script src="{$baseurl}include/lib/js/jquery/jquery.validate.min.js"></script>

<script>
	var baseurl = '{$baseurl}';
</script>

{if $is_agent_livechat}

<script>
	var isAgentLiveChat = true;
</script>
{else}
<script>
	var isAgentLiveChat = false;
</script>
{/if}



</head>

<body>


	<div class="panel panel-danger {if $is_agent_livechat} hide {/if}"
		id="alternativlabs-chatpanel">
		<div class="panel-heading" {if $is_agent_livechat} {else}onclick="openchat()"{/if}>
			<div class="row">
				<div class="col-xs-12">
					<b class="h4 heading"> {$heading} </b> 
					
					{if $is_agent_livechat} {else}
					<span
						id="chatmaximize" class="glyphicon glyphicon-plus pull-right"></span>
					{/if}
					<div class="clearfix"></div>
					<span class="h4 heading hide">Online Users : <span
						id="onlineusers">0</span></span>

				</div>

			</div>

		</div>
		<div class="panel-body hide" id="chat-panel-body">

			<div id="alternativlabs-chatform-panelbody" class="row">
				<form action="#"  id="chat_connnect_form">
			
				<div class="col-md-12">
					<div class="form-group">
						<input class="form-control" type="text" required name="name"
							placeholder="Name:" aria-required="true" />
					</div>
					<div class="form-group">
						<input class="form-control" type="text" name="email"
							placeholder="Email:" required />
					</div>
					<div class="form-group">
						<input class="form-control" required type="text" name="contact"
							placeholder="Contact Number:" />
					</div>
					<div class="form-group">
						<textarea class="form-control" required name="message" placeholder="message:"></textarea>
					</div>
				</div>
				</form>
			</div>

			<div class="row hide" id="alternativlabs-chatbody">
				<div class="col-md-12">
					<div class="well well-sm chathistory" id="stchathistory"></div>
					<hr />
					<textarea class="form-control" id="stmsgbox" disabled="disabled"
						value=""></textarea>


					
				</div>
			</div>





		</div>


		<div id="alternativlabs-chatform-panelfooter"
			class="panel-footer hide">
		
		
			<div  class="row">
				<div class="col-xs-4">
					<div class="form-group hide" id="entertosend">
							<div class="input-group">
								<div class="input-group-addon">
									<input type="checkbox" value="true">
								</div>
								<div class="form-control">Enter</div>
							</div>
						</div>
				</div>
			<div class="col-xs-8">
			<div class="form-group pull-right">

				<button class="btn btn-primary pull-right" id="stconnectbtn"
					onclick="onUserConnect()" type="button">Connect</button>
				<button class="btn btn-success" id="stsendbtn" onclick="onSend()"
					style="display: none" type="button">Send</button>
				<button class="btn btn-danger" id="stdisconnectbtn"
					onclick="onDisconnect()" style="display: none" type="button">Disconnect</button>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		
			</div>
			
		</div>
		
		
		

		</div>


	</div>
	<script src="{$fwbaseurl}modules/chat/assets/js/xhrchat.js?v=61"></script>
 
</body>
</html>

