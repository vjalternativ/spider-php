<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        {$params.title}
      </a>
      <div class="dropdown-menu">
      	{foreach from=$params.items key=key item=menu}
        <a class="dropdown-item" 
        	{foreach from=$menu.attr key=attrkey item=attrval}
        		{$attrkey}="{$attrval}"
        	{/foreach} 
         >{$menu.title}</a>
        {/foreach}
   	</div>