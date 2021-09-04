
{if $params.title}
<h4 class="heading text-purple font-weight-bold">{$params.title}</h4>
<hr />

{/if}
<span class="hide" id="chartjson">{$params.dataset}</span>
<canvas id="myChart" width="400" height="400"></canvas>


