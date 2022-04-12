{extends file="main.tpl"}
{* przy zdefiniowanych folderach nie trzeba już podawać pełnej ścieżki *}

{block name=footer}przykładowa tresć stopki wpisana do szablonu głównego z szablonu kalkulatora{/block}

{block name=content}

<h3>Kalkulator ratalny</h2>


<form class="pure-form pure-form-stacked" action="{$conf->action_root}calcCompute" method="post">
	<fieldset>
		<label for="id_amount">Kwota kredytu: </label>
		<input id="id_amount" type="text" name="amount" placeholder="np. 30000 (zł)" value="{$form->amount}" /> <br />
		<label for="id_percentage">Oprocentowanie: </label>
		<input id="id_percentage" type="text" name="percentage" placeholder="np. 3.5 (%)" value="{$form->percentage}" /> <br />
		<label for="id_time">Na ile lat: </label>
		<input id="id_time" type="text" name="time" placeholder="np. 10 (lat)" value="{$form->time}" /> <br />
		</fieldset>	
		<input type="submit" value="Oblicz" class="pure-button pure-button-primary" />
</form>	

<div class="messages">

{* wyświeltenie listy błędów, jeśli istnieją *}
{if $msgs->isError()}
	<h4>Wystąpiły błędy: </h4>
	<ol class="err">
	{foreach $msgs->getErrors() as $err}
	{strip}
		<li>{$err}</li>
	{/strip}
	{/foreach}
	</ol>
{/if}

{* wyświeltenie listy informacji, jeśli istnieją *}
{if $msgs->isInfo()}
	<h4>Informacje: </h4>
	<ol class="inf">
	{foreach $msgs->getInfos() as $inf}
	{strip}
		<li>{$inf}</li>
	{/strip}
	{/foreach}
	</ol>
{/if}

{if isset($res->result)}
	<h4>Wynik</h4>
	<p class="res">
	{$res->result}
	</p>
{/if}

</div>

{/block}