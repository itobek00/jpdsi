{extends file="main.tpl"}

{block name=content}

<div class="pure-menu pure-menu-horizontal bottom-margin">
	<a href="{$conf->action_url}logout"  class="pure-menu-heading pure-menu-link">wyloguj</a>
	<span style="float:right;">użytkownik: {$user->login}, rola: {$user->role}</span>
</div>

<form action="{$conf->action_url}calcCompute" method="post" class="pure-form pure-form-aligned bottom-margin">
	<legend>Kalkulator ratalny</legend>
	<fieldset>
        <div class="pure-control-group">
			<label for="id_amount">Kwota kredytu: </label>
			<input id="id_amount" type="text" name="amount" placeholder="np. 3000 (zł)" value="{$form->amount}" /> zł<br />
		</div>
        <div class="pure-control-group">
			<label for="id_percentage">Oprocentowanie: </label>
			<input id="id_percentage" type="text" name="percentage" placeholder="np. 3.5 (%)" value="{$form->percentage}" /> %<br />
		</div>
        <div class="pure-control-group">
			<label for="id_time">Na ile lat: </label>
			<input id="id_time" type="text" name="time" placeholder="np. 10 (lat)" value="{$form->time}" /> lat<br />
		</div>
		<div class="pure-controls">
			{if $user->role == "admin"}
			<input type="submit" value="Oblicz" class="pure-button pure-button-primary"/>
			{/if}
		</div>
	</fieldset>
</form>	

{include file='messages.tpl'}

{if isset($res->result)}
<div class="messages info">
	Wynik: {$res->result}
</div>
{/if}

{/block}