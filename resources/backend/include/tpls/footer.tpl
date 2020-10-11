

</div>



{include file=$relatemodal}


<audio  id="notificationelement" style="display:none">
	  <source src="{$fwbaseurl}resources/backend/modules/chat/assets/sounds/juntos-607.ogg" type="audio/ogg">
	  <source src="{$fwbaseurl}resources/backend/modules/chat/assets/sounds/juntos-607.mp3" type="audio/mpeg">
	  Your browser does not support the audio element.
</audio>
<script src="{$fwbaseurl}resources/backend/assets/js/jquery-ui.js"></script>
<script src="{$fwbaseurl}resources/backend/assets/js/bootstrap.min.js"></script>
<script src="{$fwbaseurl}resources/backend/assets/js/moment-with-locales.js"></script>
<script src="{$fwbaseurl}resources/backend/assets/js/bootstrap-datetimepicker.js"></script>

<script src="{$fwbaseurl}resources/backend/assets/js/custom.js?v=1"></script>
<script src="{$fwbaseurl}libs/assets/js/notification.js?v=1"></script>

<script src="{$fwbaseurl}resources/backend/assets/editor/editor.js?v=1"></script>
{if $showchatContainer}
<script type="text/javascript" src="{$fwbaseurl}modules/chat/assets/js/alternativlabslivechat.js?v=2"></script>
{/if}


</body>
</html>