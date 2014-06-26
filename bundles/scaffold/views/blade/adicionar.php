<script type="text/javascript">
$(document).ready(function () {
  // focus on the first text input field in the first field on the page
  $("input[type='text']:first", document.forms[0]).focus();
});
</script>
<?php foreach ($fields as $field => $type): ?>
<?php if ($type == 'date'): ?>
<script>
$(function() {
  $( "#<?php echo $field; ?>" ).datepicker();
});
</script>	
<?php endif ?>
<?php $tabindex = 1; ?>
<?php endforeach ?>
<div class="span12">
  <h3>Adicionando <?php echo str_replace('_', ' ', $singular_class); ?></h3>
	{{ Form::open(null, 'post', array('class' => 'form-horizontal', 'autocomplete' => 'off')) }}
<?php foreach($fields as $field => $type): ?>
  <div class="control-group">
    <label class="control-label" for="<?php echo $field; ?>"><?php echo ucwords(str_replace('_', ' ', $field)); ?></label>
    <div class="controls">
<?php if(strpos($field, '_id') !== false && in_array(substr($field, 0, -3), $belongs_to)): ?>
					{{ Form::select('<?php echo $field; ?>', $<?php echo substr($field, 0, -3); ?>, '', array('placeholder' => '<?php echo ucwords(str_replace('_', ' ', $field)); ?>', 'id' => '<?php echo $field; ?>', 'required' => 'required', 'tabindex' => <?php echo $tabindex++; ?>)) }}
<?php else: ?>
<?php if(in_array($type, array('string', 'integer', 'float', 'date', 'time', 'timestamp'))): ?>
					{{ Form::text('<?php echo $field; ?>', Input::old('<?php echo $field; ?>'), array('placeholder' => '<?php echo ucwords(str_replace('_', ' ', $field)); ?>', 'id' => '<?php echo $field; ?>', 'required' => 'required', 'tabindex' => <?php echo $tabindex++; ?>)) }}
<?php elseif($type == 'boolean'): ?>
					{{ Form::checkbox('<?php echo $field; ?>', '1', Input::old('<?php echo $field; ?>'), array('tabindex' => <?php echo $tabindex++; ?>))  }}
<?php elseif($type == 'text' || $type == 'blob'): ?>
					{{ Form::textarea('<?php echo $field; ?>', Input::old('<?php echo $field; ?>'), array('placeholder' => '<?php echo ucwords(str_replace('_', ' ', $field)); ?>', 'id' => '<?php echo $field; ?>', 'required' => 'required', 'tabindex' => <?php echo $tabindex++; ?>)) }}
<?php endif; ?>
<?php endif; ?>
					{{ $errors->first('<?php echo $field; ?>') }}
    </div>
  </div>
<?php endforeach; ?>
  <div class="control-group">
    <div class="controls">
      {{ Form::submit('Adicionar', array('class' => 'btn btn-primary', 'tabindex' => <?php echo $tabindex++; ?>)) }}
      {{ HTML::link('<?php echo $nested_path.$plural; ?>', 'Cancelar', array('class' => 'btn','tabindex' => <?php echo $tabindex++; ?>) ) }}
    </div>
  </div>
	{{ Form::close()}}
</div>