{if $params.showheaderfooter}
<input type="hidden" id="room_id" value="{$params.room_id}" />
<input type="hidden" id="member_id" value="{$params.member_id}" />
<link rel="stylesheet" href="{$fwbaseurl}resources/backend/modules/chat/assets/css/chat.css" />
{else}
<html>
<head>

<link rel="stylesheet"
	href="{$fwbaseurl}resources/backend/assets/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" href="{$fwbaseurl}resources/backend/modules/chat/assets/css/chat.css" />
<script src="{$fwbaseurl}resources/backend/assets/js/jquery-3.1.1.min.js"></script>
<script src="{$fwbaseurl}resources/backend/include/lib/js/jquery/jquery.validate.min.js"></script>
<script>var resource="frontend";</script>
	 
 



</head>

<body>


{/if}

<script>
	var baseurl = '{$baseurl}';
	var fwbaseurl = '{$fwbaseurl}';
</script>

{if $params.is_agent_livechat}
 
<script>
	var isAgentLiveChat = true;
</script>
{else}
<script>
	var isAgentLiveChat = false;
</script>
{/if}

	<div class="panel panel-danger "
		id="alternativlabs-chatpanel">
		<div class="panel-heading" {if $params.is_agent_livechat} {else}onclick="openchat()"{/if}>
			<div class="row">
				<div class="col-xs-12">
					<b class="h4 heading"> {$heading} </b> 
					
					{if $params.is_agent_livechat} {else}
					<span
						id="chatmaximize" class="glyphicon glyphicon-plus pull-right"></span>
					{/if}
					<div class="clearfix"></div>
					<span class="h4 heading hide">Online Users : <span
						id="onlineusers">0</span></span>

				</div>

			</div>

		</div>
		<div class="panel-body {if !$params.is_agent_livechat}hide{/if}" id="chat-panel-body">
			
			{if $params.is_agent_livechat}
				{$params.chatroom.description}
				<hr />
			{/if}
			<div id="alternativlabs-chatform-panelbody" class="row {if $params.is_agent_livechat}hide{/if}">
			
			
			
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

			<div class="row {if !$params.is_agent_livechat}hide{/if}" id="alternativlabs-chatbody">
				<div class="col-md-12">
					<div class="well well-sm chathistory" id="stchathistory"></div>
					<hr />
					<textarea class="form-control" id="stmsgbox" {if !$params.is_agent_livechat}disabled="disabled"{/if}
						value=""></textarea>


					
				</div>
			</div>





		</div>


		<div id="alternativlabs-chatform-panelfooter"
			class="panel-footer {if !$params.is_agent_livechat}hide{/if}">
		
		
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


				<button class="btn btn-primary pull-right {if $params.is_agent_livechat}hide{/if}" id="stconnectbtn"
					onclick="onUserConnect()" type="button">Connect</button>
				<button class="btn btn-success {if !$params.is_agent_livechat}hide{/if}" id="stsendbtn" onclick="onSend()"
					 type="button">Send</button>
				<button class="btn btn-danger {if !$params.is_agent_livechat}hide{/if}" id="stdisconnectbtn"
					onclick="onDisconnect()"  type="button">Disconnect</button>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		
			</div>
			
		</div>
		
		
		

		</div>


	</div>
	
	 	 
	
 {if !$params.showheaderfooter} 
 	<script src="{$fwbaseurl}libs/assets/js/lib_desktopnotification.js?v=1"></script>	
 	<script src="{$fwbaseurl}resources/backend/modules/notification/assets/js/notificationdispatcher.js?v=1"></script>	 
 {/if}	
	<script src="{$fwbaseurl}resources/backend/modules/chat/assets/js/frontend/chat-ui-handler.js?v=61"></script>
	<script src="{$fwbaseurl}resources/backend/modules/chat/assets/js/xhrchat.js?v=62"></script>
 {if !$params.showheaderfooter}
</body>
</html>

{/if}

