<?php echo $this->Form->create('User', array('action' => 'login')); ?>
<fieldset>
    <legend><?php echo __('Please enter your username and password'); ?></legend>
    <?php echo $this->Form->input('username'); ?>
    <?php echo $this->Form->input('password'); ?>
</fieldset>
<?php echo $this->Form->end(__('Login')); ?>
