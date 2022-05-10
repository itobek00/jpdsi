<?php
/* Smarty version 3.1.30, created on 2022-05-10 05:43:26
  from "C:\xampp\htdocs\php_08_bd\app\views\PersonEdit.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6279df5e364e06_18922575',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e10f26fa833393ad711c6dcfab1e9b753df05b2e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\php_08_bd\\app\\views\\PersonEdit.tpl',
      1 => 1650983642,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
  ),
),false)) {
function content_6279df5e364e06_18922575 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17289367486279df5e3648b4_31388083', 'top');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'top'} */
class Block_17289367486279df5e3648b4_31388083 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="bottom-margin">
<form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
personSave" method="post" class="pure-form pure-form-aligned">
	<fieldset>
		<legend>Dane osoby</legend>
		<div class="pure-control-group">
            <label for="sum">Wartosc</label>
            <input id="sum" type="text" placeholder="Wartość" name="sum" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->name;?>
">
        </div>
		<div class="pure-control-group">
            <label for="period">Lata</label>
            <input id="period" type="text" placeholder="Lata" name="period" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->surname;?>
">
        </div>
		<div class="pure-control-group">
            <label for="percent">Procent</label>
            <input id="percent" type="text" placeholder="Procent" name="percent" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->birthdate;?>
">
        </div>
		<div class="pure-controls">
			<input type="submit" class="pure-button pure-button-primary" value="Zapisz"/>
			<a class="pure-button button-secondary" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
personList">Powrót</a>
		</div>
	</fieldset>
    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->id;?>
">
</form>	
</div>

<?php
}
}
/* {/block 'top'} */
}
