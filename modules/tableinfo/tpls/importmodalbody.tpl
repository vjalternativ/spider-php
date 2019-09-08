

<div class="well well-sm">
        			| 
        			{foreach from=$columns item=item key=key}
        				 {$item} |
        			{/foreach}
        	</div>
        	
        	
        	<div class="well well-sm">
        		<input type="hidden" name="importmodule" value="page_component" />
        		<input type="file" id="{$uploaderid}" name="{$uploadername}" />
        		
        	</div>
        	
        	
        	<div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
    </div>
    