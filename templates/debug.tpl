<p style="padding-top: 60px;">
<div class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab1" data-toggle="tab">Deaktiviert</a></li>
		<li><a href="#tab2" data-toggle="tab">Komplett</a></li>
		<li><a href="#tab3" data-toggle="tab">Gegenst&auml;nde</a></li>
		<li><a href="#tab4" data-toggle="tab">Basiswerte</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tab1">
			<pre></pre>
		</div>
		<div class="tab-pane" id="tab2">
			<pre>{$char|@print_r}</pre>
		</div>
		<div class="tab-pane" id="tab3">
			<pre>{$char['items']|@print_r}</pre>
		</div>
		<div class="tab-pane" id="tab4">
			<pre>{print_r($char['stats'])}</pre>
		</div>
	</div>
</div>
</p>
