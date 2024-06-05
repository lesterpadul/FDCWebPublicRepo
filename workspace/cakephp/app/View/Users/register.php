<?php echo $this->Form->create('User', array('action' => 'register')); ?>
<fieldset>
    <legend><?php echo __('Register'); ?></legend>
    <?php echo $this->Form->input('username'); ?>
    <?php echo $this->Form->input('password'); ?>
</fieldset>
<?php echo $this->Form->end(__('Register')); ?>
